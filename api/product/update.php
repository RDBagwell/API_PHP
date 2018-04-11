<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once ('../config/database.php');
require_once ('../objects/product.php');

$database = new Database();
$db = $database->DBConnection();
$product = new Product($db);

$post = json_decode(file_get_contents('php://input'));
if($post){
    if(isset($_GET['id'])){
        if($product->getById($_GET['id'])){
            $product->id = $_GET['id'];
            $product->name = $post->name;
            $product->price = $post->price;
            $product->description = $post->description;
            $product->category_id = $post->category_id;
            $product->category_name = $post->category_name;
            
            if($product->update()){
                echo 'Product was update.';
            } else {
               echo 'Product failed to update.'; 
            }
        } else {
            echo 'No Prouduct Found';
        }

    } else {
        echo "No Work";
    }
} else {
    echo "Nothing was uploaded!";
}