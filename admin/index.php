<?php
  require_once('includes/config.php');
  $errors = array();
  $User = new admin;
  if(isset($_POST['Login']))
  {      $password=md5($_POST['password']);
	  $result = $User->select($User->table,'',"email='{$_POST['email']}' AND password='{$password}'");
	  //print_r(count($result));exit;
	   if(count($result))
	  {
		  $_SESSION['GuestBook'] = $result[0];
		  unset($_SESSION['GuestBook']['password']);
		  header("Location: dashboard.php");
		  exit;
	  }
	  else
		  $errors['Login'] = "Login Failed. Please try again.";

  }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Guestbook</title>
  <link rel="stylesheet" href="css/base.css" type="text/css" media="screen" />
  <link rel="stylesheet" id="current-theme" href="css/bec/style.css" type="text/css" media="screen" />
<script src="js/jquery-1.11.0.js" type="text/javascript"></script>
<script type="text/javascript">
 function validation()
 {
   var password=$("#password").val();
   var email=$("#email").val();
   var pattern_email=/^[a-z0-9._-]+@[a-z]+.[a-z.]{2,15}$/i;


     if(email=='')
	 {
	    $("#erremail").fadeIn().html("Please enter email address.");
		setTimeout(function(){$("#erremail").fadeOut();},8000);
		$('#email').focus();return false;
     }
     else if(!pattern_email.test(email))
	 {
	    $("#erremail").fadeIn().html("Please enter valid email address.");
		setTimeout(function(){$("#erremail").fadeOut();},8000);
		$('#email').focus();return false;
     }
     if(password=='')
	 {
	    $("#errpassword").fadeIn().html("Please enter password.");
		setTimeout(function(){$("#errpassword").fadeOut();},8000);
		$('#password').focus();return false;
     }

 }

 </script>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1><a href="index.php">Admin</a></h1>
      
      
    </div>
    <div id="wrapper" class="wat-cf">
      
      
    <div id="box">
     
      <div class="block" id="block-login">
        <h2>Login</h2>
        <div class="content login">
		<?php if(isset($errors['Login'])) { ?>
          <div class="flash">
            <div class="message notice">
              <p><?php echo $errors['Login']; ?></p>
            </div>
          </div>
		  <?php } ?>
          <form class="form login" method="post" onsubmit="return(validation());">
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">Email Address</label>
              </div>
              <div class="right">
                <input type="text" class="text_field" id="email" name="email" />
              <div class="errors" id="erremail"></div>
              </div>

            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">Password</label>
              </div>
              <div class="right">
                <input type="password" class="text_field" id="password" name="password" />
                <div class="errors" id="errpassword"></div>
             </div>
            </div>
            <div class="group navform wat-cf">
              <div class="right">
                <button class="button" type="submit" name="Login">
                  <img src="images/icons/key.png" alt="Save" /> Login
                </button>

              </div>
            </div>
	    
          </form>
	  <div class="group navform wat-cf">
              <div class="right">
                
		<span class="text_button_padding">If you forgot the password. Please click on <a class="text_button_padding link_button" style="float:right;padding-top:0px;" href="forgot_password.php">Forgot Password</a></span>
                  
              </div>
            </div>
        </div>
      </div>

     
    </div>
  </div>

</body>
</html>

