
<?php
$servername = "localhost";

$username ="root";

$password ="";

$dbname="rege";
$conn= mysqli_connect ($servername,$username ,$password ,$dbname);
if (!$conn)
{
	die ("connectionfailed:" .mysqli_connect_error());
	}
else
{
	echo "connected sucessfully";
}
?>