<?php
  require_once('includes/config.php');
  if(!isset($_SESSION['GuestBook']['id']))
  {
	 header('Location: index.php');
	 exit;
  }
  $Guest = new guests;
  $row = $Guest->select($Guest->table,'avatar',"id=".$_GET['id']);
   
  if($Guest->delete($Guest->table,"id=".$_GET['id']))
  {
	  unlink("images/Avatar/".$row[0]['avatar']);
	  $_SESSION['message'] = "Deleted Successfully";
	  header("Location: guests.php");
	  exit;
  }
?>