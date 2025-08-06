<?php
// Connection parameters
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'colproject';
session_start();
include('../partials/sidebar.php');
// include('../partials/header.php');
$data = new mysqli("localhost","root","","colproject");
if (!isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['email'];
    include('../data/connect.php');
}

// Create a new mysqli object
$data = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($data->connect_error) {
    die('Connection failed: ' . $data->connect_error);
}

// Your query
$sql = 'SELECT * FROM data';

// Prepare and execute the query
$stmt = $data->prepare($sql);
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        // echo $row['user_email'];
    }
    $stmt->close();
} else {
    echo 'Error: ' . $data->error;
}
$data->close();
$data = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($data->connect_error) {
    die('Connection failed: ' . $data->connect_error);
}

// Prepare and execute the first query
$stmt = $data->prepare("SELECT COUNT(*) AS unseen_count FROM messages WHERE receiver_id = ? AND seen = 0");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$message_count = $result->fetch_assoc()['unseen_count'];
$stmt->close();

// Prepare and execute the second query
$stmt = $data->prepare("SELECT p.*,u.fname, u.lname, u.profile_photo FROM post p JOIN data u ON p.post_id = u.Sno ORDER BY p.post_date DESC");
$stmt->execute();
$posts = $stmt->get_result();
$stmt->close();
$data->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <header>
        <div class="user-info">
            <img src="../imgs/default.png<?php echo htmlspecialchars($profile_photo); ?>" alt="Profile Photo" width="50" height="50">
            <!-- <span><?php echo htmlspecialchars($fname) . " " . htmlspecialchars($lname); ?></span> -->
        </div>
        <div class="notifications">
            <span>Unseen Messages: <?php echo $message_count; ?></span>
        </div>
        <nav>
            <a href="../pages/profile.php">Profile</a>
            <a href="../pages/add_post.php">Add Posts</a>
            <a href="../partials/exit.php">Logout</a>
        </nav>
    </header>
    <main>
       
        <h2>Posts</h2>
        <?php while ($post = $posts->fetch_assoc()) : ?>
            <div class="post">
                <div class="post-header">
                    <img src="../imgs/default.png<?php echo htmlspecialchars($post['profile_photo']); ?>" alt="User Photo" width="30" height="30">
                    <span><?php echo htmlspecialchars($post['fname']) . " " . htmlspecialchars($post['lname']); ?></span>
                </div>
                <div class="post-content">
                    <p><?php echo htmlspecialchars($post['post_content']); ?></p>
                </div>
                <div class="post-footer">
                    <span><?php echo $post['post_date']; ?></span>
                </div>
            </div>
        <?php endwhile; ?>
    </main>
</body>
</html>

