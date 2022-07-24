
<?php
require 'connectionfile/config.php';
//if session is still alive get saved user name variable
if(isset($_SESSION['username']))
	 $loggedInUser = $_SESSION['username'];
//if not redirect to the start page  to login
	else
	 header("Location:rlogin.php");
//Ajax sends displayid from the Display.php class
	if(isset($_GET['displayID']))
	//displayID keeps track on which post we are on
		 $postId=$_GET['displayID'];
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

</head>
<style>
.like, .dislike, .nOfFavs {
	color: #575d63;

}
.donDisplay {
	display: none;
}
.fa-thumbs-up, .fa-thumbs-o-up {

	font-size: 1.3em;
}
</style>
<body>

	<?php
	//retriev all from likes table
					$query = mysqli_query($con, "SELECT * FROM likes WHERE username='$loggedInUser' AND post_id='$postId'");
					//store the retrieved data in an array called name
					$row = mysqli_fetch_array($query);

					//if  already has been clicked by user display a bold thumb
					(mysqli_num_rows($query) == 1 )?
						print('<span class="dislike fa fa-thumbs-up"  data-id="$row["id"];" ></span><span class="like donDisplay fa fa-thumbs-o-up" data-id=" $row["id"];"></span>'):
					print('<span class="like fa fa-thumbs-o-up" data-id="$row["id"];" ></span><span class="dislike donDisplay fa fa-thumbs-up" data-id="$row["id"];" ></span>');


					$sqli = mysqli_query($con, "SELECT * FROM posts WHERE id=$postId");
					$data = mysqli_fetch_array($sqli);
					?>
					<span class="nOfFavs"><?php echo $data["likes"] ; ?>   likes</span>


	<script>
	//if ajax has been loaded in my project this anonymous function can execute
	$(document).ready(function(){

		// when the user clicks on like
		$('.like').on('click', function(){
			//saving a php variable in javascript by echooing it
			var postid = <?php echo "$postId"; ?>;

		    $mycontainer = $(this);
//ajax call to testindex page sendind data
			$.ajax({
				url: 'testindex.php',
				type: 'post',
				data: {
					'liked': 1,
					'postid': postid
				},
				//upon succes if data is sent  append this to mycontainer
				success: function(response){
					$mycontainer.parent().find('span.nOfFavs').text(response + " likes");
					$mycontainer.addClass('donDisplay');
					$mycontainer.siblings().removeClass('donDisplay');
				}
			});
		});

		// when the user clicks on dislike
		$('.dislike').on('click', function(){
			var postid =  <?php echo "$postId"; ?>;;
		    $mycontainer = $(this);
//ajax call for dislike when its clicked
			$.ajax({
				url: 'testindex.php',
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid
				},
				//upon succes if data is sent  append this to mycontainer
				success: function(response){
					$mycontainer.parent().find('span.nOfFavs').text(response + " likes");
					$mycontainer.addClass('donDisplay');
					$mycontainer.siblings().removeClass('donDisplay');
				}
			});
		});
	});
</script>
</body>
</html>
