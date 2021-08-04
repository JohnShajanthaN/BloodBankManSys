<?php

    class User{

        private $conn;
        private $table_name = "users";

        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $password;
        public $phone;
        public $address;
        public $gender;
        public $date_of_birth;
        public $blood_group;
        public $role;

        public function __construct($db_con){
            $this->conn = $db_con;
        }

        public function getAll(){
            // $query = "SELECT * FROM $this->table_name";
            $query = "SELECT * FROM $this->table_name AS u LEFT JOIN avatar AS a ON u.id = a.user_id order by u.id desc";
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

        public function getUsersByBloodGroup(){
            $query = "SELECT * FROM $this->table_name WHERE id=:id";
            $query = "SELECT u.id, b.name, COUNT(u.id) AS count FROM `blood_group` AS b LEFT JOIN $this->table_name AS u ON b.name=u.blood_group GROUP BY b.name order by b.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function create(){
            $query = "INSERT INTO $this->table_name (firstname, lastname, email, password, phone, address, gender, date_of_birth, blood_group, role) VALUES(:firstname, :lastname, :email, :password, :phone, :address, :gender, :date_of_birth, :blood_group, :role)";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['firstname'=>$this->firstname, 'lastname'=>$this->lastname, 'email'=>$this->email, 'password'=>$this->password, 'phone'=>$this->phone, 'address'=>$this->address, 'gender'=>$this->gender, 'date_of_birth'=>$this->date_of_birth, 'blood_group'=>$this->blood_group, 'role'=>$this->role]);
            return $stmt;
        }

        public function delete(){
            $query = "DELETE FROM $this->table_name WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['id'=>$this->id]);
            return $result;
        }

        public function emailExits(){
            $query = "SELECT * FROM $this->table_name WHERE email=:email";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['email'=>$this->email]);
            $count = $stmt->rowCount();
            if($count>0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->id = $row['id'];
                $this->firstname = $row['firstname'];
                $this->lastname = $row['lastname'];
                $this->password = $row['password'];
                $this->role = $row['role'];
                $this->blood_group = $row['blood_group'];
                return true;
            }
            return false;
        }

        public function checkUserExits($email){
            $query = "SELECT * FROM $this->table_name WHERE email=:email";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['email'=>$email]);
            $count = $stmt->rowCount();
            if($count>0){
                return true;
            }
            return false;
        }

        public function update(){
            $query = "UPDATE $this->table_name SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, phone=:phone, address=:address, gender=:gender, date_of_birth=:date_of_birth, blood_group=:blood_group, role=:role  WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(['firstname'=>$this->firstname, 'lastname'=>$this->lastname, 'email'=>$this->email, 'password'=>$this->password, 'phone'=>$this->phone, 'address'=>$this->address, 'gender'=>$this->gender, 'date_of_birth'=>$this->date_of_birth, 'blood_group'=>$this->blood_group, 'role'=>$this->role, 'id'=>$this->id]);
            return $result;
        }

    }

?>