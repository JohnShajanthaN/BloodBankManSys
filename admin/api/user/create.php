<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../objects/user.php';

    $database = new Database();
    $db_connection = $database->getConnection();

    $user = new User($db_connection);

    $data = json_decode(file_get_contents("php://input"));

    if( !empty($data->firstname) && !empty($data->lastname) && !empty($data->email) && !empty($data->password) && !empty($data->phone) && !empty($data->address) && !empty($data->gender) && !empty($data->date_of_birth) && !empty($data->blood_group) && !empty($data->role) ){
        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->email = $data->email;
        // $user->password = $data->password;
        $user->password = password_hash($data->password, PASSWORD_DEFAULT);
        $user->phone = $data->phone;
        $user->address = $data->address;
        $user->gender = $data->gender;
        $user->date_of_birth = $data->date_of_birth;
        $user->blood_group = $data->blood_group;
        $user->role = $data->role;

        $is_exit_email = $user->checkUserExits($data->email);

        if($is_exit_email){
            http_response_code(400);
            echo json_encode(array("message"=>"User already exit."));
        } else {
            if($user->create()){
                http_response_code(200);
                echo json_encode(array("message"=>"User was created", "status"=>"200"));
            } else{
                http_response_code(503);
                echo json_encode(array("message"=>"Unable to create user"));
            }
        }   
    } else{
        http_response_code(400);
        echo json_encode(array("message"=>"Unable to create user. Data is incomplete."));
    }


?>