<?php

class Alerts
{
  private $owner ,$con;
  public function __construct($con,$proffuser)
  {
    $this->con=$con;
    $this->owner=new ProfileUser($con,$proffuser);
  }

  public function return_notViewedAlerts() {
    $name = $this->owner->returnName();
    $sqldata = mysqli_query($this->con, "SELECT * FROM notifications WHERE viewed='no' AND user_to='$name'");
    return mysqli_num_rows($sqldata);
}

public function retrieveMenuAlerts($info, $max)
{
  $tabNum = $info['page'];
  $name = $this->owner->returnName();
  $mystr = "";


  if($tabNum == 1)
    $begin = 0;
  else
    $begin = ($tabNum - 1) * $max;

  $OpenedSql = mysqli_query($this->con, "UPDATE notifications SET viewed='yes' WHERE user_to='$name'");

  $sqldata = mysqli_query($this->con, "SELECT * FROM notifications WHERE user_to='$name'  ORDER BY id DESC");


  		if(mysqli_num_rows($sqldata) == 0) {
  			echo "No notifications at the moment!";
  			return;
  		}

  $viewedSms = 0;
  $count = 1;

  while($row = mysqli_fetch_array($sqldata)) {

    if($viewedSms++ < $begin)
      continue;

    if($count > $max)
      break;
    else
      $count++;


			$DataFrom = $row['user_from'];

			$sqlQuery = mysqli_query($this->con, "SELECT * FROM users WHERE username='$DataFrom'");
			$ownerDetails = mysqli_fetch_array($sqlQuery);

      $currentTime=date("Y-m-d H:i:s");
      $postdate=new DateTime($row['datetime']);
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


    $Viewed = $row['opened'];
    $style = (isset($row['opened'])&&$row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";


    $mystr .= "<a href='".$row['link']."'>
        <div class='accountOwnerMenuTab' style='" . $style . "' >
        <div class='alertin'>
	         <img src='" . $ownerDetails['profile_pic'] . "'>
                      		" . $clockScript . "
                      <div class='accountOwnertext' >

                    <span id='p2'>" . $row['message'] . "</span>
									</div>
                  </div>
                      </div>
              </a>";
  }


  //if displayed
  if($count > $max)
    $mystr .= "<input type='hidden' class='followingMenuData' value='" . ($tabNum + 1) . "'><input type='hidden'
    class='nothingToshow' value='false'>";
  else
    $mystr .= "<input type='hidden' class='nothingToshow' value='true'> <p style='text-align: center;'>
    No more notifications to load!</p>";

  return $mystr;

}
public function addAlert($postId, $dataTo, $classification) {

  $name = $this->owner->returnName();

  $postTime = date("Y-m-d H:i:s");

  switch($classification) {
    case 'comment':
      $mystr = $name . " commented on your post";
      break;
    case 'account_Owner':
      $mystr = $name . " posted on your profile";
      break;
    case 'friendresponse':
      $mystr = $name . " commented on a post you commented on";
      break;
    case 'profile_comment':
      $mystr = $name . " commented on your profile post";
      break;
  }

  $connection = "display.php?id=" . $postId;

  $insert_query = mysqli_query($this->con, "INSERT INTO notifications
    VALUES(NULL, '$dataTo', '$name', '$mystr', '$connection', '$postTime', 'no', 'no')");

}


}
?>
