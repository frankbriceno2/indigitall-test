<?php

//Call database connection
include_once('../ddbb/DBConnection.php');
//Call specific model
include_once('../models/homeModel.php');
//Call model Log
include_once('../models/logModel.php');

define("ERROR_LOG", "E");
define("INFO_LOG", "I");
    
$log = new Log("../log/log.txt");
    
$log->writeLine(INFO_LOG, "Home service access");

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
        http_response_code(200);
        echo json_encode($usersArr);
        $log->writeLine(INFO_LOG, "Response sent");
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
        $log->writeLine(ERROR_LOG, "Something went wrong");
    }
}
$log->close();
