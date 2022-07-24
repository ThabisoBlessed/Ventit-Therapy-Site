
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Assets/css/styles.css">
  </head>
  <body>

 <?php
 //including the neccesary files
    require 'connectionfile/config.php';
    include("includes/phpclasses/ProfileUser.php");
    include("includes/phpclasses/Display.php");
    include("includes/phpclasses/Alerts.php");

    (isset($_SESSION['username']))?$loggedInUser = $_SESSION['username']:header("Location:register.php");
    
    ?>

	<script>
		function toggle() {
			var dtaVar = document.getElementById("response_area");

      if(dtaVar.style.display=="block")
      dtaVar.style.display="none";

      else
      dtaVar.style.display="block";
		}
	</script>

<?php

    if(isset($_GET['displayID']))
    {
      $postId=$_GET['displayID'];

    }

    $datasql=mysqli_query($con,"SELECT added_by,user_to FROM  posts WHERE id='$postId'");
    $row=mysqli_fetch_array($datasql);
    $dataTo=$row['added_by'];
    $userTo=$row['user_to'];
    //if its set
    if(isset($_POST['responseData'.$postId]))
    {
      //the text from the input form
      $responseparagraph=$_POST['responseparagraph'];
      //remove all non charaters
      $responseparagraph=mysqli_escape_string($con,$responseparagraph);
      //get the current date
      $currentDate=date("Y-m-d H:i:s");
      //submit post to database
      $addsql=mysqli_query($con,"INSERT INTO comments VALUES(NULL,'$responseparagraph','$loggedInUser','$dataTo','$currentDate',
        'no','$postId')");


		if($dataTo != $loggedInUser) {
      //creatint an alert to send alert comment
			$alert = new Alerts($con, $loggedInUser);
      //using the alert object to call the addAlert function in class alert
			$alert->addAlert($postId, $dataTo, "comment");
		}

    if($userTo != 'none'&& $userTo != $loggedInUser)
    {
      //creatint an alert to send alert comment
			$alert = new Alerts($con, $loggedInUser);
      //using the alert object to call the addAlert function in class alert
			$alert->addAlert($postId, $userTo, "profile_comment");
		}


    $retrieveResponses =mysqli_query($con,"SELECT * FROM comments WHERE post_id='post'");
    $alerted = array();
    //while loop continues as long as they are still responses
      while($row = mysqli_fetch_array($retrieveResponses))
       {
         //if the post owner exists in array a
      if($row['posted_by']!=$dataTo && $row['posted_by']!=$userTo && $row['posted_by']!=$loggedInUser&& !in_array($row['posted_by'],$alerted))
      {
        //creatint an alert to send alert comment
      $alert = new Alerts($con, $loggedInUser);
        //using the alert object to call the addAlert function in class alert
      $alert->addAlert($postId, $row['posted_by'], "friendresponse");
      //storing alerts in alerted
      array_push($alerted,$row['posted_by']);
      }

      }}
?>
    <form action="responses.php?displayID=<?php echo $postId; ?>" class="responseform" name="responseData<?php echo $postId; ?>"
      method="POST">
    <textarea name="responseparagraph" ></textarea>
    <input type="submit" name="responseData<?php echo $postId;?>" value="Respond">
    </form>

        <?php
            $sqldata=mysqli_query($con,"SELECT * FROM comments WHERE post_id='$postId' ORDER BY id ASC");
            $count =mysqli_num_rows($sqldata);

            if($count!=0)
            {
              while($sqlarray=mysqli_fetch_array($sqldata))
              {
                $paragraph=$sqlarray['posts_body'];
                $datato=$sqlarray['posted_to'];
                $databy=$sqlarray['posted_by'];
                $timeofresponse=$sqlarray['date_added'];



                $currentTime=date("Y-m-d H:i:s");
                $postdate=new DateTime($timeofresponse);
                $todayDate=new DateTime($currentTime);
                $period=$postdate->diff($todayDate);


                    if($period->y>=1)
                    {
                      if($period==1)
                      $clockScript=$period->y. " year ago";
                      else
                      $clockScript=$period->y. " years ago";
                    }
                    else if($period->m>=1)
                    {
                      if($period->d==0)
                      $days="ago";
                      else if($period->d==1)
                      $days=$period->d. " day ago";
                      else
                      $days=$period->d ." days ago ";

                      if($period->m==1)
                      $clockScript=$period->m. " month" .$days;
                      else
                      $clockScript=$period->m." month".$days;
                    }
                    else if ($period->d>=1)
                    {
                      if($period->d==1)
                      $clockScript="Yesterday";
                      else
                      $clockScript=$period->d ." days ago ";

                    }
                    else if($period->h>=1)
                    {
                      if($period->h==1)
                      $clockScript=$period->h . " hour ago";
                      else
                      $clockScript=$period->h ." hours ago ";


                    }
                    else if($period->i>=1)
                    {
                      if($period->i==1)
                      $clockScript=$period->i. " minute ago";
                      else
                      $clockScript=$period->i ." minutes ago ";

                    }
                    else if($period->s<30)
                    {
                      if($period->s==1)
                      $clockScript= "just now";
                      else
                      $clockScript=$period->s ." seconds ago ";


                    }
                    $proffObj=new ProfileUser($con,$databy);
                    ?>

                    <div class="response_area">
                      <a href="<?php echo $databy; ?>" target="_parent" ><img src="<?php echo $proffObj->accountdisplayImage();?>" style="float:left;" height="40";margin-top:"0px";</a>
                      <a href="<?php echo $databy; ?>" target="_parent" ><b><?php echo  $proffObj->returnName();?></a>
                        &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $clockScript."<br>".$paragraph;?>
                        <hr>
                    </div>


                    <?php

                    }
                  }
                    else echo "<p style='text-align:center;'><br><br>Nothing to display! </p>";

                    echo'</body></html>';?>
