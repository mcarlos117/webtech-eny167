<?php
	$dbhost = "localhost";
	$dbuser = "root";
	//NOT SURE WHAT YOUR PASSWORD IS. I KNOW IT IS NOT THE SAME SO I HAVE BOTH THERE
	$dbpass = "";
	//$dbpass = "root";
	$dbname = "mydb";

	function connect_db(){
		$conn = mysqli_connect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
		if( mysqli_connect_errno($conn)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	
	return $conn;
	}
?>
