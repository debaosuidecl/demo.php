<?php 
      $determinant = false;
  	if(isset($_GET['key'])){
      global $determinant;
      $key = htmlspecialchars($_GET['key']);
      // echo $key;
      include_once "setdb.php";
      $sqlGetInvoiceToEdit = "SELECT invoicedetails.invoiceTitle, invoicedetails.fromNameInvoice, invoicedetails.fromEmailInvoice, invoicedetails.address1FromInvoice, invoicedetails.address2FromInvoice, invoicedetails.zipcodeFromInvoice, invoicedetails.phoneFromInvoice, invoicedetails.businessNumberFromInvoice, invoicedetails.refNumberFromInvoice, invoicedetails.dateFromInvoice, invoicedetails.termsFromInvoice, invoicedetails.clientNameFromInvoice, invoicedetails.clientEmailFromInvoice, invoicedetails.clientAddressFromInvoice, invoicedetails.paymentInstructionsAddNotes, invoicedetails.labelTax, invoicedetails.typeTaxInvoice, invoicedetails.myPercent, invoicedetails.amountDiscount, invoicedetails.myPercentDiscount, invoicedetails.currencyContInvoice, invoicedetails.subTotal, invoicedetails.taxValue, invoicedetails.discount, invoicedetails.discountInvoice, invoicedetails.pickedColor, invoicedetails.balance FROM invoicedetails WHERE invoicedetails.invoiceIdentifier='$key' ";
      
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
      $sqlGetInvoiceToEdit = "SELECT producteach.description, producteach.priceInvoice, producteach.qtyInvoice, producteach.amountPerItem, producteach.taxCheckBox, producteach.descriptionRowInvoiceId  FROM invoicedetails  INNER JOIN producteach ON invoicedetails.invoiceIdentifier = producteach.invoiceIdentifier WHERE invoicedetails.invoiceIdentifier='$key' ";

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./fontawesome-free-5.9.0-web/css/fontawesome.css" rel="stylesheet">
  <link href="chosen.css" rel="stylesheet">

  <link href="./fontawesome-free-5.9.0-web/css/brands.css" rel="stylesheet">
  <link href="./fontawesome-free-5.9.0-web/css/solid.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <div id="toggler">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <ul class="forDesktop">
      <!-- <li><a id="active" href="#">Home</a></li> -->
      <li style="position: relative;"><a class="active" data-ref="fixit" href="./index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./invoice-generator">Invoices<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="#whatwedo">Quotations<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="partnernav" data-ref="partners" href="#partners">Clients<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a  id="contactnav"data-ref="contact" href="#contact">Settings<div class="activeslider"></div></a></li>
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
              <!-- SAVE TO DATABASE -->
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
                <!-- <input type="file" name="" id=""> -->
               <img src="./includes/behance.png" alt=""> 
              </div>
            </div>
            <!-- end of Heading an Logo div -->

            <!-- Beginning of From and To div -->
   
            <div class="fromToInvoiceCont">
              <div class="fromInvoiceCont">
                <h2 id="fromInvoice">From :</h2>
              <div class="personalDets">
                    <label for="fromNameInvoice">Name </label> 
                      <?php if($determinant){?>
                        <input type="text" id="fromNameInvoice" onchange="onChangeHandler()" placeholder="Name" value="<?php echo $InvoiceValues[0]['fromNameInvoice'] ?>" name="name">
                      <?php } else {?>
                        <input type="text" id="fromNameInvoice" onchange="onChangeHandler()" placeholder="Name" value="" name="name">
                      <?php }?>
              </div> 
              <div class="personalDets">
              <label for="fromEmailInvoice">Email </label>
              <?php if($determinant){?>
                <input type="email" placeholder="Email" onchange="onChangeHandler()" id="fromEmailInvoice" value="<?php echo $InvoiceValues[0]['fromEmailInvoice'] ?>" name="email">
                <?php } else {?>
                  <input type="email" placeholder="Email" onchange="onChangeHandler()" id="fromEmailInvoice" value="" name="email">
                  <?php }?>

                     
              </div> 
              <div class="personalDets">
              <label for="address1FromInvoice">Address 1 </label>
              <?php if($determinant){?>
                <input type="text" value="<?php echo $InvoiceValues[0]['address1FromInvoice'] ?>" id="address1FromInvoice" onchange="onChangeHandler()" placeholder="Address 1" name="address1">
                <?php } else {?>
                  <input type="text" value="" id="address1FromInvoice" onchange="onChangeHandler()" placeholder="Address 1" name="address1">
                  <?php }?>

                    
              </div> 
              <div class="personalDets">
              <label for="address2FromInvoice">Address 2 </label>
              <?php if($determinant){?>
                <input type="text" value="<?php echo $InvoiceValues[0]['address2FromInvoice'] ?>" id="address2FromInvoice" onchange="onChangeHandler()" placeholder="Address 2" name="address2">
                <?php } else {?>
                  <input type="text" value="" id="address2FromInvoice" onchange="onChangeHandler()" placeholder="Address 2" name="address2">
                  <?php }?>

                     
              </div>
              <div class="personalDets">
              <label for="zipcodeFromInvoice">Zip Code </label>
              <?php if($determinant){?>
                <input type="text" value="<?php echo $InvoiceValues[0]['zipcodeFromInvoice'] ?>" id="zipcodeFromInvoice" onchange="onChangeHandler()" placeholder="Zip Code" name="zipcode">
                <?php } else {?>
                  <input type="text" value="" id="zipcodeFromInvoice" onchange="onChangeHandler()" placeholder="Zip Code" name="zipcode">
                  <?php }?>

             
              </div>
              <div class="personalDets">
              <label for="phoneFromInvoice">Phone </label>
              <?php if($determinant){?>
                <input type="text" value="<?php echo $InvoiceValues[0]['phoneFromInvoice'] ?>" onchange="onChangeHandler()" id="phoneFromInvoice" placeholder="Phone" name="phone">
                <?php } else {?>
                  <input type="text" value="" onchange="onChangeHandler()" id="phoneFromInvoice" placeholder="Phone" name="phone">
                  <?php }?>

                    
              </div>
              <div class="personalDets">
              <label for="businessNumberFromInvoice">Business Number </label>
              <?php if($determinant){?>
                <input type="text" value="<?php echo $InvoiceValues[0]['businessNumberFromInvoice'] ?>" onchange="onChangeHandler()"  id="businessNumberFromInvoice" placeholder="Business Number" name="businessnumber">
                <?php } else {?>
                  <input type="text" value="" onchange="onChangeHandler()"  id="businessNumberFromInvoice" placeholder="Business Number" name="businessnumber">
                  <?php }?>

                      
              </div>
              <div class="personalDets">
              <label for="refNumberFromInvoice">Reference Number </label>

              <?php if($determinant){?>
                <input type="text" id="refNumberFromInvoice" onchange="onChangeHandler()" value="<?php echo $InvoiceValues[0]['refNumberFromInvoice']?>" placeholder="Reference Number" name="refnumber">
                <?php } else {?>
                  <input type="text" id="refNumberFromInvoice" onchange="onChangeHandler()" value="#INV0001" placeholder="Reference Number" name="refnumber">
                  <?php }?>

              </div>
              <div class="personalDets">
              <label for="dateFromInvoice">Date </label>
              <?php if($determinant){?>
                <input id="dateFromInvoice" onchange="onChangeHandler()" type="date" value="<?php echo $InvoiceValues[0]['dateFromInvoice']?>" placeholder="Date" name="date">
                <?php } else {?>
                  <input id="dateFromInvoice" onchange="onChangeHandler()" type="date" value="" placeholder="Date" name="date">
                  <?php }?>
              </div>
              <div class="personalDets">
              <label for="termsFromInvoice">Terms </label>
              <?php if($determinant){?>
                <select onchange="onChangeHandler()" value="<?php echo $InvoiceValues[0]['termsFromInvoice']?>" id="termsFromInvoice" name="terms" id="terms">
                  <option value="none">None</option>
                  <option value="custom">Custom</option>
                  <option value="dueonreceipt">Due on Receipt</option>
                  <option value="nextday">Next day</option>
                  <option value="2days">2 days</option>
                  <option value="3days">3 days</option>
                  <option value="4days">4 days</option>
                  <option value="5days">5 days</option>
                  <option value="6days">6 days</option>
                  <option value="7days">7 days</option>
                  <option value="10days">10 days</option>
                  <option value="14days">14 days</option>
                  <option value="21days">21 days</option>
                  <option value="36days">36 days</option>
                  <option value="45days">45 days</option>
                  <option value="180days">180 days</option>
                  <option value="365days">365 days</option>
                </select>
                <?php } else {?>
                  <select onchange="onChangeHandler()" value="" id="termsFromInvoice" name="terms" id="terms">
                    <option value="none">None</option>
                    <option value="custom">Custom</option>
                    <option value="dueonreceipt">Due on Receipt</option>
                    <option value="nextday">Next day</option>
                    <option value="2days">2 days</option>
                    <option value="3days">3 days</option>
                    <option value="4days">4 days</option>
                    <option value="5days">5 days</option>
                    <option value="6days">6 days</option>
                    <option value="7days">7 days</option>
                    <option value="10days">10 days</option>
                    <option value="14days">14 days</option>
                    <option value="21days">21 days</option>
                    <option value="36days">36 days</option>
                    <option value="45days">45 days</option>
                    <option value="180days">180 days</option>
                    <option value="365days">365 days</option>
                  </select>
                  <?php }?>
              </div>
              </div>
              <div class="toInvoiceCont">
                <h2 id="toInvoice">To :</h2>
              <div class="personalDets">
                <label for="clientNameFromInvoice">Name </label>
                <?php if($determinant){?>
                  <input onchange="onChangeHandler()" type="text" id="clientNameFromInvoice" placeholder="Client Name" value="<?php echo $InvoiceValues[0]['clientNameFromInvoice'] ?>" name="clientname">
                <?php } else {?>
                  <input onchange="onChangeHandler()" type="text" id="clientNameFromInvoice" placeholder="Client Name" value="" name="clientname">
                  <?php }?>
              </div> 
              <div class="personalDets">
                <label for="clientEmailFromInvoice">Email </label>
                <?php if($determinant){?>
                  <input onchange="onChangeHandler()" type="email" value="<?php echo $InvoiceValues[0]['clientEmailFromInvoice'] ?>" id="clientEmailFromInvoice" placeholder="Client Email" name="clientemail">
                <?php } else {?>
                  <input onchange="onChangeHandler()" type="email" value="" id="clientEmailFromInvoice" placeholder="Client Email" name="clientemail">
                  <?php }?>
              </div> 
              <div class="personalDets">
                <label for="clientAddressFromInvoice">Address </label>
                <?php if($determinant){?>
                  <input onchange="onChangeHandler()" type="text" value="<?php echo $InvoiceValues[0]['clientAddressFromInvoice']?>" id="clientAddressFromInvoice" placeholder="Client Address" name="clientaddress">
                <?php } else {?>
                  <input onchange="onChangeHandler()" type="text" value="" id="clientAddressFromInvoice" placeholder="Client Address" name="clientaddress">
                  <?php }?>
              </div>
              </div>
            </div>
            <!-- End of From and To div -->
             <!-- BEGINNING OF PRODUCT DESCRIPTION ALGORITHM -->
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
                    <li id="taxInvoiceForm">Tax</li>
              </div>
              <?php if($determinant){?>
                      <?php foreach($ProductValues as $p) {?>

                        <div class="descriptionRowInvoice" data-src="" id="<?php echo $p['descriptionRowInvoiceId'] ?>">
                          
                                  <div class="cancelItemInvoice">
                                  <?php if($determinant){?>
                                    <i class="fas fa-window-close closeProductDescInvoice" style="color:  <?php echo $InvoiceValues[0]['pickedColor']?>"></i>
                                      <?php } else {?>
                                        <i class="fas fa-window-close closeProductDescInvoice"></i>
                                      <?php }?>
                                  </div>
                                  <div class="descriptionInvoiceInput">
                                    <textarea onchange="onChangeHandler()" name="description" class="description" id="description"
                                    
                                    placeholder="Describe Item"><?php echo $p['description']?></textarea>
                                  </div>
                                  <div class="priceInvoiceInput" id="priceInvoiceInput">
                                    <input type="text" name="price" class="priceInvoice" id="priceInvoice"  onkeyup="onChangeHandler()" step=".01"placeholder="0.00" value="<?php echo number_format((float)$p['priceInvoice'], 2, '.', '')?>">
                                  </div>
                                  <div id="qtyInvoiceInput" class="qtyInvoiceInput">
                                    <input type="text" name="qtyInvoice" class="qtyInvoice" id="qtyInvoice" value="<?php echo $p['qtyInvoice']?>" onkeyup="onChangeHandler()" >
                                  </div>
                                  <div id="amountInvoiceInput" class="amountInvoiceInput">
                                    <h6><?php echo $InvoiceValues[0]['currencyContInvoice'] . " " . number_format((float)$p['amountPerItem'], 2, '.', '');  ?></h6>
                                  </div>
                                  <div id="taxInvoiceInput">
                                  <?php if($determinant){?>
                                    <?php if ($p['taxCheckBox'] == '1'){ ?>
                                      <input checked onchange="onChangeHandler()" type="checkbox"  class="taxCheckBox">         
                                    <?php }  else {?>

                                      <input onchange="onChangeHandler()" type="checkbox"  class="taxCheckBox">
                                    <?php }?>
                                         <?php } else {?>
                                          <input onchange="onChangeHandler()" type="checkbox"  class="taxCheckBox">

                                      <?php }?>
                                  </div>
                         </div>
                      <?php }?>
                <?php } else {?>
                  <div class="descriptionRowInvoice" data-src="go">
                    
                            <div class="cancelItemInvoice">
                               <i class="fas fa-window-close closeProductDescInvoice" 
                               
                               id="closeProductDescInvoice"></i>
                            </div>
                            <div class="descriptionInvoiceInput" id="descriptionInvoiceInput">
                              <textarea onchange="onChangeHandler()" name="description" class="description" id="description" placeholder="Describe Item"></textarea>
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
                            <div id="taxInvoiceInput">
                              <input onchange="onChangeHandler()" type="checkbox"  class="taxCheckBox">
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
                    <div id="labelTaxContInvoice">
                     <label for="labelTax">Label</label> 
                     <?php if($determinant){?>
                      <input onchange="onChangeHandler()"  name="labelTax" id="labelTax" style="margin-bottom: 20px" placeholder="label" value="<?php echo $InvoiceValues[0]['labelTax'] ?>"/>
                <?php } else {?>
                  <input onchange="onChangeHandler()"  name="labelTax" id="labelTax" style="margin-bottom: 20px" placeholder="label" value=""/>
                  <?php }?>
                    </div> 
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