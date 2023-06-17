<?php 
     include ('connection.php'); 
   if( !isset($_SESSION)){
	    session_start();
}
if(isset($_POST['login'])){
	
	$n=sqlsrv_escape_string($conn,$_POST['email']);
	$p=sqlsrv_escape_string($conn,$_POST['password']);
	
    $t="SELECT * FROM therapist WHERE 'email'='$n'AND'password'='$p'";

	 $r=sqlsrv_query($conn,$t);
	
	
    if(sqlsrv_has_rows($r)==1){
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
select * from sys.foreign_keys ;ALter Table employee drop constraint FK__employee__cid__693CA210;
ALter Table seminar drop constraint FK__seminar__cid__6477ECF3;
ALter Table demo drop constraint FK__demo__cid__619B8048;
alter table employee add constraint cid foreign key (cid) references company(cid);
ALTER TABLE sessions
DROP COLUMN tid;

Drop table employee;
Drop table therapist;
CREATE TABLE therapist (
  tid INT NOT NULL IDENTITY(1,1),
  name VARCHAR(30) NOT NULL,
  email VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  qualif VARCHAR(30) NOT NULL,
  nid VARCHAR(30) NOT NULL,
  cv TEXT NOT NULL,
  PRIMARY KEY (tid)
) 





CREATE TABLE employee (
  eid  INT  NOT NULL Primary key IDENTITY(1,1),
  email VARCHAR(30) NOT NULL,
  pass VARCHAR(30) NOT NULL,
  numofsessions VARCHAR(30) NOT NULL,
  accountstatus VARCHAR(30) NOT NULL,
  cid INT NOT NULL,
  did INT NOT NULL,
  FOREIGN KEY (cid) REFERENCES company (cid),
  FOREIGN KEY (did) REFERENCES demo (did)
) 
