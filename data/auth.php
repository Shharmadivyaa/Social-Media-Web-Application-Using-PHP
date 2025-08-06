<?php
include('connect.php');

$email ="";
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
$password ="";
if(isset($_POST['password'])){
    $password = $_POST['password'];
}
$password1= md5($password);
$stmt = $data->prepare("SELECT * FROM data WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $_SESSION['user_email'] = $email;
    header("Location: ../pages/profile.php");
} else {
    echo "Invalid email or password";
}

$stmt->close();
$data->close();
?>
