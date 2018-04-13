<?php
$servername = "localhost";
$username = "taskuser";
$password = "nhzh1SWNSKvFZ8A5";
$dbname = "taskdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
