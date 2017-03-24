<?php
  require_once('includes/config.php');
  if(!isset($_SESSION['GuestBook']['id']))
  {
	header('Location: index.php');
	exit;
  }
  $Guest = new guests;
  $users = new users;
 $rowG = $Guest->select($Guest->table);
 $rowU = $users->select($users->table);
 //$rowM = $Guest->select($Guest->table,'',"users_id='".$_SESSION['GuestBook']['id']."' AND gender='M'");
 //$rowF = $Guest->select($Guest->table,'',"users_id='".$_SESSION['GuestBook']['id']."' AND gender='F'");
 require_once('includes/header.php'); ?>

    <div id="wrapper" class="wat-cf">
      <div id="main">

 	<div class="inner">
			 <?php if(isset($_SESSION['message'])) { ?>
              <div class="flash">
                <div class="message notice">
                  <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
                </div>
              </div>
			  <?php } ?>
       </div>


        <div class="block" id="block-tables">
          <div class="secondary-navigation"></div>
          <div class="content">
            <h2 class="title">My Dashboard</h2>
	    <div class="actions-bar wat-cf">
                  <div class="actions" style="float:right;padding-right:5px;">
                    <button class="button" type="submit" onclick="window.location='add_guest.php';">
                      <img src="images/icons/tick.png" alt="Add New Guest" /> New Guest
                    </button>
                  </div>
            </div>

            <div class="inner">
               <table class="table">
                  <tr>
                    <td style="width: 200px; font-size:14px">Total Guests</td>
                    <td><?php echo count($rowG);?></td>
                  </tr>
                  <tr>
                    <td style="width: 200px; font-size:14px">Total Users</td>
                    <td><?php echo count($rowU);?></td>
                  </tr>

                </table>
            </div>
          </div>
        </div>
       <?php require_once('includes/right.php'); ?>      