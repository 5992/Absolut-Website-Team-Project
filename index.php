<?php
include('autoloader.php');


//include("includes/database.php");
//check if connection is successful
// if($connection){
//   //echo "success";
//   $query = "SELECT 
//     products.id AS id,
//     products.name AS name,
//     products.price AS price,
//     products.description AS description,
//     images.image_file_name AS image
//     FROM products 
//     INNER JOIN products_images 
//     ON products.id = products_images.product_id 
//     INNER JOIN images
//     ON products_images.image_id = images.image_id";
//   //run the query
//   $statement = $connection -> prepare($query);
//   $statement -> execute();
//   //get the result
//   $result = $statement -> get_result();
// }
// else{
//   echo "connection failed";
// }

$products_obj = new Products();
$products = $products_obj -> getProducts();
$total_items = $products_obj -> total_products;

$page_title = "Home page";
?>
<!doctype html>
<html>
  <head>
    <?php include("includes/head.php"); ?>

  </head>
    <body>
      <?php include("includes/navbar.php"); ?>
      <?php include("includes/banner.php"); ?>
      
      
      <div class="container">
        <!-- Project Section -->
      <div class="w3-container w3-padding-32" id="projects">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Products</h3>
      </div>
        <?php
        // if($result -> num_rows > 0){
        //   $counter = 0;
        //   while( $row = $result -> fetch_assoc() ){
        //     $id = $row["id"];
        //     $name = $row["name"];
        //     $price = $row["price"];
        //     $description = $row["description"];
        //     $image = $row["image"];
        //     $counter++;
        //     if($counter == 1){
        //       //create boostrap row
        //       echo "<div class=\"row\">";
        //     }
        //     echo "<div class=\"col-md-3 col-sm-6 \">
        //     <div class=\"card\">
            
        //     <img class=\"product-thumbnail img-fluid\" src=\"images/products/$image\" style=\"width:100%\">
        //     <h4>$name</h4>
        //     <p><h4 class=\"price\">$price</h4></p>
            
        //     <p style=\"margin:0;\"><button id=\"contactbutton\" onclick=\"window.location.href='productdetails.php?product_id=$id'\">View Me</button></p>
        //     </div> 
        //     </div>";
        
          echo "<div class=\"row\">
                <div class=\"col navbar\">
                  <p class=\"navbar-text\">Total of $total_items products</p>
                </div>
              </div>";
          if( count($products) > 0 ){
            $col_counter = 0;
            foreach( $products as $product ){
              $col_counter++;
              if( $col_counter == 1 ){
                echo "<div class=\"row\">";
              }
              //print out columns
              $id = $product["id"];
              $name = $product["name"];
              $price = $product["price"];
              $image = $product["image"];
              
              echo "<div class=\"col-sm-3 product-column\">";
              echo "<div class=\"card\">";
              
              echo "<img class=\"product-thumbnail img-fluid\" src=\"images/products/$image\" style=\"width:100%\">";
              echo "<h4 class=\"product-name\">$name</h4>";
              echo "<h4 class=\"price\">$price</h4>
              <p style=\"margin:0;\"><button id=\"contactbutton\" onclick=\"window.location.href='productdetails.php?product_id=$id'\">View Me</button></p>
              </div><p></p></div>";
    
              if($counter == 4){
                echo "</div>";
                $col_counter = 0;
              }
            }
          }
        ?>
      </div>
    </body>
</html>

