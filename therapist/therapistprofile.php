<?php include('connection.php');?>
<?php include('logform.php');?>



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
                <li><a href="#home" style="color:white ">HOME</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#client">Works</a></li>
                <li><a href="#prices">Pricing</a></li>
                <li><a href="#contact">Contact</a></li>
                
            </ul>
    
            <div class="nav-buttons" style="display: flex; justify-content: flex-end;">
                <div class="btn1" style="padding-right: 10px;"><button><a href="">Member Login</a></button></div>
                <div class="btn1"><button><a href="">Request a Seminar</a></button></div>
            <div>
    
              
    
            
        </div>
    </section> 
     

    <section class="profile">
        <div class="container-fluid">
            <div class="Profile-content" style="display: flex;justify-content: center;">
               <div class="profile-left" style="width: 20%;height:700px;background-color: rgb(238, 237, 237);padding-top: 100px;">
                <div class="section-img">
                    <img src="doccc.jpg" style="border-radius: 50%; width: 70%;margin-left: 40px;margin-top: 20px;">
                    <?php
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in therapist's email from the session

$therapistEmail = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the therapist's ID based on their email
$query = "SELECT tid FROM therapist WHERE email = '$therapistEmail'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$therapistId = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$query = "SELECT name,email,phone,qualif FROM therapist WHERE tid = $therapistId";
$result = mysqli_query($conn, $query);

// Display the schedule in a table format
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h2>" . $row['name'] . "</h2><br>";
        echo "<h2>" . $row['email'] . "</h2><br>";
        echo "<h2>" . $row['phone'] . "</h2><br>"; 
        echo "<h2>" . $row['qualif'] . "</h2><br>";
    }
} else {
    echo "No schedule found.";
}

?>
                </div>
            </div>
               <div class="profile-right" style="width: 80%;height:500;padding-top: 100px;">

                <div class="formbold-main-wrapper">
                 
                    <div class="formbold-form-wrapper">
                      
                     
                  
                      <form>
                        
                  
                        <div class="formbold-input-flex">
                          <div>
                            <label for="firstname" class="formbold-form-label">
                              Name
                            </label>
                            <input
                              type="text"
                              name="firstname"
                              id="firstname"
                              class="formbold-form-input"
                            />
                          </div>
                          <div>
                            <label for="email" class="formbold-form-label"> Email </label>
                            <input
                              type="email"
                              name="email"
                              id="email"
                              class="formbold-form-input"
                            />
                          </div>
                        </div>
                  
                        <div class="formbold-input-flex">
                          <div>
                            <label  class="formbold-form-label"> Nationality </label>
                            <input
                              type="text"
                              name="nationality"
                              id="nationality"
                              class="formbold-form-input"
                            />
                          </div>
                          <div>
                            <label for="phone" class="formbold-form-label"> Phone number </label>
                            <input
                              type="text"
                              name="phone"
                              id="phone"
                              class="formbold-form-input"
                            />
                          </div>
                        </div>
                  
                        <div class="formbold-mb-3">
                          <label for="address" class="formbold-form-label">
                            Qualification
                          </label>
                          <input
                            type="text"
                            name="address"
                            id="address"
                            class="formbold-form-input"
                          />
                        </div>
                        <button class="formbold-btn">Save</button>
                      </form> 
                    </div>
                  </div>
                     
                </div>
            </div>
            </div>
        </div>
    </section>
    
   <?php
// Assuming you have a MySQL database connection established

// Start the session and retrieve the logged-in therapist's email from the session

$therapistEmail = $_SESSION['name']; // Modify this according to your authentication system

// Retrieve the therapist's ID based on their email
$query = "SELECT tid FROM therapist WHERE email = '$therapistEmail'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$therapistId = $row['tid'];

// Retrieve the therapist's schedule from the sessions table
$query = "SELECT dayy, Time1, status FROM sessions WHERE tid = $therapistId";
$result = mysqli_query($conn, $query);

// Display the schedule in a table format
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Day</th><th>session 1</th><th>status</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<td>" . $row['dayy'] . "</td>";
        echo "<td>" . $row['Time1'] . "</td>";
        echo "<td><span class='session-status " . ($row['status'] == 'booked' ? 'booked' : 'unbooked') . "'></span></td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No schedule found.";
}

?>
<style>
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

/* Add more CSS styles as needed */
</style>

    </body>