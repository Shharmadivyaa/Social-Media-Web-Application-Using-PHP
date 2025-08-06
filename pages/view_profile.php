<?php
session_start();

if (!isset($_SESSION['email'])) {
}

$current_user = $_SESSION['email'];
$data = new mysqli("localhost", "root", "", "colproject");

if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

// Fetch other users' details
$sql = "SELECT fname, username, bio, profile_photo FROM data WHERE email != ?";
$stmt = $data->prepare($sql);
$stmt->bind_param("s", $current_user);
$stmt->execute();
$result = $stmt->get_result();
$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$stmt->close();
$data->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .profile-container {
            background-color: white;
            max-width: 600px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-info {
            margin-top: 20px;
        }
        .profile-info h2 {
            margin: 10px 0;
            color: #333;
        }
        .profile-info p {
            color: #666;
            margin: 5px 0;
        }
        .profile-info form {
            margin-top: 20px;
        }
        .profile-info button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .profile-info button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php foreach ($users as $user): ?>
    <div class="profile-container">
        <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="Profile Picture" class="profile-picture">
        <div class="profile-info">
            <h2><?php echo htmlspecialchars($user['fname']); ?></h2>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Bio:</strong> <?php echo htmlspecialchars($user['bio']); ?></p>
            <form action="../pages/followreq.php" method="post">
                <input type="hidden" name="recipient_username" value="<?php echo htmlspecialchars($user['username']); ?>">
                <button type="submit">Send Follow Request</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</body>
</html>
