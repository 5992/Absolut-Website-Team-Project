<?php
class Products extends Database {
  public $products = array();
  public $total_products;
  public function __construct(){
    parent::__construct();
  }
  public function getProducts( $json = false ){
    $query = 'SELECT 
    products.id AS id,
    products.name AS name,
    products.price AS price,
    products.description AS description,
    images.image_file_name AS image
    FROM products 
    INNER JOIN products_images 
    ON products.id = products_images.product_id 
    INNER JOIN images
    ON products_images.image_id = images.image_id 
    GROUP BY products.id';
    //send the query to the database using the database class connection variable
    $statement = $this -> connection -> prepare($query);
    //execute query
    $statement -> execute();
    //get query results
    $result = $statement -> get_result();
    if( $result -> num_rows > 0 ){
      while( $row = $result -> fetch_assoc() ){
        //add each row to products array
        array_push( $this -> products, $row );
      }
      
      $this -> total_products = $result -> num_rows;
      
      if( $json == false ){
        return $this -> products;
      }
      else{
        return json_encode( $this -> products );
      }
    }
    else{
      $this -> total_products = 0;
      return false;
    }
  }
}
?>