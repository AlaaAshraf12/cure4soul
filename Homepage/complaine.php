<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connection.php";
require_once "logformemp.php";

$conn = OpenConnection();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the selected problems from the form
    if (isset($_POST['problems']) && is_array($_POST['problems'])) {
        $selectedProblems = $_POST['problems'];
        
        // Retrieve the employee's ID based on their email
        $email = $_SESSION['name']; // Modify this according to your authentication system
        $query = "SELECT eid FROM employee WHERE email = '$email'";
        $result = sqlsrv_query($conn, $query);
        
        if ($result && sqlsrv_has_rows($result) > 0) {
            $row = sqlsrv_fetch_array($result);
            $emid = $row['eid'];
           
            // Retrieve the details from the form
            $b = $_POST['details'];
            
            // Convert the array of selected problems into a string
            $problemsString = implode(", ", $selectedProblems);

            // Insert the selected problems into the complain table
            $co = "INSERT INTO complain (problem, details, eid) VALUES ('$problemsString', '$b', '$emid')";
            $result1 = sqlsrv_query($conn, $co);
            
            if ($result1 !== false) {
                echo '<p>Complaint submitted successfully!</p>';
            } else {
                echo '<p>Error executing query: ' . sqlsrv_errors()[0]['message'] . '</p>';
            }
        } else {
            echo '<p>Error: Employee ID not found.</p>';
        }
    } else {
        echo '<p>Error: No problems selected.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complain Form</title>
    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form method="POST" >    
        <h2 style="color:red">Complain Form</h2>
        <label>
            <input type="checkbox" name="problems[]" value="Therapist">
            Therapist
        </label>
        <label>
            <input type="checkbox" name="problems[]" value="Web application">
            Web application
        </label>
        <label>
            <input type="checkbox" name="problems[]" value="Session Duration">
            Session Duration
        </label>
        <label>
            <textarea name="details"></textarea>
            Details
        </label>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
