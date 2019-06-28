<?php 
session_start();
include_once "setdb.php";
$user_email = $_SESSION['user_email'];
      $determinant = false;
      $user_identification = (float)$_SESSION['user_identification'];
      
      if(!isset($_SESSION['first_name'])){
        header("Location: ./index");
      }
        
  	if(isset($_GET['key'])){
      global $determinant;
      $key = htmlspecialchars($_GET['key']);
      
      // echo $key;
      $sqlGetInvoiceToEdit = "SELECT invoicedetails.invoiceTitle, invoicedetails.fromNameInvoice, invoicedetails.fromEmailInvoice, invoicedetails.address1FromInvoice,   invoicedetails.phoneFromInvoice, invoicedetails.refNumberFromInvoice, invoicedetails.dateFromInvoice, invoicedetails.clientNameFromInvoice, invoicedetails.clientEmailFromInvoice, invoicedetails.clientAddressFromInvoice, invoicedetails.user_identification, invoicedetails.paymentInstructionsAddNotes, invoicedetails.typeTaxInvoice, invoicedetails.myPercent, invoicedetails.amountDiscount, invoicedetails.myPercentDiscount, invoicedetails.currencyContInvoice, invoicedetails.subTotal, invoicedetails.taxValue, invoicedetails.discount, invoicedetails.discountInvoice, invoicedetails.pickedColor, invoicedetails.balance FROM invoicedetails WHERE invoicedetails.invoiceIdentifier='$key' AND invoicedetails.user_identification=$user_identification";
      
      $resultGetInvoiceToEdit = mysqli_query($conn, $sqlGetInvoiceToEdit);
      $GetInvoiceToEdit = mysqli_fetch_all($resultGetInvoiceToEdit, MYSQLI_ASSOC);
      // print_r($GetInvoiceToEdit);
      $InvoiceValues = $GetInvoiceToEdit;
      if(count($InvoiceValues) === 0){
        // header("Location: ./new-invoice");

        $determinant = false;

      } else{
        $determinant = true;

      }
      if (mysqli_query($conn, $sqlGetInvoiceToEdit)) {
        // echo "New record created successfully";
       } else {
          echo "Error: " . $sqlGetInvoiceToEdit . "<br>" . mysqli_error($conn);
          // exit;
        }
      // print_r($GetInvoiceToEdit);
      $InvoiceValues = $GetInvoiceToEdit;
      // print_r($InvoiceValues);
     
      // exit;
      $sqlGetInvoiceToEdit = "SELECT producteach.description, producteach.priceInvoice, producteach.qtyInvoice, producteach.amountPerItem, producteach.descriptionRowInvoiceId  FROM invoicedetails  INNER JOIN producteach ON invoicedetails.invoiceIdentifier = producteach.invoiceIdentifier WHERE invoicedetails.invoiceIdentifier='$key' AND producteach.user_identification=$user_identification";

      $resultGetInvoiceToEdit = mysqli_query($conn, $sqlGetInvoiceToEdit);
      $GetInvoiceToEdit = mysqli_fetch_all($resultGetInvoiceToEdit, MYSQLI_ASSOC);
      if (mysqli_query($conn, $sqlGetInvoiceToEdit)) {
        // echo "New record created successfully";
       } else {
          echo "Error: " . $sqlGetInvoiceToEdit . "<br>" . mysqli_error($conn);
          // exit;
        }
        // exit;
        $ProductValues = $GetInvoiceToEdit;
        
        // print_r($ProductValues);


       


    }
    
    $sqlLogoUrl = "SELECT logo_url FROM user_profiles WHERE user_email='$user_email' ";
    
    $resultLogoUrl = mysqli_query($conn, $sqlLogoUrl);
    $logoUrl = mysqli_fetch_all($resultLogoUrl, MYSQLI_ASSOC);
    $showLogo = false;
  if((count($logoUrl)) ==0){
    $showLogo = true;
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./fontawesome-free-5.9.0-web/css/fontawesome.css" rel="stylesheet">
  <link href="./fontawesome-free-5.9.0-web/css/brands.css" rel="stylesheet">
  <link href="./fontawesome-free-5.9.0-web/css/solid.css" rel="stylesheet">
  <link href="./fontawesome-free-5.9.0-web/css/all.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" href="indexstyle.css">
  <title>Invoice Generator</title>
</head>
<body>
<!-- <?php require("loader.php") ?> -->
<div class="loader-wrapper" style="opacity: 0.5;">
<div class="lds-ripple"><div></div><div></div></div>
</div>
<nav id="nav">
    <div><a href="#">
    <?php if($determinant){?>
      <h1 style="align-self: left" data-src="<?php echo $key ?>" class="logo">Logo</h1>
                <?php } else {?>
                  <h1 style="align-self: left" data-src="" class="logo">Logo</h1>
                  <?php }?>
      </a></div>
    <div id="toggler" onclick="toggleHandler()">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <ul class="forDesktop">
  
      <li style="position: relative;"><a class="active" data-ref="fixit" href="./index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./invoice-generator">Invoices<div class="activeslider"></div></a></li>
      <!-- <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="#whatwedo">Partners<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="partnernav" data-ref="partners" href="#partners">Clients<div class="activeslider"></div></a></li>
   -->
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
  <ul class="forDropDown" >
      <div class="cancont">
        <i class="fas fa-window-close" id="cancel" onclick="toggleHandler()"></i>
      </div>
      
      <li style="position: relative;"><a class="active" data-ref="fixit" href="./index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./invoice-generator">Invoices<div class="activeslider"></div></a></li>
      <!-- <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="#whatwedo">Partners<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="partnernav" data-ref="partners" href="#partners">Clients<div class="activeslider"></div></a></li>
   -->
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










    <div data-page="invoice" class="ycontainer" data-src="<?php echo $user_identification ?>">
    <!-- <input id="hidden" type="hidden" value="<?php echo $user_identification ?>"> -->
              <!-- SAVE TO DATABASE -->

              <div class="heading" style="text-align: center; font-size: 50px; color: #477fae; font-family: 'Lobster' "><h1>Design an Invoice</h1></div>
              <div class="SavePreviewCont">
      <a class="prev" href="#" onclick="previewInvoice(this.id)">Preview</a>
    </div>
    <!-- END OF SAVE TO DATABASE -->
       <div class="invoiceGeneratorCont">
         <div class="invoiceFormBody">
         <?php if($determinant){?>
              
          <div id="topDesignInvoice" style="background: <?php echo $InvoiceValues[0]['pickedColor']?>"></div>
                <?php } else {?>
                  <div id="topDesignInvoice"></div>
                  <?php }?>
            <!-- Heading and Logo div -->
           
            <div class="headingLogoInvoice">
              <div class="invoiceTitle">
              <?php if($determinant){?>

                      <input id="invoicetitle" type="text" value="<?php echo $InvoiceValues[0]['invoiceTitle'] ?>" name="invoiceTitle">
              <?php } else {?>
                <input id="invoicetitle" type="text" value="INVOICE" name="invoiceTitle">
                <?php }?>

              </div>
              <div class="invoiceLogo">
                <label for="logoInvoice" style="position: relative" >
                <?php if($showLogo == false){?>
                    <p style="padding: 20px; border: none; position: abosolute; top: 50%; left: 50%;  border: 1px solid #999; cursor: pointer;  outline: none; ">Upload Your Logo</p>
                    <form id="formInvoice" enctype="multipart/form-data" name="submit" style="position: absolute"  >
                  
                    <input style="position: absolute" type="file" name="image" id="logoInvoice">
                  </form>
                <?php } else {?>
                  <form id="formInvoice" enctype="multipart/form-data" name="submit" style="position: absolute"  >
                  
                    <input style="position: absolute" type="file" name="image" id="logoInvoice">
                  </form>
                        <img  src="<?php echo "./uploads/" . $logoUrl[0]['logo_url']?>" alt="">
                <?php }?>
                </label>
               <!-- <img src="./includes/behance.png" alt="">  -->

              </div>
            </div>
            <!-- end of Heading an Logo div -->

            <!-- Beginning of From and To div -->
   
            <div class="fromToInvoiceCont">
              <div class="fromInvoiceCont">
                <h2 id="fromInvoice">From :</h2>
              <div class="personalDets">
                      <?php if($determinant){?>

                        <label for="fromNameInvoice">

                                        <i class="fas fa-pen"></i>
                        </label>
                        <input type="text" id="fromNameInvoice" onchange="onChangeHandler()" placeholder="Enter Your Name" value="<?php echo $InvoiceValues[0]['fromNameInvoice'] ?>" name="name">
                      <?php } else {?>
                        <label for="fromNameInvoice">

                        <i class="fas fa-pen"></i>

                        </label>
                        <input type="text" id="fromNameInvoice" onchange="onChangeHandler()" placeholder="Enter Your Name" value="<?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>" name="name">
                      <?php }?>
              </div> 
              <div class="personalDets">
       
              <?php if($determinant){?>
                
                <label for="fromEmailInvoice">

<i class="fas fa-pen"></i>
</label>
                <input type="email" placeholder="Enter Email Address" onchange="onChangeHandler()" id="fromEmailInvoice" value="<?php echo $InvoiceValues[0]['fromEmailInvoice'] ?>" name="email">
                <?php } else {?>
                                
                <label for="fromEmailInvoice">

<i class="fas fa-pen"></i>
</label>
                  <input type="email" placeholder="Enter  Email Address" onchange="onChangeHandler()" id="fromEmailInvoice" value="<?php echo $_SESSION['user_email'] ?>" name="email">
                  <?php }?>

                     
              </div> 
              <div class="personalDets">
              <?php if($determinant){?>
                              
                <label for="address1FromInvoice">

<i class="fas fa-pen"></i>
</label>
                <input type="text" value="<?php echo $InvoiceValues[0]['address1FromInvoice'] ?>" id="address1FromInvoice" onchange="onChangeHandler()" placeholder="Enter  residential address" name="address1">
                <?php } else {?>
                                
                <label for="address1FromInvoice">

        <i class="fas fa-pen"></i>
      </label>
                  <input type="text" value="" id="address1FromInvoice" onchange="onChangeHandler()" placeholder="Enter  Office Address" name="address1">
                  <?php }?>

                    
              </div> 
             
           
              <div class="personalDets">
              
              <?php if($determinant){?>
                <label for="phoneFromInvoice">

<i class="fas fa-pen"></i>
</label>
                <input type="text" value="<?php echo $InvoiceValues[0]['phoneFromInvoice'] ?>" onchange="onChangeHandler()" id="phoneFromInvoice" placeholder="Phone" name="phone">
                <?php } else {?>
                  <label for="phoneFromInvoice">

<i class="fas fa-pen"></i>
</label>
                  <input type="text" value="" onchange="onChangeHandler()" id="phoneFromInvoice" placeholder="Phone" name="phone">
                  <?php }?>

                    
              </div>
             
              
              </div>
              
              <div class="toInvoiceCont">
                <h2 id="toInvoice">To :</h2>
              <div class="personalDets">
              <!-- <i class="fa fa-pencil" aria-hidden="true"> -->
                <?php if($determinant){?>
                  <label for="clientNameFromInvoice">

          <i class="fas fa-pen"></i>
              </label>
                  <input onchange="onChangeHandler()" type="text" id="clientNameFromInvoice" placeholder="Client Name" value="<?php echo $InvoiceValues[0]['clientNameFromInvoice'] ?>" name="clientname">
                <?php } else {?>
                  <label for="clientNameFromInvoice">

<i class="fas fa-pen"></i>
</label>
                  <input onchange="onChangeHandler()" type="text" id="clientNameFromInvoice" placeholder="Client Name" value="" name="clientname">
                  <?php }?>
              </div> 
              <div class="personalDets">

               <?php if($determinant){?>
                <label for="clientAddressFromInvoice">

<i class="fas fa-pen"></i>
</label>
                  <input onchange="onChangeHandler()" type="email" value="<?php echo $InvoiceValues[0]['clientEmailFromInvoice'] ?>" id="clientEmailFromInvoice" placeholder="Client Email" name="clientemail">
                <?php } else {?>
                  <label for="clientEmailFromInvoice">

<i class="fas fa-pen"></i>
</label>
                  <input onchange="onChangeHandler()" type="email" value="" id="clientEmailFromInvoice" placeholder="Client Email" name="clientemail">
                  <?php }?>
              </div> 
              <div class="personalDets">
                <?php if($determinant){?>
                  <label for="clientAddressFromInvoice">

<i class="fas fa-pen"></i>
</label>
                  <input onchange="onChangeHandler()" type="text" value="<?php echo $InvoiceValues[0]['clientAddressFromInvoice']?>" id="clientAddressFromInvoice" placeholder="Client Address" name="clientaddress">
                <?php } else {?>
                  <label for="clientAddressFromInvoice">

<i class="fas fa-pen"></i>
</label>
                  <input onchange="onChangeHandler()" type="text" value="" id="clientAddressFromInvoice" placeholder="Client Address" name="clientaddress">
                  <?php }?>
              </div>
              </div>
            </div>
                      <div id="invoiceDueDateTableCont"> 

                          <table id="invoiceDueDateTable" cellpadding="10px">
                              <tr>
                              <?php if($determinant){?>
                                <th data-src="okay" id="bamount"  colspan="2"><?php echo $InvoiceValues[0]['currencyContInvoice'] .  " " . number_format($InvoiceValues[0]['balance'], 2, '.', '')?></th>
                                      <?php } else {?>
                                        <th data-src="" id="bamount"colspan="2">$ 0.00</th>
                                          <?php }?>

                              
                              </tr>
                              <tr>
                                <td><div class="">
                                <?php if($determinant){?>
                              <input type="text" id="refNumberFromInvoice" onchange="onChangeHandler()" value="<?php echo $InvoiceValues[0]['refNumberFromInvoice']?>" placeholder="Reference Number" name="refnumber">
                              <?php } else {?>
                                <input type="text" id="refNumberFromInvoice" onchange="onChangeHandler()" value="#INV0001" placeholder="Reference Number" name="refnumber">
                                <?php }?>
              
                                </div></td>
                                <td>
                                  <div class="">
                                  <div class="">
                            
                            <?php if($determinant){?>
                              <input id="dateFromInvoice" onchange="onChangeHandler()" type="date" value="<?php echo $InvoiceValues[0]['dateFromInvoice']?>" placeholder="Date" name="date">
                              <!-- <div  style="text-align: center; font-size: 14px; width: 100%"><span>mm/dd/yyyy<span></div> -->
                              <?php } else {?>
                                <input id="dateFromInvoice" onchange="onChangeHandler()" type="date" value="" placeholder="Date" name="date">
                              
              
                                <?php }?>
                            </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                      </div>
            <!-- End of From and To div -->
             <!-- BEGINNING OF PRODUCT DESCRIPTION ALGORITHM -->
             <div class="descriptionHeaderForMobile">
               <h2 style="color: <?php echo $InvoiceValues[0]['pickedColor']?> ">Enter Your Product Details</h2>
             </div>
             <div class="descriptionContainerInvoice">
             <?php if($determinant){?>
              <div id="descriptionHeaderInvoice" style="background: <?php echo $InvoiceValues[0]['pickedColor']?>">
                <?php } else {?>
                  <div id="descriptionHeaderInvoice">
                  <?php }?>
                    <!-- <li i></li> -->
                    <li id="descriptionInvoiceForm">Description</li>
                    <li id="priceInvoiceForm" >Price</li>
                    <li id="qtyInvoiceForm">Qty</li>
                    <li id="amountInvoiceForm">Amount</li>
              </div>
              <?php if($determinant){?>
                      <?php foreach($ProductValues as $p) {?>

                        <div class="descriptionRowInvoice" data-src="" id="<?php echo $p['descriptionRowInvoiceId'] ?>">
                          
                                  
                                  <div class="descriptionInvoiceInput">
                                    <textarea onchange="onChangeHandler()" name="description" class="description" id="description"
                                    
                                    placeholder="Describe your Invoice Item"><?php echo $p['description']?></textarea>
                                  </div>
                                  <div class="priceInvoiceInput" id="priceInvoiceInput">
                                     <input type="text" name="price" class="priceInvoice" id="priceInvoice"  onkeyup="onChangeHandler()" step=".01"placeholder="0.00" value="<?php echo number_format((float)$p['priceInvoice'], 2, '.', '')?>">
                                  </div>
                                  <div id="qtyInvoiceInput" class="qtyInvoiceInput">
                                  <span>X</span> <input type="text" name="qtyInvoice" class="qtyInvoice" id="qtyInvoice" value="<?php echo $p['qtyInvoice']?>" onkeyup="onChangeHandler()" >
                                  </div>
                                  <div id="amountInvoiceInput" class="amountInvoiceInput">
                                    <h6><?php echo $InvoiceValues[0]['currencyContInvoice'] . " " . number_format((float)$p['amountPerItem'], 2, '.', '');  ?></h6>
                                  </div>
                                  <div class="cancelItemInvoice">
                                  <?php if($determinant){?>
                                    <i class="fas fa-trash closeProductDescInvoice" style="color:  <?php echo $InvoiceValues[0]['pickedColor']?>"></i> <span class="deleteTrashInvoice" style="padding: 2px 8px; font-size: 17px; color: <?php echo $InvoiceValues[0]['pickedColor'] ?>;">Delete Item</span> 
                                      <?php } else {?>
                                        <i class="fas fa-trash closeProductDescInvoice"></i>
                                        <span class="deleteTrashInvoice" style="padding: 2px 8px; font-size: 17px; color: #477fae;">Delete Item</span>   
                                      <?php }?>
                                  </div>
                                  
                         </div>
                      <?php }?>
                <?php } else {?>
                  <div class="descriptionRowInvoice" data-src="go">
                    
                           
                            <div class="descriptionInvoiceInput" id="descriptionInvoiceInput">
                              <textarea onchange="onChangeHandler()" name="description" class="description" id="description" placeholder="Describe your Invoice Item"></textarea>
                            </div>
                            <div class="priceInvoiceInput" id="priceInvoiceInput">
                              <input type="text" name="price" class="priceInvoice" id="priceInvoice"  onkeyup="onChangeHandler()" step=".01"placeholder="0.00" value="0.00">
                            </div>
                            <div id="qtyInvoiceInput" class="qtyInvoiceInput">
                              <input type="text" name="qtyInvoice" class="qtyInvoice" id="qtyInvoice" value="1" onkeyup="onChangeHandler()" >
                            </div>
                            <div id="amountInvoiceInput" class="amountInvoiceInput">
                              <h6>0.00</h6>
                            </div>
                            <div class="cancelItemInvoice">
                            <i class="fas fa-trash closeProductDescInvoice"></i>
                                        <span class="deleteTrashInvoice" style="padding: 2px 8px; font-size: 17px; color: #477fae;">Delete Item</span>   
                            </div>
                           
                   </div>
                  <?php }?>
               
            </div>

            <div id="AddNewProductInvoice">
            <?php if($determinant){?>
              <i class="fas fa-plus-circle" style="color: <?php echo $InvoiceValues[0]['pickedColor']?>" onclick="addNewProductHandler()" id="addDescInvoice" title="Add new product To Invoice"></i>
            <?php } else {?>
              <i class="fas fa-plus-circle" onclick="addNewProductHandler()" id="addDescInvoice" title="Add new product To Invoice"></i>
            <?php }?>
            </div>
            <div id="productSummaryInvoice">
              <div id="labelsInvoice">
              <?php if($determinant){?>
                <li id="subList" data-src=""><h5>Subtotal</h5> <h5 id="subtotalValueInvoice"><?php echo $InvoiceValues[0]['currencyContInvoice'] . " " . number_format((float)$InvoiceValues[0]['subTotal'], 2, '.', '') ?></h5></li>
                  
                  <?php if($InvoiceValues[0]['discountInvoice'] == "Percent"){?>
                    <li><h5>Discount(<span id="discountTag"><?php echo $InvoiceValues[0]['myPercentDiscount']?>%</span>)</h5> <h5 id="discountValueInvoice"><?php echo $InvoiceValues[0]['currencyContInvoice'] . " " . number_format((float)$InvoiceValues[0]['discount'], 2, '.', '') ?></h5></li>
                  <?php }  else if($InvoiceValues[0]['discountInvoice'] == "Flat Amount") {?>
                    <li><h5>Discount(<span id="discountTag"><?php echo $InvoiceValues[0]['currencyContInvoice'] . $InvoiceValues[0]['amountDiscount']?></span>)</h5> <h5 id="discountValueInvoice"><?php echo $InvoiceValues[0]['currencyContInvoice'] . " " . number_format((float)$InvoiceValues[0]['discount'], 2, '.', '') ?></h5></li>
                    <?php }  else if($InvoiceValues[0]['discountInvoice'] == "None") {?>
                    <li><h5>Discount(<span id="discountTag"><?php echo '0%'?></span>)</h5> <h5 id="discountValueInvoice"><?php echo $InvoiceValues[0]['currencyContInvoice'] . " " . number_format((float)$InvoiceValues[0]['discount'], 2, '.', '') ?></h5></li>
                  <?php } ?>

                <li><h5>Tax(<span id="taxPercentTag"><?php echo $InvoiceValues[0]['myPercent']?>%</span>)</h5> <h5 id="taxValueInvoice"><?php echo $InvoiceValues[0]['currencyContInvoice'] . " " . number_format((float)$InvoiceValues[0]['taxValue'], 2, '.', '') ?></h5></li>

                <!-- <li> <h5>Total</h5> <h5>$ 0.00</h5></li> -->
                <li><h5>Balance Due</h5> <h5 id="balanceDueValueInvoice"><?php echo $InvoiceValues[0]['currencyContInvoice'] . " " . number_format((float)$InvoiceValues[0]['balance'], 2, '.', '') ?></h5></li>
                <?php } else {?>
                  <li id="subList" data-src="subList"><h5>Subtotal</h5> <h5 id="subtotalValueInvoice">$ 0.00</h5></li>
                <li><h5>Discount(0%)</h5> <h5 id="discountValueInvoice">$ 0.00</h5></li>
                <li><h5>Tax(0%)</h5> <h5 id="taxValueInvoice">$ 0.00</h5></li>
                <!-- <li> <h5>Total</h5> <h5>$ 0.00</h5></li> -->
                <li><h5>Balance Due</h5> <h5 id="balanceDueValueInvoice">$ 0.00</h5></li>
                  <?php }?>
                
              </div>
             
            </div>
         <!-- END OF PRODUCT DESCRIPTION ALGORITHM -->

         <!-- BEGINNING OF PAYMENT INSTRUCTIONS AND ADDITIONAL NOTES -->
                  <div class="paymentInstructionsAddNotes">
                    <!-- <h3>Payment Instructions</h3> -->
                    <?php if($determinant){?>
                      <textarea onchange="onChangeHandler()" name="" id="" cols="30" rows="10" placeholder="NOTES - Add any additional notes pertaining to the transaction">
                        <?php echo $InvoiceValues[0]['paymentInstructionsAddNotes'] ?>
                    </textarea>
                <?php } else {?>
                  <textarea onchange="onChangeHandler()" name="" id="" cols="30" rows="10" placeholder="NOTES - Add any additional notes pertaining to the transaction"></textarea>
                  <?php }?>
                  </div>
         <!-- END OF PAYMENT INSTRUCTIONS AND ADDITIONAL NOTES -->
         
         </div>
         <!-- BEGINNING OF INVOICE CONTROLLER -->

         <div class="invoiceFormController">
                <!-- BEGINNING OF COLOR CONTROLLER -->
                    
                <div class="colorControllerInvoice">
                  <h3>Choose Your Theme</h3>
                  <?php if($determinant){?>
                    
                  <input onchange="onChangeHandler()"  type='color' id="colorPickerInvoice" name='color2' value='<?php echo $InvoiceValues[0]['pickedColor']?>' />
                <?php } else {?>
                  
                <input onchange="onChangeHandler()"  type='color' id="colorPickerInvoice" name='color2' value='#477fae' />
                  <?php }?>

                </div>

                
                <!-- END OF COLOR CONTROLLER -->

                <!-- Beginning of Tax Controller -->
                <div class="taxControllerInvoice">

                  <h3>Tax</h3>
                  <!-- <i class="fas fa-sort-down"></i> -->
                 
                 <div id="taxControlContainer">
                    <div id="customSelectTypeTax">
                      <label for="type" style="width: 100%;">Type</label> 
                      <?php if($determinant){?>
                        <?php if ($InvoiceValues[0]['typeTaxInvoice'] == "On Total")  {?>
                          
                          <select value="OnTotal" onchange="onChangeHandler()" name="type" id="typeTaxInvoice">
                              <option value="None">None</option>
                              <option value="Deducted">Deducted</option>
                              <option selected value="On Total">On Total</option>
                            </select>
                            <div style="width: 100%; position: relative"><label for="myPercent" style="margin-top:20px;">Rate</label> 
                              <input onkeyup='onChangeHandler()' type="number" min="0" max="100" value="<?php echo number_format((float)$InvoiceValues[0]['myPercent'], 2, '.', '' )?>" step="0.01" id="myPercent"/>
                                <span style="position: absolute;
                                  bottom: 7px;
                                  right: 30px;
                                  font-size: 18px;">%</span>
                     
                     </div>
                              <?php } else if($InvoiceValues[0]['typeTaxInvoice'] == "Deducted") {?>
                                <select value="Deducted" onchange="onChangeHandler()" name="type" id="typeTaxInvoice">
                              <option value="None">None</option>
                              <option selected value="Deducted">Deducted</option>
                              <option  value="On Total">On Total</option>
                            </select>
                            <div style="width: 100%; position: relative"><label for="myPercent" style="margin-top:20px;">Rate</label> 
                              <input onkeyup='onChangeHandler()' type="number" min="0" max="100" value="<?php echo number_format((float)$InvoiceValues[0]['myPercent'], 2, '.', '' )?>" step="0.01" id="myPercent"/>
                                <span style="position: absolute;
                                  bottom: 7px;
                                  right: 30px;
                                  font-size: 18px;">%</span>
                     
                     </div>
                              <?php } else {?>
                                <select value="None" onchange="onChangeHandler()" name="type" id="typeTaxInvoice">
                                        <option selected value="None">None</option>
                                  <option  value="Deducted">Deducted</option>
                                  <option  value="On Total">On Total</option>
                            </select>
                              <?php } ?>
                          <?php } else {?>
                      
                            <select value="" onchange="onChangeHandler()" name="type" id="typeTaxInvoice">
                              <option value="None">None</option>
                              <option value="Deducted">Deducted</option>
                              <option value="On Total">On Total</option>
                            </select>
                            <?php }?>
                                     
                   </div>
                  
                </div>

                <!-- End of Tax Controller -->
                
         </div>
          <!-- Beginning of Discount Controller -->
          <div class="discountControllerInvoice">

              
                  <h3>Discount</h3>
                  <label for="type">Type</label> 
                 <div id="discountControlContainer">
                    <div id="customSelectDiscount">
                    <?php if($determinant){?>
                      <?php if($InvoiceValues[0]['discountInvoice'] == 'Percent'){?>
                        <select name="discount" value="Percent" id="discountInvoice">
                        <option class='None' value="None">None</option>
                        <option selected value="Percent">Percent</option>
                        <option value="Flat Amount">Flat Amount</option>
                      </select>
                     
                        <div style="width: 100%; position: relative">
                      <label for="myPercent" style="margin-top:20px;">Rate</label> 
                      <input type="number" onkeyup="onChangeHandler()" min="0" max="100" value="<?php echo $InvoiceValues[0]['myPercentDiscount']?>" step="0.01" id="myPercentDiscount"/>
                      <span style="position: absolute;
                      bottom: 7px;
                      right: 30px;
                      font-size: 18px;">%</span>
                      </div>

                      <?php } else if($InvoiceValues[0]['discountInvoice'] == 'Flat Amount'){?>
                        <select name="discount" value="Flat Amount" id="discountInvoice">
                        <option class='None' value="None">None</option>
                        <option value="Percent">Percent</option>
                        <option selected value="Flat Amount">Flat Amount</option>
                        </select>
                        <div id="labelTaxContInvoice">
                        <label for="labelTax">Amount</label> 
                        <input type="number" name="amount" onkeyup="onChangeHandler()" id="amountDiscount" placeholder="Amount" step="1.00" value="<?php echo number_format((float)$InvoiceValues[0]['amountDiscount'], 2, '.', '')?>"/>
                      </div> 

                      <?php } else if($InvoiceValues[0]['discountInvoice'] == 'None'){ ?>
                        <div id="customSelectDiscount">
                      <select name="discount" value="None" id="discountInvoice">
                        <option class='None' value="None">None</option>
                        <option value="Percent">Percent</option>
                        <option value="Flat Amount">Flat Amount</option>
                      </select>
                  </div>      
                      <?php }?>
                <?php } else {?>

                  <select onchange="onChangeHandler()" name="discount" value="" id="discountInvoice">
                    <option class='None' value="None">None</option>
                    <option value="Percent">Percent</option>
                    <option value="Flat Amount">Flat Amount</option>
                  </select>             
                  <?php }?>
                  </div>
                  
                </div>
                

                <!-- End of Discount Controller -->

                <!-- BEGINNING OF CURRENCY CONTROLLER -->
               

                      <div class="currencyController" style="margin-top: 50px; margin-bottom: 90px; ">
                        <h3 style="padding-bottom: 20px; margin-bottom: 20px; border-bottom: 1px solid #bbb">Currency</h3>
                        <div id="currencyControlContainer" style="width: 100%; margin: auto;">
                        <?php if($determinant){?>
                          <select data-src="<?php echo $InvoiceValues[0]['currencyContInvoice']?>" onchange="onCurrencyChangeHandler(this.id)" name="" id="currencyContInvoice" style="width: 100%; padding: 10px;">
    
                          </select>
                     <?php } else {?>
                      <select data-src="no" onchange="onCurrencyChangeHandler(this.id)" name="" id="currencyContInvoice" style="width: 100%; padding: 10px;">

                      </select>
                            <?php }?>
                        
                        </div>
                      </div>
              <!-- END OF CURRENCY CONTROLLER -->
                
         </div>
         <!-- END OF INVOICE CONTROLLER -->

         
        
       </div>
    </div>
   
    
    <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script data-cfasync="false"  src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script data-cfasync="false"  src="jquery-3.2.1.min.js"></script>
<script src="allCountryData.js"></script>
<script src="invoice-generator.js"></script>
<script src="saveInvoiceToDB.js"></script>
<script>

//SUBMIT ALGORITHM

 
</script>
</body>
</html>