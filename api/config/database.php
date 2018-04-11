<?php
    require_once("new_config.php");
    
    class Database {
        public $conn;
        public $db;
               
        public function DBConnection(){
            $this->conn = NULL;
            try {
                $this->conn = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME.";",DB_USER, DB_PASSWORD);
                $this->conn->exec("set names utf8");
            } catch (PDOException $ex) {
                echo "Connection error: " . $ex->getMessage();
            }
            return $this->conn;
        }
        
    }   