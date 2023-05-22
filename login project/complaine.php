<?php
include('connection.php');
include ('logformemp.php');// Assuming you have already established a database connection

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the selected problems from the form
    if (isset($_POST['problems']) && is_array($_POST['problems'])) {
        $selectedProblems = $_POST['problems'];
        
        // Retrieve the employee's ID based on their email
        $email = $_SESSION['name']; // Modify this according to your authentication system
        $query = "SELECT eid, tid FROM employee WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $emid = $row['eid'];
        $thid = $row['tid'];
        $d = "SELECT details FROM complain";
        $r= mysqli_query($conn, $query);
        $b=$row['details'];
        
        // Insert the selected problems into the complain table
        foreach ($selectedProblems as $problem) {
            if ($problem == "Therapist") {
                // Save $tid in the tid column in the complain table
                $query = "INSERT INTO complain (problem,details, eid, tid) VALUES ('$problem','$b', '$emid', '$thid')";
            } else {
                // Save other problems in the problem column in the complain table
                $query = "INSERT INTO complain (problem,details, eid) VALUES ('$problem','$b', '$emid')";
            }
            
            $result = mysqli_query($conn, $query);
            if (!$result) {
                echo mysqli_error($conn);
            }
        }
        
        // Redirect to a success page or perform any other desired action
        header("location: success.php");
        
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
        <label>
            <textarea name="details"></textarea>
            details
        </label>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
