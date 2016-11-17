<?php
  require_once('includes/config.php');
  if(!isset($_SESSION['GuestBook']['id']))
  {
	header('Location: index.php');
	exit;
  }
  $Guest = new guests;
  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  $start_from = ($page-1) * 3;
 // $limit= 0, 3;
  $rows = mysql_query("SELECT * FROM guests where users_id='".$_SESSION['GuestBook']['id']."' ORDER BY name LIMIT $start_from, 3");
  //$rows = $Guest->select($Guest->table,'',"users_id=".$_SESSION['GuestBook']['id'],'',$limit);

/*if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * 3;
$rows = mysql_query("SELECT * FROM guests where users_id='".$_SESSION['GuestBook']['id']."' ORDER BY name LIMIT $start_from, 3");
$rs_result = mysql_query ($sql);
   */
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
            <h2 class="title">Guests</h2>
	    <div class="actions-bar wat-cf">
                  <div class="actions" style="float:right;padding-right:5px;">
                    <button class="button" type="submit" onclick="window.location='add_guest.php';">
                      <img src="images/icons/tick.png" alt="Add New Guest" /> New Guest
                    </button>
                  </div>
            </div>

            <div class="inner">
              <form action="#" class="form">
                <table class="table">
                  <tr>
                    <th class="first"><input type="checkbox" class="checkbox toggle" /></th>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Email Id</th>
                    <th>Phone No.</th>
                    <th class="last">&nbsp;</th>
                  </tr>
				  <?php
				    $srno = 1;
					while($row = mysql_fetch_array($rows))
					{
						//print_r($row);exit;
				  ?>
                  <tr class="odd">
                    <td><input type="checkbox" class="checkbox" name="id" value="1" /></td>
                    
					<td><?php echo $srno; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td class="last"><a href="view_guest.php?id=<?php echo $row['id']; ?>">View</a> | <a href="edit-guest.php?id=<?php echo $row['id']; ?>">Edit</a> | <a href="delete-guest.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Do u want to delete this guest?');">Delete</a></td>
                  </tr>
                  <?php
					$srno++;	  
				  } ?>
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions">
                    <button class="button" type="submit" id="delete" value="delete" name="delete">
                      <img src="images/icons/cross.png" alt="Delete" /> Delete
                    </button>
                  </div>
                     <?php

$sql = "SELECT COUNT(Name) FROM guests where users_id='".$_SESSION['GuestBook']['id']."'";

$rs_result = mysql_query($sql);

$row = mysql_fetch_row($rs_result);

$total_records = $row[0];

$total_pages = ceil($total_records / 3);



for ($i=1; $i<=$total_pages; $i++) {

            echo "<a href='guests.php?page=".$i."'>".$i."</a> ";

};

?>
                </div>
                <?php

// Check if delete button active, start this

if(isset($_POST['delete']))
{
    $checkbox = $_POST['checkbox'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];
$sql = "DELETE FROM guest WHERE id='$del_id'";
$result = mysql_query($sql);
}
// if successful redirect to delete_multiple.php
if($result){
echo "<meta http-equiv=\"refresh\" content=\"0;URL=guests.php\">";
}
 }

mysql_close();

?>
              </form>
            </div>
          </div>
        </div>
       <?php require_once('includes/right.php'); ?>