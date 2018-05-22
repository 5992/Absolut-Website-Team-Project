<?php
include("autoloader.php");
session_start();

if( isset($_GET["product_id"]) ){
  
  $product_id = $_GET["product_id"];
  
  $product_detail = new ProductDetail( $product_id );
  $product = $product_detail -> product;
  
  $product_name = $product[0]["name"];
  $product_price = $product[0]["price"];
  $product_description = $product[0]["description"];
}
else{
  echo "You will be redirected to the home page after 5 seconds";
  header( "location:index.php" );
}

$page_title = $product_name;
?>
<!doctype html>
<html>
  <?php include ('includes/head.php'); ?>
  <body>
    <?php include('includes/navbar.php'); ?>
    <div class="container-fluid content">
      <?php
      include('includes/breadcrumb.php');
      ?>
      <div class="row mt-4">
        <div class="col-sm-5">
          <?php
          $count = count( $product );

          if( $count > 0 ){
            if( $count == 1 ){
              $image = $product[0]["image"];
              echo "<img class=\"img-fluid\" src=\"/images/products/$image\">";
            }
            else{
              //output carousel // id=\"product-detail-carousel\" class=\"carousel slide\" data-ride=\"carousel\">
              echo" <div class=\"detailImage\">
                <ol class=\"carousel-indicators image-indicators\">";
                  $indicator_counter = 0;
                  foreach( $product as $indicator){
                    $indicator_image = $indicator["image"];
                    if($indicator_counter == 0){
                      $class="active";
                    }
                    else{
                      unset( $class );
                    }
                    // echo "<li data-target=\"#product-detail-carousel\" data-slide-to=\"$indicator_counter\" class=\"$class\">
                    //         <img src=\"/images/products/$indicator_image\" class=\"img-fluid\">
                    //       </li>";
                    // $indicator_counter++;
                  }
                echo "</ol>";
                echo "<div class=\"carousel-inner\">";
                  $image_counter = 0;
                  foreach( $product as $item){
                    $image = $item["image"];
                    $name = $item["name"];
                    if($image_counter == 0){
                      $class="active";
                    }
                    else{
                      unset( $class );
                    }
                    echo "<div class=\"carousel-item $class\" style=\"text-align: center;\">
                            <img class=\"center\" src=\"/images/products/$image\" alt=\"$name\" style=\"width:50%; margin-top: 0px;\"> 
                        </div>";
                    $image_counter++;
                  }
                echo "</div>";
              echo "</div>";
            }
          }
          ?>
        </div>
        <div class="col-sm-7">
          <h2 class="product-name">
            <?php echo $product_name; ?>
          </h2>
          <p class="price">
            <?php echo $product_price; ?>
          </p>
          <p class="description">
            <?php echo $product_description; ?>
          </p>
        </div>
      </div>
    </div>
    <?php include("includes/footer.php"); ?>
  </body>
</html>