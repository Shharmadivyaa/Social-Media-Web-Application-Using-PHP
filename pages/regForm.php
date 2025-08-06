<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/reg.css">
</head>
<style>
.Required::after{
    content: " *";
    color: red;
    font-size: 20px;
}
</style>
<body>
        <header class="box">
            <div class="container header-nav">
                <nav class="navbar">
                    <div class="LOGIN"></div>
                    <div class="title">
                    <span> <a href="../pages/login.php">LOGIN</a></span>
                </div>
                  <div class="Policy"></div>
                  <div class="title">
                    <span><a href="../pages/policy.php">Policy</a></span>
                </div>
                  <div class="terms and conditions"></div>
                  <div class="title">
                  <span><a href="../pages/tc.php">Terms And Conditions</a></span>
    
    </header>

   <br> <b><h1>REGISTRATION FORM </h1></b><br>
    <form action="reg.php" method="post">
        <label for="First Name" class="Required"> First Name </label>
        <input type="text" name="fname" placeholder="Enter Your First Name">
        <label for="Last Name" class="Required"> Last Name </label>
        <input type="text" name="lname" placeholder="Enter Your Last Name">
        <label for="username" class="Required"> Username </label>
        <input type="text" name="username" placeholder="Enter Your Username">
        <label for="Date Of Birth"> Date Of Birth </label>
        <input type="date" name="DOB" placeholder="DD/MM/YYYY">
        <label for="Phone Number" class="Required"> Phone Number </label>
        <input type="tel" name="number" placeholder="Enter Your Phone Number">
        <label for="E-Mail"> E-Mail </label>
        <input type="email" name="email" placeholder="Enter Your E-Mail">
        <label for="Bio"> Bio </label>
        <input type="text" name="bio" placeholder="Enter Your Bio">
        <label for="Password" class="Required"> Password </label>
        <input type="password" name="password" placeholder="Enter Your Password Here">
        <label for="Confirm Password" class="Required"> Confirm Password </label>
        <input type="password" name="cpassword" placeholder="Enter Your Confirm Password">
        <label for="Profile Photo" > Profile Photo </label>
        <input type="file" name="profile_photo"  id="profile_photo" default = "default.png">
        <label for="Submit"></label>
        <input type="submit" name="SignUp" id="submit">
       <b><label for="Already have an account?"> Already have an account?</label></b>
        <b><a href="login.php">LOGIN FROM HERE</a></ul></b>
    </form>
<footer>

</footer>
</body>
</html>