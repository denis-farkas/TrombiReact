<?php

// required headers
header("Access-Control-Allow-Origin: http://cloudefar.fr/TrombiReact/api/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/personnel.php';
  
$database = new Database();
$db = $database->getConnection();
  
$product = new Personnel($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->nom) &&
    !empty($data->email) &&
    !empty($data->fonction) &&
    !empty($data->avatar) &&
    !empty($data->actif) &&
    !empty($password->password)
){
  
    // set product property values
    $product->nom = $data->nom;
    $product->email = $data->email;
    $product->fonction = $data->fonction;
    $product->avatar = $data->avatar;
    $product->actif = $data->actif;
    $product->password= $data->password;
  
    // create the product
    if($product->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Personnel est créé."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "impossible créer personnel."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "impossible créer personnel. Data est incomplet."));
}
?>