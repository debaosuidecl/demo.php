

<?php 
//

function startPointSave($assocArray){
    // print_r($assocArray);
  include_once "setdb.php";
$tableExists = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'mrziad' 
AND table_name = 'invoicedetails'";
  $tableExistQueryResult = mysqli_query($conn, $tableExists);
    $table = mysqli_fetch_all($tableExistQueryResult, MYSQLI_ASSOC);
    $counter = $table[0]['COUNT(*)'];
    print_r($table);
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
                   echo "Table invoice details created successfully";
                } else {
                echo "Error creating table: " . $conn->error;
                exit;
              }

           }

           $producteachExists = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'mrziad' 
           AND table_name = 'producteach'";
             $producteachExistQueryResult = mysqli_query($conn, $producteachExists);
              $productEach = mysqli_fetch_all($producteachExistQueryResult, MYSQLI_ASSOC);
               $mycounter = $productEach[0]['COUNT(*)'];
               print_r($productEach);
               echo '  producteach';

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
           //end of if table exists

      //beginning of adding algorithm
           // initialize variables to be added to table
          $invoiceIdentifier = $assocArray['invoiceIdentifier'];
          $pickedColor = $assocArray['pickedColor'];
          $invoiceTitle = $assocArray['invoiceTitle'];
          $fromNameInvoice = $assocArray['fromNameInvoice'];
          $fromEmailInvoice = $assocArray['fromEmailInvoice'];
          $address1FromInvoice = $assocArray['address1FromInvoice'];
          $address2FromInvoice = $assocArray['address2FromInvoice'];
          $zipcodeFromInvoice = $assocArray['zipcodeFromInvoice'];
          $phoneFromInvoice = $assocArray['phoneFromInvoice'];
          $businessNumberFromInvoice = $assocArray['businessNumberFromInvoice'];
          $refNumberFromInvoice = $assocArray['refNumberFromInvoice'];
          $dateFromInvoice = $assocArray['dateFromInvoice'];
          $termsFromInvoice = $assocArray['termsFromInvoice'];
          $clientNameFromInvoice = $assocArray['clientNameFromInvoice'];
          $clientAddressFromInvoice = $assocArray['clientAddressFromInvoice'];
          $clientEmailFromInvoice = $assocArray['clientEmailFromInvoice'];
          $paymentInstructionsAddNotes = $assocArray['paymentInstructionsAddNotes'];
          $labelTax = $assocArray['labelTax'];
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
          $sqlGetInvoiceIdentifier = "SELECT * FROM invoicedetails WHERE invoiceIdentifier = '$invoiceIdentifier'";
            //queryresult
            $queryGetInvoiceIdentifier = mysqli_query($conn, $sqlGetInvoiceIdentifier);
            //get result
            $GetInvoiceIdentifier = mysqli_fetch_all($queryGetInvoiceIdentifier, MYSQLI_ASSOC);

            if(count($GetInvoiceIdentifier) == 0){
              echo "   count  " . count($GetInvoiceIdentifier);
              print_r($GetInvoiceIdentifier);
              $sqlInsertIntoInvoiceDetails = "INSERT INTO invoicedetails (invoiceTitle, invoiceIdentifier, pickedColor, fromNameInvoice, fromEmailInvoice, address1FromInvoice, address2FromInvoice, zipcodeFromInvoice, phoneFromInvoice, businessNumberFromInvoice, refNumberFromInvoice, dateFromInvoice, termsFromInvoice, clientNameFromInvoice, clientAddressFromInvoice, clientEmailFromInvoice, paymentInstructionsAddNotes, labelTax, typeTaxInvoice, discountInvoice, myPercent, amountDiscount, myPercentDiscount, currencyContInvoice, subTotal, taxValue, discount, balance) VALUES ('$invoiceTitle', '$invoiceIdentifier', '$pickedColor', '$fromNameInvoice', '$fromEmailInvoice', '$address1FromInvoice', '$address2FromInvoice', '$zipcodeFromInvoice', '$phoneFromInvoice', '$businessNumberFromInvoice', '$refNumberFromInvoice', '$dateFromInvoice', '$termsFromInvoice', '$clientNameFromInvoice', '$clientAddressFromInvoice', '$clientEmailFromInvoice', '$paymentInstructionsAddNotes', '$labelTax', '$typeTaxInvoice', '$discountInvoice', '$myPercent', '$amountDiscount', '$myPercentDiscount', '$currencyContInvoice', $subTotal, $taxValue, $discount, $balance)" ;

          if (mysqli_query($conn, $sqlInsertIntoInvoiceDetails)) {
             echo "New record created successfully";
            } else {
               echo "Error: " . $sqlInsertIntoInvoiceDetails . "<br>" . mysqli_error($conn);
               exit;
             }
              
            } else{
               // DELETE ALREADY EXISTING INVOICE
          $sqlDeleteInvoiceIdentifier = "DELETE FROM invoicedetails WHERE invoiceIdentifier='$invoiceIdentifier'";
            //queryresult
            if(mysqli_query($conn, $sqlDeleteInvoiceIdentifier)){

           echo "Record deleted successfully";
            } else {
           echo "Error: " . $sqlInsertIntoInvoiceDetails . "<br>" . mysqli_error($conn);
           exit;
            }     
           
            // THEN INSERT NEW ONE
             $sqlInsertIntoInvoiceDetails = "INSERT INTO invoicedetails (invoiceTitle, invoiceIdentifier, pickedColor, fromNameInvoice, fromEmailInvoice, address1FromInvoice, address2FromInvoice, zipcodeFromInvoice, phoneFromInvoice, businessNumberFromInvoice, refNumberFromInvoice, dateFromInvoice, termsFromInvoice, clientNameFromInvoice, clientAddressFromInvoice, clientEmailFromInvoice, paymentInstructionsAddNotes, labelTax, typeTaxInvoice, discountInvoice, myPercent, amountDiscount, myPercentDiscount, currencyContInvoice, subTotal, taxValue, discount, balance) VALUES ('$invoiceTitle', '$invoiceIdentifier', '$pickedColor', '$fromNameInvoice', '$fromEmailInvoice', '$address1FromInvoice', '$address2FromInvoice', '$zipcodeFromInvoice', '$phoneFromInvoice', '$businessNumberFromInvoice', '$refNumberFromInvoice', '$dateFromInvoice', '$termsFromInvoice', '$clientNameFromInvoice', '$clientAddressFromInvoice', '$clientEmailFromInvoice', '$paymentInstructionsAddNotes', '$labelTax', '$typeTaxInvoice', '$discountInvoice', '$myPercent', '$amountDiscount', '$myPercentDiscount', '$currencyContInvoice', $subTotal, $taxValue, $discount, $balance)" ;

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
        $taxCheckBox = $item['taxCheckBox'];
        $amountPerItem = (float)$item['amountPerItem'];

           // check if invoice already exists
          $sqlGetProductEach = "SELECT * FROM producteach WHERE descriptionRowInvoiceId = '$descriptionRowInvoiceId'";
            //queryresult
            $queryGetProductEach = mysqli_query($conn, $sqlGetProductEach);
            //get result
            $GetProductEach = mysqli_fetch_all($queryGetProductEach, MYSQLI_ASSOC);
            if(count($GetProductEach) == 0){
               $sqlInsertIntoProductEach = "INSERT INTO producteach (description, invoiceIdentifier, descriptionRowInvoiceId, priceInvoice, qtyInvoice, amountPerItem, taxCheckBox) VALUES ('$description', '$invoiceIdentifier', '$descriptionRowInvoiceId', $priceInvoice, $qtyInvoice, $amountPerItem, '$taxCheckBox')";
                  if (mysqli_query($conn, $sqlInsertIntoProductEach)) {
                  echo "New record created successfully";

                 } else {
                     echo "Error: " . $sqlInsertIntoProductEach . "<br>" . mysqli_error($conn);
                     exit;
                 }
            } else{
                  $sqlDeleteProductEach = "DELETE FROM producteach WHERE descriptionRowInvoiceId='$descriptionRowInvoiceId'";
                   //queryresult
                  if(mysqli_query($conn, $sqlDeleteProductEach)){

                echo "Record deleted successfully";
                 } else {
                echo "Error: " . $sqlInsertIntoInvoiceDetails . "<br>" . mysqli_error($conn);
                  exit;
                   }     

                  $sqlInsertIntoProductEach = "INSERT INTO producteach (description, invoiceIdentifier, descriptionRowInvoiceId, priceInvoice, qtyInvoice, amountPerItem, taxCheckBox) VALUES ('$description', '$invoiceIdentifier', '$descriptionRowInvoiceId', $priceInvoice, $qtyInvoice, $amountPerItem, '$taxCheckBox')";
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