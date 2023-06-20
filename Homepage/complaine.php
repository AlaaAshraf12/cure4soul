<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connection.php";
require_once "logformemp.php";

$conn = OpenConnection();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the selected problems from the form
    if (isset($_POST['problems']) && is_array($_POST['problems'])) {
        $selectedProblems = $_POST['problems'];
        
        // Retrieve the employee's ID based on their email
        $email = $_SESSION['name']; // Modify this according to your authentication system
        $query = "SELECT eid FROM employee WHERE email = '$email'";
        $result = sqlsrv_query($conn, $query);
        
        if ($result && sqlsrv_has_rows($result) > 0) {
            $row = sqlsrv_fetch_array($result);
            $emid = $row['eid'];
           
            // Retrieve the details from the form
            $b = $_POST['details'];
            
            // Convert the array of selected problems into a string
            $problemsString = implode(", ", $selectedProblems);

            // Insert the selected problems into the complain table
            $co = "INSERT INTO complain (problem, details, eid,  datecom) VALUES ('$problemsString', '$b', '$emid', GETDATE())";
            $result1 = sqlsrv_query($conn, $co);
            
            if ($result1 !== false) {
                echo '<p>Complaint submitted successfully!</p>';
            } else {
                echo '<p>Error executing query: ' . sqlsrv_errors()[0]['message'] . '</p>';
            }
        } else {
            echo '<p>Error: Employee ID not found.</p>';
        }
    } else {
        echo '<p>Error: No problems selected.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complain Form</title>
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
        
        
            
           
        
             
        
    
        label {
            display: block;
            margin-bottom: 10px;
        }
        form{
            background-color:white;
            width: 500px;
            height: 500px;
            margin:auto;
            margin-top:50px;
            text-align: center;
            justify-content: center;
        }
        body{
            margin: 0;
            
        }

        .labels{
            
position: relative;
padding-left:30px;
        }

        .labels label input{
            position: absolute;
            left: 0;
        }

       .label2{
        padding-right: 300px;
        color:#164277;
       }

      
     
    </style>
</head>
<body style="background-color:#f0f7f8">
      <!--navbar--> 
      <div class="nav" style="height:60px;background-color:#164277">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
          <div class="nav-title">
            
            
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
        
          
        </div>
        
      </div>
     
<div class="form1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12">
            <form method="POST" style="text-align:center;padding:20px">    
        <h2 style="color:#1e6091">Complain Form</h2>
        <div class="labels">
        <label class="label2">
            <input type="checkbox" name="problems[]" value="Therapist">
            Therapist
        </label>
        <label class="label2">
            <input type="checkbox" name="problems[]" value="Web application">
            Web application
        </label>
        <label class="label2">
            <input type="checkbox" name="problems[]" value="Session Duration">
            Session Duration
        </label>
        </div>
       
        <label>
            <textarea name="details" style="width:400px;height:70px;color:grey">Write...</textarea>
            
        </label>
        <input type="submit" name="submit" value="Submit" style="background-color:orange;color:white;border-color:orange;width:150px;height:40px;">
    </form>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>
