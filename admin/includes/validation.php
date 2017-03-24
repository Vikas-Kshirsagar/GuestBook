<?php
function validate_signup()
{
	$errors=array();
	if(empty($_POST['name']))
	{
		$errors['name'] = "Please enter your name";
	}
	elseif(!preg_match("#^[-A-Za-z']*$#",$_POST['name']))
		$errors['name'] = "Please enter valid first name";

	
	if(empty($_POST['email']))
	{
		$errors['email'] = "Please enter email address";
	}
	elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
	{
		$errors['email'] = "Please enter valid email address";
	}

		if(empty($_POST['password']))
	{
		$errors['password'] = "Please enter your password";
	}

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
		$errors['address'] = "Please enter your address";
	}
	if(empty($_POST['phone_no']))
	{
		$errors['phone_no'] = "Please enter your phone no";
	}
	if(empty($_POST['gender']))
	{
		$errors['gender'] = "please select your gender";
	}
	
	if(empty($_FILES['photo']['name']))
	{
		$errors['photo']="please select photo";
	}
	if($_FILES['photo']['error'] == 0)
	{
	$types = array('image/jpeg','image/gif','image/png','application/pdf');
	if(!in_array($_FILES['photo']['type'],$types))
		$errors['photo'] = "please enter photo of type jpeg or png or gif";
	}
	if(empty($_POST['hobbies']))
	{
		$errors['hobbies'] = "please select your hobbies";
	}
	
	
	return $errors;
}

function validate_email()
{
	$errors=array();
	if(empty($_POST['email']))
	{
		$errors[] = "Please enter email address";
	}
	elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
	{
		$errors[] = "Please enter valid email address";
	}

	return $errors;
}
function validate_change()
{
	$errors=array();


		if(empty($_POST['oldpassword']))
	{
		$errors['oldpassword'] = "Please enter your password";
	}

        	if(empty($_POST['newpassword']))
	{
		$errors['newpassword'] = "Please enter your New Password";
	}
        	if($_POST['repassword']!== $_POST['newpassword'])
	{
		$errors['repassword'] = "Password is not matching.";
	}
	return $errors;
}

?>