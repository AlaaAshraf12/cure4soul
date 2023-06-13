<?php include('connection.php');?>
<?PHP 
if(! isset($_session)){
  session_start();
}
if(isset($_POST['sub'])){
                 $name=sqlsrv_escape_string($conn,$_POST['name']);
                 $emai=sqlsrv_escape_string($conn,$_POST['email']);
                 $passwordd=sqlsrv_escape_string($conn,$_POST['pass']);
                 $conpassword=sqlsrv_escape_string($conn,$_POST['conpass']);
                 $phon=sqlsrv_escape_string($conn,$_POST['phone']);
                 $qua=sqlsrv_escape_string($conn,$_POST['qua']);
                 $ni=sqlsrv_escape_string($conn,$_POST['nid']);
                 $cvv=sqlsrv_escape_string($conn,$_POST['cv']);
                    if($passwordd != $conpassword){
                           echo "password doesnot match"; }
                    else{
                          $sq="INSERT INTO therapist(name,email,password,phone,qualif,nid,cv) Values('$name','$emai','$passwordd','$phon','$qua','$ni','$cvv')";
                          sqlsrv_query($conn,$sq); 
                     }
                } 

?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/all.min.css">
      
        <link rel="stylesheet" href="css/style.css">
        <script src="js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="req container">
            <h3>Therapist's application</h3>
            <form method='post' class="row reqform">
                <h4 >Full Name</h4>
                <div class="col-md-4">
                    <label> Name</label>
                    <input class="form-control" type="text" aria-label="default input example" name="name" required>
                </div>
              
                <div class="col-md-4">
                    <label>email</label>
                    <input class="form-control" type="email" aria-label="default input example" name="email" required>
                    </div>
                <div class="col-md-6">
                    <label>password</label>
                    <input class="form-control" type="password" aria-label="default input example" name="pass" required>
                </div>
                <div class="col-md-6">
                    <label>confirm password</label>
                    <input class="form-control" type="password" aria-label="default input example" name="conpass" required>
                </div>
                <div class="col-md-6">
                    <label>phone</label>
                    <input class="form-control" type="text" aria-label="default input example" name="phone" required>
                </div>
                <div class="col-md-6">
                    <label>qualification</label>
                    <input class="form-control" type="text" aria-label="default input example" name="qua" required>
                </div>
              
                <div class="col-md-6">
                    <label>national id</label>
                    <input class="form-control" type="text" aria-label="default input example" name="nid" required>
                </div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">your CV</label>
                    <input class="form-control" type="file" id="formFileMultiple" name="cv" >
                  </div>

                  <button class="btn btn-primary " name="sub" type="submit">submit</button>
                </div>
                 </div>
                
                
               
            </form>
        </div>
    </body>
</html>