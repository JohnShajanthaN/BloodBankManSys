<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../objects/profile.php';

    $database = new Database();
    $db_connection = $database->getConnection();

    $profile = new Profile($db_connection);

    $data = json_decode(file_get_contents("php://input"));

    if( !empty($data->user_id) && !empty($data->phone) && !empty($data->address) && !empty($data->gender) && !empty($data->date_of_birth) && !empty($data->blood_group) ){
        $profile->user_id = $data->user_id;
        $profile->phone = $data->phone;
        $profile->address = $data->address;
        $profile->gender = $data->gender;
        $profile->date_of_birth = $data->date_of_birth;
        $profile->blood_group = $data->blood_group;
        $profile->created = date('Y-m-d H:i:s');

        if($profile->create()){
            http_response_code(200);
            echo json_encode(array("message"=>"Donor was created"));
        } else{
            http_response_code(503);
            echo json_encode(array("message"=>"Unable to create Donor"));
        }
        
    } else{
        http_response_code(400);
        echo json_encode(array("message"=>"Unable to create Donor. Data is incomplete."));
    }

?>