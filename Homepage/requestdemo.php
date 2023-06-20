<?php
require_once "connection.php";
$conn = OpenConnection();

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['submit'])) {
    $n = $_POST['company'];
    $e = $_POST['email'];
    $phone = $_POST['mobile'];
    $industry = $_POST['industry'];
    $numofemp = $_POST['employees'];
    $numofsession = $_POST['sessions'];

    // Begin the transaction
    sqlsrv_begin_transaction($conn);

    // Check if the company name already exists in the company table
    $checkQuery = "SELECT cid FROM company WHERE name = ?";
    $params = array($n);
    $checkResult = sqlsrv_query($conn, $checkQuery, $params);

    if ($checkResult !== false && sqlsrv_has_rows($checkResult)) {
        // Name already exists, retrieve the cid
        $row = sqlsrv_fetch_array($checkResult);
        $cid = $row['cid'];

        // Insert into the demo table and retrieve the generated did
$insertDemoQuery = "INSERT INTO demo (numofemp, numofses, status) OUTPUT INSERTED.did VALUES (?, ?, 'NULL')";
$params = array($numofemp, $numofsession);
$insertDemoResult = sqlsrv_query($conn, $insertDemoQuery, $params);

if ($insertDemoResult !== false && sqlsrv_has_rows($insertDemoResult)) {
    $row = sqlsrv_fetch_array($insertDemoResult);
    $generatedDid = $row['did'];

    // Insert into the democomp table
    $insertDemcompQuery = "INSERT INTO democomp (cid, did, reqdate) VALUES (?, ?, GETDATE())";
    $params = array($cid, $generatedDid);
    $insertDemcompResult = sqlsrv_query($conn, $insertDemcompQuery, $params);

    if ($insertDemcompResult !== false) {
        // Commit the transaction if all queries succeed
        sqlsrv_commit($conn);
        echo 'Data inserted successfully.';
    } else {
        // Rollback the transaction if the insertion into democomp fails
        sqlsrv_rollback($conn);
        echo 'Error inserting data into democomp table: ' . sqlsrv_errors()[0]['message'];
    }
} else {
    // Rollback the transaction if the insertion into demo fails
    sqlsrv_rollback($conn);
    echo 'Error inserting data into demo table: ' . sqlsrv_errors()[0]['message'];
}
} 
   /*// Check if the company name already exists
$checkCompanyQuery = "SELECT cid FROM company WHERE name = ?";
$params = array($n);
$checkCompanyResult = sqlsrv_query($conn, $checkCompanyQuery, $params);

if ($checkCompanyResult !== false && sqlsrv_has_rows($checkCompanyResult)) {
    // Company name already exists, retrieve the existing cid
    $row = sqlsrv_fetch_array($checkCompanyResult);
    $generatedCid = $row['cid'];

    // Insert into the demo table
    $insertDemoQuery = "INSERT INTO demo (numofemp, numofses, status) VALUES (?, ?, 'NULL')";
    $params = array($numofemp, $numofsession);
    $insertDemoResult = sqlsrv_query($conn, $insertDemoQuery, $params);

    if ($insertDemoResult !== false && sqlsrv_has_rows($insertDemoResult)) {
        // Retrieve the generated did from the inserted demo
        $row = sqlsrv_fetch_array($insertDemoResult);
        $generatedDid = $row['did'];

        // Insert into the democomp table
        $insertDemcompQuery = "INSERT INTO democomp (cid, did, reqdate) VALUES (?, ?, GETDATE())";
        $params = array($generatedCid, $generatedDid);
        $insertDemcompResult = sqlsrv_query($conn, $insertDemcompQuery, $params);

        if ($insertDemcompResult !== false) {
            // Commit the transaction if all queries succeed
            sqlsrv_commit($conn);
            echo 'Data inserted successfully.';
        } else {
            // Rollback the transaction if the insertion into democomp fails
            sqlsrv_rollback($conn);
            echo 'Error inserting data into democomp table: ' . sqlsrv_errors()[0]['message'];
        }
    } else {
        // Rollback the transaction if the insertion into demo fails
        sqlsrv_rollback($conn);
        echo 'Error inserting data into demo table: ' . sqlsrv_errors()[0]['message'];
    }
} */
else {
  // Insert into the company table and retrieve the generated cid
$insertCompanyQuery = "INSERT INTO company (name, email, phone, industry) OUTPUT INSERTED.cid VALUES (?, ?, ?, ?)";
$params = array($n, $e, $phone, $industry);
$insertCompanyResult = sqlsrv_query($conn, $insertCompanyQuery, $params);

if ($insertCompanyResult !== false && sqlsrv_has_rows($insertCompanyResult)) {
    $row = sqlsrv_fetch_array($insertCompanyResult, SQLSRV_FETCH_ASSOC);
    $generatedCid = $row['cid'];

    // Insert into the demo table and retrieve the generated did
    $insertDemoQuery = "INSERT INTO demo (numofemp, numofses, status) OUTPUT INSERTED.did VALUES (?, ?, 'NULL')";
    $params = array($numofemp, $numofsession);
    $insertDemoResult = sqlsrv_query($conn, $insertDemoQuery, $params);

    if ($insertDemoResult !== false && sqlsrv_has_rows($insertDemoResult)) {
        $row = sqlsrv_fetch_array($insertDemoResult, SQLSRV_FETCH_ASSOC);
        $generatedDid = $row['did'];

        // Insert into the democomp table
        $insertDemcompQuery = "INSERT INTO democomp (cid, did, reqdate) VALUES (?, ?, GETDATE())";
        $params = array($generatedCid, $generatedDid);
        $insertDemcompResult = sqlsrv_query($conn, $insertDemcompQuery, $params);

        if ($insertDemcompResult !== false) {
            // Commit the transaction if all queries succeed
            sqlsrv_commit($conn);
            echo 'Data inserted successfully.';
        } else {
            // Rollback the transaction if the insertion into democomp fails
            sqlsrv_rollback($conn);
            echo 'Error inserting data into democomp table: ' . sqlsrv_errors()[0]['message'];
        }
    } else {
        // Rollback the transaction if the insertion into demo fails or no generated did is retrieved
        sqlsrv_rollback($conn);
        echo 'Error inserting data into demo table or retrieving generated did: ' . sqlsrv_errors()[0]['message'];
    }
} else {
    // Rollback the transaction if the insertion into company fails or no generated cid is retrieved
    sqlsrv_rollback($conn);
    echo 'Error inserting data into company table or retrieving generated cid: ' . sqlsrv_errors()[0]['message'];
}
    }
  }
?>

<html>
    <head>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="request.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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


/*footer*/
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




    <body style="background-color:#f0f7f8" >
      <!--navbar--> 
      <div class="nav" style="height:60px;background-color:#164277">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
          <div class="nav-title">
            
            <h2><a href="" class="logo" style="color: white;font-size:30px; font-weight: bold; padding-left: 20px;text-decoration: none;">cure4soul<span class="dot" style="color: #00c3da;">.</span></a></h2>
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
            <button class="btn1" ><a href="login.php" style="text-decoration:none;color:white">Member Login</a></button>
          <button  class="btn1"><a href="requestdemo.php" style="text-decoration:none;color:white">Request Demo</a></button>
          </div>
        </div>
        
      </div>
     


            
            <div class="formbold-main-wrapper">
              <!-- Author: FormBold Team -->
              <!-- Learn More: https://formbold.com -->
              <div class="formbold-form-wrapper">
                
                <img src="images/imagery_eap_wellbeing.png">
            
                <form method="POST">
                  <div class="formbold-form-title">
                    <h2 class="" style="text-align:center">Request a demo</h2>
                    
                  </div>
            
                  <div class="formbold-input-flex">
                    <div>
                      <label for="firstname" class="formbold-form-label">
                        Company name
                      </label>
                      <input
                        type="text"
                        name="company"
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
                      <label for="firstname" class="formbold-form-label">
                        Phone
                      </label>
                      <input
                      type="text"
                        name="mobile"
                        id="phone"
                        class="formbold-form-input"
                      />
                    </div>
                    <div>
                      <label for="email" class="formbold-form-label"> Industry </label>
                      <input
                      type="text"
                        name="industry"
                        id="industry"
                        class="formbold-form-input"
                      />
                    </div>
                  </div>
                  <div class="formbold-input-flex">
                    <div>
                      <label for="firstname" class="formbold-form-label">
                        Number of Employees
                      </label>
                      <input
                      type="text"
                        name="employees"
                        id="No.of employees"
                        class="formbold-form-input"
                      />
                    </div>
                    <div>
                      <label for="email" class="formbold-form-label"> Number of Sessions </label>
                      <input
                      type="number"
                        name="sessions"
                        id="company"
                        class="formbold-form-input"
                      />
                    </div>
                  </div>
                  
            
                  <div class="formbold-checkbox-wrapper">
                    <label for="supportCheckbox" class="formbold-checkbox-label">
                      <div class="formbold-relative">
                        <input
                          type="checkbox"
                          id="supportCheckbox"
                          class="formbold-input-checkbox"
                        />
                        <div class="formbold-checkbox-inner">
                          <span class="formbold-opacity-0">
                            <svg
                              width="11"
                              height="8"
                              viewBox="0 0 11 8"
                              fill="none"
                              class="formbold-stroke-current"
                            >
                              <path
                                d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z"
                                stroke-width="0.4"
                              ></path>
                            </svg>
                          </span>
                        </div>
                      </div>
                      
                      <a href="#" style="color:gray">By submitting this form, you are agreeing Privacy Policy and Terms of Use.</a>
                    </label>
                  </div>
            
                  <button name="submit" class="formbold-btn" style="background-color:orange">Submit</button>
                </form>
              </div>
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