<?php
session_start();
//terminates the session and destroys session variables
session_destroy();
header("Location:rlogin.php")
 ?>
