<?php
  require_once('includes/config.php');
  unset($_SESSION['GuestBook']);
  header("Location: index.php");
  exit;
?>