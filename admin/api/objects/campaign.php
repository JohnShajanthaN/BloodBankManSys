<?php

    class Campaign{

        private $conn;
        private $table_name = "campaign";

        public $id;
        public $title;
        public $description;
        public $image_name;
        public $location;
        public $organizer;
        public $created_by;

        public function __construct($db_con){
            $this->conn = $db_con;
        }

        public function getAll(){
            $query = "SELECT * FROM $this->table_name order by id desc";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getAllCount(){
            $query = "SELECT COUNT(*) AS count FROM $this->table_name";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getById(){
            $query = "SELECT * FROM $this->table_name WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['id'=>$this->id]);
            return $stmt;
        }

        public function create(){
            $query = "INSERT INTO $this->table_name (title, description, image_name, location, organizer, created_by) VALUES(:title, :description, :image_name, :location, :organizer, :created_by)";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['title'=>$this->title, 'description'=>$this->description, 'image_name'=>$this->image_name, 'location'=>$this->location, 'organizer'=>$this->organizer, 'created_by'=>$this->created_by]);
            return $result;
        }

        public function delete(){
            $query = "DELETE FROM $this->table_name WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['id'=>$this->id]);
            return $result;
        }

        public function update(){
            $query = "UPDATE $this->table_name SET title=:title, description=:description, image_name=:image_name, location=:location, organizer=:organizer WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['title'=>$this->title, 'description'=>$this->description, 'image_name'=>$this->image_name, 'location'=>$this->location, 'organizer'=>$this->organizer, 'id'=>$this->id]);
            return $result;
        }


    }

?>