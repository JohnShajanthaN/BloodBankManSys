<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");

    include_once '../config/database.php';
    include_once '../objects/blood_request.php';

    $database = new Database();
    $db_connection = $database->getConnection();

    $bloodRequest = new BloodRequest($db_connection);

    if(isset($_GET['id'])){
        $bloodRequest->id = $_GET['id'];
        
        $statement = $bloodRequest->getById();
        $count = $statement->rowCount();

        if( $count > 0 ){

            $result_array = array();
            $result_array['status'] = 200;
            $result_array['count'] = $count;
            $result_array['data'] = array();

            while( $row = $statement->fetch(PDO::FETCH_OBJ) ){
                $item = array(
                    "id"=>$row->id,
                    "blood_group"=>$row->blood_group,
                    "description"=>$row->description,
                    "req_date"=>$row->req_date,
                    "req_location"=>$row->req_location,
                    "phone"=>$row->phone,
                    "created_by"=>$row->created_by,
                    "created"=>$row->created,
                    "modified"=>$row->modified
                );
                array_push($result_array['data'], $item);
            }
            http_response_code(200);
            echo json_encode($result_array);

        } else{
            http_response_code(404);
            echo json_encode(array("message" => "$bloodRequest->id not exit in the system.","count" => $count));
        }
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Missing required param.")
        );
    }

    

?>