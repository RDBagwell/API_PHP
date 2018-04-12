<?php

$data = array(
    "name" => "Test Name",
    "description" => "Test description",
    "price" => "300",
    "category_id" => "8"
);

$data_string = json_encode($data);                                                                                   
                                                                                                                     
$ch = curl_init('http://localhost/api/product/read.php');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);

echo "<pre>";
    print_r($result);
echo "</pre>";