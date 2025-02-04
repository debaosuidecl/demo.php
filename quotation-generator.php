<?php
session_start();
include_once "setdb.php";
if(!isset($_SESSION['first_name'])){
  header("Location: ./auth/signin-auth/signin?redirect=invgen");
}
$tableExists = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'rymmy2sz9p65xc6f' AND table_name = 'quotationdetails'";
  $tableExistQueryResult = mysqli_query($conn, $tableExists);
    $table = mysqli_fetch_all($tableExistQueryResult, MYSQLI_ASSOC);
    $counter = $table[0]['COUNT(*)'];
    // echo $counter;
    if($counter == 0){
      $sqlinvoicedetails = "CREATE TABLE quotationdetails (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            invoiceIdentifier VARCHAR(50),
            user_identification INT(8),
            pickedColor VARCHAR(50),
            invoiceTitle VARCHAR(30),
            fromNameInvoice VARCHAR(30),
            fromEmailInvoice VARCHAR(50),
            address1FromInvoice VARCHAR(50),
            phoneFromInvoice VARCHAR(50),
            refNumberFromInvoice VARCHAR(50),
            dateFromInvoice VARCHAR(50),
            termsFromInvoice VARCHAR(50),
            clientNameFromInvoice VARCHAR(50),
            clientEmailFromInvoice VARCHAR(50),
            clientAddressFromInvoice VARCHAR(50),
            paymentInstructionsAddNotes VARCHAR(50),
            typeTaxInvoice VARCHAR(50),
            discountInvoice VARCHAR(50),
            myPercent INT(6),
            amountDiscount INT(6),
            myPercentDiscount INT(6),
            currencyContInvoice VARCHAR(50),
            taxValue INT(6),
            discount INT(6),
            subTotal INT(6),
            balance INT(6))";
              if ($conn->query($sqlinvoicedetails) === TRUE) {
                  //  echo "Table invoice details created successfully";
                } else {
                echo "Error creating table: " . $conn->error;
                exit;
              }

           }

           $producteachExists = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'rymmy2sz9p65xc6f' 
           AND table_name = 'quotationproducteach'";
             $producteachExistQueryResult = mysqli_query($conn, $producteachExists);
              $productEach = mysqli_fetch_all($producteachExistQueryResult, MYSQLI_ASSOC);
               $mycounter = $productEach[0]['COUNT(*)'];
              //  print_r($productEach);
              //  echo '  producteach';

            if($mycounter == 0){
            $producteachQuotation = "CREATE TABLE quotationproducteach (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_identification INT(8),
            description VARCHAR(50),
            invoiceIdentifier VARCHAR(50),
            descriptionRowInvoiceId VARCHAR(50),
            priceInvoice INT(6),
            qtyInvoice INT(6),
            amountPerItem INT(6)
          )";
             if ($conn->query($producteachQuotation) === TRUE) {
                   echo "Table product each details created successfully";
                } else {
                echo "Error creating product each table: " . $conn->error;
                exit;
              }
       }

       $user_identification = (float)$_SESSION['user_identification'];

       $sqlGetInvoiceDetails = "SELECT * FROM quotationdetails WHERE user_identification=$user_identification";
       $queryGetInvoiceDetails = mysqli_query($conn, $sqlGetInvoiceDetails);
       //get result
       $GetInvoiceDetails = mysqli_fetch_all($queryGetInvoiceDetails, MYSQLI_ASSOC);
       // print_r($GetInvoiceDetails);
       
?>














<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link href="./fontawesome-free-5.9.0-web/css/fontawesome.css" rel="stylesheet">
      <link href="./fontawesome-free-5.9.0-web/css/brands.css" rel="stylesheet">
  <link href="./fontawesome-free-5.9.0-web/css/solid.css" rel="stylesheet">
  <link href="./fontawesome-free-5.9.0-web/css/all.css" rel="stylesheet">
      <link rel="stylesheet" href="indexstyle.css">
  <title>Invoice Generator</title>
</head>
<body>
<?php require("loader.php") ?>
<nav id="nav">
    <div><a href="#">
        <h1 style="align-self: left" class="logo">Logo</h1>
      </a></div>
    <div id="toggler" onclick="toggleHandler()">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <ul class="forDesktop">
  
      <li style="position: relative;"><a class="active" data-ref="fixit" href="./index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./invoice-generator">Invoices<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a  id="contactnav"data-ref="quotations" href="./quotation-generator">Quotations<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a  id="contactnav"data-ref="quotations" href="./settings">Settings<div class="activeslider"></div></a></li>
      <?php if(isset($_SESSION['first_name'])){?>
 <li>  <a href="index"> <i class="fas fa-user" style="margin-right: 10px;"></i><?php echo $_SESSION['first_name']?> </a></li>
 <li>  <a href="#" onclick="logout()">Logout </a></li>

      <?php }  else {?>
        <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./auth/signup">Signup<div class="activeslider"></div></a></li>
        <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./auth/signin-auth/signin">Signin<div class="activeslider"></div></a></li>
      <?php }?>
    </ul>
    
    
  </nav>
  <ul class="forDropDown">
      <div class="cancont">
        <i class="fas fa-window-close" id="cancel" onclick="toggleHandler()"></i>
      </div>
      <li style="position: relative;"><a class="active" data-ref="fixit" href="./index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./invoice-generator">Invoices<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a  id="contactnav"data-ref="quotations" href="./quotation-generator">Quotations<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a  id="contactnav"data-ref="quotations" href="./settings">Settings<div class="activeslider"></div></a></li>
      <?php if(isset($_SESSION['first_name'])){?>
 <li>  <a href="index"> <i class="fas fa-user" style="margin-right: 10px;"></i><?php echo $_SESSION['first_name']?> </a></li>
 <li>  <a href="#" onclick="logout()">Logout </a></li>

      <?php }  else {?>
        <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./auth/signup">Signup<div class="activeslider"></div></a></li>
        <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./auth/signin-auth/signin">Signin<div class="activeslider"></div></a></li>
      <?php }?>

    </ul>

  


    <div class="mycontainer">
          <div class="TryOurButtonCont">
             <a href="quotations" class="TryOurButton" id="addNewInvoice" >Add New Quotation</a>
          </div>
          
 <div class="invoicesContainer">
    <table id="invoiceTable">
      <tr>
    <th>Quotation</th>
    <th>Client</th>
    <th class="desktopOnly">Date</th>
    <th>Quoted Amount</th>
  </tr>
  
  <?php if(count($GetInvoiceDetails)> 0) {?>
    <?php foreach($GetInvoiceDetails as $details){?>

        <tr onclick="editInvoiceHandler('<?php echo $details['invoiceIdentifier'] ?>')" style=" cursor: pointer;">
        <td><?php echo $details['refNumberFromInvoice']?></td>
        <td><?php echo $details['clientNameFromInvoice']?></td>
        <td class="desktopOnly"><?php echo $details['dateFromInvoice']?></td>
        <td><?php echo $details['currencyContInvoice'] . " " . number_format($details['balance'], 2)?></td>
       
        </tr>
    <?php }?>

  <?php } else{?>
    <tr>  
    <td>No Quotation created presently</td>
    <td></td>
    <td class="desktopOnly"></td>
    <td><a href="quotations">Add New Quotation</a></td>
    <tr>

  <?php }?>
  
</table>

 </div>





    </div>
    
    <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script data-cfasync="false"  src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


 <script src="index.js"></script>
 <script>
      const $$ = (parameter)=> {
        return document.querySelector(parameter)
      }

      const addNewInvoice = $$("#addNewInvoice");
      addNewInvoice.onclick = ()=> {
        console.log("clicked")
        $.ajax({
                   type: "GET",
                   url: 'processtest.php',
                  //  asynonchange: false,
                   success: function(data){
                     console.log(data);
                     window.history.pushState('obj', 'PageTitle', 'http://localhost/fiverrziad/new-invoice');
                    //  window.location.href = "http://demophp32.herokuapp.com/new-invoice";
                    // resultmsg = data;
                   }                    
                 });
      }

      const editInvoiceHandler = (invId)=> {
        $.ajax({
                   type: "GET",
                   url: 'processtest.php',
                  //  asynonchange: false,
                   success: function(data){
                    //  console.log(data);
                    //  window.location.href = `http://localhost/fiverrziad/quotations?key=${invId}`
                     window.location.href = `http://demophp32.herokuapp.com/quotations?key=${invId}`;
                    // resultmsg = data;
                   }                    
                 });
      }

      const logout = ()=> {
    $.ajax({
              url: 'backend/logout.backend.php',
              datatype: 'json',
              type: 'post',
              data:{submit: true},
              // timeout: 5000,
              success: function(data){
                        window.location.href = "index.php?logout=success"
                }
              });
  }
  let show = false
  const toggleHandler = ()=> {
    show = !show;
      if (show){
        
        document.querySelector(".forDropDown").classList.add("slideDown")
      } else{
        document.querySelector(".forDropDown").classList.remove("slideDown")
      }
  }
 </script>
</body>
</html>