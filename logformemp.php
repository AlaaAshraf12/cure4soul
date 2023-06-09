<?php 
if (!isset($_SESSION)) {
session_start();
require_once "connection.php";
$conn = OpenConnection();}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $company = $_POST['company'];
    $query = "SELECT * FROM employee INNER JOIN company ON employee.cid = company.cid WHERE employee.email = '$email' AND employee.pass = '$password' AND company.name = '$company'";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        header('location: login.php');
        exit();
    }

    if (sqlsrv_has_rows($result) > 0) {
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
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
            header('location: login.php');
            exit();
        }
    } else {
        header('location: login.php');
        exit();
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header('location: login.php');
    exit();
}
?>
