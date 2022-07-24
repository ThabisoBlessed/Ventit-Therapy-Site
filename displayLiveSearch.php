<?php
include("connectionfile/header.php");

 ?>

 <style>

 .displaylive{
   margin:80px 30px auto 110px;
   width: 85%;
   border-radius: 4px;
   height: 700px;
   border: none;
   box-shadow: 1px 1px white;
   background-color: white;
   overflow: auto;
   box-shadow: 0px 2px 15px rgba(25, 119, 204, 0.1);
 }

 .displaylive_navbar{
   width: 100%;
   height: 50px;
   border:none;
   background-color: #353535;
 }

 .displaylive_filter{
   float: left;
   margin-top: 14px;
   margin-left: 10px;
 }

.selector
{
  border-radius: 4px;
  background-color: #fff;
}


 #results{
   color: #AAAAAA;
   float: right;
   margin-right: 15px;
 }

 .displaylive_container{
   width: 80%;
   height:auto;
   margin: auto;
   margin-top: 5%;
 }

 footer{
   border: 1px solid black;
   margin: auto;
   margin-top: 20px;
   width: 100%;
   background-color: #353535;
 }

 .footer_text{
   color: #AAAAAA;
   text-align: center;
   font-style: italic;
 }
.dataReturned
{
  display: flex;
  padding: 10px;
}

.dataReturned:hover
{
  background-color:#D7E9F7 ;
  cursor: pointer;
  border-radius: 4px;
}
.dataReturned p
{
  margin-left: 10px;
}

.dataReturned img
{
height: 60px;
border-radius: 4px;

}
     </style>
   <?php
       if(isset($_GET['q']))
       	$sqldata = $_GET['q'];

       else
       	$sqldata = "";

       if(isset($_GET['type']))
       	$type = $_GET['type'];

       else
       	$type = "name";



    ?>

       <section class="displaylive">
           <nav class="displaylive_navbar">

           <div class="displaylive_filter">

           </div>

         </nav>
         <div class="displaylive_container">


           <?php
           if($sqldata == "")
           {
             echo "Type to search!..";

           }

           else {

             $feedbackData = mysqli_query($con, "SELECT * FROM posts ,users  WHERE posts.added_by=users.username AND
               posts.body  LIKE '%$sqldata%' AND posts.deleted='no' LIMIT 8");

             if(mysqli_num_rows($feedbackData) == 0)
               echo "No post which contains this keyword is found : " . $type . " like: " .$sqldata;
             else
               echo mysqli_num_rows($feedbackData) . " results returned:<br>";


             while($row = mysqli_fetch_array($feedbackData)) {

               echo "<div class='dataReturned'>

                     <a  href='". $row['username'] ."'><img src='". $row['profile_pic'] ."' ></a>
                     <a  href='".$row['username'] ."'>

                     <p>  ". $row['username'] ."<br>". $row['body'] ."</p>
                     </a>
                     <br>
                     </div>
                 <hr id='hrRule'>
                 ";
               }
           }

         ?>

          </div>
        </section>

      </body>

    <footer>
       <p class="footer_text">No more results to display!.</p>
     </footer>
 </html>
