<?php
define('HTTP_DOMAIN', 'C:/xampp/htdcs/dev/GuestBookClass/');

define('FTP_DOMAIN', 'C:/xampp/htdcs/dev/GuestBookClass/');

define('FTP_AVATAR_DIR', FTP_DOMAIN.'images/Avatar/');
define('HTTP_AVATAR_DIR', HTTP_DOMAIN.'images/Avatar/');

require_once('models/db.php');
require_once('includes/database.php');
require_once('includes/validation.php');
session_name('GuestBook');
session_start();
?>
