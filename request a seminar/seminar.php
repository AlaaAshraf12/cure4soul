<?php
require_once "connection.php";
$conn = OpenConnection();

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['Submit'])) {
    $comp = $_POST['company'];
    $emai = $_POST['email'];
    $pho = $_POST['phone'];
    $industry = $_POST['industry'];
    $du = $_POST['duration'];
    $dt = $_POST['dt'];
    $top = $_POST['topic'];
    $numofp = $_POST['numofpart'];
    
   

    // Begin the transaction
    sqlsrv_begin_transaction($conn);

    
   // Check if the company name already exists in the company table
   $checkQuery = "SELECT cid FROM company WHERE name = ?";
   $params = array($comp);
   $checkResult = sqlsrv_query($conn, $checkQuery, $params);

   if ($checkResult !== false && sqlsrv_has_rows($checkResult)) {
       // Name already exists, retrieve the cid
       $row = sqlsrv_fetch_array($checkResult);
       $cid = $row['cid'];
        // Insert into the seminar table and retrieve the generated sid
        $insertsemoQuery = "INSERT INTO seminar (numofemp, datetime, topic, duration) OUTPUT INSERTED.sid VALUES (?, ?, ?, ?)";
        $params = array($numofp, $dt, $top, $du);
        $insertsemoResult = sqlsrv_query($conn, $insertsemoQuery, $params);

        if ($insertsemoResult !== false && sqlsrv_has_rows($insertsemoResult)) {
            $row = sqlsrv_fetch_array($insertsemoResult);
            $generatedsid = $row['sid'];

            // Insert into the semcomp table
            $insertsemcompQuery = "INSERT INTO semcomp (cid, sid, Reqdate) VALUES (?, ?, GETDATE())";
            $params = array($cid, $generatedsid);
            $insertsemcompResult = sqlsrv_query($conn, $insertsemcompQuery, $params);

            if ($insertsemcompResult !== false) {
                // Commit the transaction if all queries succeed
                sqlsrv_commit($conn);
                echo 'Data inserted successfully.';
            } else {
                // Rollback the transaction if the insertion into semcomp fails
                sqlsrv_rollback($conn);
                    echo 'Error inserting data into semcomp table: ' . $errors[0]['message'];
            }
        } else {
            // Rollback the transaction if the insertion into seminar fails or no generated sid is retrieved
            sqlsrv_rollback($conn);
            
                echo 'Error inserting data into seminar table: ' . $errors[0]['message'];
        }
    }
  
    else {
        // Company name does not exist, insert into the company table and retrieve the generated cid
        $insertCompanyQuery = "INSERT INTO company (name, email, phone, industry) OUTPUT INSERTED.cid VALUES (?, ?, ?, ?)";
        $params = array($comp, $emai, $pho, $industry);
        $insertCompanyResult = sqlsrv_query($conn, $insertCompanyQuery, $params);

        if ($insertCompanyResult !== false && sqlsrv_has_rows($insertCompanyResult)) {
            $row = sqlsrv_fetch_array($insertCompanyResult);
            $cid = $row['cid'];

            // Insert into the seminar table and retrieve the generated sid
            $insertsemoQuery = "INSERT INTO seminar (numofemp, datetime, topic, duration) OUTPUT INSERTED.sid VALUES (?, ?, ?, ?)";
            $params = array($numofp, $dt, $top, $du);
            $insertsemoResult = sqlsrv_query($conn, $insertsemoQuery, $params);

            if ($insertsemoResult !== false && sqlsrv_has_rows($insertsemoResult)) {
                $row = sqlsrv_fetch_array($insertsemoResult);
                $generatesid = $row['sid'];

                // Insert into the semcomp table
                $insertsemcompQuery = "INSERT INTO semcomp (cid, sid, Reqdate) VALUES (?, ?, GETDATE())";
                $params = array($cid, $generatesid);
                $insertsemcompResult = sqlsrv_query($conn, $insertsemcompQuery, $params);

                if ($insertsemcompResult !== false) {
                    // Commit the transaction if all queries succeed
                    sqlsrv_commit($conn);
                    echo 'Data inserted successfully.';
                } else {
                    // Rollback the transaction if the insertion into semcomp fails
                    sqlsrv_rollback($conn);
                    $errors = sqlsrv_errors();
                    if ($errors !== null && isset($errors[0]['message'])) {
                        echo 'Error inserting data into semcomp table: ' . $errors[0]['message'];
                    } else {
                        echo 'Unknown error occurred while inserting data into semcomp table.';
                    }
                }
            } else {
                // Rollback the transaction if the insertion into seminar fails or no generated sid is retrieved
                sqlsrv_rollback($conn);
                $errors = sqlsrv_errors();
                if ($errors !== null && isset($errors[0]['message'])) {
                    echo 'Error inserting data into seminar table: ' . $errors[0]['message'];
                } else {
                    echo 'Unknown error occurred while inserting data into seminar table.';
                }
            }
        } else {
            // Rollback the transaction if the insertion into company fails or no generated cid is retrieved
            sqlsrv_rollback($conn);
            $errors = sqlsrv_errors();
            if ($errors !== null && isset($errors[0]['message'])) {
                echo 'Error inserting data into company table: ' . $errors[0]['message'];
            } else {
                echo 'Unknown error occurred while inserting data into company table.';
            }
        }
    }

  }
?>




<html>
    <head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/seminar.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="nav.css">
  <link rel="styleshteet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
  <script src="js/bootstrap.min.js"></script>
  <script src="js/popper.min.js"></script>
  <style>
/* navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
}

.navbar ul {
    display: flex;
    list-style: none;
    justify-content: flex-end;
    margin: 0;
    padding: 0;
}

.navbar ul li {
    padding: 10px;
}

.navbar ul li a {
    text-decoration: none;
    font-weight: 600;
    margin: 5px;
    color: white;
}

/* Media query for screens smaller than 768px */
@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .navbar ul {
        flex-direction: column;
    }

    .navbar ul li {
        padding: 5px;
    }
}


.footer{margin-top:70px}
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
                <li><a href="#prices">Pricing</a></li>
                <li><a href="#contact">Contact</a></li>
                
            </ul>
    
            <div class="nav-buttons" style="display: flex; justify-content: flex-end;">
                <div class="btn1" style="padding-right: 10px;"><button><a href="login.php">Member Login</a></button></div>
                <div class="btn1"><button><a href="">Request a Seminar</a></button></div>
            <div>
    
              
    
            
        </div>
    </section>
    
    <!-- <nav class="navbar navbar-expand-lg navbar-dark
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
        </ul>
        <div class="nav-buttons" style="display: flex;
justify-content: flex-end;">
          <div class="btn1" style="padding-right: 10px;"><button><a
href="#login.php">Member Login</a></button></div>
          <div class="btn1"><button><a href="seminar.php">Request a
Demo</a></button></div>
<div>
      </div>
    </div>
  </nav>     -->
        <!-- <div class="parent">
            <div class="container">
                <div class=" row py-5 g-3 "></div>
                <div class="col-md-6 child py-4">
                    <div class="inner">
                <img src="images/pexels-photo-4065133.jpeg" alt="profile">
           </div>
                <div class="layer"></div>
        
               </div> 
                
            
            
                <div class="col-md-6 py-4 child">
                    <form method='post'>
                        <div class="form-group">
                            <label for="company">Company name :</label>
                            <input type="text" class="form-control" id="company" name="company" required>
                          </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                          <label for="phone">Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                          <label for="duration">Duration</label>
                          <input type="text" class="form-control" id="duration" name="duration" required>
                        </div>
                        <div class="form-group">
                            <label for="datetime">Date time:</label>
                            <input type="datetime-local" class="form-control" id="datetimne" name="dt" required>
                          </div>
                          <div class="form-group">
                            <label for="topic">Topic:</label>
                            <input type="text" class="form-control" id="topic" name="topic" required>
                              
                          </div>
                          <div class="form-group">
                            <label for="numparticipant">Number of Participant:</label>
                            <input type="text" class="form-control" id="numofpart" name="numofpart" required>
                          </div>

                        
                        <div class="checkbox">
                          <label><input type="checkbox"> Remember me</label>
                        </div>
                        <button name="Submit" type="submit" class="btn btn-primary">Submit</button>
                      </form>
        
            </div> 
        </div>
            <div class="crl"></div>
        
        </div>
 -->

        <div class="request"style="background-color: #f0f7f8">
          <div class="container">
            <div class="row" style="background-color: #f0f7f8">
              <div class="col-xl-6 col-lg-6 col-sm-12" >
                <div class="img"><img src="images/request.jpeg" style="width:100%;padding-top:150px;padding-right:50px;"></div>
              </div>
              <div class="col-xl-6 col-lg-6 col-sm-12">
              <form method='post' style="padding-top:60px;">
                        <div class="form-group">
                            <label for="company">Company name :</label>
                            <input type="text" class="form-control" id="company" name="company" required>
                          </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                          <label for="phone">Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                          <label for="duration">Industry</label>
                          <input type="text" class="form-control" id="duration" name="industry" required>
                        </div>
                        <div class="form-group">
                          <label for="duration">Duration</label>
                          <input type="text" class="form-control" id="duration" name="duration" required>
                        </div>
                        <div class="form-group">
                            <label for="datetime">Date time:</label>
                            <input type="datetime-local" class="form-control" id="datetimne" name="dt" required>
                          </div>
                          <div class="form-group">
                            <label for="topic">Topic:</label>
                            <input type="text" class="form-control" id="topic" name="topic" required>
                              
                          </div>
                          <div class="form-group">
                            <label for="numparticipant">Number of Participant:</label>
                            <input type="text" class="form-control" id="numofpart" name="numofpart" required>
                          </div>

                        
                        <div class="checkbox">
                          <label><input type="checkbox"> Remember me</label>
                        </div>
                        <button name="Submit" type="submit" class="btn btn-primary">Submit</button>
                      </form>
              </div>
            </div>
          </div>
        </div>
       <!--footer-->
  <section class="footer" style="width:100% ;height:50%;padding-top:
  70px;background-color:#fda95f;">
      <div class="container-fluid" style="background-color: #fda95f;">
        <div class="row g-0" style="width:90%;margin-left: 40px;">
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
              <button class="btn-footer">Sign In</button>
              <button class="btn-footer">Sign Up</button>
  
  
            </div>
          </div>
        </div>
      </div>
      <div class="row">
  
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="footer-1" style="margin: 10px;">
            <div class="line" style="background-color:gainsboro; width:
  1000px;height:1px;margin:auto;"></div>
  <div class="copyright" style="text-align: center;">
        © Copyright Cure4soul. All Rights Reserved<br>
        Designed by <span style="color:#1e6091">Cure4soul Team</span>
    </div>
        </div>
      </div>
    </div>

    </section>
    </body>
</html>