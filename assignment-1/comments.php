<?php

	session_start();

	include('database.php');
	include('functions.php');

	//get data from the form
	$content = $_POST['content'];
	$UID = $_POST['UID'];
	$PID = $_POST['PID'];

	//connect to DB
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
	$row = mysqli_fetch_assoc($result);

	//$result2 = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$PID'");
	//$row2 = mysqli_fetch_assoc($result2);
	//Fetch user info
	$name = $row["Name"];
	//$PID = $row["id"];

	$content = sanitizeString($conn,$content);
	$UID = sanitizeString($conn,$UID);
	$PID = sanitizeString($conn,$PID);
	$name = sanitizeString($conn,$name);

	echo "$name ";

	$result_insert = mysqli_query($conn, "INSERT INTO comments(content, UID, name,PID) VALUES ('$content', $UID,'$name',$PID)");

	//check if insert was ok
	if($result_insert){
		//redirect to feed pg
		header("Location: feed.php");
	}else{
		// throw an error
		echo "Oops! Something went wrong! Please try again!";
	}


?>