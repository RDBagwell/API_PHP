<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once ('../config/init.php');

$product = new Product();


$post = json_decode(file_get_contents('php://input'));

if($post){
    if(isset($_GET['id'])){
        if($product->get_by_id($_GET['id'])){
            $product->id = $_GET['id'];

            if($product->delete()){
                echo 'Product was delete.';
            } else {
               echo 'Product failed to delete.'; 
            }
        } else {
            echo 'No Prouduct Found';
        }

    } else {
        echo "No id sent";
    }
} else {
    echo "Nothing was sent!";
}