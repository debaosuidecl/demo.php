

<?php 
//rymmy2sz9p65xc6f
//
session_start();
if(!isset($_SESSION['first_name'])){
    header("Location: ./index");
    exit();
  }
function startPointSave($assocArray){
    // print_r($assocArray);
  include_once "setdb.php";
$tableExists = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'rymmy2sz9p65xc6f' 
AND table_name = 'quotationdetails'";
  $tableExistQueryResult = mysqli_query($conn, $tableExists);
    $table = mysqli_fetch_all($tableExistQueryResult, MYSQLI_ASSOC);
    $counter = $table[0]['COUNT(*)'];
    print_r($table);
    // echo " " . $counter;

    if($counter == 0){
      $sqlinvoicedetails = "CREATE TABLE quotationdetails (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_identification INT(8),
            invoiceIdentifier VARCHAR(50),
            pickedColor VARCHAR(50),
            invoiceTitle VARCHAR(30),
            fromNameInvoice VARCHAR(30),
            fromEmailInvoice VARCHAR(50),
            address1FromInvoice VARCHAR(50),
            
            phoneFromInvoice VARCHAR(50),
    
            refNumberFromInvoice VARCHAR(50),
            dateFromInvoice VARCHAR(50),
          
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
            balance INT(6)  )";
              if ($conn->query($sqlinvoicedetails) === TRUE) {
                   echo "Table invoice details created successfully";
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
               print_r($productEach);
               echo '  producteach';

            if($mycounter == 0){
             $producteach = "CREATE TABLE quotationproducteach (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_identification INT(8),
            description VARCHAR(50),
            invoiceIdentifier VARCHAR(50),
            descriptionRowInvoiceId VARCHAR(50),
            priceInvoice INT(6),
            qtyInvoice INT(6),
            amountPerItem INT(6))";
             if ($conn->query($producteach) === TRUE) {
                   echo "Table product each details created successfully";
                } else {
                echo "Error creating table: " . $conn->error;
                exit;
              }
       }
           //end of if table exists

      //beginning of adding algorithm
           // initialize variables to be added to table
          $invoiceIdentifier = $assocArray['invoiceIdentifier'];
          $pickedColor = $assocArray['pickedColor'];
          $user_identification = (float)$assocArray['user_identification'];
          $invoiceTitle = $assocArray['invoiceTitle'];
          $fromNameInvoice = $assocArray['fromNameInvoice'];
          $fromEmailInvoice = $assocArray['fromEmailInvoice'];
          $address1FromInvoice = $assocArray['address1FromInvoice'];
          // $address2FromInvoice = $assocArray['address2FromInvoice'];
          // $zipcodeFromInvoice = $assocArray['zipcodeFromInvoice'];
          $phoneFromInvoice = $assocArray['phoneFromInvoice'];
          // $businessNumberFromInvoice = $assocArray['businessNumberFromInvoice'];
          $refNumberFromInvoice = $assocArray['refNumberFromInvoice'];
          $dateFromInvoice = $assocArray['dateFromInvoice'];
          // $termsFromInvoice = $assocArray['termsFromInvoice'];
          $clientNameFromInvoice = $assocArray['clientNameFromInvoice'];
          $clientAddressFromInvoice = $assocArray['clientAddressFromInvoice'];
          $clientEmailFromInvoice = $assocArray['clientEmailFromInvoice'];
          $paymentInstructionsAddNotes = $assocArray['paymentInstructionsAddNotes'];
          // $labelTax = $assocArray['labelTax'];
          $typeTaxInvoice = $assocArray['typeTaxInvoice'];
          $discountInvoice = $assocArray['discountInvoice'];

          $myPercent = $assocArray['myPercent'];
          $amountDiscount = $assocArray['amountDiscount'];
          $myPercentDiscount = $assocArray['myPercentDiscount'];
          $currencyContInvoice = $assocArray['currencyContInvoice'];
          $subTotal = (float)$assocArray['subTotal'];
          $taxValue  = (float)$assocArray['taxValue'];
          $discount = (float)$assocArray['discount'];
          $balance = (float)$assocArray['balance'];
          // echo $balance;


          // check if invoice already exists
          $sqlGetInvoiceIdentifier = "SELECT * FROM quotationdetails WHERE invoiceIdentifier = '$invoiceIdentifier' AND user_identification=$user_identification";
            //queryresult
            $queryGetInvoiceIdentifier = mysqli_query($conn, $sqlGetInvoiceIdentifier);
            //get result
            $GetInvoiceIdentifier = mysqli_fetch_all($queryGetInvoiceIdentifier, MYSQLI_ASSOC);

            if(count($GetInvoiceIdentifier) == 0){
              echo "   count  " . count($GetInvoiceIdentifier);
              print_r($GetInvoiceIdentifier);
              $sqlInsertIntoInvoiceDetails = "INSERT INTO quotationdetails (invoiceTitle, user_identification, invoiceIdentifier, pickedColor, fromNameInvoice, fromEmailInvoice, address1FromInvoice, phoneFromInvoice, refNumberFromInvoice, dateFromInvoice, clientNameFromInvoice, clientAddressFromInvoice, clientEmailFromInvoice, paymentInstructionsAddNotes, typeTaxInvoice, discountInvoice, myPercent, amountDiscount, myPercentDiscount, currencyContInvoice, subTotal, taxValue, discount, balance) VALUES ('$invoiceTitle', $user_identification, '$invoiceIdentifier', '$pickedColor', '$fromNameInvoice', '$fromEmailInvoice', '$address1FromInvoice', '$phoneFromInvoice',  '$refNumberFromInvoice', '$dateFromInvoice', '$clientNameFromInvoice', '$clientAddressFromInvoice', '$clientEmailFromInvoice', '$paymentInstructionsAddNotes',  '$typeTaxInvoice', '$discountInvoice', '$myPercent', '$amountDiscount', '$myPercentDiscount', '$currencyContInvoice', $subTotal, $taxValue, $discount, $balance)" ;

          if (mysqli_query($conn, $sqlInsertIntoInvoiceDetails)) {
             echo "New record created successfully";
            } else {
               echo "Error: " . $sqlInsertIntoInvoiceDetails . "<br>" . mysqli_error($conn);
               exit;
             }
              
            } else{
               // DELETE ALREADY EXISTING INVOICE
          $sqlDeleteInvoiceIdentifier = "DELETE FROM quotationdetails WHERE invoiceIdentifier='$invoiceIdentifier' AND user_identification=$user_identification" ;
            //queryresult
            if(mysqli_query($conn, $sqlDeleteInvoiceIdentifier)){

           echo "Record deleted successfully";
            } else {
           echo "Error: " . $sqlInsertIntoInvoiceDetails . "<br>" . mysqli_error($conn);
           exit;
            }     
           
            // THEN INSERT NEW ONE
             $sqlInsertIntoInvoiceDetails = "INSERT INTO quotationdetails (invoiceTitle, user_identification, invoiceIdentifier, pickedColor, fromNameInvoice, fromEmailInvoice, address1FromInvoice, phoneFromInvoice, refNumberFromInvoice, dateFromInvoice, clientNameFromInvoice, clientAddressFromInvoice, clientEmailFromInvoice, paymentInstructionsAddNotes, typeTaxInvoice, discountInvoice, myPercent, amountDiscount, myPercentDiscount, currencyContInvoice, subTotal, taxValue, discount, balance) VALUES ('$invoiceTitle', $user_identification, '$invoiceIdentifier', '$pickedColor', '$fromNameInvoice', '$fromEmailInvoice', '$address1FromInvoice', '$phoneFromInvoice',  '$refNumberFromInvoice', '$dateFromInvoice', '$clientNameFromInvoice', '$clientAddressFromInvoice', '$clientEmailFromInvoice', '$paymentInstructionsAddNotes',  '$typeTaxInvoice', '$discountInvoice', '$myPercent', '$amountDiscount', '$myPercentDiscount', '$currencyContInvoice', $subTotal, $taxValue, $discount, $balance)" ;

          if (mysqli_query($conn, $sqlInsertIntoInvoiceDetails)) {
             echo "New record created successfully";

            } else {
               echo "Error: " . $sqlInsertIntoInvoiceDetails . "<br>" . mysqli_error($conn);
               exit;
             }
              

      }

      
       $totalItemArray = $assocArray['totalItemArray'];
       foreach($totalItemArray as $item){
        $description = $item['description'];
        $descriptionRowInvoiceId = $item['descriptionRowInvoiceId'];

        $priceInvoice = (float)$item['priceInvoice'];
        $qtyInvoice = (float)$item['qtyInvoice'];
        // $taxCheckBox = $item['taxCheckBox'];
        $amountPerItem = (float)$item['amountPerItem'];

           // check if invoice already exists
          $sqlGetProductEach = "SELECT * FROM quotationproducteach WHERE descriptionRowInvoiceId = '$descriptionRowInvoiceId' AND user_identification=$user_identification";
            //queryresult
            $queryGetProductEach = mysqli_query($conn, $sqlGetProductEach);
            //get result
            $GetProductEach = mysqli_fetch_all($queryGetProductEach, MYSQLI_ASSOC);
            if(count($GetProductEach) == 0){
               $sqlInsertIntoProductEach = "INSERT INTO quotationproducteach (description, user_identification, invoiceIdentifier, descriptionRowInvoiceId, priceInvoice, qtyInvoice, amountPerItem) VALUES ('$description', $user_identification, '$invoiceIdentifier', '$descriptionRowInvoiceId', $priceInvoice, $qtyInvoice, $amountPerItem)";
                  if (mysqli_query($conn, $sqlInsertIntoProductEach)) {
                  echo "New record created successfully";

                 } else {
                     echo "Error: " . $sqlInsertIntoProductEach . "<br>" . mysqli_error($conn);
                     exit;
                 }
            } else{
                  $sqlDeleteProductEach = "DELETE FROM quotationproducteach WHERE descriptionRowInvoiceId='$descriptionRowInvoiceId'";
                   //queryresult
                  if(mysqli_query($conn, $sqlDeleteProductEach)){

                echo "Record deleted successfully";
                 } else {
                echo "Error: " . $sqlInsertIntoInvoiceDetails . "<br>" . mysqli_error($conn);
                  exit;
                   }     

                  $sqlInsertIntoProductEach = "INSERT INTO quotationproducteach (description, user_identification, invoiceIdentifier, descriptionRowInvoiceId, priceInvoice, qtyInvoice, amountPerItem) VALUES ('$description', $user_identification, '$invoiceIdentifier', '$descriptionRowInvoiceId', $priceInvoice, $qtyInvoice, $amountPerItem)";
                      if (mysqli_query($conn, $sqlInsertIntoProductEach)) {
                       echo "New record created successfully";

                   } else {
                     echo "Error: " . $sqlInsertIntoProductEach . "<br>" . mysqli_error($conn);
                     exit;
                 }

            }

         
              
       }
       //end of producteach table exists
            



       print_r($assocArray['totalItemArray']);

    exit;
}

if (isset($_POST['save'])) {
  //get all the save points
  	$savePoints = $_POST['save'];
      
  	  $assocArray = json_decode($savePoints, true);
  		
  			startPointSave($assocArray);			
  	
 
  		exit;
  }

  if (isset($_GET['rowid'])) {
      $rowid = $_GET['rowid'];
      include_once "setdb.php";
      $user_identification = (float)$_SESSION['user_identification'];
      $sqlDelete = "DELETE FROM quotationproducteach WHERE descriptionRowInvoiceId='$rowid' AND user_identification=$user_identification";
                   //queryresult
                  if(mysqli_query($conn, $sqlDelete)){

                echo "Record deleted successfully";
                 } else {
                echo "Error: " . $sqlInsertIntoInvoiceDetails . "<br>" . mysqli_error($conn);
                  exit;
                   }     



  }
