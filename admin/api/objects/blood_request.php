<?php

    class BloodRequest{

        private $conn;
        private $table_name = "blood_request";

        public $id;
        public $blood_group;
        public $description;
        public $req_date;
        public $req_location;
        public $phone;
        public $created_by;

        public function __construct($db_con){
            $this->conn = $db_con;
        }

        public function create(){
            $query = "INSERT INTO $this->table_name (blood_group, description, req_date, req_location, phone, created_by) VALUES(:blood_group, :description, :req_date, :req_location, :phone, :created_by)";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['blood_group'=>$this->blood_group, 'description'=>$this->description, 'req_date'=>$this->req_date, 'req_location'=>$this->req_location, 'phone'=>$this->phone, 'created_by'=>$this->created_by]);
            return $result;
        }

        public function update(){
            $query = "UPDATE $this->table_name SET blood_group=:blood_group, description=:description, req_date=:req_date, req_location=:req_location, phone=:phone WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['blood_group'=>$this->blood_group, 'description'=>$this->description, 'req_date'=>$this->req_date, 'req_location'=>$this->req_location, 'phone'=>$this->phone, 'id'=>$this->id]);
            return $result;
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

        public function getByBloodGroup(){
            $query = "SELECT * FROM $this->table_name WHERE blood_group=:blood_group";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['blood_group'=>$this->blood_group]);
            return $stmt;
        }

        public function getRequestsByBloodGroup(){
            $query = "SELECT * FROM $this->table_name WHERE id=:id";
            $query = "SELECT u.id, b.name, COUNT(u.id) AS count FROM `blood_group` AS b LEFT JOIN $this->table_name AS u ON b.name=u.blood_group GROUP BY b.name order by b.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function delete(){
            $query = "DELETE FROM $this->table_name WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['id'=>$this->id]);
            return $result;
        }


    }


?>