<?php
require 'connectionfile/header.php';

if(isset($_GET['profile_username']))
{
  $textobj =new TextSms($con,$loggedInUser);
  $profileName=$_GET['profile_username'];
  $proff_query=mysqli_query($con,"SELECT * FROM users WHERE username='$profileName'");
  $proffArray=mysqli_fetch_array($proff_query);
}

if(isset($_POST['terminateRelation']))
{
  $proffObj=new ProfileUser($con,$loggedInUser);
  $proffObj->terminatefriend($profileName);
}

if(isset($_POST['makeRelation']))
{
  $proffObj=new ProfileUser($con,$loggedInUser);
  $proffObj->forwadRequest($profileName);
}

if(isset($_POST['respondRequest']))
{
  header("Location:pendingReq.php");
}

if(isset($_POST['sms']))
{
  if(isset($_POST['smsText']))
  {
    $paragraph=mysqli_real_escape_string($con,$_POST['smsText']);
    $time=date('Y-m-d H:i:s');
    $textobj->dispatchSms($profileName,$paragraph,$time);

  }


  $connection ='#mydatatabs a[href="#orange"]';

  echo "<script>
            $(function(){
              $('".$connection."').tab('show');
            });
        </script>";
}



?>
<section id="content" class="container">


       <div class="bg-white shadow rounded overflow-hidden">
           <div class="px-4 pt-0 pb-4 proffwrapper">
               <div class="media align-items-end proffnav">
                   <div class="profile mr-3">
                     <a href="<?php echo $profileName; ?>">  <img class="proffimg" src="<?php echo $proffArray['profile_pic']; ?>" </a>

                    <?php
                    if($loggedInUser!=$profileName)
                     echo'    <a href="block.php" class="block btn btn-outline-dark btn-sm btn-block">Manage User</a>';
                    else
                    echo'    <a href="" class=""></a>';

                     ?>


                   </div>
                   <div class="media-body mb-5 text-white">
                       <h4 class="mt-0 mb-0"><?php echo $profileName; ?></h4>
                       <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>Profile Page</p>
                   </div>
               </div>
           </div>
           <div class="profffooter  p-4 d-flex justify-content-end text-center">
               <ul class="list-inline mb-0">
                   <li class="list-inline-item">
                       <h5 class="font-weight-bold mb-0 d-block"><?php echo $proffArray['num_posts']; ?></h5><small class="text-muted"> <i class="fas fa-image mr-1"></i>POSTS</small>
                   </li>
                   <li class="list-inline-item">
                       <h5 class="font-weight-bold mb-0 d-block"><?php echo $proffArray['num_likes']; ?></h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>LIKES</small>
                   </li>
                   <li class="list-inline-item">
                       <h5 class="font-weight-bold mb-0 d-block"><?php echo substr_count($proffArray['friend_array'],",")-1;?></h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>FRIENDS</small>
                   </li>
               </ul>
           </div>

          </div>


          <!-- Modal -->
          <div class="modal fade" id="popoutform" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">

            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Post Something!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Profile Posts.</p>

                  <form action="" class="popoutdataframe" method="POST">
                    <div class="popOuttext">
                        <textarea class="form-control" name="textform"></textarea>
                        <input type="hidden" name="dataformby" value="<?php echo $loggedInUser;?>" >
                        <input type="hidden" name="dataformto" value="<?php echo $profileName;?>" >
                    </div>
                  </form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary"  name="send" id="sendData">Send</button>
                </div>
              </div>
            </div>
          </div>

<div class="row">
  <div class="col-md-4 ">
    <div class="sidetab">
      <div class="sidetab-heading">
        <span class="sidetab-icon">
          <i class="fa fa-trophy"></i>
        </span>
        <span class="sidetab-title">Profile UserTab</span>
      </div>
      <div class="sidetab-body ">

        <form action="<?php echo $profileName;?>" method="POST">
          <?php $proffObj=new ProfileUser($con,$profileName);
            if($proffObj->CheckifOpen())
            {
              header("Location:accountclosed.php");

            }

            $proffOwner=new ProfileUser($con,$loggedInUser);

            if($loggedInUser!=$profileName)
            {
            //  if()//if is not blocked
                echo '<input type="submit" name="block" class="danger" value="Block"<br>';
              //  else//if is blocked

              if($proffOwner->areCompanions($profileName))
              {
                echo '<input type="submit" name="terminateRelation" class="danger" value="Remove Friend"<br>';
              }
              else if($proffOwner->wasRequested($profileName))
              {
                echo '<input type="submit" name="respondRequest" class="warning" value="Respond to Request"<br>';
              }
              else if($proffOwner->Requested($profileName))
              {
                echo '<input type="submit" name="" class="default" value="Request Sent"<br>';

              }
              else
              {
                echo '<input type="submit" name="makeRelation" class="succes" value="Add Friend"<br>';
              }
            }
           ?>

        </form>
        <!-- Button trigger modal -->
        <button type="button" class=" postprofilbtn" data-toggle="modal" data-target="#popoutform">
          Post Something
        </button>

      </div>
    </div>
     <div class="sidetab">
       <div class="sidetab-heading">
         <span class="sidetab-icon">
           <i class="fa fa-star"></i>
         </span>
         <span class="sidetab-title">Popularity</span>
       </div>
       <div class="sidetab-body ">
         <table class="table mbn tc-icon-1 tc-med-2 tc-bold-last">
           <tbody>
             <tr>
               <td>
                 <span class="fa fa-desktop text-warning"></span>
               </td>
               <td>Television</td>
               <td>
                 <i class="fa fa-caret-up text-info pr10"></i></td>
             </tr>
             <tr>
               <td>
                 <span class="fa fa-microphone text-primary"></span>
               </td>
               <td>Radio</td>
               <td>
                 <i class="fa fa-caret-down text-danger pr10"></i></td>
             </tr>
             <tr>
               <td>
                 <span class="fa fa-newspaper-o text-info"></span>
               </td>
               <td>Newspaper</td>
               <td>
                 <i class="fa fa-caret-up text-info pr10"></i></td>
             </tr>
           </tbody>
         </table>
       </div>
     </div>

     <div class="sidetab">
       <div class="sidetab-heading">
         <span class="sidetab-icon">
           <i class="fa fa-pencil"></i>
         </span>

       </div>
     </div>
   </div>

  <div class="col-md-8">
    <ul class="nav  nav-tabs" data-tabs="tabs" id="mydatatabs">
    <li class=" nav-link active red"><a data-toggle="tab" href="#red">MY POSTS</a></li>
<?php
    if($profileName!=$loggedInUser)
    {
      echo '<li   class=" nav-link orange "><a data-toggle="tab" href="#orange">MESSAGES</a></li>';

    }
?>

</ul>

<div class="tab-content">
    <div class="tab-pane active" id="red">

      <div class="dataarea"></div>
       <img id="waiting" src="Assets/images/icons/loading.gif">

    </div>
    <div class="tab-pane" id="orange">

      <?php

        echo "<h4>You and <a href='$profileName'>" . $proffObj->returnName() . "</a></h4><hr><br>";

        echo "<div class='printedtexts' id='smsscroll'>";
          echo $textobj->retrieveSms($profileName);
        echo "</div>";

      ?>


          <div class="smstext">
            <form action="" method="POST">

                <textarea name='smsText' id='smsarea' placeholder='Type message..'></textarea>


                <input type='submit' name='sms' class='info' id='sendbtn' value='Send'>;
              </form>

          </div>

        <script>

        $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
        var div = document.getElementById("smsscroll");
        div.scrollTop = div.scrollHeight;
    });
</script>

    </div>
</div>

  </div>

</div>

<script >

var loggedInUser = "<?php echo $loggedInUser; ?>";
var loggedInProfile = "<?php echo $profileName; ?>";

jQuery(document).ready(function() {
  jQuery('#waiting').show();

  jQuery.ajax({
    url: "includes/ajax/userpagedata.php",
    type: "POST",
    data: "page=1&loggedInUser=" + loggedInUser + "&loggedInProfile=" +loggedInProfile,
    cache:false,

    success: function(data) {

      jQuery('#waiting').hide();
      jQuery('.dataarea').html(data);
    }
  });




  jQuery(window).scroll(function() {
    var length = jQuery('.dataarea').height();
    var position = jQuery(this).scrollTop();
    var page = jQuery('.dataarea').find('.followingData').val();
    var dataAvailable = jQuery('.dataarea').find('.dataAvailable').val();

    if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && dataAvailable == 'false') {
      jQuery('#waiting').show();

      var ajaxReq = jQuery.ajax({
        url: "includes/ajax/userpagedata.php",
        type: "POST",
        data: "page=" + page + "&loggedInUser=" + loggedInUser + "&loggedInProfile=" +loggedInProfile,
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

});



</script>
</div>
</body>
<footer class="bfooter">

  <a href="#" class="back-to-top"><i class="fa fa-arrow-circle-up"></i></a>

</footer>

</html>
