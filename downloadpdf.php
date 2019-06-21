<?php 
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


    } else{
      header("Location: invoice-generator.php");
    }


$html = '
<html>
<head>
    <meta charset="utf-8">
    <title>My Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="indexStyle.css">
    <style>
    tr.item td{
      border-top: 1px solid #eee;
      border-bottom: 1px solid #eee;
    }
    tr.item:nth-child(even) {
      background: rgb(250,250,250);
    
    }
        .invoice-box {
  max-width: 800px;

  margin: auto;
  padding: 30px;
  /* padding-top: 100px; */
  border: 1px solid #eee;
  min-height: 900px;
  /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
  font-size: 16px;
  line-height: 24px;
  font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
  color: #555;
}

.invoice-box table {
  width: 100%;
  line-height: inherit;
  text-align: left;
  // border-spacing: 10px 10px;
  // cell-padding: 10px;
}

.invoice-box table td {
  padding: 20px;
  margin: 10px;
  vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
  text-align: right;
}

.invoice-box table tr.top table td {
  /* padding-bottom: 20px; */
}

.invoice-box table tr.top table td.title {
  font-size: 45px;
  line-height: 45px;
  color: #333;
}

.invoice-box table tr.information table td {
  padding-bottom: 14px;
}
.invoice-box table tr.heading{
  border-bottom: 1px solid #ddd;
  

}
.invoice-box table tr.heading td {

  font-weight: bold;
}

.invoice-box table tr.details td {
  padding-bottom: 10px;
}

.invoice-box table tr.item td {
  border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
  border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
  /* border-top: 2px solid #eee; */
  font-weight: bold;
}

@media only screen and (max-width: 600px) {
  .invoice-box table tr.top table td {
    width: 100%;
    display: block;
    text-align: center;
  }

  .invoice-box table tr.information table td {
    width: 100%;
    display: block;
    text-align: center;
  }
}

/** RTL **/
.rtl {
  direction: rtl;
  font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial,
    sans-serif;
}

.rtl table {
  text-align: right;
}

.rtl table tr td:nth-child(2) {
  text-align: left;
}

    </style>
</head>

<body>





    <div class="invoice-box" id="invoice-box" style="border-top: 20px solid ' . $InvoiceValues[0]['pickedColor'] . '">
    <table cellpadding="14px" cellspacing="0">
    <tr>
    <td colspan="4" style="font-size: 50px; text-align:center; color: ' . $InvoiceValues[0]['pickedColor'] . ' ">' . $InvoiceValues[0]["invoiceTitle"] . '</td>
    
    
    </tr>
        <tr class="top">
          <td colspan="2">
            <tr>
              <td class="title">
                <img
                  src="./includes/behance.png"
                  style="width:200px; max-width:300px;"
                />
              </td>
              <td></td>
              <td></td>
              <td style="font-size: 20px;">
                Invoice: ' . $InvoiceValues[0]['refNumberFromInvoice'] . '<br />
                ' . $InvoiceValues[0]['dateFromInvoice'] . '<br />
              
              </td>
            </tr>
          </td>
        </tr>
        
        <tr class="information">
          <td>
         

            <tr>
              <td style="font-size: 18px;">
              <span style="color: #888; font-size: 14px">Your Details</span> <br/><br/>
                <strong>' . $InvoiceValues[0]['fromNameInvoice'] . ' </strong><br />
                <br />
                ' . $InvoiceValues[0]['address1FromInvoice'] . ' <br />
               ' . $InvoiceValues[0]['fromEmailInvoice'] . '<br />
                ' . $InvoiceValues[0]['phoneFromInvoice'] . ' <br />
       
              </td>
              <td></td>
              <td></td>
              <td style="font-size: 18px;">
              <span style="color: #888; font-size: 14px">Client Details</span> <br/><br/>

                <strong>
               ' . $InvoiceValues[0]['clientNameFromInvoice'] . '                </strong>
                <br /><br />
                ' . $InvoiceValues[0]['clientEmailFromInvoice'] . ' <br />
                ' . $InvoiceValues[0]['clientAddressFromInvoice'] . '               </td>
            </tr>
          </td>
        </tr>

        <tr class="heading" >
                <td >
                   Terms of Payment
                </td>
                <td ></td>
                <td ></td>
                <td >
                
Due in ' . $InvoiceValues[0]['termsFromInvoice'] . '  
             </td>
            </tr>

      
        <tr class="heading" style="background: ' . $InvoiceValues[0]['pickedColor'] . '; padding-right: 40px;">
          
          <td style=" color: rgb(255,255,255)">
            Description
          </td>

          <td style=" color: rgb(255,255,255)">
            Price
          </td>
          <td style=" color: rgb(255,255,255)">
            Quantity
          </td>
          <td style=" color: rgb(255,255,255)">
            Amount
          </td>
        </tr>

        
        ' ;


 

       
$endHTML = '
        <tr class="total">
          <td></td>
          <td></td>
          <td></td>
          <td>
            Sub Total: ' . $InvoiceValues[0]['currencyContInvoice'] .  
$InvoiceValues[0]['subTotal'] . ' <br />
            Discount: ' . $InvoiceValues[0]['currencyContInvoice'] .
 $InvoiceValues[0]['discount'] . ' <br />
            Tax: ' .  $InvoiceValues[0]['currencyContInvoice'] . 
$InvoiceValues[0]['taxValue'] . ' <br />
            <strong style="font-size: 18px;">Grand Total: ' . $InvoiceValues[0]['currencyContInvoice'] . $InvoiceValues[0]['balance']. '</strong>
          </td>
        </tr>
      </table>
    </div>';
$saveHTML = '<div  style="text-align: center; margin-top: 50px; margin-bottom: 50px;"><a href="#" onclick="downloadHandler()"  style="border: 1px solid blue; padding: 10px; box-shadow: 0px 1px 4px #bbb;" >Download as PDF</a></div>
<div  style="text-align: center; margin-top: 50px; margin-bottom: 50px;"><a href="new-invoice?key=' . $key . ' "  style="border: 1px solid blue; padding: 10px; box-shadow: 0px 1px 4px #bbb;" >Back to Edit</a></div>
<script src="jspdf.js"></script>
<script src="pdfFromHTML.js"></script>
<script src="jquery-2.1.3.js"></script>
<script src="html2canvas.js"></script>
<script src="autotable.js"></script>
<script src="printThis.js"></script>
<!-- <script src="autotable.js"></script> -->

<script>
  const downloadHandler = ()=> {
    $.ajax({
      url: "./new-invoice-preview.php?download=true",
      success: (data)=> {
          console.log(data);
      }
    })
  }
  const print = ()=> {

    $("#invoice-box").printThis({
      debug: false, // show the iframe for debugging
      importCSS: true, // import parent page css
      importStyle: true, // import style tags
      printContainer: true, // print outer container/$.selector
      loadCSS: "", // path to additional css file - use an array [] for multiple
      pageTitle: null, // add title to print page
      removeInline: false, // remove inline styles from print elements
      removeInlineSelector: "*", // custom selectors to filter inline styles. removeInline must be true
      printDelay: 333, // variable print delay
      header: null, // prefix to html
      footer: null, // postfix to html
      base: false, // preserve the BASE tag or accept a string for the URL
      formValues: true, // preserve input/form values
      canvas: true, // copy canvas content
      doctypeString: "", // enter a different doctype for older markup
      removeScripts: false, // remove script tags from print content
      copyTagClasses: false, // copy classes from the html & body tag
      beforePrintEvent: null, // function for printEvent in iframe
      beforePrint: null, // function called before iframe is filled
      afterPrint: null // function called before iframe is removed
    });
  }
  </script>
</body>
</html>';
   


$htmlMid;
foreach($ProductValues as $p){
  global $htmlMid;
  $htmlMid = $htmlMid . '<tr class="item">

  <td>
   ' .  $p['description'] . '
  </td>
  <td>
  ' . $InvoiceValues[0]['currencyContInvoice'] 
. $p['priceInvoice'] . '
  </td>
  <td>
  ' .  $p['qtyInvoice'] . '

  </td>
  <td>
  ' . $InvoiceValues[0]['currencyContInvoice'] . 
$p['amountPerItem'] . '
  </td>
</tr>
' ;
} 


$HTMLKINGU = $html . $htmlMid . $endHTML;

// if(isset($_GET['download'])){

  $path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
  require_once $path . '/vendor/autoload.php';
  $mpdf = new \Mpdf\Mpdf([
  	'margin_left' => 0,
  	'margin_right' => 0,
  	'margin_top' => 0,
  	'margin_bottom' => 0,
  	'margin_header' => 0,
  	'margin_footer' => 0
  ]);
  $mpdf->SetProtection(array('print'));
  $mpdf->SetTitle("Acme Trading Co. - Invoice");
  $mpdf->SetAuthor("Acme Trading Co.");
  $mpdf->SetWatermarkText("Paid");
  // $mpdf->showWatermarkText = true;
  $mpdf->watermark_font = 'DejaVuSansCondensed';
  $mpdf->watermarkTextAlpha = 0.1;
  $mpdf->SetDisplayMode('fullpage');
  $mpdf->WriteHTML($HTMLKINGU);
  $mpdf->Output();
// }
