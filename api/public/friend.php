<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    require_once('../controllers/friendController.php');
    /*
    List of friend from user
    Method GET
    Param id_user
    Request url http://127.0.0.1:81/friend.php?id_user=1

    Add a friend
    Method POST
    Param id_user, id_user_friend (id_user related) INT
    Request url http://127.0.0.1:81/friend.php?action=add

    Delete friendship
    Method POST
    Param id_friendship
    Format JSON
    Request url http://127.0.0.1:81/friend.php?action=delete
    */
?>