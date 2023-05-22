<?php include('connection.php');?>
<?php include('logformemp.php');?>
<?php

// Assuming you have already included the necessary files (connection.php and logformemp.php)

// Assuming you have already established a database connection

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the selected problems from the form
    if (isset($_POST['problems']) && is_array($_POST['problems'])) {
        $selectedProblems = $_POST['problems'];
        
        // Retrieve the employee's ID based on their email
        $email = $_SESSION['name']; // Modify this according to your authentication system
        $quer = "SELECT eid, tid FROM employee WHERE email = '$email'";
        $result = mysqli_query($conn, $quer);
        $row = mysqli_fetch_assoc($result);
        $emid = $row['eid'];
        $thid = $row['tid'];

        // Insert the selected problems into the complain table
        foreach ($selectedProblems as $problem) {
            if ($problem == "Therapist") {
                // Save $tid in the tid column in the complain table
                $que = "INSERT INTO complain (problem, eid, tid) VALUES ('$problem', '$emid', '$thid')";
                $q = mysqli_query($conn, $que);
            } else {
                // Save other problems in the problem column in the complain table
                $query = "INSERT INTO complain (problem, eid) VALUES ('$problem', '$emid')";
                $q2 = mysqli_query($conn, $query);
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
    <form method="POST">
        <h2>Complain Form</h2>
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
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
<?php
  echo '<p>Complaint submitted successfully!</p>';
} else {
    echo '<p>Error: No problems selected.</p>';
}
}
?>
