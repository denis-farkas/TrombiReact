<?php
class Administration{

    // database connection and table name
    private $conn;
    private $table_name = "adm";

    // object properties
    public $id;
    public $login;
    public $email;
    public $password;
    
    
    
    


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
function read_adm(){

    // select all query
    $query = "SELECT
                *
            FROM
                adm
            WHERE id = ?
            ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}

function create_adm(){

    // query to insert record
    $query = "INSERT INTO
                adm
            SET
                login=:login, email=:email, password=:password";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->login=htmlspecialchars(strip_tags($this->login));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));

    // bind values
    $stmt->bindParam(":login", $this->login);
    $stmt->bindParam(":email", $this->email);
    
    // hash the password before saving to database
    $options = array("cost" => 4);
    $password_hash = password_hash($this->password, PASSWORD_BCRYPT, $options);
    $stmt->bindParam(":password", $password_hash);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}
// check if given email exist in the database
function emailExists(){
 
    // query to check if email exists
    $query = "SELECT *
            FROM adm
            WHERE email = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind given email value
    $stmt->bindParam(1, $this->email);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        

        $this->id = $row['id'];
        $this->login = $row['nom'];
        $this->password = $row['password'];
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}
}
?>