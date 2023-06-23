<?php include("connection.php"); ?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Employee Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section" style="margin-top: -80px;">
		<div class="container">
			<div class="d-flex">
				<div class="w-100">
					<h3 class="mb-4" style="text-align: center;color:#1e6091;font-weight: bold;">Sign In Cure4Soul</h3>
				</div>
					  
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(images/pexels-alex-green-5699436.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
							
							<form method="POST" action="logformemp.php" class="signin-form">
			      		<div class="form-group mt-3">
			      			<input type="text" class="form-control" required>
			      			<label class="form-control-placeholder" for="name" id="company" name="company" required>Company Name</label>
			      		</div>
			      		<div class="form-group mt-3">
			      			<input type="email" class="form-control" required>
			      			<label class="form-control-placeholder" for="Email" id="email" name="email" required>Email</label>
			      		</div>
		            <div class="form-group">
		              <input id="password-field" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password" id="password" name="password" required>Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="login" class="form-control btn btn-primary rounded submit px-3" style="color:white">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0" style="color:#1e6091;">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									
		            </div>
		          </form>
		          
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

