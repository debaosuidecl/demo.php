<?php
// echo "I'm Here";
session_start();

include_once '../setdb.php';
if(!isset($_SESSION['first_name'])){
    header("Location: ../auth/signin-auth/signin?redirect=invgen");
    exit();
  }
  $user_identification = $_SESSION['user_identification'];
  $user_email = $_SESSION['user_email'];
  $user_identificationInt = (float)$user_identification;




if($_FILES["image"]["error"] == 0){
  $file = $_FILES['image'];
  // print_r($file);

  // echo "file";
  $fileName = $_FILES['image']['name'];
  $fileTmpName = $_FILES['image']['tmp_name'];
  $fileSize = $_FILES['image']['size'];
  $fileError = $_FILES['image']['error'];
  $fileType = $_FILES['image']['type'];

  $fileExt = explode(".", $fileName);
  $fileActualExt = strtolower(end($fileExt));  // end gets the last piece of data from an array


  // create an array of the extension we want allowed
  $allowed = array("jpg", "jpeg", "png");

  if (in_array( $fileActualExt, $allowed)){ // if an object is in the array (extension, array)
      if($fileError === 0){
          if($fileSize < 1000000){
              // upload file
              $fileNameNew = 'File' . uniqid('', true) . '.' . $fileActualExt;
              // $fileDestination =  basename( $_FILES["image"]["name"]);
              //move file from temporary location to permanent location.
              move_uploaded_file($fileTmpName, $fileNameNew);
              $fileInDb = mysqli_real_escape_string($conn, $fileNameNew);
              $sqlGetLogoExists = "SELECT * FROM user_profiles WHERE user_email = 'user_email' ";
              //queryresult
              $queryGetLogoExists = mysqli_query($conn, $sqlGetLogoExists);
              //get result
              $GetLogoExists = mysqli_fetch_all($queryGetLogoExists, MYSQLI_ASSOC);
              // print_r($GetLogoExists);
              if(count($GetLogoExists) !== 0){
                // $showLogo = true;
                $sql= "INSERT INTO user_profiles (logo_url, user_email) VALUES ('$fileInDb', '$user_email')";
                if (mysqli_query($conn, $sql)) {
                //  echo "New record created successfully";
                echo '{"success" : "' . $fileNameNew . '"}';
                                exit();
              
              } else{
                echo  "msg: Database cannot be accessed";
              }
            
          } else{
            $sqlDeletelogo = "DELETE FROM user_profiles WHERE user_email='$user_email'";
            //queryresult
             if(mysqli_query($conn, $sqlDeletelogo)){

                $sql= "INSERT INTO user_profiles (logo_url, user_email) VALUES ('$fileInDb', '$user_email')";
                if (mysqli_query($conn, $sql)) {
                //  echo "New record created successfully";
                echo '{"success" : "' . $fileNameNew . '"}';
                exit();
              
              } else{
                echo  "msg: Database cannot be accessed";
              }
            } else {
            echo "Error: " . $sqlDeletelogo . "<br>" . mysqli_error($conn);
           exit;
            }     
          }
      } else{
        echo "{msg: Your File is too Big!}";
      }
  } else{//if there was an error
    echo "{msg: There was an error uploading your file}";
}

} else{
  echo "{msg: You can not upload files of this type!}";

}

}