<?php
include("connectionfile/header.php");

if(isset($_GET['id']))
	$postId = $_GET['id'];

else
	$postId = 0;

?>
<div class="column">
<div class="User column" >
  <a href="<?php echo $loggedInUser; ?>"> <img class "indeximg" src="<?php echo $userdetails['profile_pic']; ?>"> </a>


	<div class="Userdata">
			<?php
      echo "<span style='font-weight:bold;color: #345B63; font-size: 17px;'>$loggedInUser</span><br>";
      echo "Posts: " . $userdetails['num_posts']. "<br>";
			echo "Likes: " . $userdetails['num_likes'];
      ?>
</div>
</div>
</div>

      <div class="notssection">
        <?php
      $displayobj = new Display($con, $loggedInUser);
      $displayobj->returnAlerts_Posts($postId);
    ?>

    </div>
