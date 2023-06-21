<?php require_once "connection.php";?>
<?php require_once "logform.php"; ?>



<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="therapistprofile.css">
        <link rel="styleshteet" href="css/all.min.css">
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/popper.min.js"></script>
        <title>Therapist Profile</title>
        <style>
                /* navbar */
* {
    box-sizing: border-box;
  }
  
  body {
    margin: 0px;
    font-family: 'segoe ui';
  }
  
  .nav {
    height: 50px;
    width: 100%;
    background-color: #4d4d4d;
    position: relative;
  }
  
  .nav > .nav-header {
    display: inline;
  }
  
  .nav > .nav-header > .nav-title {
    display: inline-block;
    font-size: 22px;
    color: #fff;
    padding: 10px 10px 10px 10px;
  }
  
  .nav > .nav-btn {
    display: none;
    
  }
  
  .nav > .nav-links {
    display: inline;
    float: right;
    font-size: 18px;
    padding-right:70px
  }
  
  .nav > .nav-links > a {
    display: inline-block;
    padding: 13px 10px 13px 10px;
    text-decoration: none;
    color: #efefef;
  }
  
  .nav > .nav-links > a:hover {
    background-color: rgba(0, 0, 0, 0.3);
  }
  
  .nav > #nav-check {
    display: none;
  }
  
  @media (max-width:600px) {
    .nav > .nav-btn {
      display: inline-block;
      position: absolute;
      right: 0px;
      top: 0px;
    }
    

    .nav > .nav-btn > label {
      display: inline-block;
      width: 50px;
      height: 50px;
      padding: 13px;
    }
    .nav > .nav-btn > label:hover,.nav  #nav-check:checked ~ .nav-btn > label {
      background-color: rgba(0, 0, 0, 0.3);
    }
    .nav > .nav-btn > label > span {
      display: block;
      width: 25px;
      height: 10px;
      border-top: 2px solid #eee;
    }
    .nav > .nav-links {
      position: absolute;
      display: block;
      width: 100%;
      background-color:#164277;
      height: 0px;
      transition: all 0.3s ease-in;
      overflow-y: hidden;
      top: 50px;
      left: 0px;
      margin-left:-5px;
    }
    .nav > .nav-links > a {
      display: block;
      width: 100%;
    }
    .nav > #nav-check:not(:checked) ~ .nav-links {
      height: 0px;
    }
    .nav > #nav-check:checked ~ .nav-links {
      height: calc(100vh - 50px);
      overflow-y: auto;
    }
  }
  .nav-title{margin-left: 80px;}
  .btn{margin-left: 60px;}
  .nav-links{padding-left:20px;margin-left: 20px;}

        </style>
    </head>
    <body>
       <!--navbar--> 
       <div class="nav" style="height:60px;background-color:#164277">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
          <div class="nav-title">
          <a href="home.html" target="_blank" style="text-decoration:none;color:white;font-weight:bold">Cure4soul<span class="dot" style="color:
#00c3da;">.</a>
            
          </div>
        </div>
        <div class="nav-btn">
          <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
          </label>
        </div>
        
        <div class="nav-links">
          
          <a href="" target="_blank">How We Work</a>
          <a href="" target="_blank">Wellness</a>
          <a href="" target="_blank">Resources</a>
          <a href="" target="_blank">Who Are We</a>
          <a href="" target="_blank">Support</a>
          <a href="therapistsession.php">My Sessions</a>
          
          <button class="btn1" style="width:70px;height:40px;background-color:#dddd;border-color:#dddd;border-radius:8px;">
          <a style="text-decoration:none;color:white;" href="logintherapist.php? logout='1'">log out </a></button>
          
        </div>
        
      </div>
      <!-- <section class="nav" >
        <div class="navbar"style="background-color:#1e6091;">
            <h2 style="color: white; font-size:30px;font-weight: bold; padding-left: 40px;">cure4soul<span class="dot" style="color: #00c3da;">.</span></h2>
    
            <ul>
                <li><a href="#home" style="color:white ">How We Work</a></li>
                <li><a href="#about">Wellness</a></li>
                <li><a href="#team">Resources</a></li>
                <li><a href="#service">Who Are We</a></li>
                <li><a href="therapistsession.php">My Sessions</a></li>
                <li><a href="#contact">Contact</a></li>
                
            </ul>
            
    
            <div class="nav-buttons" style="display: flex; justify-content: flex-end;">
                <div class="btn1" style="padding-right: 10px;"><button><a href="">Member Login</a></button></div>
                <div class="btn1"><button><a href="logintherapist.php? logout='1'">log out </a></button></div>
            <div>
    
              
    
            
        </div>
    </section>  -->
     

    
    <section class="profile">
        <div class="container-fluid">
            <div class="Profile-content" style="display: flex;justify-content: center;">
               <div class="profile-left" style="width:40%;height:720px;background-color:#f8f6f4;padding-top: 100px;">
                <div class="section-img">
                   
                    <?php
                    $conn = OpenConnection();
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in therapist's email from the session

$therapistEmail = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the therapist's ID based on their email
$query = "SELECT tid , image FROM therapist WHERE email = '$therapistEmail'";
$result = sqlsrv_query($conn, $query);
$row =sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
$therapistId = $row['tid'];
$Image=$row['image'];
echo '<img src="' . $Image . '" style="border-radius: 10%; width: 50%; margin-left: 40px; margin-top: 20px;">';
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
               <div class="profile-right" style="width:100%;height:720px;padding-top: 50px;padding-left:140px;background-color:#f4faff">

                   
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
<!--footer-->
<section class="footer" style="width:100% ;background-color:#fda95f;padding-top:20px;padding-bottom:20px">
  <div class="container-fluid" style="background-color: #fda95f;">
    

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
      <div class="footer-1" style="margin: 10px;">
        <div class="line" style="background-color:gainsboro; width:
1000px;height:1px;margin:auto;"></div>
  <div class="copyright" style="text-align: center;"> © Copyright Cure4soul. All Rights Reserved<br>
      Designed by <span style="color:#1e6091">Cure4soul Team</span>
  </div>
      </div>
    </div>
  </div>

  </section>
<style>
  *{margin:0;
  padding:0;}
.data-one{
  color:gray;
  
}
table{width:80%;
  background-color:white;

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
  padding:10px;
  font-size:18px;margin-left:20px
}
/* Add more CSS styles as needed */
</style>

    </body>