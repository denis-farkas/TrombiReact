<?php
class Personnel{

    // database connection and table name
    private $conn;
    private $table_name = "personnel";

    // object properties
    public $id;
    public $nom;
    public $email;
    public $fonction;
    public $avatar;
    public $actif;
    


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
function read(){

    // select all query
    $query = "SELECT
                *
            FROM
                personnel
            ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}

// create product
function create(){

    // query to insert record
    $query = "INSERT INTO
                personnel
            SET
                nom=:nom, email=:email, fonction=:fonction, avatar=:avatar, actif=:actif";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->nom=htmlspecialchars(strip_tags($this->nom));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->fonction=htmlspecialchars(strip_tags($this->fonction));
    $this->avatar=htmlspecialchars(strip_tags($this->avatar));
    $this->actif=htmlspecialchars(strip_tags($this->actif));
    $this->password=htmlspecialchars(strip_tags($this->password));

    // bind values
    $stmt->bindParam(":nom", $this->nom);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":fonction", $this->fonction);
    $stmt->bindParam(":avatar", $this->avatar);
    $stmt->bindParam(":actif", $this->actif);

    // hash the password before saving to database
    $options = array("cost" => 4);
    $password_hash = password_hash($this->pass, PASSWORD_BCRYPT, $options);
    $stmt->bindParam(":password", $password_hash);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}

// used when filling up the update product form
function readOne(){

    // query to read single record
    $query = "SELECT
                *
            FROM
                personnel

            WHERE
                id = ?
            ";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->nom = $row['nom'];
    $this->email = $row['email'];
    $this->fonction = $row['fonction'];
    $this->avatar = $row['avatar'];
    $this->actif = $row['actif'];
}

// update the product
function update(){

    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nom = :nom,
                email = :email,
                fonction = :fonction,
                avatar = :avatar,
                actif= :actif
            WHERE
                id = :id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->nom=htmlspecialchars(strip_tags($this->nom));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->fonction=htmlspecialchars(strip_tags($this->fonction));
    $this->avatar=htmlspecialchars(strip_tags($this->avatar));
    $this->actif=htmlspecialchars(strip_tags($this->actif));
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind new values
    $stmt->bindParam(":nom", $this->nom);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":fonction", $this->fonction);
    $stmt->bindParam(":avatar", $this->avatar);
    $stmt->bindParam(":actif", $this->actif);
    $stmt->bindParam(':id', $this->id);

    // execute the query
    if($stmt->execute()){
        return true;
    }

    return false;
}

// delete the product
function delete(){

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind id of record to delete
    $stmt->bindParam(1, $this->id);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;
}

// search products
function search($keywords){

    // select all query
    $query = "SELECT
                nom, email, fonction, avatar, actif
            FROM
                personnel

            WHERE
                nom LIKE ? OR email LIKE ? OR fonction LIKE ? OR actif LIKE ?
            ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
    $stmt->bindParam(4, $keywords);

    // execute query
    $stmt->execute();

    return $stmt;

}



}
?>
