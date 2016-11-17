<?php
  require_once('includes/config.php');
  //print_r($_POST);
  $errors = array();
  $User = new users;
  if(isset($_POST['Login']))
  {
    $errors = validate_email();
    if(!count($errors))
	{
	$condition ="email='".$_POST['email']."'";
    $result = $User->select($User->table,'',$condition);
	   if(count($result))
	  {
         $newpass = rand(111,999);
          $_POST['password'] = $newpass;
          $User->save($User->table,$_POST,$condition);
          $errors['Login'] = "Your new password $newpass.";
	  }
	  else
		  $errors['Login'] = "Your not Authorised user.";

  }
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

 }

 </script>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1><a href="index.php">Guestbook</a></h1>
      
      
    </div>
    <div id="wrapper" class="wat-cf">
      
      
    <div id="box">
     
      <div class="block" id="block-login">
        <h2>Forget Password</h2>
        <div class="content login">
		<?php if(isset($errors['Login'])) { ?>
          <div class="flash">
            <div class="message notice">
              <p><?php echo $errors['Login']; ?></p>
            </div>
          </div>
		  <?php } ?>
          <form class="form login" onsubmit="return(validation());" method="post">
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">Email Address</label>
              </div>
              <div class="right">
                <input type="text" id="email" class="text_field" name="email" />
                <?php if(isset($errors['email'])){?> <div class="error"><?php echo $errors['email']; ?></div><?php }?>
                <div class="errors" id="erremail"></div>
              </div>
            </div>
            <div class="group navform wat-cf">
              <div class="right">
                <button class="button" type="submit" name="Login">
                  <img src="images/icons/key.png" alt="Save" /> Submit
                </button>
		<span class="text_button_padding">or</span>
                  <a class="text_button_padding link_button" href="index.php">Login</a>

                  
              </div>
            </div>
	    
          </form>
        </div>
      </div>

     
    </div>
  </div>

</body>
</html>

