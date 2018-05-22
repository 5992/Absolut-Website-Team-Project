<?php
$nav_obj = new Navigation();
$navigation = $nav_obj -> getNavigationItems();

//right item
$right_navigation = $nav_obj -> getNavigationRightItems();
?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="index.php">Absolut.</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
        if( count($navigation) > 0 ){
          
          foreach( $navigation as $name => $link ){
            //if the link matches the current page, set active as 'active'
            if( $link == $nav_obj -> current_page ){
              $active = "active";
            }
            else{
              unset($active);
            }
            
            echo "<li class=\"nav-item $active\">
                    <a class=\"nav-link\" href=\"/$link\">$name <span class=\"sr-only\">(current)</span></a>
                  </li>";
          }
        }
      ?>
    </ul>
    
     
    <!-- Search -->
    <form class="form-inline my-2 my-lg-0" method="get" action="search.php" style="padding-right: 5px;">
      <input class="form-control mr-sm-2" type="search" name="keywords" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    
    
    <!-- SignUp SignIn -->
    <?php
    if( $_SESSION["username"] ){
      $user = $_SESSION["username"];
      echo "<span class=\"navbar-text\">Hello, $user!</span>";
      echo "<ul class=\"navbar-nav justify-content-end\">
            <li class=\"nav-item\">
              <a class=\"nav-link\" href=\"signout.php\"><i class=\"fas fa-sign-out-alt\"></i> Sign Out</a>
            </li>
            </ul>";
    }
    else{
      if( count($right_navigation) > 0 ){
          
          foreach( $right_navigation as $name => $link ){
            //if the link matches the current page, set active as 'active'
            if( $link == $nav_obj -> current_page ){
              $active = "active";
            }
            else{
              unset($active);
            }
            
            if($name == "Sign Up")
            {
              echo "<ul class=\"navbar-nav justify-content-end\">
                  <li class=\"nav-item $active\">
                    <a class=\"nav-link\" href=\"/$link\"><i class=\"fas fa-user-plus\"></i> $name <span class=\"sr-only\">(current)</span></a>
                  </li>";
              
            }
            else {
              echo "<ul class=\"navbar-nav justify-content-end\">
                  <li class=\"nav-item $active\">
                    <a class=\"nav-link\" href=\"/$link\"><i class=\"fas fa-sign-in-alt\"></i> $name <span class=\"sr-only\">(current)</span></a>
                  </li>";
            }
          }
        }
    }
    ?>
  </div>
</nav>