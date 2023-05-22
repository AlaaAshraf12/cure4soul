
<?php
$servername = "localhost";

$username ="root";

$password ="";

$dbname="cure";
$conn= mysqli_connect ($servername,$username ,$password ,$dbname);
if (!$conn)
{
	die ("connectionfailed:" .mysqli_connect_error());
	}
	
?>