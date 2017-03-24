<?php
//error_reporting(0);
  require_once('includes/config.php');
  if(!isset($_SESSION['GuestBook']['id']))
  {
	header('Location: index.php');
	exit;
  }
  $Guest = new guests;
  $Users = new users;
  if (isset($_GET["page"])) { $page_num  = $_GET["page"]; } else { $page_num=1; };
  $start_from = ($page_num-1) * 3;
 // $limit= 0, 3;
 if(isset($_POST['search']))
 {
   $rows = mysql_query("SELECT * FROM users where name like '%".$_POST['search_text']."%' ORDER BY name LIMIT $start_from, 5");
    $numrows = mysql_num_rows(mysql_query("SELECT * FROM users where name like '%".$_POST['search_text']."%'"));
 }
 else
 {
   $rows = mysql_query("SELECT * FROM users ORDER BY name LIMIT $start_from, 5");
   $numrows = mysql_num_rows(mysql_query("SELECT * FROM users"));
 }

if(isset($_POST['delete']))
{
$checkbox = $_POST['id'];
for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];
$sql = "DELETE FROM users WHERE id='$del_id'";
$result = mysql_query($sql);
}
// if successful redirect to delete_multiple.php
if($result){
echo "<meta http-equiv=\"refresh\" content=\"0;URL=guests.php\">";
}
 } 

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
            <h2 class="title">Users</h2>
	    <div class="actions-bar wat-cf">
                <form class="form" method="post">
                <div class="actions" style="float:left;padding-left:14px;">
                  <span><input style="width: 69%; border: 1px solid #99ffff;height: 20px;" placeholder="Search..." type="text" name="search_text"/></span>
                  <span>
                      <input type="submit" name="search" value="Search"/>
                    </span>
                  </div>
                    </form>
            </div>

            <div class="inner">
                <form method="post">
                 <table class="table">
                  <tr>
                    <th class="first"><input type="checkbox" class="checkbox toggle" /></th>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Email Id</th>
                    <th class="last">Total Guests</th>
                  </tr>
                  <?php
				    $srno = 1;
					while($row = mysql_fetch_array($rows))
					{
						//print_r($row);exit;
				  ?>
                  <tr class="odd">
                    <td><input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row['id']; ?>" /></td>
                    
					<td><?php echo $srno; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['email']; ?></td>
                    <?php
                    $rowM = $Guest->select($Guest->table,'',"users_id='".$row['id']."'");
                    ?>
					<td ><a href="view_guest.php?id=<?php echo $row['id']; ?>"><?php echo count($rowM); ?></a></td>
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
                  <div>

    </div>
                </div>
                </form>
                  <?php

    $rowsPerPage = 5;

	// how many pages we have when using paging?
	$numofpages = ceil($numrows/$rowsPerPage);
    // print the link to access each page
	$self = $_SERVER['PHP_SELF'];

	if ($numofpages > '1' )
		{

            $range =6; //set this to what ever range you want to show in the pagination link
            $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
            $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
            $page_min = $page_num- $range_min;
            $page_max = $page_num+ $range_max;

            $page_min = ($page_min < 1) ? 1 : $page_min;
            $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
            if ($page_max > $numofpages) {
                $page_min = ($page_min > 1) ? $numofpages - $range + 1 : 1;
                $page_max = $numofpages;
            }

            $page_min = ($page_min < 1) ? 1 : $page_min;

            //$page_content .= '<p class="menuPage">';

            if ( ($page_num > ($range - $range_min)) && ($numofpages > $range) ) {
                $page_pagination .= '<a class="num"  title="First" href="'.$self.'?page=1">&lt;</a> ';
            }

            if ($page_num != 1) {
                $page_pagination .= '<a class="num" href="'.$self.'?page='.($page_num-1). '">Previous</a> ';
            }

            for ($i = $page_min;$i <= $page_max;$i++) {
                if ($i == $page_num)
                $page_pagination .= '<span class="pgn_cur"><strong>' . $i . '</strong></span> ';
                else
                $page_pagination.= '<a class="num" href="'.$self.'?page='.$i.'">'.$i.'</a> ';
            }

            if ($page_num < $numofpages) {
                $page_pagination.= ' <a class="num" href="'.$self.'?page='.($page_num + 1) . '">Next</a>';
            }


            if (($page_num< ($numofpages - $range_max)) && ($numofpages > $range)) {
                $page_pagination .= ' <a class="num" title="Last" href="'.$self.'?page='.$numofpages. '">&gt;</a> ';
            }

        }//end if more than 1 page

		if(isset($page_pagination))
		{
		echo $page_pagination.'<BR><BR>';
		}

		//End PAGINATION Code

	?>
            </div>
          </div>
        </div>
       <?php require_once('includes/right.php'); ?>