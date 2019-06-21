<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
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

	<link rel="stylesheet" type="text/css" href="../indexStyle.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
		
		a.login100-form-btn:hover{
			/* background: #477fae !important; */
			color: white;
			opacity: 0.6;
			transition: .4s !important;
		}
		input:focus{
			border-bottom: 1px solid #477fae
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




	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign Up
					</span>
				</div>

				<form class="login100-form validate-form" method="P">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

				
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Enter Email">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

							<!-- <div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

				<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div> -->

					<div class="container-login100-form-btn">
						<a style="border: 1px solid #477fae; background: none; color: #477fae !important; cursor: pointer; text-align: center; margin: auto;" class="login100-form-btn">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

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