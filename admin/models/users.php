<?php
class users extends DB
{
	var $table = "users";

function validate_signup()
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

		if(empty($_POST['password']))
	{
		$errors['password'] = "Please enter your password";
	}

	return $errors;
}

function validate_profile()
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


	return $errors;
}
}
?>
