<?php
session_start();
include('autoloader.php');


$page_title = "Shopping Cart";
?>

<!doctype html>
<html>
  <?php include ('includes/head.php'); ?>
  <body>
    <?php include('includes/navbar.php'); ?>
    <div class="container" id="shopping-list">
      <div class="row">
        
      </div>
    </div>
  
    <script src="/js/shoppingcartpage.js"></script>
  </body>
</html>