<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../objects/campaign.php';

    $database = new Database();
    $db_connection = $database->getConnection();

    $campaign = new Campaign($db_connection);

    $data = json_decode(file_get_contents("php://input"));

    if( !empty($data->id)){
        $campaign->id = $data->id;

        $checkId = $campaign->getById();
        $checkCount = $checkId->rowCount();

        if( $checkCount > 0 ){
            $statement = $campaign->delete();

            if($statement){
                http_response_code(200);
                echo json_encode(array("message" => "Campaign was deleted."));
            } else{
                http_response_code(503);
                echo json_encode(array("message" => "Unable to delete campaign."));
            }
        } else{
            http_response_code(404);
            echo json_encode(array( "message" => "$data->id not in the system."));
        }


    } else{
        http_response_code(400);
        echo json_encode(array("message" => "Invalid format."));
    }

?>