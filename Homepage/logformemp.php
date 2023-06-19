<?php require_once "connection.php";
$conn = OpenConnection();


if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM employee WHERE email = '$email' AND pass = '$password'";
    $result = sqlsrv_query($conn, $query);

    if (sqlsrv_has_rows($result) > 0) {
        $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
        $employeeID = $row['eid'];

        // Check if the employee's account should be marked as inactive
        $sessionQuery = "SELECT COUNT(*) AS numSessions FROM booking WHERE eid = '$employeeID' AND attendancestatus = 'attended'";
        $sessionResult =sqlsrv_query($conn, $sessionQuery);

        if ($sessionResult) {
            $sessionRow = sqlsrv_fetch_array($sessionResult,SQLSRV_FETCH_ASSOC);
            $numSessions = $sessionRow['numSessions'];
            $availableSessions = $row['numofsessions'];

            if ($numSessions >= $availableSessions) {
                // Mark the account as inactive
                $updateQuery = "UPDATE employee SET accountstatus = 'inactive' WHERE eid = '$employeeID'";
                sqlsrv_query($conn, $updateQuery);

                // Redirect to an inactive account page
                header('location: login.php');
                
                exit();
            }

            $_SESSION['name'] = $email;
            $_SESSION['success'] = "Welcome dear";
            header('location: employeeprofile.php');
            exit();
        } else {
            echo "Error: " . sqlsrv_errors($conn);
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
