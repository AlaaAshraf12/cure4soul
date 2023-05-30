<?php
include('connection.php');

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM employee WHERE email = '$email' AND pass = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $employeeID = $row['eid'];

        // Check if the employee's account should be marked as inactive
        $sessionQuery = "SELECT COUNT(*) AS numSessions FROM booking WHERE eid = '$employeeID' AND attendancestatus = 'attended'";
        $sessionResult = mysqli_query($conn, $sessionQuery);

        if ($sessionResult) {
            $sessionRow = mysqli_fetch_assoc($sessionResult);
            $numSessions = $sessionRow['numSessions'];
            $availableSessions = $row['numofsessions'];

            if ($numSessions >= $availableSessions) {
                // Mark the account as inactive
                $updateQuery = "UPDATE employee SET accountstatus = 'inactive' WHERE eid = '$employeeID'";
                mysqli_query($conn, $updateQuery);

                // Redirect to an inactive account page
                header('location: login.php');
                
                exit();
            }

            $_SESSION['name'] = $email;
            $_SESSION['success'] = "Welcome dear";
            header('location: employeeprofile.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Wrong data!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header('location: login.php');
    exit();
}
?>
