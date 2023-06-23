<?php
require_once "connection.php";
$conn = OpenConnection();

session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $company = $_POST['company'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT employee.eid, employee.numofsessions, company.name 
              FROM employee 
              INNER JOIN company ON employee.cid = company.cid 
              WHERE employee.email = ? AND employee.pass = ? AND company.name = ?";

    $params = array($email, $password, $company);
    $result = sqlsrv_query($conn, $query, $params);

    if ($result === false) {
        echo "Query Error: " . print_r(sqlsrv_errors(), true);
        exit();
    }

    if (sqlsrv_has_rows($result)) {
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        $employeeID = $row['eid'];
        $availableSessions = $row['numofsessions'];

        // Check if the employee's account should be marked as inactive
        $sessionQuery = "SELECT COUNT(*) AS numSessions 
                         FROM booking 
                         WHERE eid = ? AND attendancestatus = 'attended'";

        $sessionResult = sqlsrv_query($conn, $sessionQuery, array($employeeID));

        if ($sessionResult !== false) {
            $sessionRow = sqlsrv_fetch_array($sessionResult, SQLSRV_FETCH_ASSOC);
            $numSessions = $sessionRow['numSessions'];

            if ($numSessions >= $availableSessions) {
                // Mark the account as inactive
                $updateQuery = "UPDATE employee SET accountstatus = 'inactive' WHERE eid = ?";
                sqlsrv_query($conn, $updateQuery, array($employeeID));

                
                exit();
            }

            $_SESSION['name'] = $email;
            $_SESSION['success'] = "Welcome dear";
<<<<<<< HEAD
            header('Location: employeeprofile.php');
=======
            header('location:employeeprofile.php');
>>>>>>> 451065e7e8c836089ac03112c049b3524426978e
            exit();
        } else {
            echo "Error: " . print_r(sqlsrv_errors(), true);
        }
    } else {
        echo "Wrong data!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header('Location: login.php');
    exit();
}
?>
