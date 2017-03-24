<?php
require_once('includes/config.php');
if(!isset($_SESSION['GuestBook']['id']))
{
	header("Location: index.php");
	exit;
}
$Guest = new users;
$users= $Guest->select($Guest->table,'',"id=".$_SESSION['GuestBook']['id']);
require_once('includes/header.php'); ?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
	
    <div class="inner">
			 <?php if(isset($_SESSION['message'])) { ?>
              <div class="flash">
                <div class="message notice">
                  <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
                </div>
              </div>
			  <?php } ?>
       </div>
        

        <div class="block" id="block-tables">
          <div class="secondary-navigation"></div>
          <div class="content">
            <h2 class="title">My Profile</h2>
	    <div class="actions-bar wat-cf">
                  <div class="actions" style="float:right;padding-right:5px;">
                    <button class="button" type="submit" onclick="window.location='edit_profile.php';">
                      <img src="images/icons/tick.png" alt="Add New Guest" /> Edit Profile
                    </button>
                  </div>
            </div>

            <div class="inner">
              <form action="" method="post" enctype="multipart/form-data" class="form">
                <div class="group">
                  <label class="label">Name</label>
		 
                  <?php echo $users[0]['name'];?>
                  
		  
                </div>
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Email Id</label>                    
                  </div>
                  <?php echo $users[0]['email'];?>
                  
                </div>
                
              </form>
            </div>
          </div>
        </div>

      <?php require_once('includes/right.php'); ?>