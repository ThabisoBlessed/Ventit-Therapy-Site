<?php
//including the file that contains database connection
require 'config.php';
//animal name
$name= NULL;
//color as last name
$surname= NULL;
$username=NULL;
//reg passcode
$regpsswrd = NULL;
$regpsswrd2 = NULL;
//register date
$date = NULL;
//stores Error messages
$errArry = array();

if(isset($_POST['regbutton'])){

  //eliminate non characters
  $name= strip_tags($_POST['rname']);
  //eliminate white spaces
  $name= str_replace(' ', '', $name);
  //convert first letter to caps
  $name= ucfirst(strtolower($name));
  //retain name variable in memory
  $_SESSION['rname'] = $name;

  //eliminate non characters
  $surname= strip_tags($_POST['sname']);
  //eliminate white spaces
  $surname= str_replace(' ', '', $surname);
  //convert first letter to caps
  $surname= ucfirst(strtolower($surname));
  //retain name variable in memory
  $_SESSION['sname'] = $surname;

  //regpsswrd
  //eliminate non english characters
  $regpsswrd = strip_tags($_POST['rpsswrd']);
  $regpsswrd2 = strip_tags($_POST['rpsswrd2']);

//recent date
  $date = date("Y-m-d");


  //Check if  similar user exists
      $querrycheck = mysqli_query($con, "SELECT username FROM users WHERE firstname='$name' AND lastname='$surname'");

      //Querry rows returned
      $querryrows = mysqli_num_rows($querrycheck);

      if($querryrows > 0) {
        array_push($errArry, "Color and Animal combination already in use<br>");
      }
        //calculating if length of name is long enough
      if(strlen($name) > 25 || strlen($name) < 2) {
        array_push($errArry, "Your favourite color should be within 2 and 25 letters<br>");
      }

//calculating if length of surname is long enough
      if(strlen($surname) > 25 || strlen($surname) < 2) {
        array_push($errArry,  "Your favourite  animal should be between 2 and 25 characters<br>");
      }

//checking if passwords are equal
      if($regpsswrd != $regpsswrd2) {
        array_push($errArry,  "regpsswrds not similar<br>");
      }
      else {
        if(preg_match('/[^A-Za-z0-9]/', $regpsswrd)) {
          array_push($errArry, "Your regpsswrd can only contain english characters or numbers<br>");
        }
      }

      if(strlen($regpsswrd) > 30 || strlen($regpsswrd) < 5)
      {
        array_push($errArry, "Your regpsswrd must be betwen 5 and 30 characters<br>");
      }


      if(empty($errArry)) {
        $regpsswrd = md5($regpsswrd); //Encrypt regpsswrd before sending to database


        //Producing a user name for user
        $length = 4;
        $chararray = '01AB2EIJ37WXYZ8abc45defgPQ9RSTq0rstuhFGHi1jklm3no6pvwxyzC9D4KLMNOUV';
        $charLen = strlen($chararray);
        $stringgenerated = '';


        for ($i = 0; $i < $length; $i++)
        {
            $stringgenerated .= $chararray[rand(0, $charLen - 1)];
        }
        $username='User'."$stringgenerated";

        $userquery = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $myvar = 0;
        //if username exists add number to username
        while(mysqli_num_rows($userquery) != 0) {
          $myvar++;//increment variable
          //concatenating a number to my already existing variable
          $username = $username.$myvar;
          $userquery = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        //Selects number within  1 and 16
        $rand = rand(1, 16);

        $profile_pic = "Assets/images/profile_pics/defaults/$rand.png";

        $query=mysqli_query($con,"INSERT INTO users VALUES(NULL,'$name','$surname','$username','$regpsswrd','$date','$profile_pic','0','0','no',',')");
          //adding error string  to my array
        array_push($errArry, "<span style='color: #14279B;'>Setup Complete! Proceed to signin.</span><br>");


        $_SESSION['rname'] = NULL;
        $_SESSION['sname'] = NULL;



}

}



//if login button is pressed  send data to the database
if(isset($_POST['lgbttn'])) {
	$username=$_POST['generatedname'];
	//save variable in memory
	$_SESSION['generatedname'] = $username;
	//Unencrypt the password
	$regpsswrd = md5($_POST['psswrdlg']);

//check if user is registered
	$Dbasequery=mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$regpsswrd' AND user_closed='no'");
//if user is in dbase or not
	$lginquery = mysqli_num_rows($Dbasequery);

	if($lginquery == 1) {
		$row = mysqli_fetch_array($Dbasequery);
		$username = $row['username'];
//checkif accis closed or not
		$clsdquery = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND user_closed='yes'");
		if(mysqli_num_rows($clsdquery) == 1) {
			//query to open closed acc
			$reOpacc = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE username='$username'");
		}

		$_SESSION['username'] = $username;
		//after login redirect to index page
		header("Location: index.php");
		exit();
	}
	else {
		array_push($errArry, "wrong user name or regpsswrd<br>");
	}


}
				//remove rname and sname from memory
        $_SESSION['rname'] = "";
        $_SESSION['sname'] = "";



//erasing responses or posts

if(isset($_GET['commentId']))
		$commentId = $_GET['commentId'];

	if(isset($_POST['result'])) {
		if($_POST['result'] == 'true')
			$query = mysqli_query($con, "UPDATE posts SET deleted='yes' WHERE id='$commentId'");
	}






  //settings page
  if(isset($_POST['settings_bttn'])) {
    $setting_psswrd0 = strip_tags($_POST['setting_psswrd0']);
    $setting_psswrd1 = strip_tags($_POST['setting_psswrd1']);
    $setting_psswrd2 = strip_tags($_POST['setting_psswrd2']);

    $userdetails=mysqli_fetch_array(mysqli_query($con,"SELECT password FROM users WHERE username='$loggedInUser'"));
    $psswd=$userdetails['password'];

    if(md5($setting_psswrd0==$psswd))
    {
      if($setting_psswrd1==$setting_psswrd2)
      {
        if(strlen($setting_psswrd1) <5) {
            $error_script="<br><br>Passwords are too shot!!...<br><br>";
        }
        else {
          $settngpsswrd = md5($setting_psswrd1);
        mysqli_query($con, "UPDATE users SET password='$settngpsswrd' WHERE username='$loggedInUser'");
        $error_script="<br><br>Password updated!!...<br><br>";
        }

  //calcul
      }
      else
       {
        $error_script="<br><br>Passwords are not same!!...<br><br>";
      }
    }
    else
     {
      $error_script="<br><br>Current password is wrong!!...<br><br>";
    }




  }
  else {
    $error_script="<br><br>";
  }

  if(isset($_POST['delete_bttn'])) {
  {
  	header("Location:delete.php");
  }
}


if(isset($_POST['changePass'])) {

  $newpass = strip_tags($_POST['newpass']);
  $newpass1 = strip_tags($_POST['newpass1']);
  $name =$_POST['rname'];
  $name2 =$_POST['sname'];


  $sqldata=mysqli_query($con,"SELECT * FROM users WHERE firstname='$name' AND lastname='$name2'");
  $count=mysqli_num_rows($sqldata);

  if($count==1)
  {

  if($newpass==$newpass1)
  {

      if(strlen($newpass) <5)
      {
          $error_script="<br><br>Password is too shot!!...<br><br>";
      }
      else
       {
         echo "$newpass";
         $newpass=md5($newpass);
         echo "$newpass";
        mysqli_query($con, "UPDATE users SET password='$newpass' WHERE firstname='$name' AND lastname='$name2'");
        $error_script="<br><br>Password updated!!...<br><br>";
      }


  }
  else
   {
    $error_script="<br><br>Passwords are not same!!...<br><br>";
  }




}
else {
  $error_script="<br>No User like that!!...<br>";
}

  }

?>
