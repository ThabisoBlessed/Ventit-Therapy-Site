<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("connectionfile/header.php");

if(isset($_POST['datapost']))
{
  $display=new Display($con,$loggedInUser);

  $display->dataSavePost($_POST['datatext'],'none');

  header("Location:index.php");

}
?>

<div class="column">
<div class="User column" >
  <a href="<?php echo $loggedInUser; ?>"> <img class ="indeximg" src="<?php echo $userdetails['profile_pic']; ?>"> </a>


	<div class="Userdata">
			<?php
      echo "<span style='font-weight:bold;color: #345B63; font-size: 17px;'>$loggedInUser</span><br>";
      echo "Posts: " . $userdetails['num_posts']. "<br>";
			echo "Likes: " . $userdetails['num_likes'];
      ?>
</div>
</div>
<div class="caldiv ">
  <div class="maincontainer ">
  <p class="popularWords">Trending words</p>
  <hr>
    <div  class='poptrends'>
      <?php
/*
      $sqldata=mysqli_query($con,"SELECT * FROM popularWords ORDER BY occurances DESC LIMIT 6");


      foreach($sqldata as $trending)
      {
        $wrdtrending=$trending['name'];
        echo $wrdtrending.'<br>';


      }
*/
      ?>
  </div>
  </div>
	<div class="calendar calendar-first" id="calendar_first">
    <div class="calendar_header">
        <button class="switch-month switch-left"> <i class="fa fa-chevron-left"></i></button>
        <h2></h2>
        <button class="switch-month switch-right"> <i class="fa fa-chevron-right"></i></button>
    </div>
    <div class="calendar_weekdays"></div>
    <div class="calendar_content"></div>
	</div>


</div>



</div>
    <div class="centermain column">
      <form class="post_form" action="index.php" method="POST">
			<textarea name="datatext" style="display:none;" id="post_text" placeholder="Feeling like venting out something?"></textarea>
			<input type="submit" name="datapost" id="post_button" value="Post">
      </form>
    </div>

      <div class="postssection">
       <div class="dataarea"></div>
       <img id="waiting" src="Assets/images/icons/loading.gif">
      </div>






<script >
var loggedInUser = "<?php echo $loggedInUser; ?>";
jQuery(document).ready(function() {

  jQuery('#waiting').show();

  jQuery.ajax({
    url: "includes/ajax/getData.php",
    type: "POST",
    data: "page=1&loggedInUser=" + loggedInUser,
    cache:false,

    success: function(data) {

      jQuery('#waiting').hide();
      jQuery('.dataarea').html(data);
    }
  });
//scroll function same for header ,notifications ,sms menu
  jQuery(window).scroll(function() {
    var length = jQuery('.dataarea').height();
    var position = jQuery(this).scrollTop();
    var page = jQuery('.dataarea').find('.followingData').val();
    var dataAvailable = jQuery('.dataarea').find('.dataAvailable').val();

    if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && dataAvailable == 'false') {
      jQuery('#waiting').show();

      var ajaxReq = jQuery.ajax({
        url: "includes/ajax/getData.php",
        type: "POST",
        data: "page=" + page + "&loggedInUser=" + loggedInUser,
        cache:false,

          success: function(response) {
          jQuery('.dataarea').find('.followingData').remove();
          jQuery('.dataarea').find('.dataAvailable').remove();
          jQuery('#waiting').hide();
          jQuery('.dataarea').append(response);
        }
      });

    }
return false;

  });
  jQuery(window).scroll(function() {
    var length = jQuery('.dataarea').height();
    var position = jQuery(this).scrollTop();
    var page = jQuery('.dataarea').find('.followingData').val();
    var dataAvailable = jQuery('.dataarea').find('.dataAvailable').val();

    if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && dataAvailable == 'false') {
      jQuery('#waiting').show();

      var ajaxReq = jQuery.ajax({
        url: "includes/ajax/getData.php",
        type: "POST",
        data: "page=" + page + "&loggedInUser=" + loggedInUser,
        cache:false,

          success: function(response) {
          jQuery('.dataarea').find('.followingData').remove();
          jQuery('.dataarea').find('.dataAvailable').remove();
          jQuery('#waiting').hide();
          jQuery('.dataarea').append(response);
        }
      });

    }
return false;

  });

  jQuery(window).scroll(function() {
    var length = jQuery('.dataarea').height();
    var position = jQuery(this).scrollTop();
    var page = jQuery('.dataarea').find('.followingData').val();
    var dataAvailable = jQuery('.dataarea').find('.dataAvailable').val();

    if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && dataAvailable == 'false') {
      jQuery('#waiting').show();

      var ajaxReq = jQuery.ajax({
        //locate to this page
        url: "includes/ajax/getData.php",
        //posting data to another page
        type: "POST",
        //sending the page data with loggedInUser
        data: "page=" + page + "&loggedInUser=" + loggedInUser,
        //no tempory memory
        cache:false,
        //on success do this
          success: function(returned) {
            //remove this class
          jQuery('.dataarea').find('.followingData').remove();
          //remove this class
          jQuery('.dataarea').find('.dataAvailable').remove();
          //waitin image loading hide
          jQuery('#waiting').hide();
          //append msg at the end of posts
          jQuery('.dataarea').append(returned);
        }
      });

    }
return false;

  });

});

</script>
</div>

</body>
  <footer class="bfooter">

    <a href="#" class="back-to-top"><i class="fa fa-arrow-circle-up"></i></a>

  </footer>

  </html>
