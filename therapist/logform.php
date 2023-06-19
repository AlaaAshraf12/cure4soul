<?php 
    require_once "connection.php"; 
	$conn = OpenConnection();
   if( !isset($_SESSION)){
	    session_start();
}
if(isset($_POST['login'])){
	
	$n=$_POST['email'];
	$p=$_POST['password'];
	$s='accepted';
    $t=" SELECT * FROM therapist WHERE email='$n' AND password='$p' And status='$s'";

	 $r=sqlsrv_query($conn,$t);
	
	
    if(sqlsrv_has_rows($r)==1){
		$_SESSION['name']=$n;
		$_SESSION['success']="welcome dear";
		header('location:therapistprofile.php');
}
    else{
		echo "Username is not found";
}

}
if(isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['name']);
	header('location:logintherapist.php');
}

?>