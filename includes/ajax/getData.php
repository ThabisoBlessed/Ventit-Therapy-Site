<?php

include("../../connectionfile/config.php");
include("../phpclasses/ProfileUser.php");
include("../phpclasses/Display.php");

//max load per page
$max=9;

$display=new Display($con,$_REQUEST['loggedInUser']);
$display->displayToScreen($_REQUEST,$max);
 ?>
