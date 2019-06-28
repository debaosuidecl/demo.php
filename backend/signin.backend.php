<?php
session_start();
if (isset($_POST['submit'])) {

	
	include_once '../setdb.php';

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	//ERROR HANDLERS
	//CHECK IF INPUTS ARE EMPTY

	if(empty($email) || empty($pwd)){
		header("Location: ../auth/signin-auth/signin.php?login=empty");
	    exit();
	} else{
		$sql = "SELECT * FROM users WHERE user_email ='$email'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1){
			header("Location: ../auth/signin-auth/signin.php?login=error");
			exit();
		} else{
			if($row = mysqli_fetch_assoc($result)){
        $hash = $row['user_pwd'];
        echo $hash; 
        echo $pwd;

        // exit();
				//De-hashing the password;
        $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
       
				if($hashedPwdCheck == false){
					header("Location: ../auth/signin-auth/signin.php?login=errorpassword");
						exit();
					} else if ($hashedPwdCheck === true){
						//login the user here;
						$_SESSION['first_name'] = $row['first_name'];
						$_SESSION['last_name'] = $row['last_name'];
						$_SESSION['user_identification'] = $row['user_identification'];
						$_SESSION['user_email'] = $row['user_email'];

					header("Location: ../index.php?login=success");
						exit();
					}
				}
			}
		}

	}
 else{
	header("Location: ../index.php?login=error");
	exit();
}