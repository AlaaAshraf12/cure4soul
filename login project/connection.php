<?php
function OpenConnection()
{
	$serverName = "cure4soul.database.windows.net";
	$connectionOptions = array("Database"=>"Cure4soul",
		"Uid"=>"cur4soul", "PWD"=>"AdminAdmin123");
	$conn = sqlsrv_connect($serverName, $connectionOptions);
	if($conn == false)
		die(FormatErrors(sqlsrv_errors()));

	return $conn;
}
?>