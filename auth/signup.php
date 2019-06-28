<?php
	session_start();
	if(isset($_SESSION['first_name'])){
		header("Location: ../index");
	}
  $error="";
  if(isset($_GET['signup'])){
    if($_GET['signup'] == "usertaken"){
      $error="<h3 style='color: red; text-align: center; font-weight: 100; '>User Taken</h3>";
    } else if($_GET['signup'] == "empty"){
      $error="<h3 style='color: red; text-align: center; font-weight: 100;  '>Login failed: empty fields</h3>";
    } else {

		}

  }
?>

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

	<link rel="stylesheet" type="text/css" href="../indexstyle.css">
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
    <div id="toggler" onclick="toggleHandler()">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <ul class="forDesktop">
      <!-- <li><a id="active" href="#">Home</a></li> -->
      <li style="position: relative;"><a class="active" data-ref="fixit" href="../index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./signup">Sign Up<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="./signin-auth/signin">Login<div class="activeslider"></div></a></li>
    </ul>
    
    
  </nav>
  <ul class="forDropDown" >
      <div class="cancont">
        <i class="fas fa-window-close" id="cancel" onclick="toggleHandler()"></i>
      </div>
			<li style="position: relative;"><a class="active" data-ref="fixit" href="../index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./signup">Sign Up<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="./signin-auth/signin">Login<div class="activeslider"></div></a></li>

    </ul>




	<div class="limiter" >
		<div class="container-login100">
			<div style=" margin-top: 30px;" class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-03.jpg); background: #477fae">
					<span class="login100-form-title-1">
						Sign Up
					</span>
				</div>

				<form  class="login100-form validate-form" action="../backend/signup.backend.php" method="post">
						<?php echo $error ?>
					<div class="wrap-input100 validate-input m-b-26" data-validate="First name is required">
						<span class="label-input100">First Name</span>
						<input class="input100" type="text" name="first_name" placeholder="Enter first name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Last name is required">
						<span class="label-input100">Last Name</span>
						<input class="input100" type="text" name="last_name" placeholder="Enter last name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Enter Email">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pwd" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
				
						<input type="submit" name="submit" style="border: 1px solid #477fae; background: none; color: #477fae !important; cursor: pointer; text-align: center; margin: auto;"  class="login100-form-btn" value="Sign Up">
					</div>
				
				</form>
				<p style="text-align: center; margin: 2px auto 10px;">Already have and account? <a href="#">Sign In</a></p>
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
<script>
	let show = false
const toggleHandler = ()=> {
    show = !show;
      if (show){
        
        document.querySelector(".forDropDown").classList.add("slideDown")
      } else{
        document.querySelector(".forDropDown").classList.remove("slideDown")
      }
  }
</script>
</body>
</html>