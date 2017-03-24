<?php
class guests extends DB
{
	var $table = "guests";

	function validate()
	  {
		  $errors = array();
		  
		  if(empty($_POST['name']))
			  $errors['name'] = "You must enter name.";
		  elseif(!preg_match("#^[-A-Za-z' ]*$#",$_POST['name']))
				$errors['name'] = "Please enter valid name.";
           if(empty($_POST['email']))
			  $errors['email'] = "You must enter email.";
		    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
				$errors['email'] = "Please enter valid email address.";

		   if(empty($_POST['phone']))
			  $errors['phone'] = "You must enter phone no.";
		  elseif(!preg_match("#^[0-9 -]*$#",$_POST['phone']))
				$errors['phone'] = "Please enter valid phone no.";
			
			$types = array('image/jpeg','image/jpg','image/png');
			if($_FILES['avatar']['error'] == 0 && !in_array($_FILES['avatar']['type'], $types))
				$errors['avatar'] = "Please upload the image of valid type.";

		  return $errors;
	  }
	  
	  function validate_add()
{
	$errors=array();
	if(empty($_POST['name']))
	{
		$errors['name'] = "Please enter your name";
	}
	elseif(!preg_match("#^[-A-Za-z' ]*$#",$_POST['name']))
		$errors['name'] = "Please enter valid first name";

	
	if(empty($_POST['email']))
	{
		$errors['email'] = "Please enter email address";
	}
	elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
	{
		$errors['email'] = "Please enter valid email address";
	}
		if(empty($_POST['address']))
	{
		$errors['address'] = "Please enter address";
	}
	if(empty($_POST['phone']))
	{
		$errors['phone'] = "Please enter phone no";
	}
	if(empty($_POST['gender']))
	{
		$errors['gender'] = "please select gender";
	}
	
	if(empty($_FILES['avatar']['name']))
	{
		$errors['avatar']="please select photo";
	}
	if($_FILES['avatar']['error'] == 0)
	{
	$types = array('image/jpeg','image/gif','image/png','application/pdf');
	if(!in_array($_FILES['avatar']['type'],$types))
		$errors['avatar'] = "please enter photo of type jpeg or png or gif";
	}
	if(empty($_POST['hobbies']))
	{
		$errors['hobbies'] = "please select hobbies";
	}
	
	
	return $errors;
}

}
?>
