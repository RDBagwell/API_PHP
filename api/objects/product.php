<?php

class Product {
    private $conn;
    private $table_name = 'products';
    
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function sanitize($string){
        $sanitized_strin = htmlspecialchars(strip_tags($string));
        return $sanitized_strin; 
    }
    
    public function get() {
       $sql =  "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM ".$this->table_name." p ";
       $sql .=  "LEFT JOIN categories c ON p.category_id = c.id";
       
       $stmt = $this->conn->prepare($sql);
       $stmt->execute();
       return $stmt;
       
    }
    
    public function getById($id) {
       $sql =  "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM ".$this->table_name." p ";
       $sql .=  "LEFT JOIN categories c ON p.category_id = c.id ";
       $sql .=  "WHERE p.id = ".$id;
       
       $stmt = $this->conn->prepare($sql);
       $stmt->execute();
       return $stmt->execute() ? $stmt->fetch(PDO::FETCH_ASSOC) : false;

       
    }
    
    public function create() {
       $sql =  "INSERT INTO ".$this->table_name."(name, description, price, category_id, created)";
       $sql .=  " VALUES (:name, :description, :price, :category_id, :created);";
       
       $stmt = $this->conn->prepare($sql);
       $stmt->bindParam(':name', $this->sanitize($this->name));
       $stmt->bindParam(':description', $this->sanitize($this->description));
       $stmt->bindParam(':price', $this->sanitize($this->price));
       $stmt->bindParam(':category_id', $this->sanitize($this->category_id));
       $stmt->bindParam(':created', $this->sanitize($this->created));
       
       if($stmt->execute()){
           return true;
       } else {
           return false;
       }
    }
    
    public function update() {
       $sql =  "UPDATE ".$this->table_name;
       $sql .=  " SET name = :name, description = :description, price = :price, category_id = :category_id";
       $sql .=  " WHERE id = :id";
       
       $stmt = $this->conn->prepare($sql);
       $stmt->bindParam(':id', $this->sanitize($this->id));
       $stmt->bindParam(':name', $this->sanitize($this->name));
       $stmt->bindParam(':description', $this->sanitize($this->description));
       $stmt->bindParam(':price', $this->sanitize($this->price));
       $stmt->bindParam(':category_id', $this->sanitize($this->category_id));
       
       if($stmt->execute()){
           return true;
       } else {
           return false;
       }
    }

    public function delete() {
       $sql =  " DELETE FROM ".$this->table_name;
       $sql .=  " WHERE id = :id";
       
       $stmt = $this->conn->prepare($sql);
       $stmt->bindParam(':id', $this->sanitize($this->id));
       
       if($stmt->execute()){
           return true;
       } else {
           return false;
       }
    }    
    

}

