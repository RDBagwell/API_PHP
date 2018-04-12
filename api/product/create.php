<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once ('../config/init.php');

$product = new Product();

$post = json_decode(file_get_contents('php://input'));

if($post){
    $product->name = $post->name;
    $product->price = $post->price;
    $product->description = $post->description;
    $product->category_id = $post->category_id;
    $product->created = date('Y-m-d H:i:s');
    
    if($product->create()){
       echo '{';
           echo '"message": "Product was created."';
       echo '}';       
    } else {
        echo '{';
            echo '"message": "Unable to create product."';
        echo '}';
    }
    echo "product uploaded sucessfuly!";
    
} else {
    echo "Nothing was uploaded!";
}