<?php
include("../../connectionfile/config.php");
include("../phpclasses/ProfileUser.php");
include("../phpclasses/Alerts.php");



$max = 6; //Number of messages to load

$textobj =new Alerts($con,$_REQUEST['loggedInUser']);
echo $textobj->retrieveMenuAlerts($_REQUEST, $max);

?>
