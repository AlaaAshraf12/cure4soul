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
        $insertsemoQuery = "INSERT INTO seminar (numofemp, datetime, topic, duration) OUTPUT INSERTED.seid VALUES (?, ?, ?, ?)";
        $params = array($numofp, $dt, $top, $du);
        $insertsemoResult = sqlsrv_query($conn, $insertsemoQuery, $params);

        if ($insertsemoResult !== false && sqlsrv_has_rows($insertsemoResult)) {
            $row = sqlsrv_fetch_array($insertsemoResult);
            $generatedsid = $row['seid'];

            // Insert into the semcomp table
            $insertsemcompQuery = "INSERT INTO semocomp (cid, sid, Reqdate) VALUES (?, ?, GETDATE())";
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
            $insertsemoQuery = "INSERT INTO seminar (numofemp, datetime, topic, duration) OUTPUT INSERTED.seid VALUES (?, ?, ?, ?)";
            $params = array($numofp, $dt, $top, $du);
            $insertsemoResult = sqlsrv_query($conn, $insertsemoQuery, $params);

            if ($insertsemoResult !== false && sqlsrv_has_rows($insertsemoResult)) {
                $row = sqlsrv_fetch_array($insertsemoResult);
                $generatesid = $row['seid'];

                // Insert into the semcomp table
                $insertsemcompQuery = "INSERT INTO semocomp (cid, sid, Reqdate) VALUES (?, ?, GETDATE())";
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
  .btn1{background-color: orange;
  width: 150px;
  height: 40px;
  border-radius: 8px;
  border-style: none;
  margin-left: 12px;
  color:white;
  font-size:15px}
.btn1:hover{background-color: #fad263;}


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
label{font-size:15px;color:#1e6091}

</style>  
  </head>
    <body>
    <!--navbar--> 
    <div class="nav" style="height:60px;background-color:#164277">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
          <div class="nav-title">
            
            <h2><a href="home.html" class="logo" style="color: white;font-size:30px; font-weight: bold; padding-left: 20px;text-decoration: none;">cure4soul<span class="dot" style="color: #00c3da;">.</span></a></h2>
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
        
          <div class="btn" style="margin-right:20px;">
            <button class="btn1" style=""><a href="login.php" style="text-decoration:none;color:white">Member Login</a></button>
          <button  class="btn1"><a href="requestdemo.php" style="text-decoration:none;color:white">Request Demo</a></button>
          </div>
        </div>
        
      </div>
     

    
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

                        
                        <div class="" style="padding-top:20px;padding-left:100px"><button name="Submit" type="submit" class="btn btn-primary" style="width:160px;height:40px;background-color:orange;border-color:orange;font-size:12px">Submit</button></div>
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
 
              <button class="btn-footer"><a href="requesttherapist.php" style="text-decoration:none;color:white">Sign Up</a></button>
  
  
            </div>
          </div>
        </div>
      </div>
      <div class="row">
  
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="footer-1" style="margin: 10px;">
            <div class="line" style="background-color:gainsboro; width:
  1000px;height:1px;margin:auto;"></div>
  <div class="copyright" style="text-align: center;font-size:13px">
        © Copyright Cure4soul. All Rights Reserved<br>
        Designed by <span style="color:#1e6091">Cure4soul Team</span>
    </div>
        </div>
      </div>
    </div>

    </section>


         
    </body>
</html>