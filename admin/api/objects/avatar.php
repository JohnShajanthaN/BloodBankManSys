<?php

    class Avatar{
        
        private $con;
        private $table_name = "avatar";

        public $user_id;
        public $image_name;

        public function __construct($dbConnection){
            $this->con = $dbConnection;
        }

        public function create(){
            $sql = "INSERT INTO $this->table_name (user_id, image_name) VALUES (:user_id, :image_name)";
            $res = $this->con->prepare($sql);
            $result = $res->execute(['user_id'=>$this->user_id, 'image_name'=>$this->image_name]);
            return $result;
        }

    }

?>