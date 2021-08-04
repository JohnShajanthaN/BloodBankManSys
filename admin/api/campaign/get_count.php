<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/campaign.php';

    $database = new Database();
    $db_connection = $database->getConnection();

    $campaign = new Campaign($db_connection);

    $statment = $campaign->getAllCount();
    $count = $statment->rowCount();

    if($count>0){

        $result_array = array();
        $result_array['status'] = 200;
        $result_array['data'] = array();

        while(  $row = $statment->fetch(PDO::FETCH_OBJ)){
            $item = array(
                "count"=>$row->count
            );
            array_push($result_array['data'], $item);
        }
        http_response_code(200);
        echo json_encode($result_array);
    } else{
        http_response_code(404);
        echo json_encode(array("message" => "No Campaign found.","count" => $count));
    }

?>