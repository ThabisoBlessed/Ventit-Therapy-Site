<?php
require 'connectionfile/header.php';
?>
 <style>
.maincontainer
{
margin-left:1.5rem;
margin-top: 5rem;
width: 70%;
}
.ptofileData
{
  margin: 5rem 10rem 0rem -1rem;
}
.poptrends
{
  margin-top:-3rem;
}
.poptrends a
{
  color: #F6EABE;

}

.poptrends a:hover
{
  color: #334756;
}

 </style>
<div class="row">
<div class="col-md-3 ">
<div class="maincontainer ">
<p class="popularWords">MY FRIENDS</p>
<hr>
  <div  class='poptrends'>
    <?php

   $sqldata=mysqli_query($con,"SELECT friend_array FROM users  WHERE username='$loggedInUser' ");
   	$row = mysqli_fetch_array($sqldata);

    $myFriends = explode (",", $row['friend_array']);


    	foreach($myFriends as $frnd)
      {
        echo "<a href='$frnd'>$frnd<br></a>";
      }
?>

</div>
</div>
</div>

<div class="col-md-9">
<?php

print('<div class="ptofileData">'.'<h4>Pending Requests</h4>');

//Checking the database if they are no  requests.
    if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM friend_requests WHERE user_to='$loggedInUser'"))==0)
    print("You have no prompts at the moment.");
    //if requests exist
    else {
          $makefriends=mysqli_query($con,"SELECT * FROM friend_requests WHERE user_to='$loggedInUser'");
        while($row=mysqli_fetch_array($makefriends))
        {
          $databy=$row['user_from'];
          $proffObj=new ProfileUser($con,$databy);

          echo $proffObj->returnName(). " sent you a request .";
          $databy_array=$proffObj->returnfriends();

            if(isset($_POST['accept'.$databy]))
            {

              $acceptfriend=mysqli_query($con,"UPDATE users SET friend_array=CONCAT(friend_array,'$databy,') WHERE username='$loggedInUser'");
              $acceptfriend=mysqli_query($con,"UPDATE users SET friend_array=CONCAT(friend_array,'$loggedInUser,') WHERE username='$databy'");

              $updateRequestsTable=mysqli_query($con,"DELETE FROM friend_requests WHERE user_to ='$loggedInUser' AND user_from='$databy'");
              echo "You are now friends!";
              header("Location:pendingReq.php");

            }
            if(isset($_POST['ignore'.$databy]))
            {

              $updateRequestsTable=mysqli_query($con,"DELETE FROM friend_requests WHERE user_to ='$loggedInUser' AND user_from='$databy'");
              header("Location:pendingReq.php");

            }

            ?>
            <div class='requestform'>
              <form action="pendingReq.php" method="POST">
                <input type="submit" name="accept<?php echo $databy; ?>"  id="accept_bttn" value="Accept">
                <input type="submit" name="ignore<?php echo $databy; ?>"  id="ignore_bttn" value="Ignore">
              </form>
</div>
            <?php

        }
      }
   ?>

</div>
</div>

</div>
