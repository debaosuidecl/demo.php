<?php 
session_start();

 ?>
 
 <html>
    <head>
      <!--Import Google Icon Font-->
      <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
      <!--Import materialize.css-->
      <!-- <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/> -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link href="./fontawesome-free-5.9.0-web/css/fontawesome.css" rel="stylesheet">
      <link href="./fontawesome-free-5.9.0-web/css/brands.css" rel="stylesheet">
  <link href="./fontawesome-free-5.9.0-web/css/solid.css" rel="stylesheet">
  <link href="./fontawesome-free-5.9.0-web/css/all.css" rel="stylesheet">


      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" href="indexstyle.css">
      
    </head>

    <body>
    
    <nav id="nav">
    <div><a href="#">
        <h1 style="align-self: left" class="logo">Logo</h1>
      </a></div>
    <div id="toggler" onclick="toggleHandler()">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <ul class="forDesktop">
  
      <li style="position: relative;"><a class="active" data-ref="fixit" href="./index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="#">About<div class="activeslider"></div></a></li>
      <!-- <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="#whatwedo">Partners<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="partnernav" data-ref="partners" href="#partners">Clients<div class="activeslider"></div></a></li>
   -->
      <li style="position: relative;"><a  id="contactnav"data-ref="contact" href="#contact">Settings<div class="activeslider"></div></a></li>
      <?php if(isset($_SESSION['first_name'])){?>
 <li>  <a href="index"> <i class="fas fa-user" style="margin-right: 10px;"></i><?php echo $_SESSION['first_name']?> </a></li>
 <li>  <a href="#" onclick="logout()">Logout </a></li>

      <?php }  else {?>
        <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./auth/signup">Signup<div class="activeslider"></div></a></li>
        <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./auth/signin-auth/signin">Signin<div class="activeslider"></div></a></li>
      <?php }?>
    </ul>
    
    
  </nav>
  <ul class="forDropDown">
      <div class="cancont">
        <i class="fas fa-window-close" id="cancel" onclick="toggleHandler()"></i>
      </div>
      <li style="position: relative;"><a class="active" data-ref="fixit" href="./index">Home<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="aboutnav" data-ref="about" href="#">About<div class="activeslider"></div></a></li>
      <!-- <li style="position: relative;"><a id="whatwedonav" data-ref="whatwedo" href="#whatwedo">Partners<div class="activeslider"></div></a></li>
      <li style="position: relative;"><a id="partnernav" data-ref="partners" href="#partners">Clients<div class="activeslider"></div></a></li>
   -->
      <li style="position: relative;"><a  id="contactnav"data-ref="contact" href="#contact">Settings<div class="activeslider"></div></a></li>
      <?php if(isset($_SESSION['first_name'])){?>
 <li>  <a href="index"> <i class="fas fa-user" style="margin-right: 10px;"></i><?php echo $_SESSION['first_name']?> </a></li>
 <li>  <a href="#" onclick="logout()">Logout </a></li>

      <?php }  else {?>
        <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./auth/signup">Signup<div class="activeslider"></div></a></li>
        <li style="position: relative;"><a id="aboutnav" data-ref="about" href="./auth/signin-auth/signin">Signin<div class="activeslider"></div></a></li>
      <?php }?>

    </ul>

    <div class="mycontainer" style="margin-top: 1px;"> 
    <?php
if(isset($_SESSION['first_name'])){?>
  <h2 style="width: 70%; margin: 20px auto; font-weight:lighter; color: #477fae; " class="userWelcomeText">Welcome  <?php echo $_SESSION['first_name']?>,</h2>
<?php } ?>
        <div class="whatwedoicons"> 
        
        <div class="card" style="width: 18rem;">
            <img class="" src="includes/toolbox.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Quotation and Invoice Generator</h5>
                <p class="card-text"> Generate your professional quotations and invoices with beautiful templates</p>
                 <a href="./invoice-generator" class="btn btn-primary" style="background: #477fae; border: none; margin-top: 5px">Try it Now!</a>
           </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="" src="includes/window-cleaner.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Bio/Intro Creator</h5>
                <p class="card-text"><!-- Our professional team of Home Maintenance experts and Technicians are here to attend to all requests -->
                Generate a Bio or Short introduction based on a
                questionnaire You fill about your profile.
</p>
                 <a href="#contact" class="btn btn-primary" style="background: #477fae; border: none; margin-top: 5px">Try it Now</a>
           </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="" src="includes/improvement.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">CV Creator</h5>
                <p class="card-text">Generate a CV based on a questionnaire You fill about
Your profile</p>
                 <a href="#contact" class="btn btn-primary" style="background: #477fae; border: none; margin-top: 5px">Try it Now!</a>
           </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="" src="includes/business.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Business Card Generator</h5>
                <p>Generate several  business cards based on a questionnaire
you fill about your profile. Choose from a plethora of templates.</p>

                 <a href="#contact" class="btn btn-primary" style="background: #477fae; border: none; margin-top: 5px">Try it Now!</a>
           </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="" src="includes/diploma.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"> Certificate Generator</h5>
                <p>Generate several  Certificates based on a questionnaire
you fill about your profile. Choose from a plethora of templates.</p>

                 <a href="#contact" class="btn btn-primary" style="background: #477fae; border: none; margin-top: 5px">Try it Now!</a>
           </div>
        </div>
       <div class="card" style="width: 18rem;">
            <img class="" src="includes/calculator.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Product Price Calculator</h5>
                <p>Calculate price of a products based on some questions
that we ask</p>

                 <a href="#contact" class="btn btn-primary" style="background: #477fae; border: none; margin-top: 5px">Try it Now!</a>
           </div>
        </div>

</div>
    </div>
      <!-- <script type="text/javascript" src="js/materialize.min.js"></script> -->
      <script data-cfasync="false"  src="jquery-3.2.1.min.js"></script>

      <script>

      const logout = ()=> {
    $.ajax({
              url: 'backend/logout.backend.php',
              datatype: 'json',
              type: 'post',
              data:{submit: true},
              // timeout: 5000,
              success: function(data){
                        window.location.href = "index.php?logout=success"
                }
              });

  }
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