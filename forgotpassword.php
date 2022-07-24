<?php
require 'connectionfile/reg.php';
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="favicon.ico">
    <title> Vent-It</title>
    <link rel="stylesheet" href="Assets/css/styles.css">
  </head>
  <body>


    <div class="ptofileData" id ="ptofileData">
      <form action="forgotpassword.php" method="POST" >
    			<input type="text" name="rname" placeholder="Enter Favourite Color" value"" required>
          <br>
    			<input type="text" name="sname" placeholder="Enter Favourite Animal" required>
          <br>
    			<input type="password" name="newpass" placeholder="Set new Password" required>
    			<br>
    			<input type="password" name="newpass1" placeholder="Confirm Password" required>
          <br>
          <input type="submit" name="changePass" value="Done">
          <?php echo "$error_script"; ?>
          <a href="rlogin.php"  >Sign in here!</a><br>
    </form>
  </div>

</body>
</html>
