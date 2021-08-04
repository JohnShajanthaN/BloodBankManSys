<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../objects/campaign.php';

    $database = new Database();
    $db_connection = $database->getConnection();

    $campaign = new Campaign($db_connection);

    $data = json_decode(file_get_contents("php://input"), true); 

    $fileName  =  $_FILES['sendimage']['name'];
    $tempPath  =  $_FILES['sendimage']['tmp_name'];
    $fileSize  =  $_FILES['sendimage']['size'];

    if(empty($fileName)){
        $campaign->id = $_POST['id'];
        $statement = $campaign->getById();
        $count = $statement->rowCount();
        if( $count > 0 ){
            $row = $statement->fetch(PDO::FETCH_OBJ);
            $campaign->image_name = $row->image_name;
        }
    } else {
        $campaign->image_name = $fileName;
    }

    if(!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['description'])  && !empty($_POST['location']) && !empty($_POST['organizer'])){
        $campaign->id = $_POST['id'];
        $campaign->title = $_POST['title'];
        $campaign->description = $_POST['description'];
        // $campaign->image_name = $fileName;
        $campaign->location = $_POST['location'];
        $campaign->organizer = $_POST['organizer'];

        $upload_path = 'upload/';

        if($campaign->update()){
            move_uploaded_file($tempPath, $upload_path . $fileName); 
            http_response_code(200);
            echo json_encode(array("message"=>"Campaign was updated.", "data" => $campaign));
        } else{
            http_response_code(401);
            echo json_encode(array("message"=>"Unable to update Campaign"));
        }
    } else{
        http_response_code(400);
        echo json_encode(array("message"=>"Missing parameter"));
    }

?>