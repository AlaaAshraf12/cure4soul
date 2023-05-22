<?php include("connection.php"); ?>
<html>

<head>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="parent">
    <h4>
        Login to CURE4SOUL
    </h4>
    <div class="frame">
        <form method="POST" action="logformemp.php">

            <br><br>
            <label for="company">Enter your company</label><br>
            <input class="for" type="text" id="company" name="company" required><br>
            <br>
            <label for="email">Enter your email</label><br>
            <input class="for" type="text" id="email" name="email" required><br>
            <br>
            <label for="password">Enter your password</label><br>
            <input class="for"  type="password" id="password" name="password" required><br><br>


            <button type="submit" name="login" class="submit1">Login</button><br><br>

            <a href="forgot.html">forgot your password?</a>
        </form> 
    </div>
 
</div>







</body>
</html>