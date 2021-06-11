<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once('../controllers/homeController.php');

    /*
    List of all users registered
    Method GET
    Request url http://127.0.0.1:81/home.php
    The idea is serve the list of users to be used for home page in the frontend
    */
    
?>