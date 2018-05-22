<?php
class Navigation{
  private $nav_items = array();
  //right items
  private $nav_right_items = array();
  
  public $current_page;
  private $json;
  public function __construct($json = false){
    $this -> json = $json;
    //get the current page so it can be marked as active in the navigation bar
    $this -> current_page = $this -> getCurrentpage();
    
    if( $this -> checkUserAuthState() == true ){
      $this -> nav_items = array(
      "Home" => "index.php",
      "Sign Out" => "signout.php"
      );
    }
    else{
      $this -> nav_items = array(
      "Home" => "index.php",
      "About" => "about.php",
      "Products" => "productlist.php"
      );
      
      
      
      //right items
      $this -> nav_right_items = array(
      "Sign Up" => "register.php",
      "Sign In" => "login.php"
      );
    }
    
    
    
  }
  protected function getCurrentpage(){
    //get the name of the current page
    $uri = basename( $_SERVER["REQUEST_URI"] );
    if( $uri == "" ){
      $uri = "index.php";
    }
    return $uri;
  }
  private function checkUserAuthState(){
    //check if user is logged in or not via a session variable
    if( isset($_SESSION["user_token"]) ){
      return true;
    }
    else{
      return false;
    }
  }
  public function getNavigationItems(){
    if($this -> json == true ){
      return json_encode( $this -> nav_items );
    }
    else{
      return $this -> nav_items;
    }
  }
  
  
  //right items
  public function getNavigationRightItems(){
    if($this -> json == true ){
      return json_encode( $this -> nav_right_items );
    }
    else{
      return $this -> nav_right_items;
    }
  }
}
?>