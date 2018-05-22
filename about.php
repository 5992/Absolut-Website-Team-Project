<?php
include('autoloader.php');
session_start();

$products_obj = new Products();
$products = $products_obj -> getProducts();
$total_items = $products_obj -> total_products;

$page_title = "About Us";
?>
<!doctype html>
<html>
  <head>
    <?php include("includes/head.php"); ?>
  </head>
    <body>
      <?php include("includes/navbar.php"); ?>

        
      <div class="container text-center">
        
        <div class="w3-container w3-padding-32">
          <p></p>
          <h1 class="w3-border-bottom w3-border-light-grey w3-padding-16">A STORY ABOUT PEOPLE</h1>
        </div>
        <p class="ingress">
          BACK IN 1979 A FEW DARING ENTREPRENEURS MANAGED TO BRING AN UNKNOWN SWEDISH VODKA ONTO THE HIGHLY COMPETITIVE U.S. MARKET. 
          THE NAME OF THE NEW BRAND WAS ABSOLUT VODKA AND IT QUICKLY BECAME THE NATURAL CHOICE FOR THE COOL VODKA DRINKER. 
          FOLLOWING AN ICONIC AD CAMPAIGN WITH ANDY WARHOL, ABSOLUT VODKA ESTABLISHED ITSELF AS A WAY OF LIFE – ONE INTIMATELY CONNECTED WITH ART, DESIGN, FASHION AND CREATIVITY THAT IS STILL TRUE TO THIS DAY . 
          SINCE 2008, THE ABSOLUT COMPANY HAS BEEN A PART OF THE PERNOD RICARD GROUP, GROWING ITS PORTFOLIO TO INCLUDE SEVERAL NEW BRANDS. WE ARE NOW A GLOBAL INDUSTRY LEADER, KNOWN FOR OUR FAST-MOVING, AGILE WAY OF DOING THINGS, 
          AND WE ARE PROUD TO SAY THAT ONE VITAL INGREDIENT HAS ALWAYS REMAINED AT THE HEART OF OUR SUCCESS: THE PASSION AND PERSEVERANCE OF OUR PEOPLE.
        </p>
        <img src="/images/about/productportfolioimage.jpg"></img>
      </div>
    </body>
    <?php include("includes/footer.php"); ?>
</html>