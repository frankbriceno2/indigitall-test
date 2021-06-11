<?php

class User {
        //Connection
        private $conn;
        //Table to use
        private $db_table = "users";

        //Columns
        public $id_user;
        public $fullname;
        public $email;
        public $password;
        public $language;
        public $latitude;
        public $longitude;
        public $created_at;
        public $updated_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getAllUsers() {

            $t_sql = "SELECT * FROM ". $this->db_table ."";
            $stmt = $this->conn->prepare($t_sql);
            $stmt->execute();
            return $stmt;

        }

        public function getUser() {

            $t_sql = "SELECT * FROM ". $this->db_table ." WHERE id_user = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($t_sql);
            $stmt->bindParam(1, $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->fullname = $data['fullname'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->language = $data['language'];
            $this->latitude = $data['latitude'];
            $this->longitude = $data['longitude'];
            $this->created_at = $data['created_at'];
            $this->updated_at = $data['updated_at'];

        }

        public function createUser() {

            $t_sql = "INSERT INTO ". $this->db_table ." SET fullname = :fullname, email = :email, password = :password, language = :language, latitude = :latitude, longitude = :longitude";
            $stmt = $this->conn->prepare($t_sql);

            $this->fullname = htmlspecialchars(strip_tags($this->fullname));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->language = htmlspecialchars(strip_tags($this->language));
            $this->latitude = htmlspecialchars(strip_tags($this->latitude));
            $this->longitude = htmlspecialchars(strip_tags($this->longitude));

            $stmt->bindParam(":fullname", $this->fullname);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":language", $this->language);
            $stmt->bindParam(":latitude", $this->latitude);
            $stmt->bindParam(":longitude", $this->longitude);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updateUser() {

            $t_sql = "UPDATE ". $this->db_table ." SET fullname = :fullname, email = :email, password = :password, updated_at = :updated_at WHERE id_user = :id_user";
            $stmt = $this->conn->prepare($t_sql);

            $this->fullname = htmlspecialchars(strip_tags($this->fullname));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
            $this->id_user = htmlspecialchars(strip_tags($this->id_user));

            $stmt->bindParam(":fullname", $this->fullname);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":updated_at", $this->updated_at);
            $stmt->bindParam(":id_user", $this->id_user);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        }

        public function deleteUser() {
            
            $t_sql = "DELETE FROM ". $this->db_table ." WHERE id_user = ?";
            $stmt = $this->conn->prepare($t_sql);
            $this->id_user = htmlspecialchars(strip_tags($this->id_user));
            $stmt->bindParam(1, $this->id_user, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        }

    }

?>