<?php
require_once "connection.php";
require_once "logformemp.php";
$conn = OpenConnection();
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['name'])) {
    header('location: login.php');
    exit();
}

$employeeEmail = $_SESSION['name'];
// Retrieve employee's ID based on email
$employeeQuery = "SELECT eid FROM employee WHERE email = '$employeeEmail'";
$employeeResult = sqlsrv_query($conn, $employeeQuery);


$employeeRow = sqlsrv_fetch_array($employeeResult, SQLSRV_FETCH_ASSOC);
$employeeId = $employeeRow['eid'];

// Retrieve booked sessions for the employee
$bookingQuery = "SELECT booking.bid, sessions.dayy, sessions.date, sessions.Time1, booking.attendancestatus 
                FROM booking 
                INNER JOIN sessions ON booking.sid = sessions.sid 
                WHERE booking.eid = '$employeeId'";
$bookingResult = sqlsrv_query($conn, $bookingQuery);

if (!$bookingResult) {
    echo "Error: Failed to fetch booked sessions.";
    exit();
}

// Handle the attendance update or cancellation when the button is clicked
if (isset($_POST['bookingId']) && isset($_POST['action'])) {
    $bookingId = $_POST['bookingId'];
    $action = $_POST['action'];

    if ($action === 'markAttendance') {
        // Update the attendance status to "attended" in the booking table
        $updateQuery = "UPDATE booking SET attendancestatus = 'attended' WHERE bid = '$bookingId' AND attendancestatus = 'pending'";
    } elseif ($action === 'cancelBooking') {
        // Update the attendance status to "cancelled" in the booking table
        $updateQuery = "UPDATE booking SET attendancestatus = 'cancelled' WHERE bid = '$bookingId' AND attendancestatus = 'pending'";
        $updatesessiontable = "UPDATE sessions SET status='unbooked' WHERE bid = '$bookingId' AND attendancestatus = 'pending'";
        $updateResult = sqlsrv_query($conn, $updatesessiontable);
    } else {
        echo "Error: Invalid action.";
        exit();
    }

    $updateResult = sqlsrv_query($conn, $updateQuery);

    if ($updateResult) {
        // Attendance status updated successfully
        if ($action === 'markAttendance') {
            echo "Attendance marked as attended.";
        } elseif ($action === 'cancelBooking') {
            echo "Booking cancelled.";
        }
        exit();
    } else {
        // Failed to update attendance status
        echo "Error: Failed to update attendance or cancel booking.";
        exit();
    }
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
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn[disabled] {
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
            <th>Attendance Status</th>
            <th>Action</th>
        </tr>
        <?php  while ($bookingRow = sqlsrv_fetch_array($bookingResult, SQLSRV_FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $bookingRow['dayy']; ?></td>
                <td><?php echo $bookingRow['date']; ?></td>
                <td><?php echo $bookingRow['Time1']; ?></td>
                <td><?php echo $bookingRow['attendancestatus']; ?></td>
                <td>
                    <?php if ($bookingRow['attendancestatus'] == 'pending') { ?>
                        <button class="btn" onclick="markAttendance(<?php echo $bookingRow['bid']; ?>)" id="btn-<?php echo $bookingRow['bid']; ?>">Go live</button>
                        <button class="btn" onclick="cancelBooking(<?php echo $bookingRow['bid']; ?>)">Cancel</button>
                    <?php } else { ?>
                        <button class="btn" disabled>Attended</button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <script>
        function markAttendance(bookingId) {
            var btn = document.getElementById('btn-' + bookingId);
            btn.disabled = true; // Disable the button to prevent multiple clicks

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Handle the response here if needed
                    console.log(xhr.responseText);
                    window.location.href = 'video.html'; 
                }
            };
            xhr.send('bookingId=' + bookingId + '&action=markAttendance');
        }

        function cancelBooking(bookingId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Handle the response here if needed
                    console.log(xhr.responseText);
                    // Reload the page to update the booking list
                    window.location.reload();
                }
            };
            xhr.send('bookingId=' + bookingId + '&action=cancelBooking');
        }
    </script>
     </body>
</html>
