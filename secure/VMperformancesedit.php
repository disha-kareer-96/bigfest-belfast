<?php
include('../conn/dbconnection.php');
$arg = $conn->real_escape_string($_GET["filter"]);
 $findusername1 = "SELECT * FROM users INNER JOIN venuemanagers ON venuemanagers.loginid = users.id INNER JOIN venues ON venues.VenueID = venuemanagers.venueid INNER JOIN junction ON venues.VenueID = junction.VenueID INNER JOIN registeredperformers ON junction.PerformerID = registeredperformers.PerformerID INNER JOIN schedule ON junction.ScheduleID = schedule.ID WHERE venuemanagers.managerid = '$arg' AND schedule.ID = '$arg'";
     $queryresult1 = $conn->query($findusername1) or die($conn->error);
         while ($row = $queryresult1->fetch_assoc()) {
             $managerid1 = $row["managerid"];
             $scheduleid = $row["ID"];
         }
         

      
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="../css/venuemanager.css" rel="stylesheet" type="text/css"/>

        <title>Performances</title>
    </head>
    <body>
        
                 <ul class="topnav" id="myTopnav2">
 <?php echo" <li><a href='venuemanagerhome.php?filter=$managerid1'>Home</a></li>
  <li><a href='VMperformances.php?filter=$managerid1'>Performances</a></li>
  <li><a href='VMeditprofile.php?filter=$managerid1'>Edit Profile</a></li>
  <li><a href='VMsetdetails.php?filter=$managerid1'>Image Upload</a></li>
  <li><a href='VMcommunication.php?filter=$managerid1'>Messages</a></li> "; ?>
  <li style="float:right;"><a href="login.php" >Logout</a></li> 
  <li class="-icon">
    <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
  </li>
</ul>
        <h1 style="text-align: center;"><strong> Edit Schedule </strong></h1>
        
   <?php echo "<form method='POST' action='updateVMperformers.php?filter=$managerid1'>  ";?>
        <div class="centering">
        <?php
        
        
        $readquery = "SELECT * FROM registeredperformers INNER JOIN junction ON registeredperformers.PerformerID =  junction.PerformerID INNER JOIN venues ON venues.VenueID = junction.VenueID INNER JOIN schedule ON schedule.ID = junction.ScheduleID INNER JOIN venuemanagers ON venues.VenueID = venuemanagers.venueid WHERE venuemanagers.venueid = '$arg' AND schedule.ID = '$arg'";

         $queryresult = $conn->query($readquery) or die($conn->error);
         
         while ($row = $queryresult->fetch_assoc()) {
            $performername = $row["PerformerName"];
            $performerid = $row["PerformerID"];
            $performerinfo = $row["PerformerInfo"];
            $PerformerCategory = $row["PerformerCategory"];
            $performerEmail = $row["PerformerEmail"];
            $Performerimage = $row["PerformerImage"];
            
            $scheduleddate = $row["ShowDate"];
            $scheduledtime = $row["ShowTime"];
            $scheduleid = $row["ID"];
            
            $venueName = $row["VenueName"];
            $venueid = $row["VenueID"];
            
            
         }
            
              echo "
                  
            
            <div class='row'>
            <div class= 'card' style = 'width:600px; margin-bottom: 10px;'>
            <div class = '-content _alignCenter'>
            
            <h2><strong>$performername</strong></h2>
                <h3> Edit Date:</h3>
              <h5><textarea name='ShowDate' required='required' >$scheduleddate</textarea></h5> 
                  <h3> Edit Time: </h3>
                  <h5><strong><textarea name='ShowTime' required='required' >$scheduledtime</textarea></h5> 
                    <h3> $performerEmail</h3>
                        
            <div class='button1'>
            <button class='editbutton' type='submit'> Submit </button>
            </div>
                


           
                    </div>
                            
            
            <br>
            </div>
            
            
            

            ";
         
         
?>
           
        </div>

        
        
</form>
    
    </body>
</html>
