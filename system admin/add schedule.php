<?php include('connection.php');?>
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
<body>
  <h2>Add Weekly Schedule</h2>
  <form method="POST" action="add schedule.php">
  <label for="therapist">Therapist:</label>
  <select name="therapist" id="therapist">
  <?php
  // Retrieve therapist options from the database
$sql = "SELECT tid, name FROM therapist";
$result =mysqli_query($conn,$sql);
  while ($row = $result->fetch_assoc()) {
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
if(isset($_POST['Submit'])) {
    $therapistId = $_POST["therapist"];
    $day = $_POST["day"];
    $time = $_POST["time"];
    $date = $_POST["date"];
    $status = "unbooked";
    $attendStatus = "pending";

    // Insert the schedule into the sessions table
    $sql = "INSERT INTO sessions (dayy, date, Time1, status, attendstatus, tid) 
            VALUES ('$day','$date', '$time', '$status', '$attendStatus', '$therapistId')";

    if ( mysqli_query($conn,$sql) === TRUE) {
        echo "Schedule added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
