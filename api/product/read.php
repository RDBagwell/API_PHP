<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once ('../config/init.php');

if(isset($_GET['id'])){
    $products = Product::get_by_id($_GET['id']);
    $products_arr = array();
    $products_arr["records"]=array();
    $product_item = array(
        "id" => $products->id,
        "name" => $products->name,
        "description" => html_entity_decode($products->description),
        "price" => $products->description,
        "category_id" => $products->description,
        "category_name" => $products->description
    );
    array_push($products_arr["records"], $product_item);    
    echo json_encode($products_arr);

} else {
    
   $products = Product::get_all();

   $num = count($products);

    if(!empty($products)){
        $products_arr = array();
        $products_arr["records"]=array();
        foreach ($products as $product) {
            $product_item = array(
                "id" => $product->id,
                "name" => $product->name,
                "description" => html_entity_decode($product->description),
                "price" => $product->description,
                "category_id" => $product->description,
                "category_name" => $product->description
            );
           array_push($products_arr["records"], $product_item);
        }
        echo json_encode($products_arr);
    } else {
        echo json_encode(array("Message => 'No products found.'"));
    }
    
}



