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

    $database = new Database();
    $db_connection = $database->getConnection();

    $user = new User($db_connection);

    $data = json_decode(file_get_contents("php://input"));

    if( !empty($data->email) && !empty($data->password) ){
        $user->email = $data->email;
        $is_exit_email = $user->emailExits();
        
        if( $is_exit_email && password_verify($data->password, $user->password) ){
            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $user->id,
                    "firstname" => $user->firstname,
                    "lastname" => $user->lastname,
                    "email" => $user->email
                )
            );

            $jwt = JWT::encode($token, $secret_key);
            
            http_response_code(200);
            echo json_encode(array("message"=>"Login successful.", "token"=>$jwt, "id"=>$user->id, "role"=>$user->role, "blood_group"=>$user->blood_group));
            // echo json_encode(
            //     array(
            //         "message" => "login successful.",
            //         "token" => $jwt,
            //         "data" => $user,
            //         "expireAt" => $expire_claim,
            //         "status" => 200
            //     )
            // ); 
        } else{
            http_response_code(503);
            echo json_encode(array("message"=>"Invalid user"));
        }

    } else{
        http_response_code(400);
        echo json_encode(array("message"=>"Invalide json formate."));
    }

?>