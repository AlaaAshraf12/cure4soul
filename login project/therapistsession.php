<?php
include('connection.php');
include('logform.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['name'])) {
    header('location: logintherapist.php');
    exit();
}

$therapistEmail = $_SESSION['name'];

// Retrieve therapist's ID based on email
$therapistQuery = "SELECT tid FROM therapist WHERE email = '$therapistEmail'";
$therapistResult = mysqli_query($conn, $therapistQuery);

if (!$therapistResult || mysqli_num_rows($therapistResult) == 0) {
    echo "Error: Therapist not found.";
    exit();
}

$therapistRow = mysqli_fetch_assoc($therapistResult);
$therapistId = $therapistRow['tid'];

// Retrieve booked sessions with pending attendstatus for the therapist
$sessionQuery = "SELECT sid, dayy, Time1 
                FROM sessions 
                WHERE tid = '$therapistId' AND status = 'booked' AND attendstatus = 'pending'";
$sessionResult = mysqli_query($conn, $sessionQuery);

if (!$sessionResult) {
    echo "Error: Failed to fetch booked sessions.";
    exit();
}

// Handle the attendstatus update when the button is clicked
if (isset($_POST['sid'])) {
    $sid = $_POST['sid'];

    // Update the attendstatus column in the sessions table
    $updateQuery = "UPDATE sessions SET attendstatus = 'attended' WHERE sid = '$sid' AND attendstatus = 'pending'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Attendstatus updated successfully
        echo "Success";
        exit();
    }
    // } else {
    //     // Failed to update attendstatus
    //     echo "Error updating attendstatus.";
    //     exit();
    // }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booked Sessions</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        .button:disabled {
            background-color: gray;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h2>Booked Sessions</h2>
    <table>
        <tr>
            <th>Day</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        <?php
        while ($sessionRow = mysqli_fetch_assoc($sessionResult)) {
            $sid = $sessionRow['sid'];
            $day = $sessionRow['dayy'];
            $time = $sessionRow['Time1'];

            echo "<tr>";
            echo "<td>$day</td>";
            echo "<td>$sid</td>";
            echo "<td>$time</td>";
            echo "<td><button id='go' class='button' onclick='updateAttendStatus($sid, this)'>Go Live</button></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        function updateAttendStatus(sid, button) {
            debugger;
           var button= document.getElementById('go');
            // Make an AJAX request to update the attendstatus in the sessions table
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log(xhr.status);
                if (xhr.status === 200) {
                    
                    // Update the button text and disable the button
                    button.textContent = 'Attended';
                    button.disabled = true;
                
                } else {
                    alert('Request failed. Status: ' + xhr.status);
                }
            };
            xhr.send('sid=' + sid);
        }
    </script>
</body>
</html>

