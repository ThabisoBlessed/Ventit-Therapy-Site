<?php
include("../../connectionfile/config.php");

$sqlidata = $_POST['query'];



$sqldata = mysqli_query($con, "SELECT * FROM posts ,users  WHERE posts.added_by=users.username AND  posts.body  LIKE '%$sqlidata%'
	AND posts.deleted='no' LIMIT 8");

if($sqlidata != ""){

	while($datareturned = mysqli_fetch_array($sqldata))
	{
				echo "<div class='dataShow row'>

					<div class='resultsComments col'>

					<img src='" . $datareturned['profile_pic'] ."'>

						<a href='" . $datareturned['username'] . "' style='color: #345B63'>
						" . $datareturned['username'] ."
						<p>" . $datareturned['body'] ."</p>

				</div>
				</a>
				</div>";
}
}

?>
