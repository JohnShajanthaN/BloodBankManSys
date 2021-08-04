<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../objects/blood_request.php';

    $database = new Database();
    $db_connection = $database->getConnection();

    $bloodRequest = new BloodRequest($db_connection);

    $data = json_decode(file_get_contents("php://input"), true); 

    if(!empty($_POST['blood_group']) && !empty($_POST['description']) && !empty($_POST['req_date']) && !empty($_POST['req_location']) && !empty($_POST['phone']) && !empty($_POST['created_by'])){
        $bloodRequest->blood_group = $_POST['blood_group'];
        $bloodRequest->description = $_POST['description'];
        $bloodRequest->req_date = $_POST['req_date'];
        $bloodRequest->req_location = $_POST['req_location'];
        $bloodRequest->phone = $_POST['phone'];
        $bloodRequest->created_by = $_POST['created_by'];

        if($bloodRequest->create()){
            http_response_code(200);
            echo json_encode(array("message"=>"Blood request was created"));
        } else{
            http_response_code(503);
            echo json_encode(array("message"=>"Unable to create blood request"));
        }

    } else{
        http_response_code(400);
        echo json_encode(array("message"=>"Invalid data."));
    }

?>