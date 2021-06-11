<?php

    include_once('../ddbb/DBConnection.php');

    try {
        $db = DBConnection::connection();
        $sql = file_get_contents('data/database.sql');
        echo "Database and tables created successfully!";
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }

?>