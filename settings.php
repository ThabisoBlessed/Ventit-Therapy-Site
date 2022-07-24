<?php
include('connectionfile/header.php');
include('connectionfile/reg.php');
?>

<div class="ptofileData">

  <h5>Update Password</h5>

  <form action="settings.php" method="POST" >
    <input type="password" name="setting_psswrd0" placeholder="Enter old Password" required>
    <br>
  <input type="password" name="setting_psswrd1" placeholder="Enter new Password" required>
  <br>
  <input type="password" name="setting_psswrd2" placeholder="Confirm Password" required>
  <br>
<input type="submit" name="settings_bttn" value="Update">
<?php echo "$error_script"; ?>

</form>

<h5>Delete Account</h5>
<form action="delete.php" method="POST">
<input type="submit" name="delete_bttn" value="DELETE">
</form>



</div>
