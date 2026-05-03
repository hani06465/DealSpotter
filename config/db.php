<?php

// creates database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "deal_platform";

$conn = new mysqli($host, $user, $pass, $dbname);


if($conn->connect_error){
    die("Connection faild: ". $conn->connect_error);
}

?>