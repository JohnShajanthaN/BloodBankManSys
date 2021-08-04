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

    if(empty($data->password)){
        $user->id = $data->id;
        $statement = $user->getById();
        $count = $statement->rowCount();
        if( $count > 0 ){
            $row = $statement->fetch(PDO::FETCH_OBJ);
            $user->password = $row->password;
        }
    } else {
        $user->password = password_hash($data->password, PASSWORD_DEFAULT);
    }

    if( !empty($data->id) && !empty($data->firstname) && !empty($data->lastname) && !empty($data->email) && !empty($data->phone) && !empty($data->address) && !empty($data->gender) && !empty($data->date_of_birth) && !empty($data->blood_group) && !empty($data->role) ){
        $user->id = $data->id;
        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->email = $data->email;
        // $user->password = $data->password;
        // $user->password = password_hash($data->password, PASSWORD_DEFAULT);
        $user->phone = $data->phone;
        $user->address = $data->address;
        $user->gender = $data->gender;
        $user->date_of_birth = $data->date_of_birth;
        $user->blood_group = $data->blood_group; 
        $user->role = $data->role;

        if($user->update()){
            http_response_code(200);
            echo json_encode(array("message"=>"User was updated.",  "data" => $user, "status"=>"200" ));
        } else{
            http_response_code(401);
            echo json_encode(array("message"=>"Unable to update user"));
        }
    } else{
        http_response_code(401);
        echo json_encode(array("message"=>"Assecc denied"));
    }

?>