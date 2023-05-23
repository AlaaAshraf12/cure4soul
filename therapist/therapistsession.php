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
        include('connection.php');
        include('logform.php');

        // Check if the therapist is logged in
        if (isset($_SESSION['name'])) {
            $therapistEmail = $_SESSION['name'];

            // Retrieve the therapist's ID based on their email
            $therapistQuery = "SELECT tid FROM therapist WHERE email = '$therapistEmail'";
            $therapistResult = mysqli_query($conn, $therapistQuery);
            $therapistRow = mysqli_fetch_assoc($therapistResult);
            $tid = $therapistRow['tid'];

            // Retrieve the booked sessions with pending attendstatus for the therapist
            $sessionQuery = "SELECT sid, dayy, Time1 FROM sessions WHERE tid = '$tid' AND status = 'booked' AND attendstatus = 'pending'";
            $sessionResult = mysqli_query($conn, $sessionQuery);

            while ($sessionRow = mysqli_fetch_assoc($sessionResult)) {
                $sid = $sessionRow['sid'];
                $day = $sessionRow['dayy'];
                $time = $sessionRow['Time1'];

                echo "<tr>";
                echo "<td>$day</td>";
                echo "<td>$sid</td>";
                echo "<td>$time</td>";
                echo "<td><button class='button' onclick='updateAttendStatus($sid, this)'>Go Live</button></td>";
                echo "</tr>";
            }
        }

        // Update attendstatus when Go Live button is clicked
        if (isset($_POST['sid'])) {
            $sid = $_POST['sid'];

            // Update the attendstatus column in the sessions table
            $updateQuery = "UPDATE sessions SET attendstatus = 'attended' WHERE sid = '$sid'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                echo "success";
            } else {
                echo "error";
            }

            exit; // Stop further execution of the script
        }
        ?>
    </table>

    <script>
        function updateAttendStatus(sid, button) {
            // Make an AJAX request to update the attendstatus in the sessions table
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status == 200) {
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
