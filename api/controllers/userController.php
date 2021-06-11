<?php

    //Call database connection
    include_once('../ddbb/DBConnection.php');
    //Call model
    include_once('../models/userModel.php');

    $database = new Database();
    $db = $database->getConnection();

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        if (!isset($_GET['id_user'])) {

            $userList = new User($db);
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
                        "email" => $email,
                        "language" => $language,
                        "latitude" => $latitude,
                        "longitude" => $longitude,
                        "created_at" => $created_at,
                        "updated_at" => $updated_at
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
        } else {

            $user = new User($db);
            $user->id_user = $_GET['id_user'];
            $user->getUser();

            if ($user->fullname != null) {
                $user_arr = array(
                    "id_user" => $user->id_user,
                    "fullname" => $user->fullname,
                    "email" => $user->email,
                    "password" => $user->password,
                    "language" => $user->language,
                    "latitude" => $user->latitude,
                    "longitude" => $user->longitude,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at
                );

                http_response_code(200);
                echo json_encode($user_arr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "No record found.")
                );
            }

        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_GET['action']) && $_GET['action'] == 'insert'){

            $newUser = new User($db);
            $data = json_decode(file_get_contents("php://input"));

            $newUser->fullname = $data->fullname;
            $newUser->email = $data->email;
            $newUser->password = md5($data->password);
            $newUser->language = $data->language;
            $newUser->latitude = $data->latitude;
            $newUser->longitude = $data->longitude;

            if ($newUser->createUser()) {
                echo '{"result": "insert success"}';
            } else {
                echo '{"result": "insert fail"}';
            }
        }

        if (isset($_GET['action']) && $_GET['action'] == 'update'){

            $updateUser = new User($db);
            $data = json_decode(file_get_contents("php://input"));

            $updateUser->id_user = $data->id_user;

            $updateUser->fullname = $data->fullname;
            $updateUser->email = $data->email;
            $updateUser->password = md5($data->password);
            $updateUser->updated_at = date('Y-m-d H:i:s');

            if ($updateUser->updateUser()) {
                echo '{"result": "update success"}';
            } else {
                echo '{"result": "update fail"}';
            }

        }

        if (isset($_GET['action']) && $_GET['action'] == 'delete'){

            $deleteUser = new User($db);
            $data = json_decode(file_get_contents("php://input"));

            $deleteUser->id_user = $data->id_user;

            if ($deleteUser->deleteUser()) {
                echo '{"result": "Delete success"}';
            } else {
                echo '{"result": "Delete fail"}';
            }

        }

    }

?>