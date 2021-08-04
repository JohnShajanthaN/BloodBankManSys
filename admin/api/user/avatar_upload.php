<?php

    header("Content-Type: application/json");
    header("Acess-Control-Allow-Origin: *");
    header("Acess-Control-Allow-Methods: POST");
    header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

    include_once '../config/database.php';
    include_once '../objects/avatar.php';


    $database = new Database();
    $db_connection = $database->getConnection();

    $avatar = new Avatar($db_connection);

    $data = json_decode(file_get_contents("php://input"), true); 

    $fileName  =  $_FILES['sendimage']['name'];
    $tempPath  =  $_FILES['sendimage']['tmp_name'];
    $fileSize  =  $_FILES['sendimage']['size'];


    // $avatar->user_id =$_REQUEST['user_id'];
    $avatar->user_id = $_POST['user_id'];
    $avatar->image_name = $fileName;
            
    if(empty($fileName))
    {
        http_response_code(400);
        echo json_encode(array("message"=>"Please select image."));
    }
    else
    {
        $upload_path = 'upload/'; 
        
        $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); 
            
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
                        
        if(in_array($fileExt, $valid_extensions)){				
            if(!file_exists($upload_path . $fileName)){
                if($fileSize < 5000000){
                    if($avatar->create()){
                        move_uploaded_file($tempPath, $upload_path . $fileName);  
                        echo json_encode(array("message" => "Image Uploaded Successfully", "id" => $_POST['user_id']));	
                    } else {
                        http_response_code(503);
                        echo json_encode(array("message" => "Unable to upload your file"));
                    }    
                }
                else{		
                    http_response_code(400);
                    echo json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size"));
                }
            }
            else
            {		
                http_response_code(400);
                echo json_encode(array("message" => "Sorry, file already exists check upload folder"));	
            }
        }
        else
        {		
            http_response_code(400);
            echo json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed"));		
        }
    }
		
?>