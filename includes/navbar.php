<?php
$nav_obj = new Navigation();
$navigation = $nav_obj -> getNavigationItems();
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
        //temporary link to database only during development
        echo "<li class=\"nav-item\">
          <a class=\"nav-link\" href=\"/phpmyadmin/\" target=\"_blank\">Database</a>
        </li>";
        }
      ?>
    </ul>
    
     
    <!-- Search -->
    <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" type="search" name="keywords" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    
    <!--Signup & Signin icon -->
    <ul class="navbar-nav justify-content-end">
      <li class="nav-item">
        <a class="nav-link" href="register.php"><i class="fas fa-user-plus"></i> Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Sign in</a>
      </li>
    </ul>
  </div>
</nav>