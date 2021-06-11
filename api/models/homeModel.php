<?php

    class Home {
        //Connection
        private $conn;
        //Table to use
        private $db_table = "users";

        //Columns
        public $id_user;
        public $fullname;
        public $language;
        public $latitude;
        public $longitude;
        public $created_at;
        public $updated_at;
        //Conection to database
        public function __construct($db) {
            $this->conn = $db;
        }
        //Method that list all users
        public function getAllUsers() {

            $t_sql = "SELECT id_user, fullname, language, latitude, longitude, created_at, updated_at FROM ". $this->db_table;
            $stmt = $this->conn->prepare($t_sql);
            $stmt->execute();

            return $stmt;

        }

    }

?>