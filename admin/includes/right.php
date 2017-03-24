<div id="footer">
          <div class="block">
            <p>Copyright &copy; 2015 Your Site.</p>
          </div>
        </div>
      </div>

     <div id="sidebar">
 <div class="block notice">
 <?php
 require_once('includes/config.php');
 $Guest = new notices;
 $row = $Guest->select($Guest->table);
 ?>
          <h4><?php echo $row[0]['title']; ?></h4>
          <p><?php echo $row[0]['notice']; ?></p>
        </div>
          </div>

    </div>

  </div>

</body>
</html>