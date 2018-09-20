<?php
session_start();
include('autoloader.php');

// if user is not logged in, redirect to home page
if(!$_SESSION["account_id"]){
  header("location:index.php");
}


$page_title = "Shopping Cart";
?>

<!doctype html>
<html>
  <?php include ('includes/head.php'); ?>
  <body>
    <?php include('includes/navbar.php'); ?>
    
   <div style="margin-top: 100px" class="container content">
    <div class="container" id="shopping-list">
      
    </div>
    </div>
    <script src="/js/shopping-cart-page.js"></script>
  </body>
</html>