<?php
require_once('includes/config.php');
$errors = array();
$Guest = new users;
if(isset($_POST['add']))
{
	$errors = $Guest ->validate_signup();
	if(count($errors) == 0)
	{
		$result = $Guest->save($Guest->table,$_POST);
		if(count($result))
		{
			header('location: signup_success.php');
		}
		else
			echo "Couldnot add guest.";
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
   var name=$("#name").val();
   var email=$("#email").val();
   var password=$("#password").val();
   var pattern_name = /^[A-Za-a ]{1,15}$/i;
   var pattern_email=/^[a-z0-9._-]+@[a-z]+.[a-z.]{2,15}$/i;
   var pattern_phone = /^[0-9]{1,10}$/i;

   if(name=='')
	 {
	    $("#errname").fadeIn().html("Please enter name.");
		setTimeout(function(){$("#errname").fadeOut();},8000);
		$('#name').focus();return false;
     }
     else if(!pattern_name.test(name))
	 {
	    $("#errname").fadeIn().html("Please enter valid name.");
		setTimeout(function(){$("#errname").fadeOut();},8000);
		$('#name').focus();return false;
     }
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
	    $("#errpassword").fadeIn().html("Please enter address.");
		setTimeout(function(){$("#errpassword").fadeOut();},8000);
		$('#password').focus();return false;
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
     
      <div class="block" id="block-signup">
        <h2>Sign up</h2>
        <div class="content">
          <form onsubmit="return(validation());" class="form" method="POST" enctype="multipart/form-data">
            <div class="group wat-cf">
              <div class="left">
                <label class="label">Name</label>
              </div>
              <div class="right">
                <input type="text" class="text_field" id="name" name="name" value="<?php echo isset($_POST['name'])?$_POST['name']:''; ?>" />
                <span class="description">Ex: Devchand Sonsathi</span>
                <?php if(isset($errors['name'])) { ?><div class="error"><?php echo $errors['name'];?></div><?php } ?>
                <div class="errors" id="errname"></div>
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label">Email</label>
              </div>
              <div class="right">
                <input type="text" class="text_field" name="email" id="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>" />
                <span class="description">Ex: test@example.com</span>
              <?php if(isset($errors['email'])) { ?><div class="error"><?php echo $errors['email'];?></div><?php } ?>
              <div class="errors" id="erremail"></div>
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label">Password</label>
              </div>
              <div class="right">
                <input type="password" class="text_field" name="password" id="password" value="<?php echo isset($_POST['password'])?$_POST['email']:''; ?>" />
                <span class="description">Must contains the word '****'</span>
                <?php if(isset($errors['password'])) { ?><div class="error"><?php echo $errors['password'];?></div><?php } ?>
                <div class="errors" id="errpassword"></div>
              </div>
            </div>
            <div class="group navform wat-cf">
              <button class="button" type="submit" name="add">
                <img src="images/icons/tick.png" alt="Save" /> Signup
              </button>
            </div>
          </form>
        </div>
      </div>

     
    </div>
  </div>

</body>
</html>

