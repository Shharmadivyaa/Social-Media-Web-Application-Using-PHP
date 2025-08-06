<?php
session_start();

if (!isset($_SESSION['username'])) {
 
}

$user_username = $_SESSION['username'];
$data = new mysqli("localhost", "root", "", "colproject");

if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

// Fetch current user details
$sql = "SELECT fname, username, bio, number, profile_photo FROM data WHERE username = ?";
$stmt = $data->prepare($sql);
$stmt->bind_param("s", $user_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
}

// Update user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update_query = "UPDATE data SET fname = ?, username = ?, bio = ?, number = ? WHERE username = ?";
    $stmt = $data->prepare($update_query);
    $stmt->bind_param("sssss", $_POST['fname'], $_POST['username'], $_POST['bio'], $_POST['number'], $user_username);
    $stmt->execute();
    
    // Update session variables if needed
    $_SESSION['username'] = $_POST['username'];

    // Fetch updated user details
    $user['fname'] = $_POST['fname'];
    $user['username'] = $_POST['username'];
    $user['bio'] = $_POST['bio'];
    $user['number'] = $_POST['number'];

    $stmt->close();
}

// Update profile picture
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_photo'])) {
    $profile_photo = $_FILES['profile_photo'];
    $target_dir = "cover/";
    $target_file = $target_dir . basename($profile_photo["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($profile_photo["tmp_name"]);
    if ($check === false) {
        $upload_ok = 0;
    }

    // Check file size (example: limit to 5MB)
    if ($profile_photo["size"] > 5000000) {
        $upload_ok = 0;
    }

    // Allow certain file formats
    if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
        $upload_ok = 0;
    }

    if ($upload_ok == 1) {
        if (move_uploaded_file($profile_photo["tmp_name"], $target_file)) {
            $stmt = $data->prepare("UPDATE data SET profile_photo = ? WHERE username = ?");
            $stmt->bind_param("ss", $target_file, $user_username);
            $stmt->execute();
            $stmt->close();

            // Update the session variable if needed
            $_SESSION['profile_photo'] = $target_file;

            // Update user array
            $user['profile_photo'] = $target_file;

            header('Location: ../pages/profile.php');
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, your file was not uploaded.";
    }
}

$data->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        .profile-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        .profile-info {
            margin-top: 20px;
        }
        .profile-info h2 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="Profile Picture" class="profile-picture">
        <div class="profile-info">
            <h2><?php echo htmlspecialchars($user['fname']); ?></h2>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Bio:</strong> <?php echo htmlspecialchars($user['bio']); ?></p>
            <p><strong>Number:</strong> <?php echo htmlspecialchars($user['number']); ?></p>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($user['fname']); ?>" required><br><br>
            
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br><br>

            <label for="bio">Bio:</label>
            <textarea name="bio" id="bio" required><?php echo htmlspecialchars($user['bio']); ?></textarea><br><br>

            <label for="number">Phone Number:</label>
            <input type="text" name="number" id="number" value="<?php echo htmlspecialchars($user['number']); ?>" required><br><br>

            <label for="profile_photo">Update Profile Picture:</label>
            <input type="file" name="profile_photo" id="profile_photo"><br><br>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
