<?php include('connection.php');?>
<?php include('login.php');?>
<?PHP 
if(! isset($_session)){
  session_start();
}
if(isset($_POST['submit'])){
    $fnn=mysqli_real_escape_string($conn,$_POST['fn']);
    $lnn=mysqli_real_escape_string($conn,$_POST['ln']);
    $wemaill= mysqli_real_escape_string($conn,$_POST['email']);
    $mobilee=mysqli_real_escape_string($conn,$_POST['mobile']);
    $counn=mysqli_real_escape_string($conn,$_POST['country']);
    $jobb=mysqli_real_escape_string($conn,$_POST['title']);
    $companyy=mysqli_real_escape_string($conn,$_POST['company']);
    $industryy=mysqli_real_escape_string($conn,$_POST['industry']);
    $numofempp=mysqli_real_escape_string($conn,$_POST['employees']);
    $websitee=mysqli_real_escape_string($conn,$_POST['website']);

    $sql="INSERT INTO reqdemo(fname,lname,wemail,mobile,country,jobtitle,company,industry,numofemp,website) Values('$fnn','$lnn','$wemaill','$mobilee','$counn','$jobb','$companyy','$industryy','$numofempp','$websitee')";
    mysqli_query($conn,$sql);
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
    </head>
    <body>
        
        <form method='post'>
            
          <div class="container">
            <h2>  Request A Demo</h2>
            <form action="/action_page.php" class="form-control w-50 mx-auto my-4">
              <div class="form-group" >
                <label for="Firstname">First name:</label>
                <input type="text" class="form-control" id="Firstname" required placeholder="Enter  First name" name="fn">
              </div>
              <div class="form-group">
                <label for="Lastname">Last name</label>
                <input type="text" class="form-control" id="Lastname" placeholder="Enter Lastname" name="ln">
              </div>
              <div class="form-group">
                <label for="email">Work Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
              </div>
              <div class="form-group">
                <label for="Mobile">Mobile:</label>
                <input type="number" class="form-control" id="Mobile" placeholder="Enter Mobile" name="mobile">
              </div>
              <div class="form-group">
                <label for="country">country:</label>
                <input type="text" class="form-control" id="country" placeholder="Enter country" name="country">
              </div>
              <div class="form-group">
                <label for="title">Job title:</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
              </div>
              <div class="form-group">
                <label for="company">company:</label>
                <input type="text" class="form-control" id="company" placeholder="Enter company" name="company">
              </div>
              <div class="form-group">
                <label for="Industry">Industry:</label>
                <input type="Industry" class="form-control" id="Industry" placeholder="Enter Industry" name="industry">
              </div>
              <div class="form-group">
                <label for="employees">No. of employees:</label>
                <input type="employees" class="form-control" id="employees" placeholder="Enter employees" name="employees">
              </div>
              <div class="form-group">
                <label for="Website">Website:</label>
                <input type="Website" class="form-control" id="Website" placeholder="Enter Website" name="website">
              </div>
              <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
              </div>
              <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
            </form>
            <div class="formbold-main-wrapper">
              <!-- Author: FormBold Team -->
              <!-- Learn More: https://formbold.com -->
              <div class="formbold-form-wrapper">
                
                <img src="images/">
            
                <form action="https://formbold.com/s/FORM_ID" method="POST">
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
                        First name
                      </label>
                      <input
                        type="text"
                        name="firstname"
                        id="firstname"
                        class="formbold-form-input"
                      />
                    </div>
                    <div>
                      <label for="lastname" class="formbold-form-label"> Last name </label>
                      <input
                        type="text"
                        name="lastname"
                        id="lastname"
                        class="formbold-form-input"
                      />
                    </div>
                  </div>
            
                  <div class="formbold-input-flex">
                    <div>
                      <label for="email" class="formbold-form-label">work Email </label>
                      <input
                        type="email"
                        name="email"
                        id="email"
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
                    <label for="country" class="formbold-form-label">
                      country
                    </label>
                    <input
                      type="text"
                      name="country"
                      id="country"
                      class="formbold-form-input"
                    />
                  </div>
            
                  <div class="formbold-mb-3">
                    <label for="job title" class="formbold-form-label">
                      job title
                    </label>
                    <input
                      type="text"
                      name="job title"
                      id="job title"
                      class="formbold-form-input"
                    />
                  </div>
            
                  <div class="formbold-input-flex">
                    <div>
                      <label for="company" class="formbold-form-label"> company</label>
                      <input
                        type="text"
                        name="company"
                        id="company"
                        class="formbold-form-input"
                      />
                    </div>
                    <div>
                      <label for="industry" class="formbold-form-label"> industry </label>
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
                      <label for="post" class="formbold-form-label"> No.of employees </label>
                      <input
                        type="text"
                        name="No.of employees"
                        id="No.of employees"
                        class="formbold-form-input"
                      />
                    </div>
                    <div>
                      <label for="area" class="formbold-form-label"> Website </label>
                      <input
                        type="website"
                        name="website"
                        id="website"
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
                      I agree to the defined
                      <a href="#"> terms, conditions, and policies</a>
                    </label>
                  </div>
            
                  <button class="formbold-btn">Submit</button>
                </form>
              </div>
            </div>
          </div>
    </body>
</html>