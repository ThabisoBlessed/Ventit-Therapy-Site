<?php
include("../../connectionfile/config.php");
include("../phpclasses/ProfileUser.php");
include("../phpclasses/Display.php");
include("../phpclasses/TextSms.php");


$max = 6; //Number of messages to load

$textobj =new TextSms($con,$_REQUEST['loggedInUser']);
echo $textobj->retrieveMenuSms($_REQUEST, $max);

?>
