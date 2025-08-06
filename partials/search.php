<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: rgb(133, 111, 133);
            margin: 200px;
        }
        .box {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .search {
            font-size: 20px;
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid rgb(133, 111, 133);
            border-radius: 5px;
            width: 300px;
        }
        .btn {
            font-size: 15px;
            background: white;
            color: rgb(133, 111, 133);
            cursor: pointer;
            padding: 10px 20px;
            border: 2px solid rgb(133, 111, 133);
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn:hover {
            background-color: rgb(133, 111, 133);
            color: white;
        }
        .results {
            text-align: center;
            margin-top: 20px;
        }
        .results ul {
            list-style: none;
            padding: 0;
        }
        .results li {
            margin: 10px 0;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: rgb(133, 111, 133);
        }
        .pagination a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
  <?php include('../partials/header.php'); ?>
    <h1 class="box">SEARCH USERS TO FOLLOW</h1>
    <form method="GET">
        <input type="text" class="search" name="query" placeholder="Search for users...">
        <button type="submit" class="btn">Search</button>
    </form>
    
    <div class="results">
        <?php
        if (isset($_GET['query'])) {
            include '../data/connect.php'; // Include your database connection
            $data = new mysqli("localhost", "root", "", "colproject");
            $query = $data->real_escape_string($_GET['query']);
            
            $limit = 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            $sql = "SELECT email, username FROM data WHERE username LIKE '%$query%' LIMIT $limit OFFSET $offset";
            $result = $data->query($sql);
            
            $count_sql = "SELECT COUNT(*) as total FROM data WHERE username LIKE '%$query%'";
            $count_result = $data->query($count_sql);
            $total = $count_result->fetch_assoc()['total'];
            $total_pages = ceil($total / $limit);

            if ($result->num_rows > 0) {
                echo "<h2>Search Results:</h2>";
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($row['username']) . " 
                    <a href='../pages/view_profile.php?id=" . htmlspecialchars($row['username']) . "'> View Profile</a>
                    </li>";
                }
                echo "</ul>";

                echo "<div class='pagination'>";
                if ($page > 1) {
                    echo "<a href='?query=$query&page=" . ($page - 1) . "'>Previous</a>";
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?query=$query&page=$i'>$i</a>";
                }
                if ($page < $total_pages) {
                    echo "<a href='?query=$query&page=" . ($page + 1) . "'>Next</a><br><br><br>";
                }
                echo "</div>";
            } else {
                echo "No users found.";
            }
            
            $data->close();
        }
        ?>
    </div>
</body>
</html>
<?php include('../partials/footer.php');  ?>
