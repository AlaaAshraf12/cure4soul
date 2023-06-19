<?php
require_once "connection.php";
require_once "logformemp.php";
$conn = OpenConnection();
?>

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
        <style>  /*navbar*/
  .nav-buttons{margin-right: 40px; padding-bottom: 10px;margin-top:15px}
.btn1 button {
    background-color: orange;
    width: 150px;
    height: 40px;
    border-radius: 8px;
    border-style: none;
    margin-left: 10px;


}

.btn1 button:hover{background-color: #fad263;}
.btn1 button a{text-decoration: none;
color: white;}
.navbar{padding:10px}
.navbar-nav{margin-left: 70px;}
.nav-link{color:white;font-size:18px;margin-left: 20px;margin-top:15px}
 .nav-item .nav-link{color:white;}
 .nav-item .nav-link:hover{color:rgb(185, 185, 185)}


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

         <nav class="navbar navbar-expand-lg navbar-dark
"style="background-color:#1e6091;">
    <div class="container-fluid">
      <h2><a href="" class="logo" style="color: white; font-weight:
bold; padding-left: 40px;text-decoration: none;">cure4soul<span
class="dot" style="color: #00c3da;">.</span></a></h2>
      <button class="navbar-toggler" type="button"
data-bs-toggle="collapse" data-bs-target="#navbarText"
aria-controls="navbarText" aria-expanded="false" aria-label="Toggle
navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page"
href="#">How We Work</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Wellness</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Resources</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Who Are We</a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" href="employeesessions.php">My sessions</a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" href="complaine.php">Add Complain</a>
          </li>
        
        <div class="nav-buttons" style="display: flex;
justify-content: flex-end;">
          <div class="btn1" style="padding-right: 10px;"><button><a
href="#login.php">Member Login</a></button></div>
          <div class="btn1"><button><a href="seminar.php">Request a
Demo</a></button></div>
          <div class="btn1"><button style="width:75px;height:40px;background-color:#dddd"> <a href="seminar.php"> <a href="home.html">Log Out </a></button></div>
      <div>
      </div>
    </div>
  </nav>

	
<section class="test" style="margin-top: 10px;">
    <div class="container">
        <div class="test-details" style="display: flex;justify-content:center;">
            <div class="test-left" style="background-color:#f8f6f4">
                <img src="docc.jpg">
            </div>
            <div class="test-right" style="background-color:#f8f6f4">
            <?php
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in therapist's email from the session

$email = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the employee's ID based on their email
$query = "SELECT eid, tid FROM employee WHERE email = '$email'";
$result = sqlsrv_query($conn, $query);
$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
$emid = $row['eid'];
$thid = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$quer = "SELECT name, email, qualif FROM therapist WHERE tid = '$thid'";
$resul = sqlsrv_query($conn, $quer);

// Display the schedule in a table format
if (sqlsrv_has_rows($resul)) {
    while ($row = sqlsrv_fetch_array($resul, SQLSRV_FETCH_ASSOC)) {
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
    
		
<?php
$conn = OpenConnection();
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in employee's email from the session

$email = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the employee's ID based on their email
$query = "SELECT eid, tid FROM employee WHERE email = '$email'";
$result = sqlsrv_query($conn, $query);
$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
$eid = $row['eid'];
$tid = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$query = "SELECT sid, dayy, Time1, status FROM sessions WHERE tid = '$tid' AND status='unbooked'";
$result = sqlsrv_query($conn, $query);

// Display the schedule in a table format
if (sqlsrv_has_rows($result)) {
    echo '<form method="POST" action="">';
    echo '<table>';
    echo '<tr><th>Day</th><th>Time 1</th><th></th></tr>';

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
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
    $checkQuery = "SELECT status FROM sessions WHERE sid = ? AND status = 'unbooked'";
    $params = array($selectedSid);
    $checkResult = sqlsrv_query($conn, $checkQuery, $params);

    if (sqlsrv_has_rows($checkResult)) {
        // Update the sessions table to mark the selected session as booked
        $updateQuery = "UPDATE sessions SET status = 'booked' WHERE sid = ?";
        $params = array($selectedSid);
        $query=sqlsrv_query($conn, $updateQuery, $params);

        // Insert the booking into the booking table
        $insertQuery = "INSERT INTO booking (eid, sid, attendancestatus) VALUES (?, ?, 'pending')";
        $params = array($eid, $selectedSid);
        $queryResult =sqlsrv_query($conn, $insertQuery, $params);
           if ($queryResult === false) {
                  die(print_r(sqlsrv_errors(), true));

        echo 'Session booked successfully!';
    } else {
        echo 'Session already booked or unavailable.';
    }
}
}
?>



<!--footer-->
<section class="footer" style="width:100% ;padding-top:
70px;background-color:#fda95f;margin-top:50px">
  <div class="container-fluid" style="background-color: #fda95f;">
    <div class="row g-0" style="width:100%;margin-left: 40px;">
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="footer-2">
          <h3 style=" color:rgb(37, 37, 37);font-size: 28px;">CURE4SOUL</h3>
              <h5>253 Degla Maadi, Egypt</h5>
              <h5>Phone: +1 5589 55488 55
              </h5>
              <h5>Email: cure4soul@gmail.com</h5>


        </div>
      </div>

      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="footer-2">

           <h3>Company</h3>
            <h5><a href="">Home</a></h5>
            <h5><a href="">About us</a></h5>
            <h5><a href="">Services</a></h5>
            <h5><a href="">Terms & policices</a></h5>
            <h5><a href="">Privacy policy</a></h5>

        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="footer-2">

           <h3>Partners</h3>
           <h5><a href="">Employers/Corporate</a></h5>
           <h5><a href="">Health Plans</a></h5>
           <h5><a href="">Doctors/Providers</a></h5>
           <h5><a href="">Therapists</a></h5>


        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="footer-2">
          <h3>Want to join as a Doctor?</h3>
          
          <button class="btn-footer">Sign Up</button>


        </div>
      </div>
    </div>
  </div>
  <div class="row">

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
      <div class="footer-1" style="margin: 10px;">
        <div class="line" style="background-color:gainsboro; width:80%;height:1px;margin:auto;"></div>
  <div class="copyright" style="text-align: center;">
      © Copyright Cure4soul. All Rights Reserved<br>
      Designed by <span style="color:#1e6091">Cure4soul Team</span>
  </div>
      </div>
    </div>
  </div>

  </section>

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
/*footer*/
.footer{width:100%}
.footer-text{padding-right: 5px;}
.footer-text h3{
    font-size:28px;

}

.footer-2 h3{font-size: 24px;
    color:rgb(37, 37, 37)

}
.footer-2{color:rgb(37, 37, 37);
    text-decoration: none;
    font-size: 16px;}
.footer-2 h5 a{color:rgb(37, 37, 37);
    text-decoration: none;
    font-size: 16px;

}
.btn-footer{width:100px;height:40px;
border-radius: 6px;
border-style: none;
background-color: #1e6091;
color:white}
.btn-footer:hover{background-color: #337ab1;}
</style>
