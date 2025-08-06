<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../data/connect.php'; // Include your database connection

// Get the follower_id from the session or POST data
$follower_id = isset($_SESSION['follower_username']) ? $_SESSION['follower_username'] : null;
$following_id = isset($_POST['following_username']) ? $_POST['following_username'] : null;

// Check if both follower_id and following_id are set
if ($follower_id !== null && $following_id !== null) {
    // Check if a request already exists
    $data = new mysqli("localhost", "root", "", "colproject");
    $query = "SELECT * FROM follows WHERE follower_username = ? AND following_username = ?";
    $stmt = $data->prepare($query);
    $stmt->bind_param("ii", $follower_username, $following_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "You have already sent a request to this user.";
    } else {
        // Insert the follow request into the database
        $query = "INSERT INTO follows (follower_username, following_username) VALUES (?, ?)";
        $stmt = $data->prepare($query);
        $stmt->bind_param("ii", $follower_username, $following_username);
        if ($stmt->execute()) {
            echo "Follow request sent successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $data->close();
}
?>
