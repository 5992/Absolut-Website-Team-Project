<?php
class ProductDetail extends Products{
  private $query;
  public $product = array();
  public function __construct($product_id){
    parent::__construct();
    $this -> query = 'SELECT 
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
    WHERE products.id = ?';
    $this -> getProduct( $product_id );
  }
  private function getProduct($product_id){
    $statement = $this -> connection -> prepare( $this -> query );
    $statement -> bind_param( 'i', $product_id );
    $statement -> execute();
    $result = $statement -> get_result();
    if( $result -> num_rows > 0 ){
      while( $row = $result -> fetch_assoc() ){
        array_push( $this -> product, $row );
      }
    }
  }
}
?>