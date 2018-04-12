<?php

class Product extends Db_object{
    protected static $db_table = "products";
    protected static $db_table_fields = array('name', 'description', 'price', 'category_id', 'created');
   
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
//    public $category_name;
    public $created;
    
    
}