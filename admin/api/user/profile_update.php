<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
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


    if( !empty($data->token)) {
        $jwt = $data->token;
        try{
            $decoded = JWT::decode($jwt, $secret_key, array('HS256'));
            $user->id = $decoded->data->id;
            $user->firstname = $data->firstname;
            $user->lastname = $data->lastname;
            $user->email = $data->email;
            // $user->password = password_hash($data->password, PASSWORD_DEFAULT);
            $user->phone = $data->phone;
            $user->address = $data->address;
            $user->gender = $data->gender;
            $user->date_of_birth = $data->date_of_birth;
            $user->blood_group = $data->blood_group;
            $user->role = $data->role;

            if(empty($data->password)){
                $user->id = $decoded->data->id;
                $statement = $user->getById();
                $count = $statement->rowCount();
                if( $count > 0 ){
                    $row = $statement->fetch(PDO::FETCH_OBJ);
                    $user->password = $row->password;
                }
            } else {
                $user->password = password_hash($data->password, PASSWORD_DEFAULT);
            }

            if($user->update()){
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
                        "email" => $user->email,
                        "role" => $user->role,
                        "blood_group" => $user->blood_group,
                    )
                );
                $jwt = JWT::encode($token, $secret_key);
                http_response_code(200);
                echo json_encode(array("message"=>"User was updated.", "token"=>$jwt, "data" => $user, "status"=>"200"));
            } else{
                http_response_code(401);
                echo json_encode(array("message"=>"Unable to update user"));
            }
            
        } catch(Exception $e){
            http_response_code(401);
            echo json_encode(array("message"=>"Access denied", "error"=>$e->getMessage()));
        }
    } else{
        http_response_code(401);
        echo json_encode(array("message"=>"Assecc denied"));
    }

?>