<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");

    include_once '../config/database.php';
    include_once '../objects/user.php';

    $database = new Database();
    $db_connection = $database->getConnection();

    $user = new User($db_connection);

    if(isset($_GET['id'])){
        $user->id = $_GET['id'];
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Missing required param.")
        );
    }

    $statement = $user->getById();
    $count = $statement->rowCount();

    if( $count > 0 ){

        $result_array = array();
        $result_array['status'] = 200;
        $result_array['count'] = $count;
        $result_array['data'] = array();

        while( $row = $statement->fetch(PDO::FETCH_OBJ) ){
            $item = array(
                "id"=>$row->id,
                "firstname"=>$row->firstname,
                "lastname"=>$row->lastname,
                "email"=>$row->email,
                "password"=>$row->password,
                "phone"=>$row->phone,
                "address"=>$row->address,
                "gender"=>$row->gender,
                "date_of_birth"=>$row->date_of_birth,
                "blood_group"=>$row->blood_group,
                "role"=>$row->role,
                "created"=>$row->created,
                "modified"=>$row->modified,
            );
            array_push($result_array['data'], $item);
        }
        http_response_code(200);
        echo json_encode($result_array);

    } else{
        http_response_code(404);
        echo json_encode(array("message" => "$user->id not exit in the system.","count" => $count));
    }

?>