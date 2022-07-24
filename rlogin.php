<!--DOCTYPE html-->
<html>
<head>
  <!--website title-->
	<title> Vent-It</title>
  <!--favicon which contains the website logo acts as the title image-->
  <link rel="icon" href="favicon.ico">
  <!--jquery shortened version of javascript-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!--bootstrap frame work makes webpages responsive where we view them ina pc or mobile phone-->
	<script src="Assets/js/bootstrap.js"></script>
  <!--javascript bootbox for the toggle function-->
	<script src="Assets/js/bootbox.min.js"></script>
  <!--this link gives us personalized icons -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!--linking my stylesheet which decorates my webpage-->
	<link rel="stylesheet" href="Assets/css/rstyles.css">

<script >
  //script that hides the login form and shows the signup form
  $(document).ready(function(){
  	//On click signup, hide login and show registration form
  	$("#createacc").click(function() {
  		$("#logform").slideUp("slow", function(){
  			$("#regform").slideDown("slow");
  		});
  	});
  	//On click signup, hide registration and show login form
  	$("#signin").click(function() {
  		$("#regform").slideUp("slow", function(){
  			$("#logform").slideDown("slow");
  		});
  	});
});
</script>
</head>
<body>
<?php
  //setting up connection to the database by calling the file reg.php
  require 'connectionfile/reg.php';
  //if regbutton value is set and the button is pressed hide the sign in form
	if(isset($_POST['regbutton']))
	{
    //printing script as php which is later translated to javascript code
		echo '<script>
			$(document).ready(function() {
			$("#logform").hide();
			$("#regform").show();
		});</script>';
	}
	$name=$username;
?>
  <section id="reg">
  	<!--register div contains login form-->
  <div class="register">
  	<!--login_box div contains login form-->
  <div class="login_box">
  <!--container that holds the header of the form-->
  		<div class="login_header container-fluid">
  			<!--title of the form  h3 level header-->
  			<h3>Vent-It</h3>
  			Login or Signup!
  		</div >
  <!--signin form-->
  	<div id="logform">
  		  <!--sends the data to the rlogin.php  page method POST sends data to this page -->
  		<form action="rlogin.php" method="POST">
  			  <!--username session variables make it possible to display user Username field text input-->
  			<input type="text" name="generatedname" placeholder="Username" value="<?php
  			//if user name that was generated is set  print it in the input field
  			$username =(isset($_SESSION['generatedname'])) ? $_SESSION['generatedname'] : "";
  				print($username);?>" required>
  			<br>
  			<!--the input type is password which means user wont be able to view password entered-->
  			<input type="password" name="psswrdlg" placeholder="Password" required>
  			<!--new line tag prevents the input fields being in the same line-->
  			<br>
  			<?php
  			//in_array stores error strings if user first name is less or more than the requeired characters.
  			$nme =(in_array("wrong user name or regpsswrd<br>", $errArry))?
  			"wrong user name or Password<br>" : "";
  			print($nme);
   			echo '
  			<!--input is of type submit -Button-->
  			<input type="submit" name="lgbttn" value="Login">
  			  <!--link which takes you to the sign up form-->
  			<br><a href="#" id="createacc" class="createacc">No account? or  Forgot Password! </a><br>
  			'; ?>
  		</form>
  		<!--end of logform div-->
  </div>
  <!--signup form div-->
  <div id="regform">
  <!--sends the data to the rlogin.php  page method POST sends data to this page -->
  		<form action="rlogin.php" method="POST" >
  			<!--rname session variables make it possible to display user registername field text input-->
  			<input type="text" name="rname" placeholder="Favourite Color" value="" required>
  			<br>
  			<?php
  			//in_array stores error strings if user first name is less or more than the requeired characters.
  			$nme =(in_array("Your favourite color should be within 2 and 25 letters<br>", $errArry)) ?
  			"Your favourite color should be within 2 and 25 letters<br>" : "";
  			print($nme);
  		 ?>
  		 <!--same as the rname variaable-->
  			<input type="text" name="sname" placeholder="Favourite Animal" value="<?php
  			//if the rname variable is set
  			$U_name =(isset($_SESSION['sname'])) ? $_SESSION['sname'] : "";
  				print($U_name);

  				?>" required>
  			<!--sets the input fields in different lines  -->
  			<br>
  			<!--new line -->
  			<?php //in_array stores error strings if user first name is less or more than the requeired characters.
  			$x =(in_array("Your favourite  animal should be between 2 and 25 characters<br>", $errArry)) ?
  			"Your favourite  animal should be between 2 and 25 characters<br>" : "";
  				print( $x);
  				//the input type is password which means user wont be able to view password entered	new line
  				echo'
  			<input type="password" name="rpsswrd" placeholder="Password" required><br><input type="password" name="rpsswrd2" placeholder="Confirm Password" required>
  			<br>';
  			//the input type of password-->

  				$b = (in_array("Color and Animal combination already in use<br>", $errArry)) ? "Color and Animal
  		 		combination already in use<br>" : "";
    			print ( $b);

  			switch (true) {
  				case (in_array("regpsswrds not similar<br>", $errArry)):
  						print("Passwords not similar<br>");
  						break;

  				case (in_array("Your regpsswrd can only contain english characters or numbers<br>", $errArry)):
  						print("Your Password can only contain english characters or numbers<br>");
  						break;

  				case (in_array("Your regpsswrd must be betwen 5 and 30 characters<br>", $errArry)):
  						print("Your Password must be betwen 5 and 30 characters<br>");
  						break;
  					}

  					echo'<input type="submit" name="regbutton" value="Register"><br>';

						$a = (in_array("<span style='color: #14279B;'>Setup Complete! Proceed to signin.</span><br>", $errArry))
						 ? "<span class='namelink'><br>Proceed to  login , your username is :$name</span><br>" :"";
						 print ($a);
  					print( '<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a><br><br>
  		      <a href="forgotpassword.php" >Forgot Password!</a>');
  			?>
  </form>
  <!--end of regform-->
  </div>
  <!---->
  </div>
  <!--end of form div-->
  </div>
  <!--end of login section-->

<section id="cards_abt">
	<h1 class="page-title"> Ready to get started ?</h1>


	  <div class="wrap">
 			<div class="card-wrapper first">
 				<div class="front-card">
	          <img src="Assets/images/images/im5.jpg">
	          <h2 style="padding-top: 20px;"> Share your thought</h2>
	        <p>connect and brainstorm annonymously with people from different cultures, backgrounds and races around the world.
	        </p>

	      </div>

	      <div class="back-card">
	        <h2> Vent-it </h2>
	        <a href="#reg">Join Us </a>
	      </div>
      </div>
      <div class="card-wrapper second">

	      <div class="front-card">
	          <img src="Assets/images/images/im3.jpg">
	          <h2 > Pros</h2>
	        <p>Suitable for theraputic venting, speak your truth anonymously. </p>
	      </div>

	      <div class="back-card">
	        <h2> Cons </h2>
	        <p>The services provided by Vent-It come from people who are not licensed by and are not experts.</p>
	      </div>
	    </div>

	    <div class="card-wrapper third">

	      <div class="front-card">
	          <img src="Assets/images/images/im4.png">
	        <h2> About Vent-it  </h2>
	        <p>Social-Networking system where people share stories or traumas they are afraid to share on other social networking platforms anonymously.</p>
	      </div>

	      <div class="back-card">
	        <h2>About Us</h2>
	        <p>Vent-it  helps users connect with different people around the world in a digital way, without revealing their identity.</p>
	      </div>

</div>
</div>
</section>

</body>

<footer class="bfooter">
	<a href="#" class="back-to-top"><i class="fa fa-arrow-circle-up"></i></a>
	<p>Vent It designed and Powered by  Thabiso Blessed Ngulube</a>.</p>
	 <p class="copyright">Vent It © 2021</p>

</footer>

</html>
