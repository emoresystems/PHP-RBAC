<?php

// db configuration
$host = 'localhost';
$db = 'onlinerbac';
$user = 'onlinerbac';
$pass = '';

// establish connection to db
$conn = new mysqli($host, $user, $pass, $db);


// check for the connection
if($conn->connect_error){
    echo'failed to connect to db'.$conn->connect_error;
}