<?php 
include_once 'setdb.php';
// $invoiceNumber = "";
// $clientNumber = "";
$tableExists = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'rymmy2sz9p65xc6f' 
AND table_name = 'invoicedetails'";
  $tableExistQueryResult = mysqli_query($conn, $tableExists);
    $table = mysqli_fetch_all($tableExistQueryResult, MYSQLI_ASSOC);
    $counter = $table[0]['COUNT(*)'];
    // print_r($table);
    // echo " " . $counter;

    if($counter == 0){
      $sqlinvoicedetails = "CREATE TABLE invoicedetails (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            invoiceIdentifier VARCHAR(50),
            pickedColor VARCHAR(50),
            invoiceTitle VARCHAR(30),
            fromNameInvoice VARCHAR(30),
            fromEmailInvoice VARCHAR(50),
            address1FromInvoice VARCHAR(50),
            address2FromInvoice VARCHAR(50),
            zipcodeFromInvoice VARCHAR(50),
            phoneFromInvoice VARCHAR(50),
            businessNumberFromInvoice VARCHAR(50),
            refNumberFromInvoice VARCHAR(50),
            dateFromInvoice VARCHAR(50),
            termsFromInvoice VARCHAR(50),
            clientNameFromInvoice VARCHAR(50),
            clientEmailFromInvoice VARCHAR(50),
            clientAddressFromInvoice VARCHAR(50),
            paymentInstructionsAddNotes VARCHAR(50),
            labelTax VARCHAR(50),
            typeTaxInvoice VARCHAR(50),
            discountInvoice VARCHAR(50),
            myPercent INT(6),
            amountDiscount INT(6),
            myPercentDiscount INT(6),
            currencyContInvoice VARCHAR(50),
            taxValue INT(6),
            discount INT(6),
            subTotal INT(6),
            balance INT(6)


             )";
              if ($conn->query($sqlinvoicedetails) === TRUE) {
                  //  echo "Table invoice details created successfully";
                } else {
                echo "Error creating table: " . $conn->error;
                exit;
              }

           }

           $producteachExists = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'rymmy2sz9p65xc6f' 
           AND table_name = 'producteach'";
             $producteachExistQueryResult = mysqli_query($conn, $producteachExists);
              $productEach = mysqli_fetch_all($producteachExistQueryResult, MYSQLI_ASSOC);
               $mycounter = $productEach[0]['COUNT(*)'];
              //  print_r($productEach);
              //  echo '  producteach';

            if($mycounter == 0){
             $producteach = "CREATE TABLE producteach (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            description VARCHAR(50),
            invoiceIdentifier VARCHAR(50),
            descriptionRowInvoiceId VARCHAR(50),
            priceInvoice INT(6),
            qtyInvoice INT(6),
            amountPerItem INT(6),
            taxCheckBox VARCHAR(50)
          )";
             if ($conn->query($producteach) === TRUE) {
                   echo "Table product each details created successfully";
                } else {
                echo "Error creating table: " . $conn->error;
                exit;
              }
       }
$sqlGetInvoiceDetails = "SELECT * FROM invoicedetails";
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
      <link rel="stylesheet" href="indexstyle.css">
  <title>Invoice Generator</title>
</head>
<body>
<?php require("loader.php") ?>
<nav id="nav">
    <div><a href="#">
        <h1 style="align-self: left" class="logo">Logo</h1>
      </a></div>
    <div id="toggler">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <ul class="forDesktop">
  
      <li style="position: relative;"><a class="active" data-ref="fixit" href="./index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./invoice-generator">Invoices<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="./index">Quotations<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="partnernav" data-ref="partners" href="./index">Clients<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a  id="contactnav"data-ref="contact" href="./index">Settings<div class="activeslider"></div></a></li>
    </ul>
    
    
  </nav>
  <ul class="forDropDown">
      <div class="cancont">
        <i class="fas fa-window-close" id="cancel"></i>
      </div>
      <li><a id="active"  style="font-weight: bolder" href="#">Home</a></li>
      <li><a style="font-weight: bolder"  href="#about">Clients</a></li>
      <li><a  style="font-weight: bolder" href="#whatwedo">Login</a></li>
      <li><a  style="font-weight: bolder" href="#partners">Sign Up</a></li>
      <li><a  style="font-weight: bolder" href="#contact">Contact Us</a></li>

    </ul>



    <div class="mycontainer">
          <div class="TryOurButtonCont">
             <a href="new-invoice" class="TryOurButton" id="addNewInvoice" >Add New Invoice</a>
          </div>
          
 <div class="invoicesContainer">
    <table id="invoiceTable">
      <tr>
    <th>Invoice</th>
    <th>Client</th>
    <th>Date</th>
    <th>Balance Due</th>
  </tr>
  
  <?php if(count($GetInvoiceDetails)> 0) {?>
    <?php foreach($GetInvoiceDetails as $details){?>

        <tr onclick="editInvoiceHandler('<?php echo $details['invoiceIdentifier'] ?>')" style=" cursor: pointer;">
        <td><?php echo $details['refNumberFromInvoice']?></td>
        <td><?php echo $details['clientNameFromInvoice']?></td>
        <td><?php echo $details['dateFromInvoice']?></td>
        <td><?php echo $details['balance']?></td>
        </tr>
    <?php }?>

  <?php } else{?>
    <tr>  
    <td>No Invoice created presently</td>
    <td></td>
    <td></td>
    <td><a href="new-invoice">Add New Invoice</a></td>
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
                    //  window.history.pushState('obj', 'PageTitle', 'http://localhost/fiverrziad/new-invoice');
                     window.location.href = "http://demophp32.herokuapp.com/new-invoice";
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
                     console.log(data);
                    //  window.history.pushState('obj', 'PageTitle', 'http://localhost/fiverrziad/new-invoice');
                     window.location.href = `http://demophp32.herokuapp.com/new-invoice?key=${invId}`;
                    // resultmsg = data;
                   }                    
                 });
      }
 </script>
</body>
</html>