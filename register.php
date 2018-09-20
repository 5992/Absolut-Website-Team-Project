<?php
include('autoloader.php');
session_start();

//check for POST request
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
  //receive variables from form
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  $account = new Account();
  $registration = $account -> register( $username, $email, $password );
  
  $success = array();
  $errors = array();
  
  if( $registration == true ){
    $success["registration"] = "Account successfully created!";
  }
  else{
    //$errors["registration"] = "There has been an error!";
    $errors["username"] = $account -> errors["username"];
    $errors["email"] = $account -> errors["email"];
    $errors["password"] = $account -> errors["password"];
  }
}
?>

<!doctype html>
<html>
  <?php include ('includes/head.php'); ?>
  <body>
    <?php include('includes/navbar.php'); ?>
    <div class="container content">
      <?php
      if( count($success) > 0 ){
        $msg = implode( " ", $success );
      
      echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
        <strong>Success</strong> $msg
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
      </div>";
      }
      
      if( count($errors) > 0 ){
        $msg = implode( "", $errors );
        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
            <strong>Error</strong> $msg
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>";
      }
      ?>
      <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
          <h4>Register for an account</h4>
          <div class="alert-success"></div>
          <form id="register-form" method="post" action="register.php" novalidate>
            <div class="form-group">
              <label for="username">Username</label>
              <input id="username" class="form-control" type="text" name="username" placeholder="Username" required>
              <div class="invalid-feedback">Please enter a valid username which has at least 4 characters</div>
              <div class="alert-username"></div>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input id="email" class="form-control" type="email" name="email" placeholder="Email" required>
              <div class="invalid-feedback">Please enter a valid email: sample@domain.com</div>
              <div class="alert-email"></div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" class="form-control" type="password" name="password" placeholder="Minimum 8 characters" required>
              <div class="invalid-feedback">Please enter a valid password which has at least 8 characters</div>
              <div class="alert-password"></div>
            </div>
            <div class="text-center">
              <button type="submit" name="register-btn" class="btn btn-outline-success btn-block">Register</button>
            </div>
            <p class="my-4">Already have an account? <a href="login.php">Sign in</a></p>
          </form>
        </div>
      </div>
    </div>
    <!--<script src="/js/register.js"></script>-->
    <?php include("includes/footer.php"); ?>
  </body>
</html>

<template id="alert-template">
  <div class="alert alert-dismissible fade show" role="alert">
    <span class="alert-message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</template>