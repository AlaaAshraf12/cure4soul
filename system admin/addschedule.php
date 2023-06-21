<?php require_once "connection.php"; 
$conn = OpenConnection();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Weekly Schedule</title>
  <style>
    /* Add some basic styling */
    body {
      font-family: Arial, sans-serif;
    }
    form {
      width: 300px;
      margin: 0 auto;
    }
    label {
      display: block;
      margin-top: 10px;
    }
    select, input[type="time"] {
      width: 100%;
      padding: 5px;
      margin-top: 5px;
    }
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
  </style>
</head>


<body style="background-color: #f0f7f8;">
  <h2 style="text-align:center;color:#164277">Add Weekly Schedule</h2>
  <form method="POST" style="border-style:solid; width:500px; height:500px;border-color:gray">
    <label for="therapist">Therapist:</label>
    <select name="therapist" id="therapist">
      <?php
      // Retrieve therapist options from the database
      $sql = "SELECT tid, name FROM therapist";
      $result = sqlsrv_query($conn, $sql);

      while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        echo '<option value="' . $row["tid"] . '"> ' . $row["name"] . '</option>';
      }
      ?>
    </select>
    <label for="day">Day:</label>
    <select name="day" id="day">
      <option value="Sunday">Sunday</option>
      <option value="Monday">Monday</option>
      <option value="Tuesday">Tuesday</option>
      <option value="Wednesday">Wednesday</option>
      <option value="Thursday">Thursday</option>
      <option value="Friday">Friday</option>
      <option value="Saturday">Saturday</option>
    </select>
    <label for="time">Time:</label>
    <input type="time" name="time" id="time">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>
    <input type="submit" name='Submit' value="Save">
  </form>
</body>
</html>

<?php
// Handle form submission
if (isset($_POST['Submit'])) {
  $therapistId = $_POST["therapist"];
  $day = $_POST["day"];
  $time = $_POST["time"];
  $date = $_POST["date"];
  $status = "unbooked";
  $attendStatus = "pending";

  // Insert the schedule into the sessions table
  $sql = "INSERT INTO sessions (dayy, date, Time1, status, attendstatus, tid) 
          VALUES (?, ?, ?, ?, ?, ?)";

  $params = array($day, $date, $time, $status, $attendStatus, $therapistId);
  $stmt = sqlsrv_query($conn, $sql, $params);

  if ($stmt === false) {
    echo "Error: " . sqlsrv_errors()[0]['message'];
  } else {
    echo "Schedule added successfully.";
  }
}
?>