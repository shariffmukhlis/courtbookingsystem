<?php
    $servername = 'localhost:3306';
    $admin = 'root';
    $password = '';
    $database = 'courtbooking';

    $conn = new mysqli($servername, $admin, $password, $database);


    if($conn->connect_error){
        die('connection fail');
    }

?>