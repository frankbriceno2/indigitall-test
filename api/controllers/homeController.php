<?php

//Call database connection
include_once('../ddbb/DBConnection.php');
//Call specific model
include_once('../models/homeModel.php');
//validate http method
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $database = new Database();
    $db = $database->getConnection();

    $userList = new Home($db);
    $stmt = $userList->getAllUsers();
    $count = $stmt->rowCount();

    if ($count > 0) {
        $usersArr = array();
        $usersArr["body"] = array();
        $usersArr["count"] = $count;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $e = array(
                "id_user" => $id_user,
                "fullname" => $fullname,
                "language" => $language,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "created_at" => $created_at
            );
            array_push($usersArr['body'], $e);
        }
        echo json_encode($usersArr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
}
