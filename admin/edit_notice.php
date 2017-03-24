<?php
  require_once('includes/config.php');
  $Guest = new notices;
  $errors = array(); 
  if(isset($_POST['Save']))
  {
	  $errors = $Guest->validate();
	  //print_r($errors);
	  if(!count($errors))
	  {
        	$Guest->save($Guest->table,$_POST,"id=".$_GET['id']);
            $_SESSION['message'] = "Updated Successfully";
            header("Location:notice.php");exit;

	  }
  }
  else
  {
	  $row = $Guest->select($Guest->table,'',"id=".$_GET['id']);
	  $_POST = $row[0];
  }

 require_once('includes/header.php'); ?>
<script src="js/jquery-1.11.0.js" type="text/javascript"></script>
<script type="text/javascript">
 function validation()
 {
   var title=$("#title").val();
   var notices=$("#notices").val();
   var pattern_title = /^[A-Za-a ]{1,100}$/i;

   if(title=='')
	 {
	    $("#errname").fadeIn().html("Please enter title.");
		setTimeout(function(){$("#errname").fadeOut();},8000);
		$('#title').focus();return false;
     }
     else if(!pattern_title.test(title))
	 {
	    $("#errname").fadeIn().html("Please enter valid title.");
		setTimeout(function(){$("#errname").fadeOut();},8000);
		$('#title').focus();return false;
     }
     if(notices=='')
	 {
	    $("#erraddress").fadeIn().html("Please enter notice.");
		setTimeout(function(){$("#erraddress").fadeOut();},8000);
		$('#notices').focus();return false;
     }

 }

 </script>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        

        <div class="block" id="block-forms">
          <div class="secondary-navigation"></div>
          <div class="content">
            <h2 class="title">Edit Guest</h2>
            <div class="inner">
              <form onsubmit="return(validation());" method="post" enctype="multipart/form-data" class="form">
                <div class="group">
                  <label class="label">Name<span class="mandatory">*</span></label>
		 
                  <input type="text" class="text_field" name="title" id="title" value="<?php echo isset($_POST['title'])?$_POST['title']:''; ?>" />
                  <span class="description">Ex: a simple text</span>
		            <?php if(isset($errors['title'])) { ?>
					<div class="error"><?php echo $errors['title']; ?></div>
					<?php } ?>
                    <div class="errors" id="errname"></div>
                </div>
                <div class="group">
                  <label class="label">Address</label>
                  <textarea class="text_area" rows="5" id="notices" cols="80" name="notice"><?php echo isset($_POST['notice'])?$_POST['notice']:''; ?></textarea>
                  <span class="description">Write here a long text</span>
                  <div class="errors" id="erraddress"></div>
                  <?php if(isset($errors['notice'])) { ?>
					<div class="error"><?php echo $errors['notice']; ?></div>
					<?php } ?>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="Save">
                    <img src="images/icons/tick.png" alt="Save" /> Save
                  </button>
                  <span class="text_button_padding">or</span>
                  <a class="text_button_padding link_button" href="dashboard.php">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>

        <?php require_once('includes/right.php'); ?>
