<?php 

	if(isset($_POST['submit'])) {
		session_start();
		session_unset(); //unset seesion
		session_destroy();// destroy session
		header("Location: ../index.php");
		// exit();
	}
 ?>