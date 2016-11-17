<?php
  require_once('includes/config.php');
  //print_r($_FILES);
  $Guest = new guests;
  $errors = array();
   $row = $Guest->select($Guest->table,'',"id=".$_GET['id']);
   $_POST = $row[0];

require_once('includes/header.php'); ?>

    <div id="wrapper" class="wat-cf">
      <div id="main">



        <div class="block" id="block-forms">
          <div class="secondary-navigation"></div>
          <div class="content">
            <h2 class="title">Guest Details</h2>
            <div class="actions-bar wat-cf">
                  <div class="actions" style="float:right;padding-right:5px;">
                    <button class="button" onclick="window.location='edit-guest.php?id=<?php echo $_GET['id']; ?>';">
                      <img src="images/icons/tick.png" alt="Edit Guest" /> Edit Guest
                    </button>
                  </div>
            </div>
            <div class="inner">
              <form action="" method="post" enctype="multipart/form-data" class="form">
                <div class="group">
                  <label class="label">Name</label>

                    <span class="guest-view"><?php echo isset($_POST['name'])?$_POST['name']:''; ?></span>

                </div>
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Email Id</label>
                  </div>
                  <span class="guest-view"><?php echo isset($_POST['email'])?$_POST['email']:''; ?></span>

                </div>
                <div class="group">
                  <label class="label">Address</label>
                  <span class="guest-view"><?php echo isset($_POST['address'])?$_POST['address']:''; ?></span>

                </div>
		<div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Phone No.</label>
                  </div>
                  <span class="guest-view"><?php echo isset($_POST['phone'])?$_POST['phone']:''; ?></span>

                </div>
		<div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Gender</label>
                  </div>
                    <span class="guest-view"><?php if($_POST['gender']=='M'){echo "Male";}if($_POST['gender']=='F'){echo "Female";} ?></span>
                </div>
		<div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Avatar</label>
                  </div>

				  <span class="description"><img src="images/Avatar/<?php echo $_POST['avatar']; ?>" width="125px" height="100px" /> </span>

                </div>
		<div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Hobbies</label>
                  </div>
                   <span class="guest-view"><?php echo isset($_POST['hobbies'])?$_POST['hobbies']:''; ?></span>
                </div>

              </form>
            </div>
          </div>
        </div>
        <?php require_once('includes/right.php'); ?>
