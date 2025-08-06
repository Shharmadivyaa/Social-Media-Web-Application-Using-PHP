<?php
session_start();
if (!isset($_SESSION['user_email'])) {
include('../data/connect.php');
}
$follower_username = $_POST['follower_username'];
$following_username = $_SESSION['username'];

// Get following ID
$stmt = $data->prepare("SELECT * FROM data WHERE username = ?");
$stmt->bind_param("s", $following_username);
$stmt->execute();
$result = $stmt->get_result();
$following = $result->fetch_assoc();
$following_id = $following['id'];
$stmt->close();

$stmt = $data->prepare("UPDATE follows SET status = 'accepted' WHERE follower_username = ? AND following_username = ?");
$stmt->bind_param("ii", $follower_username, $following_username);
$stmt->execute();
$stmt->close();
$data->close();

header('Location: ../pages/home.php');
?>