<?php
  require_once('includes/config.php');
 
  if(!isset($_SESSION['GuestBook']['id'])) 
  {
	 header('Location: index.php');
	 exit;
  }
  //print_r($_FILES);
  $errors = array();
  $Guest = new guests;
  if(isset($_POST['Save']))
  {
	 $errors = $Guest->validate_add();
	  //print_r($errors);
	  if(!count($errors))
	  {
		  $_POST['users_id'] = $_SESSION['GuestBook']['id'];
		  $_POST['created'] = date("Y-M-D H:M:S");

			if(isset($_POST['hobbies']))
				$_POST['hobbies'] = implode(', ',$_POST['hobbies']);

			if($_FILES['avatar']['error'] == 0)

			{
                 $time=time();
				$src = $_FILES['avatar']['tmp_name'];
                $dest = "images/Avatar/".$time.$_FILES['avatar']['name'];
			   if(move_uploaded_file($src, $dest))
				{
					$_POST['avatar'] = $time.$_FILES['avatar']['name'];
				}
			  }
			if($Guest->save($Guest->table,$_POST))
			//print_r($_POST);exit;
		    {
				$_SESSION['message'] = "Inserted Successfully";
				header("Location: guests.php");
				exit;
			}
  }
  }
 require_once('includes/header.php'); ?>
 <script src="js/jquery-1.11.0.js" type="text/javascript"></script>
 <script type="text/javascript">
 function validation()
 {
   var name=$("#name").val();
   var email=$("#email").val();
   var address=$("#address").val();
   var phone=$("#phone").val();
   var avatar=$("#avatar").val();
   var genderM=document.getElementById('genderM').checked;
   var genderF=document.getElementById('genderF').checked;
   var hobbiesL=document.getElementById('hobbiesL').checked;
   var hobbiesR=document.getElementById('hobbiesR').checked;
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
     if(address=='')
	 {
	    $("#erraddress").fadeIn().html("Please enter address.");
		setTimeout(function(){$("#erraddress").fadeOut();},8000);
		$('#address').focus();return false;
     }
     if(phone=='')
	 {
	    $("#errphone").fadeIn().html("Please enter phone no.");
		setTimeout(function(){$("#errphone").fadeOut();},8000);
		$('#phone').focus();return false;
     }
     else if(!pattern_phone.test(phone))
	 {
	    $("#errphone").fadeIn().html("Please enter valid phone no.");
		setTimeout(function(){$("#errphone").fadeOut();},8000);
		$('#phone').focus();return false;
     }

     if(genderM=='' && genderF=='')
	 {
	    $("#errgender").fadeIn().html("Please select gender.");
		setTimeout(function(){$("#errgender").fadeOut();},8000);
		$('#gender').focus();return false;
     }
     if(avatar=='')
	 {
	    $("#erravatar").fadeIn().html("Please select avatar.");
		setTimeout(function(){$("#erravatar").fadeOut();},8000);
		$('#avatar').focus();return false;
     }
     if(hobbiesL=='' && hobbiesR=='')
	 {
	    $("#errhobbies").fadeIn().html("Please select hobbies.");
		setTimeout(function(){$("#errhobbies").fadeOut();},8000);
		$('#gender').focus();return false;
     }
 }

 </script>
     <div id="wrapper" class="wat-cf">
      <div id="main">



        <div class="block" id="block-forms">
          <div class="secondary-navigation"></div>
          <div class="content">
            <h2 class="title">Add New Guest</h2>
            <div class="inner">
              <form method="post" enctype="multipart/form-data" class="form" onsubmit="return(validation());">
                <div class="group">
                  <label class="label">Name<span class="mandatory">*</span></label>
		 
                  <input type="text" class="text_field" name="name" id="name" value="<?php echo isset($_POST['name'])?$_POST['name']:''; ?>" />
                  <span class="description">Ex: a simple text</span>
		            <?php if(isset($errors['name'])) { ?>
					<div class="error"><?php echo $errors['name']; ?></div>
					<?php } ?>
                    <div class="errors" id="errname"></div>
                </div>
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Email Id</label>                    
                  </div>
                  <input type="text" class="text_field" name="email" id="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>" />
                  <span class="description">Ex: a simple text</span>
				  <?php if(isset($errors['email'])) { ?>
					<div class="error"><?php echo $errors['email']; ?></div>
					<?php } ?>
                    <div class="errors" id="erremail"></div>
                </div>
                <div class="group">
                  <label class="label">Address</label>
                  <textarea class="text_area" rows="5" cols="80" id="address" name="address"><?php echo isset($_POST['address'])?$_POST['address']:''; ?></textarea>
                  <span class="description">Write here a long text</span>
                   <?php if(isset($errors['address'])) { ?>
					<div class="error"><?php echo $errors['address']; ?></div>
					<?php } ?>
                    <div class="errors" id="erraddress"></div>
                </div>
		<div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Phone No.<span class="mandatory">*</span></label>
                  </div>
                  <input type="text" class="text_field" id="phone" name="phone" value="<?php echo isset($_POST['phone'])?$_POST['phone']:''; ?>" />
                  <span class="description">Ex: 123-2323213</span>
				  <?php if(isset($errors['phone'])) { ?>
					<div class="error"><?php echo $errors['phone']; ?></div>
					<?php } ?>
                    <div class="errors" id="errphone"></div>
                </div>
		<div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Gender</label>                    
                  </div>
		  <div>
		          <input type="radio" class="text_field" style="width:20px;" id="genderM" name="gender" value="M" />
		          <label class="radio">Male</label>&nbsp;
			  <input type="radio" class="text_field" style="width:20px;" id="genderF" name="gender" value="F" />
		          <label class="radio">Female</label>
		  </div>
		   <?php if(isset($errors['gender'])) { ?>
					<div class="error"><?php echo $errors['gender']; ?></div>
					<?php } ?>
                    <div class="errors" id="errgender"></div>
                </div>
		<div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Avatar</label>                    
                  </div>
                  <input type="file" class="text_field" style="width:20px;" id="avatar" name="avatar" />
                  <span class="description">jpeg or png</span>
				  <?php if(isset($errors['avatar'])) { ?>
					<div class="error"><?php echo $errors['avatar']; ?></div>
					<?php } ?>
                    <div class="errors" id="erravatar"></div>
                </div>
		<div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Hobbies</label>
                  </div>
                   <div>
		          <input type="checkbox" class="text_field" style="width:20px;" id="hobbiesR"  name="hobbies[]" value="Reading" <?php echo (isset($_POST['hobbies']) && in_array('Reading',$_POST['hobbies'])) ?'checked':''; ?> />
		          <label class="checkbox">Reading Books</label>&nbsp;
			  <input type="checkbox" class="text_field" style="width:20px;" id="hobbiesL" name="hobbies[]" value="Listening" <?php echo (isset($_POST['hobbies']) && in_array('Listening',$_POST['hobbies'])) ?'checked':''; ?> />
		          <label class="checkbox">Listening to Music</label>
		  </div>
		    <?php if(isset($errors['hobbies'])) { ?>
					<div class="error"><?php echo $errors['hobbies']; ?></div>
					<?php } ?>
                    <div class="errors" id="errhobbies"></div>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="Save">
                    <img src="images/icons/tick.png" alt="Save" /> Save
                  </button>
                  <span class="text_button_padding">or</span>
                  <a class="text_button_padding link_button" href="guests.php">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
       

        <?php require_once('includes/right.php'); ?>