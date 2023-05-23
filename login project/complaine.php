<?php
include('connection.php');
include('logformemp.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the selected problems from the form
    if (isset($_POST['problems']) && is_array($_POST['problems'])) {
        $selectedProblems = $_POST['problems'];

        // Retrieve the employee's ID based on their email
        $email = $_SESSION['name']; // Modify this according to your authentication system
        $query = "SELECT eid, tid FROM employee WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $emid = $row['eid'];
            $thid = $row['tid'];

            // Retrieve the details from the form
            $b = mysqli_real_escape_string($conn, $_POST['details']);

            // Insert the selected problems into the complain table
            foreach ($selectedProblems as $problem) {
                if ($problem == "Therapist") {
                    // Retrieve the therapist ID from the therapist table
                    $query = "SELECT tid FROM therapist WHERE eid = '$emid'";
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $therapistRow = mysqli_fetch_assoc($result);
                        $thid = $therapistRow['tid'];
                    } else {
                        echo '<p>Error: Therapist ID not found.</p>';
                        continue; // Skip this iteration and move to the next problem
                    }
                }

                $co = "INSERT INTO complain (problem, details, eid, tid) VALUES ('$problem', '$b', '$emid', '$thid')";
                $result1 = mysqli_query($conn, $co);
                if (!$result1) {
                    echo mysqli_error($conn);
                }
            }

            echo '<p>Complaint submitted successfully!</p>';
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
            Details
        </label>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

