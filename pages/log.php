<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include('../data/connect.php');
session_start();
     $username ="";
    if(isset($_POST['username'])){
    $username = $_POST['username'];
    }
    $password ="";
    if(isset($_POST['password'])){
    $password = $_POST['password'];
    }
    $password1 = md5($password);
    
    $data = new mysqli("localhost", "root", "", "colproject");
    $stmt = $data->prepare("SELECT * FROM data WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password1);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    
    if($stmt_result->num_rows > 0){
        $_POST['username'] = $username;
        header("Location: ../pages/home.php");

    }
    else{
        // header("Location: exit.php");
        header('Location: ../partials/exit.php');
    }
    $stmt->close();
    $data->close();

?>