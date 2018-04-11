<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once ('../config/database.php');
require_once ('../objects/product.php');

$database = new Database();
$db = $database->DBConnection();
$product = new Product($db);
$stmt = $product->get();
$num = $stmt->rowCount();

if($num){
    $products_arr = array();
    $products_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $product_item = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "description" => html_entity_decode($row['description']),
            "price" => $row['price'],
            "category_id" => $row['category_id'],
            "category_name" => $row['category_name']
        );
        array_push($products_arr["records"], $product_item);
    }

    echo json_encode($products_arr);
} else {
    echo json_encode(array("Message => 'No products found.'"));
}
