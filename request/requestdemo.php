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
       /*navbar*/
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




    <body>
<!--    
    
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
  </nav> -->
     

            
            <div class="formbold-main-wrapper">
              <!-- Author: FormBold Team -->
              <!-- Learn More: https://formbold.com -->
              <div class="formbold-form-wrapper">
                
                <img src="images/imagery_eap_wellbeing.png">
            
                <form method="POST">
                  <div class="formbold-form-title">
                    <h2 class="">Request a demo</h2>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                      eiusmod tempor incididunt.
                    </p>
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
                      <p style="margin-left:-5px">i agree </p>
                      <a href="#" style="">By submitting this form, you are agreeing Privacy Policy and Terms of Use.</a>
                    </label>
                  </div>
            
                  <button name="submit" class="formbold-btn">Submit</button>
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