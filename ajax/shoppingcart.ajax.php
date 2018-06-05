<?php
//handle ajax request to add item to the shopping cart
if( $_SERVER["REQUEST_METHOD"] == "POST"){
  //include the autoloader
  include( '../autoloader.php' );
  
  //add an array to store responses
  $response = array();
  //add an array to store errors
  $errors = array();
  
  //create instance of shopping cart class
  $cart = new ShoppingCart();
  //get action
  $action = $_POST["action"];
  //if the request was to add an item to the cart
  if( $action == "add" ){
    //add item to cart
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    if( $cart -> addItem( $product_id , $quantity ) ){
      //success
      $response["success"] = true;
    }
    else{
      //failed
      $response["success"] = false;
      //if error is caused by the user not being logged in
      //response should contain redirect page, product id and quantity
      if( $cart -> errors['auth'] ){
        $response["redirect"] = "login.php";
        //add item and quantity to response
        $response["product_id"] = $product_id;
        $response["quantity"] = $quantity;
      }
    }
  }
  if( $action = "list" ){
    $cart_list = $cart -> list();
    if( $cart_list ){
      $response["success"] = true; 
      $response["items"] = $cart -> cart_items;
    }
    else{
      $response["success"] = false;
      $response["redirect"] = "login.php";
      $response["origin"] = "shopping_cart.php";
    }
  }
  $response["errors"] = $errors;
  echo json_encode($response);
}
?>