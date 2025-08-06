<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/log.css">
<body>
    <header class="box">
        <div class="container header-nav">
            <nav class="navbar">
                <div class="Register"></div>
                <div class="title">
                <span> <a href="../pages/regForm.php">Register</a></span>
            </div>
              <div class="policies"></div>
              <div class="title">
                <span><a href="../pages/policy.php">Policy</a></span>
            </div>
              <div class="terms and conditions"></div>
              <div class="title">
              <span><a href="../pages/tc.php">Terms And Conditions</a></span>

    </header>
    <h1> LOGIN PAGE</h1>
    <form method="post" action="../pages/log.php">
        <label for="Username"> Username </label>
        <input type="text" name="username" placeholder="Enter Your Username">
        <label for="Password"> Password </label>
        <input type="password" name="password" placeholder="Enter Your Password Here">
        <label for="Submit"></label>
        <input type="submit" name="submit" id="submit">
        <ul><label for="Remember me">Remember me</label>
            <input type="checkbox" name="Remember_me"><br><br></ul>
            <a href="#">Forgot Password?</a>
            <label for="Don't have an account?">Don't have an account?</label>
            <a href="regForm.php">Register Now</a>
    </form>
</body>
</html>