<?php
//including the header file
include("connectionfile/header.php");
//creating a new oject of Texsms ,passing connection variable and name of logged in user
$textobj =new TextSms($con,$loggedInUser);

//if value you is set.
if(isset($_GET['you']))
//retrieve the value and set it to $dataTo variable
	$dataTo = $_GET['you'];

else
	//if they is no one data to is set to new
	$dataTo =($textobj->returnCurrentUser() == false)?'new':$textobj->returnCurrentUser();

	//tenary operation
    $proffobj=($dataTo != "new")?new ProfileUser($con, $dataTo):"";

//when sms is set and  smsText is set also
	if(isset($_POST['sms'])&&isset($_POST['smsText'])) {
		$paragraph = mysqli_real_escape_string($con, $_POST['smsText']);
		//date objects gives us the current date
		$time = date("Y-m-d H:i:s");
		//send the message
		$textobj->dispatchSms($dataTo, $paragraph, $time);
}
 // message chat  frame
		print('<div class="column smspage">');
		($dataTo != "new")?print("<h4>You and <a href='$dataTo'>" . $proffobj->returnName() . "</a></h4><hr><br>"."<div class='printedtexts' id='smsscroll'>".$textobj->retrieveSms($dataTo)."</div>"):"";


    	print('	<div class="smstext">
    			<form action="" method="POST">');
					print("<textarea name='smsText' id='smsarea' placeholder='Type message..'></textarea>.<input type='submit'
					name='sms' class='info' id='sendbtn' value='Send'></form></div>");

			echo'<script>document.getElementById("smsscroll").scrollTop = document.getElementById("smsscroll").scrollHeight;</script>';
