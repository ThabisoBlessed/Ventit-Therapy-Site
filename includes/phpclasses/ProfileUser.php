<?php

class ProfileUser{
  private $owner ,$con;

  public function __construct($con,$proffuser)
  {
    $this->con=$con;
    $profiledata =mysqli_query($con,"SELECT * FROM users WHERE username ='$proffuser'");

    $this->owner=mysqli_fetch_array($profiledata);

  }

  public function returnName()
  {
    return $this->owner['username'];
  }
  public function newfriendCount() {
		 $name = $this->owner['username'];
     return mysqli_num_rows(mysqli_query($this->con, "SELECT * FROM friend_requests WHERE user_to='$name'"));
	}

  	public function accountdisplayImage() {
  		$name = $this->owner['username'];
  		$mySqli = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username='$name'");
  		$myarray = mysqli_fetch_array($mySqli);
  		return $myarray['profile_pic'];
}

  public function returnPostCounter()
  {
    $name= $this->owner['username'];
    $datasql=mysqli_query($this->con,"SELECT num_posts FROM users WHERE username='$name'");
    $row=mysqli_fetch_array($datasql);
    return $row['num_posts'];
  }


  public function CheckifOpen()
  {
    $name=$this->owner['username'];
    $query=mysqli_query($this->con,"SELECT user_closed FROM users WHERE username='$name'");
    $row=mysqli_fetch_array($query);

      if($row['user_closed']=='yes')
      return true;
      else
        return false;
}

public function wasRequested($userto)
{
  $name=$this->owner['username'];
  $query=mysqli_query($this->con,"SELECT * FROM friend_requests WHERE user_to='$userto' AND user_from= '$name'");


    if(mysqli_num_rows($query)>0)
    return true;
    else
      return false;

}
public function areCompanions($name) {
		$separator = "," . $name . ",";

		if((strstr($this->owner['friend_array'], $separator) || $name == $this->owner['username'])) {
			return true;
		}
		else {
			return false;
		}
	}
public function Requested($name)
{
  $userto=$this->owner['username'];
  $query=mysqli_query($this->con,"SELECT * FROM friend_requests WHERE user_to='$userto' AND user_from= '$name'");


    if(mysqli_num_rows($query)>0)
    return true;
    else
      return false;

}

public function returnfriends()
{
  $username=$this->owner['username'];
  $query=mysqli_query($this->con,"SELECT friend_array FROM users WHERE username='$username'");
  $row=mysqli_fetch_array($query);

  return $row['friend_array'];
}



public function terminatefriend($name)
{
  $username=$this->owner['username'];
  $query=mysqli_query($this->con,"SELECT friend_array FROM  users WHERE username='$name'");
  $row=mysqli_fetch_array($query);
  $myArray=$row['friend_array'];
  $updatedArray=str_replace($name.",","",$this->owner['friend_array']);
  $terminate_friendship=mysqli_query($this->con,"UPDATE users SET friend_array='$updatedArray' WHERE username ='$username'");

  $updatedArray=str_replace($this->owner['username'].",","",$myArray);
  $terminate_friendship=mysqli_query($this->con,"UPDATE users SET friend_array='$updatedArray' WHERE username ='$name'");
}

public function forwadRequest($directto)
{
  $from=$this->owner['username'];
  $request=mysqli_query($this->con,"INSERT INTO friend_requests VALUES(NULL,'$directto','$from') ");
}


}

 ?>
