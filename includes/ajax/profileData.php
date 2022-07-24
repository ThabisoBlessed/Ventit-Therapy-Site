<?php
include("../../connectionfile/config.php");
include("../phpclasses/ProfileUser.php");
include("../phpclasses/Display.php");
include("../phpclasses/Alerts.php");


if(isset($_POST['textform'])) {

	$display = new Display($con, $_POST['dataformby']);
	$display->dataSavePost($_POST['textform'], $_POST['dataformto']);
}

?>
