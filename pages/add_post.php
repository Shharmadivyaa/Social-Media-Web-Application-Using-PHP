<?php
include('../data/connect.php');
include_once('../partials/header.php');
include_once('../partials/sidebar.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
    $post_content = isset($_POST['post_content']) ? $_POST['post_content'] : '';
    $post_date = isset($_POST['post_date']) ? $_POST['post_date'] : date('Y-m-d H:i:s');
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["upload_image"]["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["upload_image"]["tmp_name"]);
    if ($check !== false) {
        $upload_ok = 1;
    } else {
        echo "File is not an image.";
        $upload_ok = 0;
    }

    // Check file size
    if ($_FILES["upload_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    // Allow certain file formats
    if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
        && $image_file_type != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $upload_ok = 0;
    }

    // Check if $upload_ok is set to 0 by an error
    if ($upload_ok == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["upload_image"]["tmp_name"], $target_file)) {
            // Prepare an SQL statement to insert the data
            $stmt = $data->prepare("INSERT INTO post (post_id, post_content, image_path, post_date, user_email) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $post_id, $post_content, $target_file, $post_date, $user_email);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "New post created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
</head>
<style>
    .head{
        color: rgb(133, 111, 133);
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
}
.box{
    color: black;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
}
.area{
    width: 500px;
    margin-left: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.image{
    color: black;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.img{
    margin-left: 690px;
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.post{
    margin-left: 710px;
    font-size: 20px;
    cursor: pointer;
}
</style>
<body>
    <h1 class="head">Add a New Post</h1><br><br>
    <form method="POST" action="add_post.php" enctype="multipart/form-data">
        <!-- <label for="post_id">Post ID:</label>
        <input type="number" id="post_id" name="post_id" required><br><br> -->
        <label for="post_content" class="box">Caption</label>
        <textarea id="post_content" name="post_content" class="area"></textarea><br><br>
        <h2> <label for="upload_image" class="image">Upload Image:</label></h2>
        <input type="file" id="upload_image" name="upload_image" required class="img"><br><br>
        <input type="submit" value="Add Post" class="post"><br><br><br><br><br><br><br><br><br>
    </form>
</body>
<?php  include_once('../partials/footer.php'); ?>
</html>
