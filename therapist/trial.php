<?php
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in therapist's email from the session

$therapistEmail = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the therapist's ID based on their email
$query = "SELECT tid FROM therapist WHERE email = '$therapistEmail'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$therapistId = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$query = "SELECT dayy, time , status FROM sessions WHERE tid = $therapistId";
$result = mysqli_query($conn, $query);

// Display the schedule in a table format
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Day</th><th>Time</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<td>" . $row['dayy'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td><span class='session-status " . ($row['status'] == 'booked' ? 'booked' : 'unbooked') . "'></span></td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No schedule found.";
}

?>
<style>
.session-status {
    display: inline-block;
    width: 16px;
    height: 16px;
    border-radius: 50%;
}

.booked {
    background-color: green;
}

.unbooked {
    background-color: red;
}

/* Add more CSS styles as needed */
</style>
$b="SELECT details from complain";
        $b2=mysqli_query($conn,$b);
        $d=$row['details'];