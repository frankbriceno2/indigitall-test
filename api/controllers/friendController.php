<?php

    include_once('../ddbb/DBConnection.php');
    //Call model
    include_once('../models/friendModel.php');
    //Call model Log
    include_once('../models/logModel.php');

    $database = new Database();
    $db = $database->getConnection();

    define("ERROR_LOG", "E");
    define("INFO_LOG", "I");
    
    $log = new Log("../log/log.txt");
    
    $log->writeLine(INFO_LOG, "Friend service access");

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        if (isset($_GET['id_user'])) {
            $friendship = new Friend($db);
            $friendship->id_user = $_GET['id_user'];
            $stmt = $friendship->getFriends();
            $count = $stmt->rowCount();

            if ($count > 0) {
                $friendsArr = array();
                $friendsArr["body"] = array();
                $friendsArr["count"] = $count;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $e = array(
                        "id_friendship" => $id_friendship,
                        "id_user" => $id_user,
                        "fullname" => $fullname,
                        "email" => $email,
                        "language" => $language,
                        "latitude" => $latitude,
                        "longitude" => $longitude,
                        "created_at" => $created_at
                    );
                    array_push($friendsArr['body'], $e);
                }
                http_response_code(200);
                echo json_encode($friendsArr);
                $log->writeLine(INFO_LOG, "Response sent");
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "No record found.")
                );
                $log->writeLine(ERROR_LOG, "Something went wrong");
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_GET['action']) && $_GET['action'] == 'add'){

            $addFriend = new Friend($db);
            $data = json_decode(file_get_contents("php://input"));

            $addFriend->id_user = $data->id_user;
            $addFriend->id_user_friend = $data->id_user_friend;

            if ($addFriend->addFriend()) {
                http_response_code(200);
                echo '{"result": "Add success"}';
                $log->writeLine(INFO_LOG, "Response sent");
            } else {
                http_response_code(404);
                echo '{"result": "Add fail"}';
                $log->writeLine(ERROR_LOG, "Something went wrong");
            }

        }

        if (isset($_GET['action']) && $_GET['action'] == 'delete'){

            $deleteFriend = new Friend($db);
            $data = json_decode(file_get_contents("php://input"));
    
            $deleteFriend->id_friendship = $data->id_friendship;
    
            if ($deleteFriend->deleteFriend()) {
                http_response_code(200);
                echo '{"result": "Delete success"}';
                $log->writeLine(INFO_LOG, "Response sent");
            } else {
                http_response_code(404);
                echo '{"result": "Delete fail"}';
                $log->writeLine(ERROR_LOG, "Something went wrong");
            }
    
        }
    }

    $log->close();

?>