<?php

include("../../connectionfile/config.php");
include("../phpclasses/ProfileUser.php");
include("../phpclasses/Display.php");
include("../phpclasses/Alerts.php");
//max load per page
$max=9;

$display=new Display($con,$_REQUEST['loggedInUser']);
$display->displayProfileToScreen($_REQUEST,$max);
 ?>
