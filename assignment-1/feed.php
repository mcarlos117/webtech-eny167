<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>

<?php
	include('database.php');
	session_start();
	
	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//User information
	$row = mysqli_fetch_assoc($result);
	echo "<h1>Welcome ".$row['Name'].".</h1>";
	echo"<img src='".$row['profile_pic']."'>";
	//echo"<img src='".$row['profile_pic']."'style='width:300px;height:25px>";
	

	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Say something..</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";
	echo "</form>";

	echo"<br>";
	echo"<hr>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);


	echo "<h2>My Feed</h2>";

	if ($num_of_rows == 0){
		echo "<p>No new posts to show!</p>";
	}

	for($i = 0; $i < $num_of_rows; $i++){

		$row = mysqli_fetch_row($result_posts);
		echo "$row[2] said $row[4] ($row[5] ";
		echo "<img src='https://image.freepik.com/free-icon/like_318-31404.png' alt='Like' style='width:15px;height:15px;'>)";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'><input type='submit' value='Like'></form>";

		//Comments
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
		$rowc = mysqli_fetch_assoc($result);
		echo "<form method='POST' action='comments.php'>";
		echo "<p><textarea name='content'>Write a comment..</textarea></p>";
		echo "<input type='hidden' name='UID' value='$rowc[id]'>";
		echo "<input type='hidden' name='PID' value='$row[0]'>";
		echo "<p><input type='submit'></p>";
		echo "</form>";

		$result_posts2 = mysqli_query($conn, "SELECT * FROM comments");
		$num_of_rows2 = mysqli_num_rows($result_posts2);
		for($j = 0; $j < $num_of_rows2 ; $j++){

				$row2 = mysqli_fetch_row($result_posts2);
				if ($row[0] == $row2[5]){
					echo "$row2[3] commented $row2[1] ";
					echo "<br>";
				}	
			
		}

		echo "<br>";
		echo "<hr>";
	}

?>
</body>
</html>