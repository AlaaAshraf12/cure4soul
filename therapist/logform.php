<?php 
     include ('connection.php'); 
   if( !isset($_SESSION)){
	    session_start();
}
if(isset($_POST['login'])){
	
	$n=mysqli_real_escape_string($conn,$_POST['email']);
	$p=mysqli_real_escape_string($conn,$_POST['password']);
	
    $t="SELECT * FROM therapist WHERE 'email'='$n'AND'passwordd'='$p'";

	 $r=mysqli_query($conn,$t);
	
	
    if(mysqli_num_rows($r)==1){
		$_SESSION['name']=$n;
		$_SESSION['success']="welcome dear";
		header('location:therapistprofile.php');
}
    else{
		echo "wrong data!!!";
}

}
if(isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['name']);
	header('location:logintherapist.php');
}

?>