<?php 
include('connection.php');

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['login'])) {
    $n = mysqli_real_escape_string($conn, $_POST['email']);
    $p = mysqli_real_escape_string($conn, $_POST['password']);

    $t = "SELECT * FROM employee WHERE email ='$n' AND pass ='$p' ";

    $r = mysqli_query($conn, $t);

    if (mysqli_num_rows($r) > 0) {
        // Fetch all rows and check for a matching email and password
        while ($row = mysqli_fetch_assoc($r)) {
            if ($row['email'] == $n && $row['pass'] == $p) {
                $_SESSION['name'] = $n;
                $_SESSION['success'] = "Welcome dear";
                header('location:employeeprofile.php');
               
            }
        }
        
        echo "Wrong data!";
    } else {
        echo "Wrong data!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header('location:login.php');
   
}
?>
