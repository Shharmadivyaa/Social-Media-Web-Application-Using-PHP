<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Initialize variables
$fname = isset($_POST['fname']) ? $_POST['fname'] : "";
$lname = isset($_POST['lname']) ? $_POST['lname'] : "";
$username = isset($_POST['username']) ? $_POST['username'] : "";
$DOB = isset($_POST['DOB']) ? $_POST['DOB'] : "";
$number = isset($_POST['number']) ? $_POST['number'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$bio = isset($_POST['bio']) ? $_POST['bio'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : "";
$profile_photo = isset($_POST['profile_photo']) ? $_POST['profile_photo'] : "";

// Validate password and phone number
if ($password !== $cpassword) {
    die("Passwords do not match");
    exit();
}

if (strlen($password) < 9) {
    die("Password must be at least 9 characters");
    exit();
}

if (strlen($number) < 10) {
    die("Phone number is incorrect");
    exit();
}

$password1 = md5($password);
$cpassword1 = md5($cpassword);

// Database connection
$data = new mysqli("localhost", "root", "", "colproject");
if ($data->connect_error) {
    die("ERROR: Could not connect. " . $data->connect_error);
}

// Check if username or email already exists
$check_query = "SELECT * FROM data WHERE username = ? OR email = ?";
$stmt = $data->prepare($check_query);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Username or email already exists. Please choose a different one.");
    exit();
}

// Insert new user into the database
$insert_query = "INSERT INTO data (fname, lname, username, DOB, number, email, bio, password, cpassword, profile_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $data->prepare($insert_query);
$stmt->bind_param("ssssssssss", $fname, $lname, $username, $DOB, $number, $email, $bio, $password1, $cpassword1, $profile_photo);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $_SESSION['email'] = $email;
    include('../pages/login.php');
    exit();
} else {
    echo "Invalid Details";
}

// Randomly select profile picture
$rand = rand(1, 2);
$profilepic = $rand == 1 ? "../imgs/default.png" : "../imgs/fdefault.png";

$stmt->close();
$data->close();
?> 
