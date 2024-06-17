<?php 

$server_name = "localhost";
$db_name = "finaldata";
$username = "root";
$password = "";

$conn = mysqli_connect($server_name, $username, $password, $db_name);

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

// echo("Connected Successfully!" . "<br>");
?>