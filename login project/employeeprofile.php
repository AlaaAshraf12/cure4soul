<?php include('connection.php');?>
<?php include('logformemp.php');?>

<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/employeeprofile.css">
        <link rel="styleshteet" href="css/all.min.css">
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/popper.min.js"></script>
        <title>Employee Schedule</title>
        <style>  .navbar{
            display: flex;
            justify-content: space-between;

            align-items: center;
            position: fixed;
            left:0px;
            right: 0px;
            }
        .navbar ul{display: flex;
            list-style: none;
        justify-content: flex-end;
        }
        .navbar ul li{padding: 20px;
        }
        .navbar ul li a{text-decoration:none;
        font-weight: 600;
        margin:5px;
        color: white;

    }
    .navbar ul li a:hover{color: gray;}
    .nav-buttons{margin-right: 40px; padding-bottom: 10px;}
    .btn1 button {
        background-color: orange;
        width: 150px;
        height: 40px;
        border-radius: 8px;
        border-style: none;


    }
    .btn1 button:hover{background-color: #fad263;}
    .btn1 button a{text-decoration: none;
    color: white;}

    /*testimonial*/

.test-left{background-color:  rgb(226, 225, 225);
    width:15%;

  }
    .test-left img{width:80%;
    margin-top:30px ; border-radius: 5%;margin-bottom: 20px;margin-left: 20px;}
    .test-right{width:70%;background-color:  rgb(226, 225, 225);

    }
    .test-right h3{margin:50px 0px 10px 20px;
        color:darkgoldenrod;
    }
    .test-right p{margin:0px 0px 10px 20px;
    }
    </style>
	<title>Doctor Schedule</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Custom CSS -->
	<style type="text/css">
		.schedule-table {
			margin-top: 30px;
			margin-bottom: 30px;
		}
		.schedule-table th {
			text-align: center;
			background-color: #f5f5f5;
			border: 1px solid #ddd;
			padding: 10px;
		}
		.schedule-table td {
			text-align: center;
			border: 1px solid #ddd;
			padding: 10px;
		}
		.book-btn {
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<!--navbar--> 
    <section class="nav" >
        <div class="navbar"style="background-color:#1e6091;">
            <h2 style="color: white; font-weight: bold; padding-left: 40px;">cure4soul<span class="dot" style="color: #00c3da;">.</span></h2>
    
            <ul>
                <li><a href="#home" style="color:white ">HOME</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#client">Works</a></li>
                <li><a href="complaine.php">Add Complain</a></li>
                <li><a href="#contact">Contact</a></li>
                
            </ul>
            <div>
             <a href="login.php? logout='1'">log out </a>
             </div>
            <div class="nav-buttons" style="display: flex; justify-content: flex-end;">
                <div class="btn1" style="padding-right: 10px;"><button><a href="">Member Login</a></button></div>
                <div class="btn1"><button><a href="">Request a Seminar</a></button></div>
            <div>
    
              
    
            
        </div>
    </section>
	<!--testimonial-->
<section class="test" style="margin-top: 10px;">
    <div class="container">
        <div class="test-details" style="display: flex;justify-content:center;">
            <div class="test-left">
                <img src="docc.jpg">
            </div>
            <div class="test-right">
            <?php
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in therapist's email from the session

$email = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the employee's ID based on their email
$query = "SELECT eid, tid FROM employee WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$emid = $row['eid'];
$thid = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$quer = "SELECT name,email,qualif FROM therapist WHERE tid = '$thid'";
$resul = mysqli_query($conn, $quer);

// Display the schedule in a table format
if (mysqli_num_rows($resul) > 0) {
   
    while ($row = mysqli_fetch_assoc($resul)) {
        echo "<h3>" . $row['name'] . "</h3><br>";
        echo "<p>" . $row['email'] . "</p><br>"; 
        echo "<p>" . $row['qualif'] . "</p><br>";
    }
} else {
    echo "No schedule found.";
}

?>
            </div>

        </div>
    </div>
</section>
	
    
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
            </body>
			</html>
		
<?php
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in employee's email from the session

$email = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the employee's ID based on their email
$query = "SELECT eid, tid FROM employee WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$eid = $row['eid'];
$tid = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$query = "SELECT sid, dayy, Time1 , status FROM sessions WHERE tid = '$tid'";
$result = mysqli_query($conn, $query);

// Display the schedule in a table format
if (mysqli_num_rows($result) > 0) {
    echo '<form method="POST" action="">';
    echo '<table>';
    echo '<tr><th>Day</th><th>Time 1</th><th></th></tr>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['dayy'] . '</td>';
        echo '<td>' . $row['Time1'] . '</td>';
        if ($row['status'] == 'booked') {
            echo '<td>Booked</td>';
        } else {
            echo '<td><button type="submit" name="book" value="' . $row['sid'] . '">Book Session</button></td>';
        }
        echo '</tr>';
    }
    
    echo '</table>';
    echo '</form>';
} else {
    echo 'No schedule found.';
}

// Handle the form submission when booking a session
if (isset($_POST['book'])) {
    $selectedSid = $_POST['book'];
    
    // Check if the selected session is available (not already booked)
    $checkQuery = "SELECT status FROM sessions WHERE sid = '$selectedSid' AND status = 'unbooked'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        // Update the sessions table to mark the selected session as booked
        $updateQuery = "UPDATE sessions SET status = 'booked' WHERE sid = '$selectedSid'";
        mysqli_query($conn, $updateQuery);
        
        // Insert the booking into the booking table
        $insertQuery = "INSERT INTO booking (eid, sid) VALUES ('$eid', '$selectedSid')";
        mysqli_query($conn, $insertQuery);
        
        echo 'Session booked successfully!';
    } else {
        echo 'Session already booked or unavailable.';
    }
}
?>

<style>
  *{margin:0;
  padding:0;}
.data-one{background-color:#8fb8ca;
  color:white;
  
}
table{width:70%;
  background-color:white;
  margin:auto;
  margin-top:20px
  
  
}
table, th, td {
  border: 1px solid #8fb8ca;
  
}
td{text-align:center;
  color: rgba(0,0,0,.54);
}

tr:nth-child(even) {background-color:#edf2fb}
tr{text-align:center;
font-size:18px;
}
tr:hover {background-color:#ffe6cc}
th{background-color:#8fb8ca;
  height:40px;
color:white;
text-align:center}
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

button{background:orange;
border:none;
border-radius:5px;
margin:5px;
height:40px;
width:150px;
color:white}
/* Add more CSS styles as needed */
</style>
