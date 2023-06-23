<?php include('connection.php');?>
<?php include('logform.php');?>



<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="styleshteet" href="css/all.min.css">
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/popper.min.js"></script>
        <title>cure4soul</title>

    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark
"style="background-color:#1e6091;">
    <div class="container-fluid">
      <h2 style="font-size:30px;"><a href="" class="logo"
style="color: white; font-weight: bold; padding-left:
40px;text-decoration: none;">cure4soul<span class="dot" style="color:
#00c3da;">.</span></a></h2>
      <button class="navbar-toggler" type="button"
data-bs-toggle="collapse" data-bs-target="#navbarText"
aria-controls="navbarText" aria-expanded="false" aria-label="Toggle
navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">My
Sessions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Wellness</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Support</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Resources</a>
          </li>
          <div class="btn1"
style="padding-left:10px;padding-top:20px"><button><a
href="logintherapist.php? logout='1'">Log Out </a></button></div>

        </ul>

      </div>
    </div>
  </nav>

      <!-- <section class="nav" >
        <div class="navbar"style="background-color:green;">
            <h2 style="color: white; font-weight: bold; padding-left:
40px;">cure4soul<span class="dot" style="color:
#00c3da;">.</span></h2>

            <ul>
                <li><a href="#home" style="color:white ">HOME</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#client">Works</a></li>
                <li><a href="#prices">Pricing</a></li>
                <li><a href="#contact">Contact</a></li>

            </ul>
            <div>
<a href="logintherapist.php? logout='1'">log out </a>
</div>

            <div class="nav-buttons" style="display: flex;
justify-content: flex-end;">
                <div class="btn1" style="padding-right:
10px;"><button><a href="">Member Login</a></button></div>
                <div class="btn1"><button><a href="">Request a
Seminar</a></button></div>
            <div>




        </div>
    </section>  -->
    <div class="doc">
    <div class="container-fuild">
        <div class="row g-0" >
            <div class="col-xl-6 col-lg-6 col-sm-12">
            <div class="profile-left"
style="background-color:#F0EEED;width:65%;height:90%;margin-top:100px">
                <div class="section-img">
                    <img src="doccc.jpg" style="border-radius: 50%;
width: 40%;margin-left: 60px;margin-top: 20px;">
                     <?php
                    $conn = OpenConnection();
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in therapist's email from the session

$therapistEmail = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the therapist's ID based on their email
$query = "SELECT tid FROM therapist WHERE email = '$therapistEmail'";
$result = sqlsrv_query($conn, $query);
$row =sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
$therapistId = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$query = "SELECT name,email,phone,qualif FROM therapist WHERE tid = $therapistId";
$result = sqlsrv_query($conn, $query);

// Display the schedule in a table format
if (sqlsrv_has_rows($result) > 0) {
   
    while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
        echo "<h2>" . $row['name'] . "</h2>";
        echo "<h2>" . $row['email'] . "</h2>";
        echo "<h2>" . $row['phone'] . "</h2>"; 
        echo "<h2>" . $row['qualif'] . "</h2>";
    }
} else {
    echo "No schedule found.";
}

?>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-sm-12">

            <div class="profile-right" style="width: 80%;height:720px;padding-top: 80px;padding-left:140px;background-color:#f4faff">

                   
<?php
$conn = OpenConnection();
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in therapist's email from the session

$therapistEmail = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the therapist's ID based on their email
$query = "SELECT tid FROM therapist WHERE email = '$therapistEmail'";
$result = sqlsrv_query($conn, $query);
$row =sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
$therapistId = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$query = "SELECT dayy, Time1, status FROM sessions WHERE tid = $therapistId AND status != 'booked' AND attendstatus != 'attended'";
$result = sqlsrv_query($conn, $query);

// Display the schedule in a table format
if (sqlsrv_has_rows($result) > 0) {
 echo "<table>";
 echo "<tr><th>Day</th><th>session 1</th><th>status</th></tr>";
 while ($row =sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
     echo "<td class='data-one'>" . $row['dayy'] . "</td>";
     echo "<td>" . $row['Time1'] . "</td>";

     echo "<td><span class='session-status " . ($row['status'] == 'booked' ? 'booked' : 'unbooked') . "'></span></td>";
     
     echo "</tr>";
 }
 echo "</table>";
} else {
 echo "No schedule found.";
}

?>
         </div>
         </div>
     </div>
 </section>

     <style>
  *{margin:0;
  padding:0;}
  /*navbar*/

.btn1 button {
    background-color: orange;
    width: 130px;
    height: 40px;
    border-radius: 8px;
    border-style: none;
    margin-left: 12px;


}

.btn1 button:hover{background-color: #fad263;}
.btn1 button a{text-decoration: none;
color: white;}
.navbar{height:100px}
.navbar-nav{margin-left: 70px;}
.nav-item{;margin:-2px;width:180px}
.nav-link{color:white;font-size:18px;;}
 .nav-item .nav-link{color:white}
 .nav-item .nav-link:hover{color:rgb(185, 185, 185)}

.data-one{background-color:#8fb8ca;
  color:white;

}
table{width:80%;
  background-color:white;
  margin-top:100px


}
table, th, td {

  border: 1px  #8fb8ca;


}
td{text-align:center;
  color: rgba(0,0,0,.54);
  padding:4px;

}

tr:nth-child(even) {background-color:#edf2fb}
tr{text-align:center;
font-size:18px;

}
tr:hover {background-color:#ffe6cc}
th{background-color:#8fb8ca;
  height:40px;
color:white}
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

h2{
    padding:10px;font-size:20px;margin-left:20px;
}
/* Add more CSS styles as needed */


</style>


 </body>
