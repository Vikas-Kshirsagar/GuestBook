<?php
  require_once('includes/config.php');
  //print_r($_FILES);
  $Guest = new notices;
  $errors = array();
   $row = $Guest->select($Guest->table);
   $_POST = $row[0];

require_once('includes/header.php'); ?>

    <div id="wrapper" class="wat-cf">
      <div id="main">



        <div class="block" id="block-forms">
          <div class="secondary-navigation"></div>
          <div class="content">
            <h2 class="title">Guest Details</h2>
            <div class="actions-bar wat-cf">
                  <div class="actions" style="float:right;padding-right:5px;">
                    <button class="button" onclick="window.location='edit_notice.php?id=<?php echo $_POST['id']; ?>';">
                      <img src="images/icons/tick.png" alt="Edit Guest" /> Edit Notice
                    </button>
                  </div>
            </div>
            <div class="inner">
              <form action="" method="post" enctype="multipart/form-data" class="form">
                <div class="group">
                  <label class="label">Title</label>

                    <span><?php echo isset($_POST['title'])?$_POST['title']:''; ?></span>

                </div>
                <div class="group">
                  <label class="label">Notice</label>
                  <span><?php echo isset($_POST['notice'])?$_POST['notice']:''; ?></span>

                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once('includes/right.php'); ?>
