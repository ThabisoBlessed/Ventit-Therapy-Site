<?php
class TextSms
{
  //class TextSms atributes made private
  private $owner ,$con;

  //TextSms constructor
  public function __construct($dbase,$proffuser)
  {
    //assigning database connection to the con attribute
    $this->con=$dbase;
    //creating new object to get user data
    $this->owner=new ProfileUser($dbase,$proffuser);
  }

public function returnCurrentUser()
{
  $name = $this->owner->returnName();

  //tenary operation  to check if user exists or not
  $nouser=(mysqli_num_rows(mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE
    user_to='$name' OR user_from='$name' ORDER BY id DESC LIMIT 1")) == 0)?false:"";

    if($nouser==false)
    return false;


  $row = mysqli_fetch_array(mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE
    user_to='$name' OR user_from='$name' ORDER BY id DESC LIMIT 1"));
//return the owner of the text.
  ($row['user_to'] != $name)?$row['user_to']:$row['user_from'];

  }


  public function currentSms($acc_owner, $participant) {
    $smsArray = array();

    $myQuery = mysqli_query($this->con, "SELECT  user_to, body,date FROM messages WHERE (user_to='$acc_owner'
     AND user_from='$participant' ) OR (user_to='$participant' AND user_from='$acc_owner') ORDER BY id DESC LIMIT 1");

    $sqldata = mysqli_fetch_array($myQuery);
    $sender = ($sqldata['user_to'] == $acc_owner) ? "They said: " : "You said: ";

        $currentTime=date("Y-m-d H:i:s");
        $postdate=new DateTime($sqldata['date']);
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
        else if($period->s<60)
        {
          $clockScript= "just now";
        }

    array_push($smsArray, $sender);
    array_push($smsArray, $sqldata['body']);
    array_push($smsArray, $clockScript);

    return $smsArray;
  }


  public function dispatchSms($dataTo, $paragraph, $time) {

  		if($paragraph != "") {
  			$name = $this->owner->returnName();
  			$sqlidata = mysqli_query($this->con, "INSERT INTO messages VALUES(NULL, '$dataTo', '$name', '$paragraph', '$time', 'no', 'no', 'no')");
  		}
  	}


    public function retrieveSms($sender) {
    		$name = $this->owner->returnName();
    		$info = "";

    		$sqldata = mysqli_query($this->con, "UPDATE messages SET opened='yes' WHERE user_to='$name' AND user_from='$sender'");

    		$sqlidata = mysqli_query($this->con, "SELECT * FROM messages WHERE (user_to='$name' AND user_from='$sender') OR (user_from='$name' AND user_to='$sender')");

    		while($row = mysqli_fetch_array($sqlidata)) {
    			$dataTo = $row['user_to'];
    			$dataFrom = $row['user_from'];
    			$paragraph = $row['body'];

            //styling the textsms message div  if im the sender mytexts will be blue else green.
    			$container = ($dataTo == $name) ? "<div class='message' id='receiver'>" : "<div class='message' id='sender'>";
    			$info = $info . $container . $paragraph . "</div><br><br>";
    		}
    		return $info;
    	}

      public function retrieveMenuSms($info, $max) {

        //receiving ajax data sent from smsMenu.php

        //tabNUm  gets the page number of the messages
    		$tabNum = $info['page'];
        //$neme holds the account owner name
    		$name = $this->owner->returnName();
        //mystr holds an empty string
    		$mystr = "";
        //$chat array is also empty
    		$chat = array();

        $begin=($tabNum == 1)?0:($tabNum - 1) * $max;

    		mysqli_query($this->con, "UPDATE messages SET viewed='yes' WHERE user_to='$name'");
        //Getting all messages of the user thus logged in ,Ordered in DESC order starting From recent ones.
    		$sqldata = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$name' OR
           user_from='$name' ORDER BY id DESC");

    		while($row = mysqli_fetch_array($sqldata)) {
    			$smsSender = ($row['user_to'] != $name) ? $row['user_to'] : $row['user_from'];

    			if(!in_array($smsSender, $chat))
    				array_push($chat, $smsSender);

    		}
        //keeps count of the messages that havent been viewed
    		$viewedSms = 0;
        //count begins at one
    		$tally = 1;
        //foreach loop to access array chat
    		foreach($chat as $profilename) {

    			if($viewedSms++ < $begin)continue;

            if($tally > $max)break; else $tally++;


    			$notViewed = mysqli_query($this->con, "SELECT opened FROM messages WHERE user_to='$name' AND
            user_from='$profilename' ORDER BY id DESC");
    			$row = mysqli_fetch_array($notViewed);
    			$cssbackground = (isset($row['opened'])&&$row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";


          $proffObj=new ProfileUser($this->con,$profilename);
    			$newSms = $this->currentSms($name, $profilename);
          //checking the length of the sms in the menu tab bar
    			if(strlen($newSms[1]) >11)
          //if its its greater than 11 characters  trim the string add loading dots
          $separaters= "...";
          else
          //else set empty space
          $separaters= "";
          //split the strings
    			$separate = str_split($newSms[1], 11);
          //add separators
    			$separate = $separate[0] . $separaters;

    			$mystr .= "<a href='textsms.php?you=$profilename'>

        <div class='accountOwnerMenuTab' style='" . $cssbackground . "'>
        <div class='alertin'>
	        <img src='" . $proffObj->accountdisplayImage() . "' >" . $proffObj->returnName() . "
          <span > " . $newSms[2] . "</span>
          <div class='accountOwnertext' ><span id='p2'>" . $newSms[0] . $separate . "</span></div></div></div></a>";
    		}

    		//if displayed
    		$mystr .= ($tally > $max)?
    			"<input type='hidden' class='followingMenuData' value='" . ($tabNum + 1) . "'><input type='hidden'
          class='nothingToshow' value='false'>":"<input type='hidden' class='nothingToshow' value='true'>
          <span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFinished displaying!..</span>";

          //return the string
    		return $mystr;
    	}

      public function notViewedSms() {
        $name = $this->owner->returnName();
        $sqldata = mysqli_query($this->con, "SELECT * FROM messages WHERE viewed='no' AND user_to='$name'");
        return mysqli_num_rows($sqldata);
}




}
?>
