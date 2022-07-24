<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'config.php';
include("includes/phpclasses/ProfileUser.php");
include("includes/phpclasses/Display.php");
include("includes/phpclasses/TextSms.php");
include("includes/phpclasses/Alerts.php");


if(isset($_SESSION['username']))
{
	$loggedInUser = $_SESSION['username'];
	$detailsquery = mysqli_query($con, "SELECT * FROM users WHERE username='$loggedInUser'");
	$userdetails = mysqli_fetch_array($detailsquery);

}
else
{
	header("Location:rlogin.php");
}
?>
 <html lang="en" dir="ltr">
   <head>

		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
     <!-- Seo  tips trying to make my web page visible online -->
     <meta charset="utf-8">
     <meta name="description" content="A platform for people suffering from post traumas or people who want to vent out something anonymously.">
     <meta name="keywords" content="Vent, Anonymously, Trauma,Depression,Online ,chat">
     <meta name="author" content="Nampande Sibana">

     <title>Vent-It</title>
      <!-- my_scripts -->

				<script src="Assets/js/emojionearea.min.js"> </script>
				<script src="Assets/js/popper.js"></script>
				<script src="Assets/js/bootstrap.min.js"></script>
				<script src="Assets/js/bootbox.min.js"></script>
				<script src="Assets/js/main.js"></script>
				<script src="Assets/js/ventit.js"></script>

		 		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

       <!-- my_stylesheets -->

       <link rel="icon" href="favicon.ico">
       <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
			 <link rel="stylesheet" type="text/css" href="Assets/css/bootstrap.css">
			 <link rel="stylesheet" href="Assets/css/emojionearea.min.css" >
			 <link rel="stylesheet" type="text/css" href="Assets/css/style.css">
			 <link rel="stylesheet" type="text/css" href="Assets/css/styles.css">


		 </head>


<body>

    <header class="fixed-top headclass">

    <!-- Nav Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark container-fluid"  id="title">

		<?php
				$textobj = new TextSms($con, $loggedInUser);
					$sms_count = $textobj->notViewedSms();
					$alertobj = new Alerts($con, $loggedInUser);
					$alert_count = $alertobj->return_notViewedAlerts();
					$friendobj = new ProfileUser($con, $loggedInUser);
					$friendcount = $friendobj->newfriendCount();
					?>

        <a class="logo navbar-brand" href="index.php">Vent-It Feed </a>
        <form class="navbar-brand" action="displayLiveSearch.php" method="GET" name="liveData">
       <input type="liveData"  onkeyup="formData(this.value)"name="q" placeholder="Search here ..." autocomplete="off">
       <i class="searchbtn fa fa-search"></i>
      </form>

  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class=" navbar-nav ml-auto">
            <li class="nav-item ">
            <a class="usernav" href="<?php echo $loggedInUser;?>"> <?php echo $userdetails['username'];?></a>
            </li>
              <li class="nav-item">
                  <a  class="nav nav-link" href="index.php"><i class="fa fa-home fa-lg"></i></a>
              </li>
              <li class="nav-item">
                  <a class="nav nav-link" href="javascript:void(0);" onClick ="getSmsData('<?php echo $loggedInUser;?>','sms')"><i class="fa fa-envelope fa-lg"></i>

								<?php
									if($sms_count > 0)
									 echo '<span class="alerter" id="textnotViewed">'.$sms_count.'</span>';
									?>
								</a>
              </li>
              <li class="nav-item">
                  <a class="nav nav-link" href="javascript:void(0);" onClick ="getSmsData('<?php echo $loggedInUser;?>','alerts')">
										<i class="fa fa-bell fa-lg"></i>
									<?php
										if($alert_count > 0)
										 echo '<span class="alerter" id="notViewed">' . $alert_count . '</span>';
										?>
										</a>
              </li>

               <li class="nav-item">
                  <a class="nav nav-link" href="pendingReq.php">
										<i class="fa fa-users fa-lg"></i>

									<?php
										if($friendcount > 0)
										 echo '<span class="alerter" id="notViewed">' . $friendcount . '</span>';
										?>
									</a>

              </li>

               <li class="nav-item">
                   <a class="nav nav-link" href="settings.php"><i class="fa fa-cog fa-lg"></i></a>
              </li>
              <li class="nav-item">
                  <a class="nav nav-link" href="logout.php"><i class="fa fa-sign-out fa-lg"></i></a>
             </li>

          </ul>
        </div>
    </nav>

		<div class="dataRetrieved"></div>
		<div class="lowertab"></div>

		<div class="smsnotificationScreen" style="height:0px;"></div>
		<input type="hidden" id="smsdatascreen" value="">



</header>




<script >
var loggedInUser = '<?php echo $loggedInUser; ?>';

		jQuery(document).ready(function() {

			jQuery('.smsnotificationScreen').scroll(function() {
				var inner_height = jQuery('.smsnotificationScreen').innerHeight();
				var scroll_top = jQuery('.smsnotificationScreen').scrollTop();
				var page = jQuery('.smsnotificationScreen').find('.followingMenuData').val();
				var noMoreData = jQuery('.smsnotificationScreen').find('.nothingToshow').val();

				if ((scroll_top + inner_height >= jQuery('.smsnotificationScreen')[0].scrollHeight) && noMoreData == 'false') {

					var menuTab;
					var type = jQuery('#dropdown_data_type').val();


					if(type == 'alerts')
						menuTab = "smsAlerts.php";
					else if(type = 'sms')
						menuTab = "smsMenu.php"


					var ajaxReq = jQuery.ajax({
						url: "includes/ajax/" + menuTab,
						type: "POST",
						data: "page=" + page + "&loggedInUser=" + loggedInUser,
						cache:false,

						success: function(response) {
							jQuery('.smsnotificationScreen').find('.followingMenuData').remove();
							jQuery('.smsnotificationScreen').find('.nothingToshow').remove();


							jQuery('.smsnotificationScreen').append(response);
						}
					});

				}

				return false;

			});


		});


</script>
<div class="wrapper">
