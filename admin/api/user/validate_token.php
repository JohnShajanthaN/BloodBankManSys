<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../config/core.php';
    include_once '../objects/user.php';

    include '../lib/php-jwt-master/src/BeforeValidException.php';
    include '../lib/php-jwt-master/src/ExpiredException.php';
    include '../lib/php-jwt-master/src/SignatureInvalidException.php';
    include '../lib/php-jwt-master/src/JWT.php';
    use \Firebase\JWT\JWT;

    $data = json_decode(file_get_contents("php://input"));

    if( !empty($data->token)) {
        $jwt = $data->token;
        try{
            $decoded = JWT::decode($jwt, $secret_key, array('HS256'));
            http_response_code(200);
            echo json_encode(array("message"=>"Access Granted", "data"=>$decoded));
        } catch(Exception $e){
            http_response_code(401);
            echo json_encode(array("message"=>"Access denied", "error"=>$e->getMessage()));
        }
    } else{
        http_response_code(401);
        echo json_encode(array("message"=>"Assecc denied"));
    }

?>