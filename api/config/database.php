<?php

class Database{



    private $host = "localhost";
    private $db_name = "cp130650_lab";
    private $username = "cp130650_defar";
    private $pass = "SiN=KwhN(ES%";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->pass);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
