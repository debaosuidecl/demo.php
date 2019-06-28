<?php
session_start();
if (isset($_POST['submit'])) {

include_once '../setdb.php';

$first = mysqli_real_escape_string($conn, $_POST['first_name']);
$last = mysqli_real_escape_string($conn, $_POST['last_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

// error handlers
echo  $name; 
echo $email;
echo $pwd;
echo "Pleas Now";

//Check for empty fields

if(empty($first) || empty($last) || empty($email) || empty($pwd) ){
    header("Location: ../auth/signup.php?signup=empty");
    
		exit();
} else{
	//check if input characters are valid

	if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)  || !preg_match("/^[a-zA-Z]*$/", $pwd)){
		header("Location: ../auth/signup.php?signup=invalid");
		exit();
	} else{
		//Check if email is valid

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location: ../auth/signup.php?signup=email");
		exit();
		} else{
		 	$sql = "SELECT * FROM users WHERE user_email='$email'";
		 	$result = mysqli_query($conn, $sql);
       $resultCheck = mysqli_num_rows($result);
      //  mysqli_query($conn, $sql);
              
		 	if($resultCheck > 0 ){
		 		header("Location: ../auth/signup.php?signup=usertaken");
				exit();
		 	} else{
		 		// hashing the password;
		 		$hashedPwd = trim(password_hash($pwd, PASSWORD_DEFAULT));

		 		//Insert the user into the database
		 		$sql = "INSERT INTO users (first_name, last_name,  user_email, user_pwd) VALUES ('$first', '$last', '$email', '$hashedPwd')";
				 
				 if (mysqli_query($conn, $sql)) {

					
					$sql = "SELECT * FROM users WHERE user_email ='$email'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1){
			header("Location: ../auth/signin-auth/signin.php?login=error");
			exit();
		} else{
			if($row = mysqli_fetch_assoc($result)){
					$_SESSION['first_name'] = $row['first_name'];
					$_SESSION['last_name'] = $row['last_name'];
					$_SESSION['user_identification'] = $row['user_identification'];
					$_SESSION['user_email'] = $row['user_email'];
					header("Location: ../auth/signup.php?signup=success");
				
				}

			}






				 } else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						exit;
					}
				 
				exit();
		 	}
		}
	}

}

} else{
	header("Location: ../auth/signup.php");
	exit();
}