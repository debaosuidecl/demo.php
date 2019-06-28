

<?php 
session_start();
if(isset($_GET['redirect'])){
	
}
if(isset($_SESSION['first_name'])){
  header("Location: ../../index");
}
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V14</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="../../indexStyle.css">


		<style>
			a{
			color: #477fae !important;

		}
		*{
			font-weight: 100;
		}
		.limiter{
			margin-top: 40px;
		}
		span.label-input100{
			font-weight: lighter;
		}
		
		a.login100-form-btn:hover{
			/* background: #477fae !important; */
			color: white;
			opacity: 0.6;
			transition: .4s !important;
		}
		input:focus{
			border-bottom: 1px solid #477fae
		}
		input::placeholder{
			font-weight: lighter;
		}
		</style>
</head>
<body>
<nav id="nav">
    <div><a href="#">
		<h1 style="align-self: left" data-src="" class="logo">Logo</h1>

      </a></div>
    <div id="toggler">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <ul class="forDesktop">
      <!-- <li><a id="active" href="#">Home</a></li> -->
      <li style="position: relative;"><a class="active" data-ref="fixit" href="../../index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="../signup">Sign Up<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="./signin">Login<div class="activeslider"></div></a></li>
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

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form method="POST" action="../../backend/signin.backend.php" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-32">
						Account Login
					</span>

					<span class="txt1 p-b-11">
						Email
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100" type="email" name="email" >
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="pwd" >
						<span class="focus-input100"></span>
					</div>
					

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="submit" style="background: #477fae !important;"/>
				
						<!-- </button> -->
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>
</html>