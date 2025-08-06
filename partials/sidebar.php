    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <nav class="sidebar close">
<body>
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo.jpeg" alt="logo">
                </span>
                <div class="text header-text">
                    <b><span class="name">CHITCHAT</span></b>
                </div>
            </div>

            <i class='bx bx-chevrons-right toggle'></i>
        </header>
        <div class="menu-bar">

                <ul class="menu-links">
                    <li class="nav-link">
                    <a href="../pages/home.php">
                        <i class='bx bxs-home icon'></i>
                        <span class="text nav-text">Home</span>
                    </a>
                </li>
                    <li class="nav-link">
                    <a href="#">
                        <i class='bx bxs-heart icon'></i>
                        <span class="text nav-text">Likes</span>
                    </a>
                </li>
                    <li class="nav-link">
                    <a href="#">
                        <i class='bx bxs-user icon'></i>
                        <span class="text nav-text">My friends</span>
                    </a>
                </li>
                    <li class="nav-link">
                    <a href="../pages/search.php">
                        <i class='bx bxs-user-plus icon'></i>
                        <input type="hidden" name="following_id" value="ID_OF_USER_TO_FOLLOW">
                       <span class="text nav-text">Requests</span>
                    </a>
                </li>
                </li>
                    <li class="nav-link">
                    <a href="#">
                        <i class='bx bxs-chat icon'></i>
                        <span class="text nav-text">Messages</span>
                    </a>
                </li>
                </li>
                    <li class="nav-link">
                    <a href="#">
                        <i class='bx bxs-bell icon'></i>
                        <span class="text nav-text">Notifications</span>
                    </a>
                </li>
                    <li class="nav-link">
                    <a href="../partials/exit.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                </ul>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </div>
        </div>
        <!-- <div class="user">
         <li><i class='bx bxs-log-out'></i>
            <a href="exit.php" class="btn">Logout</a> -->
            <!-- <ul class="dropdown">
              <li><a href="login.php">Logout</a></li>
            </ul> -->
        </li>
        </div>
        </nav>
        <script src = "../partials/sidebar.js"></script>
</body>
</html>
        