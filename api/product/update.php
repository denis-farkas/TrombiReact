<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// required to encode json web token
include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

// include database and object files
include_once '../config/database.php';
include_once '../objects/personnel.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Personnel($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
 
// decode jwt here
// if jwt is not empty
if($jwt){
 
    // if decode succeed, show user details
    try {
 
        // decode jwt
        $decoded = JWT::decode($jwt, $key, array('HS256'));
 
        // set user property values here
        // set ID property of product to be edited
        $product->id = $data->id;
        
        // set product property values
        $product->nom = $data->nom;
        $product->email = $data->email;
        $product->fonction = $data->fonction;
        $product->avatar = $data->avatar;
        $product->actif = $data->actif;
        $product->password = $data->password;

        // update the product
        if($product->update()){
        
            // set response code - 200 ok
            http_response_code(200);
        
            // tell the user
            echo json_encode(array("message" => "Personnel est modifié."));
        }
        
        // if unable to update the product, tell the user
        else{
        
            // set response code - 503 service unavailable
            http_response_code(503);
        
            // tell the user
            echo json_encode(array("message" => "Impossible de modifier personnel."));
        }

    }
 
    // catch failed decoding will be here
    // if decode fails, it means jwt is invalid
catch (Exception $e){
 
    // set response code
    http_response_code(401);
 
    // show error message
    echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage()
    ));
}

}
 
  

?>