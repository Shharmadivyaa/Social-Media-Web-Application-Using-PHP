<!-- <?php

if (!isset($_SESSION['email'])) {
include __DIR__ . 'connect.php';
}

$data = mysqli_connect("localhost","root","","colproject");
$stmt = $data->prepare("SELECT * FROM data WHERE email = ?");
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!isset($_SESSION['user_email'])) {
// $user_email = $_SESSION['user_email'];
$stmt_posts = $data->prepare("SELECT COUNT(*) AS post_count FROM post WHERE user_email = ?");
$stmt_posts->bind_param("s",$_SESSION['user_email'] );
$stmt_posts->execute();
$result_posts = $stmt_posts->get_result();
$row_posts = $result_posts->fetch_assoc();
}
$stmt->close();
$stmt_posts->close();
$data->close(); 

?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<style>
    .nav-item {
    display: flex;
    flex-direction: row;
    align-items: end;
    justify-content: end;
    background: #f8b9b9;
    min-width: 100px;
    height: 80px;
    font-size: 20px;
    padding-left: 700px;
}
.li.nav-item{
    color: black;
    padding-left: 55px;
}

.nav-item ul.nav.navbar-nav {
    display: flex;
    flex-direction: row;
    align-items: end;
    justify-content: space-evenly;
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.nav-item ul.nav.navbar-nav li {
    margin-right: 50px; /* Adjust the spacing between list items */
}

.nav-item ul.nav.navbar-nav li:last-child {
    margin-right: 0; /* Remove the right margin from the last list item */
}
.dropdown-toggle{
    margin-right: 20px;
}

</style>
<body>
    <header>

        <li class="nav-item" style="color: black; display=flex; flex-direction=column; align-items=end; justify-content=end;">
            <ul class="nav navbar-nav">
           
                <li><a href='home.php'>Home</a></li>
                <li><a href='search.php'>Find People</a></li>
                <li><a href='message.php'>Messages</a></li>
                <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                User <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                    <li>
                        <a href="mypost.php?fname=<?php echo htmlspecialchars($row['fname']); ?>">My Posts <span class="badge badge-secondary"></span></a>
                    </li>
                    <li>
                        <a href="../pages/add_post.php?email=<?php echo htmlspecialchars($row['email']); ?>">Add post <span class="badge badge-secondary"></span</a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="../partials/exit.php">Logout</a>
                    </li>
            </ul>
        </li>
    </ul>

            </ul>
        </li>
    </ul>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
