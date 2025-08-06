<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
.nav-item{
    font-size: 300%;
    text: black;
    background: rgb(219, 193, 219);
    width: 100%;
    height: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.img-rounded{
  min-width: 80%;
  height: 200px;
  display: flex;
  align-items: center; 
  justify-content: space-between;
  padding-left: 76%;
}
#signup{
  width: 30%;
  border-radius: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: auto;
  
}
#login{
  width: 30%;
  border-radius: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: auto;

}

</style>
<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page">CHITCHAT</a><br>
        </li>
       
      </ul>
      
       <br><br><div class= "col-sm-6" style = "left: 3%;">
      <img src="../imgs/cc.png"  class= "img-rounded " title = "chitchat" min-width ="100%" height ="auto" display = "flex" align-items = "center" alt="logo"><br>
</div>
</div>
<form method="post" action="">
  <button id="signup" class="btn btn-info btn-lg" name="signup">Sign Up</button><br>
  <?php
    if(isset($_POST['signup'])) {
      header ("Location: ../pages/regForm.php");
    }
  ?>
  <button id="login" class="btn btn-info btn-lg" name="login">Login</button><br>
  <?php
    if(isset($_POST['login'])) {
      header ("Location: ../pages/login.php");
    }
  ?>
</form>
<?php
 include('footer.php');
 ?>
</body>
</html>