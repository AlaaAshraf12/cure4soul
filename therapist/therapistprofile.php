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
            .navbar{
    display: flex;
    justify-content: space-between;
    height:10%;
    align-items: center;
    position: fixed;
    left:0px;
    right: 0px;
    }
    .nav-item{background-color: red;}
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
width: 140px;
height: 40px;
border-radius: 8px;
border-style: none;


}
.btn1 button:hover{background-color: #fad263;}
.btn1 button a{text-decoration: none;
color: white;}

        </style>
    </head>
    <body>
     
      <section class="nav" >
        <div class="navbar"style="background-color:#1e6091;">
            <h2 style="color: white; font-weight: bold; padding-left: 40px;">cure4soul<span class="dot" style="color: #00c3da;">.</span></h2>
    
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
    </section> 
     

    
    <section class="profile">
        <div class="container-fluid">
            <div class="Profile-content" style="display: flex;justify-content: center;">
               <div class="profile-left" style="width:40%;height:700px;background-color:#f8f6f4;padding-top: 100px;">
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
echo '<img src="' . $Image . '" style="border-radius: 50%; width: 40%; margin-left: 40px; margin-top: 20px;">';
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
               <div class="profile-right" style="width:100%;height:720px;padding-top: 80px;padding-left:140px;background-color:#f4faff">

                   
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
.data-one{background-color:#8fb8ca;
  color:white;
  
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