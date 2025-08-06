

</head>
<body>
    <?php include ("../partials/header.php");?>
    <?php include ("../partials/sidebar.php");?>
<form class="box" style="display: flex; bgcolor: purple ; justify-content: center; align-items: center; min-height: 100vh; background: rgb(241, 197, 197);">
        <!-- <h2 class="data" style="text-align: center;" >USER's DATA</h2> -->
        <table  border="1px" width="30%" cellspacing="2px" cellpadding="1px" allign="center">
        <!-- <h2 class="data" style="text-align: center;" >USER's DATA</h2> -->
        <tr align = "center">
            <th>Email</th>
            <th>Number</th>
        </tr
        <?php
        $conn= mysqli_connect("localhost","root","","colproject");
        if($conn->connect_error){
            die("Connection Failed:".$conn->connect_error);
        }
        $sql = "SELECT email, number from data";
        $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row["email"]."</td><td>".$row["number"]."</td></tr>";
                }
                echo "</table>";
            }else{
                echo "0 result";
            }
            $conn->close();
            ?>
    </table>
        </form>
        <!-- <form>
            <div class="container">
                <div class="row mt-5">
                    <div class="col">
                        <div class="card mt-5">
                            <div class="card-header">
                                <h1 class="display-6 text center">USER's DATA</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

        </form> -->
    <script src = "../partials/sidebar.js"></script>
</body>
</html>
