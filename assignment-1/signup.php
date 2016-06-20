<?php
	//start session
	session_start();

	include('database.php');
	include('functions.php');

	//get info from $_POST
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$ver_question = $_POST['verification_question'];
	$ver_answer = $_POST['verification_answer'];
	$location = $_POST['location'];
	$profile_pic = $_POST['profile_pic'];

	//Hash Password
	$crypt = crypt($password,'$6$rounds=6000$xjp3w4zo057ovm5wn6a9$');
	
	//connect to DB
	$conn = connect_db();

	//sanitize data
	$username = sanitizeString($conn,$username);
	$crypt = sanitizeString($conn,$crypt);
	$name = sanitizeString($conn,$name);
	$email = sanitizeString($conn,$email);
	$dob = sanitizeString($conn,$dob);
	$gender = sanitizeString($conn,$gender);
	$ver_question = sanitizeString($conn,$ver_question);
	$ver_answer = sanitizeString($conn,$ver_answer);
	$location = sanitizeString($conn,$location);
	$profile_pic = sanitizeString($conn,$profile_pic);

	if( mysqli_connect_errno($conn)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result_insert = mysqli_query($conn, "INSERT INTO users(username,password,Name,email,dob,gender,verification_question,verification_answer,location,profile_pic) VALUES ('$username','$crypt','$name','$email','$dob','$gender','$ver_question','$ver_answer','$location','$profile_pic')");


	if($result_insert){
		//redirect to feed.php
		$_SESSION["username"] = $username;	
		header ("Location: feed.php");	
	}else{
		//error
		echo "Something went wrong";
	}

?>
