<?php
  require_once('includes/config.php');
  //print_r($_FILES);
  $Guest = new users;
  $errors = array();
  if(isset($_POST['Save']))
  {
     $errors = $Guest->validate_profile();
	 if(!count($errors))
	  {
			if($Guest->save($Guest->table,$_POST,"id=".$_SESSION['GuestBook']['id']))
		    {
				$_SESSION['message'] = "Updated Successfully";
				header("Location: guests.php");
				exit;
				
			}
	  }
  }

   $users= $Guest->select($Guest->table,'',"id=".$_SESSION['GuestBook']['id']);
 require_once('includes/header.php'); ?>

    <div id="wrapper" class="wat-cf">
      <div id="main">

        

        <div class="block" id="block-forms">
          <div class="secondary-navigation"></div>
          <div class="content">
            <h2 class="title">Edit User</h2>
            <div class="inner">
              <form method="post" enctype="multipart/form-data" class="form">
                <div class="group">
                  <label class="label">Name<span class="mandatory">*</span></label>
		 
                  <input type="text" class="text_field" name="name" value="<?php echo $users[0]['name']; ?>" />
                  <span class="description">Ex: a simple text</span>
		            <?php if(isset($errors['name'])) { ?>
					<div class="error"><?php echo $errors['name']; ?></div>
					<?php } ?>
                </div>
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Email Id</label>                    
                  </div>
                  <input type="text" class="text_field" name="email" value="<?php echo $users[0]['email']; ?>" />
                  <span class="description">Ex: a simple text</span>
				  <?php if(isset($errors['email'])) { ?>
					<div class="error"><?php echo $errors['email']; ?></div>
					<?php } ?>
                </div>

                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="Save">
                    <img src="images/icons/tick.png" alt="Save" /> Save
                  </button>
                  <span class="text_button_padding">or</span>
                  <a class="text_button_padding link_button" href="#header">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
          
        <?php require_once('includes/right.php'); ?>
