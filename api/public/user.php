<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    require_once('../controllers/userController.php');

    /*
    List of all users registered
    Method GET
    Request url http://127.0.0.1:81/user.php

    Get a single user
    Method GET
    Param id_user INT
    Request url http://127.0.0.1:81/user.php?id_user=1

    Create a user
    Method POST
    Params fullname, email, password, language, latitude, longitude
    Format JSON
    Request url http://127.0.0.1:81/user.php?action=insert

    Update user
    Method POST
    Params id_user, fullname, email, password, updated_at
    Format JSON
    Request url http://127.0.0.1:81/user.php?action=update

    Delete a user
    Method POST
    Param id_user
    Format JSON
    Request url http://127.0.0.1:81/user.php?action=delete
    */
    
?>