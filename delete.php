<?php
include('connectionfile/header.php');

if(isset($_POST['lockacc']))
{
  mysqli_query($con,  "UPDATE users SET user_closed='yes'  WHERE username ='$loggedInUser'");

  session_destroy();
  header("Location:rlogin.php");
}


if(isset($_POST['cancel']))
header("Location:settings.php");

?>

<div class="ptofileData" id="ptofileData">
<p>Your account won't be accessible once deleted!!!...</p>

<form action="delete.php" method="POST" >
  <input type="submit" name="lockacc" id="lockacc" value="Delete" required>
  <input type="submit" name="cancel" id="cancelQuery" value="Cancel" required>
  <br>
</div>
