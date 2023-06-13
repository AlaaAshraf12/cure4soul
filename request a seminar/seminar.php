
<?php require_once "connection.php" ?>
<?PHP 
if(! isset($_session)){
  session_start();
}
if(isset($_POST['Submit'])){
    $comp=$_POST['company'];
    $emai=$_POST['email'];
    $pho= $_POST['phone'];
    $du=$_POST['duration'];
    $dt=$_POST['dt'];
    $top=$_POST['topic'];
    $numofp=$_POST['numofpart'];

    $a="INSERT INTO reqseminar(compname,email,phone,duration,dt,topic,numofpart) Values('$comp','$emai','$pho','$du','$dt','$top','$numofp')";
    sqlsrv_query($conn,$a);
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
 footer/
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
  </nav>    
        <div class="parent">
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
       <!--footer-->
  <section class="footer" style="width:100% ;height:100%;padding-top:
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