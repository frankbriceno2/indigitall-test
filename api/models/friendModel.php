<?php

    class Friend {
        //Connection
        private $conn;
        //Table to use
        private $db_table = "friends";

        public $id_friendship;
        public $id_user;
        public $id_user_friend;
        public $created_at;
        public $fullname;
        public $email;
        public $language;
        public $latitude;
        public $longitude;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getFriends() {

            $t_sql = "select a.id_friendship, b.* from ". $this->db_table ." as a
                    left join users as b on a.id_user_friend = b.id_user
                    where a.id_user = ?";

            $stmt = $this->conn->prepare($t_sql);
            $stmt->bindParam(1, $this->id_user, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt;
        }

        public function addFriend() {

            $t_sql = "INSERT INTO ". $this->db_table ." SET id_user = :id_user, id_user_friend = :id_user_friend";
            $stmt = $this->conn->prepare($t_sql);

            $this->id_user = htmlspecialchars(strip_tags($this->id_user));
            $this->id_user_friend = htmlspecialchars(strip_tags($this->id_user_friend));

            $stmt->bindParam(":id_user", $this->id_user);
            $stmt->bindParam(":id_user_friend", $this->id_user_friend);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        }

        public function deleteFriend() {

            $t_sql = "DELETE FROM ". $this->db_table ." WHERE id_friendship = ?";
            $stmt = $this->conn->prepare($t_sql);
            $this->id_friendship = htmlspecialchars(strip_tags($this->id_friendship));
            $stmt->bindParam(1, $this->id_friendship, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        }

    }

?>