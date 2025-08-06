<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "colproject";

// Create connection
$data = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}
$data->close();
?>
