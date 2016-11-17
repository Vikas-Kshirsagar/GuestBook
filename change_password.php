<?php
require_once('includes/config.php');
$errors = array();
 $Guest = new users;
if(isset($_POST['Change']))
{
	$errors = validate_change();
	if(count($errors) == 0)
	{
      $row = $Guest->select($Guest->table,'',"id=".$_SESSION["GuestBook"]['id']);
      if($_POST["oldpassword"] == $row[0]["password"])
      {
      $_POST["password"] = $_POST["newpassword"];
      $Guest->save($Guest->table,$_POST,"id=".$_SESSION["GuestBook"]['id']);
      $_SESSION['message'] = "Your Password Changed";
      header("Location: guests.php");exit;
      }
       else
       {$_SESSION['message'] = "Current Password is not correct";}
	}
}
require_once('includes/header.php'); ?>
<script src="js/jquery-1.11.0.js" type="text/javascript"></script>
<script type="text/javascript">
 function validation()
 {
   var newpassword=$("#newpassword").val();
   var oldpassword=$("#oldpassword").val();
   var conpassword=$("#conpassword").val();


    if(oldpassword=='')
    {
      $("#erroldpass").fadeIn().html("Please enter old password.");
      setTimeout(function(){$("#erroldpass").fadeOut();},8000);
      $('#oldpassword').focus();return false;
    }
    if(newpassword=='')
    {
      $("#errnewpass").fadeIn().html("Please enter new password.");
      setTimeout(function(){$("#errnewpass").fadeOut();},8000);
      $('#newpassword').focus();return false;
    }
    else if(newpassword==conpassword)
    {
      $("#errnewpass").fadeIn().html("Current password and new password could not be same.");
      setTimeout(function(){$("#errnewpass").fadeOut();},8000);
      $('#newpassword').focus();return false;
    }

    if(conpassword=='')
    {
      $("#errconpass").fadeIn().html("Please enter confirm password.");
      setTimeout(function(){$("#errconpass").fadeOut();},8000);
      $('#conpassword').focus();return false;
    }
    else if(newpassword!==conpassword)
    {
      $("#errconpass").fadeIn().html("Password are not same.");
      setTimeout(function(){$("#errconpass").fadeOut();},8000);
      $('#conpassword').focus();return false;
    }
 }

 </script>
    <div id="wrapper" class="wat-cf">


    <div id="box">

      <div class="block" id="block-signup">
        <h2>Change Password</h2>
        <div class="content">
        <div class="inner">
			 <?php if(isset($_SESSION['message'])) { ?>
              <div class="flash">
                <div class="message notice">
                  <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
                </div>
              </div>
			  <?php } ?>
       </div>
       <br />
          <form onsubmit="return(validation());" class="form" method="POST" enctype="multipart/form-data">
            <div class="group wat-cf">
              <div class="left">
                <label class="label">Current Password</label>
              </div>
              <div class="right">
                <input type="password" class="text_field" id="oldpassword" name="oldpassword" value="<?php echo isset($_POST['oldpassword'])?$_POST['oldpassword']:''; ?>" />
                <?php if(isset($errors['oldpassword'])){?> <div class="error"><?php echo $errors['oldpassword']; ?></div><?php }?>
                <div class="errors" id="erroldpass"></div>
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label">New Password</label>
              </div>
              <div class="right">
                <input type="password" class="text_field" id="newpassword" name="newpassword" value="<?php echo isset($_POST['newpassword'])?$_POST['newpassword']:''; ?>" />
                <?php if(isset($errors['newpassword'])){?> <div class="error"><?php echo $errors['newpassword']; ?></div><?php }?>
                <div class="errors" id="errnewpass"></div>
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label">Re-Enter Password</label>
              </div>
              <div class="right">
                <input type="password" class="text_field" id="conpassword" name="repassword" value="<?php echo isset($_POST['repassword'])?$_POST['repassword']:''; ?>" />
                <?php if(isset($errors['repassword'])){?> <div class="error"><?php echo $errors['repassword']; ?></div><?php }?>
                <div class="errors" id="errconpass"></div>
              </div>
            </div>
            <div class="group navform wat-cf">
              <button class="button" type="submit" name="Change">
                <img src="images/icons/tick.png" alt="Save" /> Change
              </button>
              <span class="text_button_padding">or</span>
                  <a class="text_button_padding link_button" href="guests.php">Cancel</a>
            </div>
          </form>
        </div>
      </div>


    </div>
  </div>

</body>
</html>

