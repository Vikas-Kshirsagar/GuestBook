<?php
class notices extends DB
{
	var $table = "notices";

function validate()
{
	$errors=array();
	if(empty($_POST['title']))
	{
		$errors['title'] = "Please enter title";
	}
	elseif(!preg_match("#^[-A-Za-z' ]*$#",$_POST['title']))
		$errors['title'] = "Please enter valid title";


	if(empty($_POST['notice']))
	{
		$errors['notice'] = "Please enter notice";
	}
	
	return $errors;
}
}
?>
