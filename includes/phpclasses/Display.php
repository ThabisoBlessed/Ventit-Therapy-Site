<?php

class Display
{
  private $owner ,$con;
  public function __construct($con,$proffuser)
  {
    $this->con=$con;
    $this->owner=new ProfileUser($con,$proffuser);
  }

  public function dataSavePost($paragraph,$dataTo)
  {
      $paragraph=strip_tags($paragraph);
      $paragraph=mysqli_real_escape_string($this->con,$paragraph);
      $submittedBy=    $this->owner->returnName();
      $paragraph=str_replace('\r\n','\n',$paragraph);
      $paragraph=nl2br($paragraph);
      $spaces=preg_replace('/\s+/','',$paragraph);

      if($spaces!="")
      {
        $postDate=date("Y-m-d H:i:s");

        //retrieve name

        $dataPostby=$this->owner->returnName();

        //while user on his account

        if($dataTo==$dataPostby)
        {
            $dataTo="none"; //everyone not just someone specific.
        }

        //add PostsData into the server
        $datasql=mysqli_query($this->con,"INSERT INTO  posts VALUES(NULL,'$paragraph','$dataPostby','$dataTo','$postDate','no','no','0')");
        $feedbackId=mysqli_insert_id($this->con);


			if($dataTo != 'none') {
				$alertobj =new Alerts($this->con,$submittedBy);
				$alertobj->addAlert($feedbackId,$dataTo,"account_Owner");
			}


        //update returnPostCounter

        $counterPost=$this->owner->returnPostCounter();
        $counterPost++;
        $counterUpdateSql=mysqli_query($this->con,"UPDATE users SET num_posts='$counterPost' WHERE username='$dataPostby'");
        $ignore = "howzit Hie  whatsup sup a about above across hello Am forward  before
          after again against all almost alone along already guys thanks
         also although always among am an and another any anybody anyone anything anywhere are
         area areas around as ask asked asking asks at away b back backed backing backs be became
         because become becomes been before began behind being beings best better between big
         both but by c came can cannot case cases certain certainly clear clearly come could
         d did differ different differently do does done down down downed downing downs during
         e each early either end ended ending ends enough even evenly ever every everybody
         everyone everything everywhere f face faces funny fact facts far felt few find finds first
         for four from full fully further furthered furthering furthers g gave general generally
         get gets give given gives go going good goods got great greater greatest group grouped
         grouping groups h had has have having he her here herself high high high higher
           highest him himself his how however i im if important in interest interested interesting
         interests into is it its itself j just k keep keeps kind knew know known knows
         large largely last later latest least less let lets like likely long longer
         longest m made make making man many may me member members men might more most
         mostly mr mrs much must my myself n necessary need needed needing needs never
         new new newer newest next no nobody non noone not nothing now nowhere number
         numbers o of off often old older oldest on once one only open opened opening
         opens or order ordered ordering orders other others our out over p part parted
         parting parts per perhaps place places point pointed pointing points possible
         present presented presenting presents problem problems put puts q quite r
         rather really right right room rooms s said same saw say says second seconds
         see seem seemed seeming seems sees several shall she should show showed
         showing shows side sides since small smaller smallest so some somebody
         someone something somewhere state states still still such sure t take
         taken than that the their them then there therefore these they thing
         things think thinks this those though thought thoughts three through
          What's  thus to today together too took toward turn turned turning turns two
         u under until up upon us use used uses v very w want wanted wanting
         wants was way ways we well wells went were what when where whether
         which while who whole whose why will lmao with within without work
         worked working works would x y year years yet you young younger
         youngest your yours z lol haha omg hey ill iframe wonder else like
          hate sleepy reason for some little yes bye choose";



        $ignore=preg_split("/[\s,]+/",$ignore);

        $impureString=preg_replace("/[^a-zA-Z 0-9]+/", "",$paragraph);
        $impureString=preg_split("/[\s,]+/",$impureString);


        foreach($ignore as $wrd)
        {
            foreach($impureString as $index=>$wrd2)
            {
              if(strtolower($wrd)==strtolower($wrd2))
                $impureString[$index]="";

            }
        }

        foreach($impureString as $name)// for emojies.
        {

          $name = str_replace( "?", "{%}", $name );
          $name  = mb_convert_encoding( $name, "ISO-8859-1", "UTF-8" );
          $name  = mb_convert_encoding( $name, "UTF-8", "ISO-8859-1" );
          $name  = str_replace( array( "?", "? ", " ?" ), array(""), $name );
          $name  = str_replace( "{%}", "?", $name );
          $name= trim( $name );

          if($name!='')
         $this->popularWords(ucfirst($name));
// changed the emoji encoding to that of a string so that it can be saved in the database with no error.
        }
      }
  }


public function popularWords($word)
{
  if($word)
  $sqlidata=mysqli_query($this->con,"SELECT * FROM popularWords WHERE name='$word'");

  if(mysqli_num_rows($sqlidata)==0)
  mysqli_query($this->con,"INSERT INTO popularWords VALUES(NULL,'$word','1')");
  else
  mysqli_query($this->con,"UPDATE popularWords SET occurances=occurances+1 WHERE name='$word'");
}

public function displayToScreen($info,$max)
{

    $lcnofpost=$info['page'];//location of post which page it is.
    $loggedInUser=$this->owner->returnName();

    if($lcnofpost==1)
      $start=0;

      else
      $start=($lcnofpost-1)*$max;

  $mystring="";
  $infoquery=mysqli_query($this->con,"SELECT * FROM posts WHERE deleted='no' AND user_to='none' ORDER BY id DESC");
  if(mysqli_num_rows($infoquery)>0)
  {
    $countiterations=0;
    $count=0;

  while($row=mysqli_fetch_array($infoquery)) //infoquery =posts
  {

    $postId=$row['id'];
    $paragraph=$row['body'];
    $dataPostby=$row['added_by'];
    $postTime=$row['date_added'];

    if($row['user_to']=="none") //if the post is not directed to anyone.
    {
      $dataTo="";
    }
    else
    {
      $proffObj=new ProfileUser($this->con,$row['user_to']);
      $dataToName=$proffObj->returnName();
      $dataTo="  to  <a href='" .$row['user_to']."'>" . $dataToName . "</a>";
    }

    $dataPostObj=new ProfileUser($this->con,$dataPostby);

    if($dataPostObj->CheckifOpen())
    {
      continue;
    }

      if($countiterations++ <$start) //counting posts
      continue;

if($count>$max)
break;
else
  $count++;

        if($loggedInUser == $dataPostby)
  						$erasebttn = "<button class='erasebttn btn-danger' id='post$postId'>X</button>";
  					else
  						$erasebttn = "";


    $sqldetails =mysqli_query($this->con,"SELECT username , profile_pic FROM users WHERE username ='$dataPostby'");
    $sqlrow=mysqli_fetch_array($sqldetails);
    $profile_pic = $sqlrow['profile_pic'];
?>

    <script>



    function flick<?php echo $postId;?>()
    {

      var dtaVar =document.getElementById("flickresponse<?php echo $postId?>");
      if(dtaVar.style.display=="block")
      dtaVar.style.display="none";

      else
      dtaVar.style.display="block";
    }


    </script>
<?php

    $currentTime=date("Y-m-d H:i:s");
    $postdate=new DateTime($postTime); //shows the date the post was posted
    $todayDate=new DateTime($currentTime); //shwos the time the post was posted
    $period=$postdate->diff($todayDate); // returns the period bewteen postdate and todays date.


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
      $clockScript=$period->m. " month " .$days;
      else
      $clockScript=$period->m." month ".$days;
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
$count=mysqli_num_rows(mysqli_query($this->con,"SELECT * FROM comments WHERE post_id='$postId'"));
//unoderd list is not closed to make the vertical line continious(the time stamps_)
    $mystring.="    <ul class='saatTag' >

         <li>             <div class='saatTag-time'>
                              <span class='time'>$clockScript</span>
                           </div>

                           <div class='saatTag-icon'>
                              <a href='javascript:;'>&nbsp;</a>
                           </div>

                           <div class='saatTag-body'>
                              <div class='saatTag-header'>
                                 <span class='userimage'><img src='$profile_pic' alt=''></span>
                                 <span class='pull-right text-muted'>$erasebttn</span>
                                 <div class='username'><a href='$dataPostby'>$dataPostby </a></div>

                              </div>
                              <div class='saatTag-content'>
                                 <p>$paragraph</p>

                              </div>

                              <div class='saatTag-footer'>

                              <embed     style='overflow:hidden '; src='test.php?displayID=$postId' width='110' height='40' class='embedlike'   ></embed>



                   <a href='javascript:flick$postId();'class='m-r-15 text-inverse-lighter'><i class='fa fa-comments fa-fw fa-lg m-r-3'></i> $count Comments</a>

                              </div>

                              <div class='responses_tab' id='flickresponse$postId' style='display:none';>

                              <iframe src='responses.php?displayID=$postId' id='response_frame'></iframe>
                              </div>
                           </div>


                        </li>";


                        ?>

<script>

	$(document).ready(function() {
    var id=<?php echo "$postId"; ?>

      jQuery.ajax({


        url: "test.php",
        type: "POST",
        data: {
					'postId':id
				},
          success: function(data) {
          jQuery('.likes').html(data);
        }
      });

		$('#post<?php echo $postId; ?>').on('click', function() {
			bootbox.confirm("Erase Post?", function(result) {

				$.post("connectionfile/reg.php?commentId=<?php echo $postId; ?>", {result:result});

				if(result)
					location.reload();

			});
		});


	});

</script>

<?php


  }
  if($count>$max)
  {
    $mystring.="<input type='hidden' class='followingData' value='".($lcnofpost+1)."'>
    <input type='hidden' class='dataAvailable' value='false'>";


  }

    else
    {

    $mystring.="<input type='hidden' class='dataAvailable' value='true' ><p style='text-align:centre;'>No more posts to display!</p>";
    }
}
 echo $mystring;
}


//displaying profile posts
public function displayProfileToScreen($info,$max)
{
    $loggedInProfileUser=$info['loggedInProfile'];
    $lcnofpost=$info['page'];
    $loggedInUser=$this->owner->returnName();

    if($lcnofpost==1)
      $start=0;

      else
      $start=($lcnofpost-1)*$max;

  $mystring="";
  $infoquery=mysqli_query($this->con,"SELECT * FROM posts WHERE deleted='no' AND((added_by ='$loggedInProfileUser' AND user_to='none')OR user_to='$loggedInProfileUser') ORDER BY id DESC");
  if(mysqli_num_rows($infoquery)>0)
  {
    $countiterations=0;
    $count=0;

  while($row=mysqli_fetch_array($infoquery))
  {

    $postId=$row['id'];
    $paragraph=$row['body'];
    $dataPostby=$row['added_by'];
    $postTime=$row['date_added'];



    $dataPostObj=new ProfileUser($this->con,$dataPostby);

    if($dataPostObj->CheckifOpen())
    {
      continue;
    }

      if($countiterations++ <$start)
      continue;

if($count>$max)
break;
else
  $count++;

        if($loggedInUser == $dataPostby)
  						$erasebttn = "<button class='erasebttn btn-danger' id='post$postId'>X</button>";
  					else
  						$erasebttn = "";


    $sqldetails =mysqli_query($this->con,"SELECT username , profile_pic FROM users WHERE username ='$dataPostby'");
    $sqlrow=mysqli_fetch_array($sqldetails);
    $profile_pic = $sqlrow['profile_pic'];
?>

    <script>

    function flick<?php echo $postId;?>()
    {

      var dtaVar =document.getElementById("flickresponse<?php echo $postId?>");
      if(dtaVar.style.display=="block")
      dtaVar.style.display="none";

      else
      dtaVar.style.display="block";
    }
    </script>
<?php


    $currentTime=date("Y-m-d H:i:s");
    $postdate=new DateTime($postTime);
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

    $count=mysqli_num_rows(mysqli_query($this->con,"SELECT * FROM comments WHERE post_id='$postId'"));

    $mystring.= "<div class='myposts'>
               <div class='picture'>
                 <img src='$profile_pic' width='50'>
                 <a href='$dataPostby'>$dataPostby </a> &nbsp;&nbsp;&nbsp;&nbsp;$clockScript
                <div class='userbttn'> $erasebttn</div>
                <div id='paratext'>$paragraph<br> </div>

                <div class='profilefooter'>
                <div class='embedfooter'>
                    <embed     style='overflow:hidden '; src='test.php?displayID=$postId' width='110' height='40' class='embedlike'   ></embed>
                  </div>
                  <div class='commentfooter'>
                     <a href='javascript:flick$postId();'class='m-r-15 text-inverse-lighter newf'><i class='fa fa-comments fa-fw fa-lg m-r-3  Nicon'></i>$count Comments</a>

                  </div>
                </div>

                  <div class='responses_tab' id='flickresponse$postId' style='display:none';>

                  <iframe src='responses.php?displayID=$postId' id='response_frame'></iframe>
                  </div>
              </div><hr>";




?>
<script>


$(document).ready(function() {

		$('#post<?php echo $postId; ?>').on('click', function() {
			bootbox.confirm("Erase Post?", function(result) {

				$.post("connectionfile/reg.php?commentId=<?php echo $postId; ?>", {result:result});

				if(result)
					location.reload();

			});
		});


	});

</script>

<?php


  }
  if($count>$max)
  {
    $mystring.="<input type='hidden' class='followingData' value='".($lcnofpost+1)."'>
    <input type='hidden' class='dataAvailable' value='false'>";


  }

    else
    {

    $mystring.="<input type='hidden' class='dataAvailable' value='true' ><p style='text-align:center;'>No more posts to display!</p>";
    }
}
 echo $mystring;
}

public function returnAlerts_Posts($postId)
{

      $loggedInUser=$this->owner->returnName();
      $viewed = mysqli_query($this->con, "UPDATE notifications SET opened='yes'WHERE user_to='$loggedInUser'
        AND link LIKE '%=$postId'");


    $mystring="";
    $infoquery=mysqli_query($this->con,"SELECT * FROM posts WHERE deleted='no'AND id ='$postId'");
    if(mysqli_num_rows($infoquery)>0)
    {

      $row=mysqli_fetch_array($infoquery);


      $postId=$row['id'];
      $paragraph=$row['body'];
      $dataPostby=$row['added_by'];
      $postTime=$row['date_added'];

      if($row['user_to']=="none")
      {
        $dataTo="";
      }
      else
      {
        $proffObj=new ProfileUser($this->con,$row['user_to']);
        $dataToName=$proffObj->returnName();
        $dataTo="  to  <a href='" .$row['user_to']."'>" . $dataToName . "</a>";


      }

      $dataPostObj=new ProfileUser($this->con,$dataPostby);

      if($dataPostObj->CheckifOpen())
      {
        return;
      }


          if($loggedInUser == $dataPostby)
    						$erasebttn = "<button class='erasebttn btn-danger' id='post$postId'>X</button>";
    					else
    						$erasebttn = "";


      $sqldetails =mysqli_query($this->con,"SELECT username , profile_pic FROM users WHERE username ='$dataPostby'");
      $sqlrow=mysqli_fetch_array($sqldetails);
      $profile_pic = $sqlrow['profile_pic'];
  ?>

      <script>



      function flick<?php echo $postId;?>()
      {

        var dtaVar =document.getElementById("flickresponse<?php echo $postId?>");
        if(dtaVar.style.display=="block")
        dtaVar.style.display="none";

        else
        dtaVar.style.display="block";
      }


      </script>
  <?php

      $currentTime=date("Y-m-d H:i:s");
      $postdate=new DateTime($postTime);
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
      $count=mysqli_num_rows(mysqli_query($this->con,"SELECT * FROM comments WHERE post_id='$postId'"));

      $mystring.="    <div class='NotTag' >
                      <ul class='saatTag' >
                      <li>
                      <div class='saatTag-time'>
                          <span class='time'>$clockScript</span>
                        </div>

                             <div class='saatTag-icon'>
                                <a href='javascript:;'>&nbsp;</a>
                             </div>

                             <div class='saatTag-body'>
                                <div class='saatTag-header'>
                                   <span class='userimage'><img src='$profile_pic' alt=''></span>
                                   <span class='pull-right text-muted'>$erasebttn</span>
                                   <div class='username'><a href='$dataPostby'>$dataPostby </a></div>

                                </div>
                                <div class='saatTag-content'>
                                   <p>$paragraph</p>

                                </div>

                                <div class='saatTag-footer'>
                                <div class='embedfooter'>
                                    <embed     style='overflow:hidden '; src='test.php?displayID=$postId' width='110' height='40' class='embedlike'   ></embed>
                                  </div>
                                   <a href='javascript:flick$postId();'class='m-r-15 text-inverse-lighter newf'><i class='fa fa-comments fa-fw fa-lg m-r-3  Nicon'></i>$count Comments</a>

                                </div>

                                <div class='responses_tab' id='flickresponse$postId' style='display:none';>

                                <iframe src='responses.php?displayID=$postId' id='response_frame'></iframe>
                                </div>
                             </div>


                          </li>
                          </ul>
                          </div>";


                          ?>
  <script>

  	$(document).ready(function() {

  		$('#post<?php echo $postId; ?>').on('click', function() {
  			bootbox.confirm("Erase Post?", function(result) {

  				$.post("connectionfile/reg.php?commentId=<?php echo $postId; ?>", {result:result});

  				if(result)
  					location.reload();

  			});
  		});


  	});

  </script>

  <?php


    }
    else {
      echo "<p>No results found!!....</p>";
        return;
    }
   echo $mystring;
  }



}





 ?>
