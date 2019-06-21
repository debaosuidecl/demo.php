<?php
if (isset($_POST['submit'])) {

include_once 'dbh.inc.php';

$first = mysqli_real_escape_string($conn, $_POST['first']);
$last = mysqli_real_escape_string($conn, $_POST['last']);
$nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
$state = mysqli_real_escape_string($conn, $_POST['state']);
$religion = mysqli_real_escape_string($conn, $_POST['religion']);
$occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

// error handlers


//Check for empty fields

if(empty($first) || empty($last) || empty($nationality) || empty($state) || empty($religion) || empty($occupation) || empty($email) || empty($pwd) ){
		header("Location: ../registration.php?signup=empty");
		exit();
} else{
	//check if input characters are valid

	if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last) || !preg_match("/^[a-zA-Z]*$/", $nationality) || !preg_match("/^[a-zA-Z]*$/", $state) || !preg_match("/^[a-zA-Z]*$/", $religion) || !preg_match("/^[a-zA-Z]*$/", $occupation) || !preg_match("/^[a-zA-Z]*$/", $pwd)){
		header("Location: ../registration.php?signup=invalid");
		exit();
	} else{
		//Check if email is valid

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location: ../registration.php?signup=email");
		exit();
		} else{
		 	$sql = "SELECT * FROM users WHERE user_email='$email'";
		 	$result = mysqli_query($conn, $sql);
		 	$resultCheck = mysqli_num_rows($result);
		 	if($resultCheck > 0 ){
		 		header("Location: ../registration.php?signup=usertaken");
				exit();
		 	} else{
		 		// hashing the password;
		 		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

		 		//Insert the user into the database
		 		$sql = "INSERT INTO users (user_first, user_last, user_email, user_pwd, user_nationality, user_state, user_religion, user_occupation) VALUES ('$first', '$last', '$email', '$hashedPwd', '$nationality', '$state', '$religion', '$occupation')";
		 		mysqli_query($conn, $sql);
		 		header("Location: ../registration.php?signup=success");
				exit();
		 	}
		}
	}

}



} else{
	header("Location: ../registration.php");
	exit();
}