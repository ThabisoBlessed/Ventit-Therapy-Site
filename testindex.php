<?php
require 'connectionfile/config.php';
	$postid = $_POST['postid'];


	if(isset($_SESSION['username']))
		 $loggedInUser = $_SESSION['username'];

		else
		 header("Location:rlogin.php");


	$result = mysqli_query($con, "SELECT * FROM posts WHERE id='$postid'");
	$detailsquery = mysqli_fetch_array($result);
	$n = $detailsquery['likes'];
	$postOwner=$detailsquery['added_by'];

	$query=mysqli_query($con, "SELECT * FROM users WHERE username='$postOwner'");
	$row = mysqli_fetch_array($query);
	$numOfLIkes=$row['num_likes'];

	if (isset($_POST['liked'])) {

		$numOfLIkes++;

		mysqli_query($con, "INSERT INTO likes  VALUES(NULL, '$loggedInUser','$postid')");
		mysqli_query($con, "UPDATE posts SET likes=$n+1 WHERE id='$postid'");
		mysqli_query($con, "UPDATE users SET num_likes='$numOfLIkes' WHERE username='$postOwner'");


		echo $n+1;
		exit();
	}

	if (isset($_POST['unliked'])) {
		$numOfLIkes--;
		mysqli_query($con, "DELETE FROM likes WHERE username='$loggedInUser' AND post_id='$postid' ");
		mysqli_query($con, "UPDATE posts SET likes=$n-1 WHERE id='$postid'");
		if($numOfLIkes<0)
		$numOfLIkes=0;

		mysqli_query($con, "UPDATE users SET num_likes='$numOfLIkes' WHERE username='$postOwner'");

		echo $n-1;
		exit();
	}

?>
