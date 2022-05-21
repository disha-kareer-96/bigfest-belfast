<?php

include('../conn/dbconnection.php');

$arg = $conn->real_escape_string($_GET["filter"]);
 $findusername1 = "SELECT * FROM users INNER JOIN venuemanagers ON venuemanagers.loginid = users.id INNER JOIN venues ON venues.VenueID = venuemanagers.venueid INNER JOIN junction ON venues.VenueID = junction.VenueID INNER JOIN registeredperformers ON junction.PerformerID = registeredperformers.PerformerID INNER JOIN schedule ON junction.ScheduleID = schedule.ID WHERE venuemanagers.managerid = '$arg'";
     $queryresult1 = $conn->query($findusername1) or die($conn->error);
         while ($row = $queryresult1->fetch_assoc()) {
             $managerid1 = $row["managerid"];
             $scheduleid = $row["ID"];
         }
         
         
        $newscheduledate = $conn->real_escape_string($_POST["ShowDate"]);
        $newscheduletime = $conn->real_escape_string($_POST["ShowTime"]);
        
        

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="../css/venuemanager.css" rel="stylesheet" type="text/css"/>
        <title>Submitted</title>
    </head>
    <body>
                         <ul class="topnav" id="myTopnav2">
 <?php echo" <li><a href='venuemanagerhome.php?filter=$managerid1'>Home</a></li>
  <li><a href='VMperformances.php?filter=$managerid1'>Performances</a></li>
  <li><a href='VMeditprofile.php?filter=$managerid1'>Edit Profile</a></li>
  <li><a href='VMsetdetails.php?filter=$managerid1'>Set Details</a></li>
  <li><a href='VMcommunication.php?filter=$managerid1'>Messages</a></li> "; ?>
  <li style="float:right;"><a href="login.php" >Logout</a></li> 
  <li class="-icon">
    <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
  </li>
</ul>
        
         <div class="centering">
       
        <?php
        
        
        
        
        $updateq = "UPDATE schedule INNER JOIN junction ON junction.ScheduleID = schedule.ID INNER JOIN venues ON venues.VenueID = junction.VenueID INNER JOIN venuemanagers ON venuemanagers.venueid = venues.VenueID INNER JOIN registeredperformers ON registeredperformers.PerformerID = junction.PerformerID SET ShowDate='$newscheduledate', ShowTime='$newscheduletime' WHERE schedule.ID = '$arg'";
        
        $result = $conn->query($updateq);
        
        if($result){
            
                  echo"      <div class='row'>
            <div class= 'card' style = 'width:600px; margin-bottom: 10px;'>
            <div class = '-content _alignCenter'>
            <h1><strong>Your changes have been submitted  </strong></h1>
                    </div>
                    </div>
                            
            
            <br>
            </div>";
            
        }else{
            echo $conn->error;
        }
        
            
        
        
        ?>
         </div>
    </body>
</html>
