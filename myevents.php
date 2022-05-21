<?php

session_start();

if ($_SESSION["user_id"] == '') {

//destroy the session
session_destroy();
/* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/loginPublic.php");
}
 else {
    
$URLLoginText = "<a href=".loginPublic.php." >Login</a>";
 }
//----------------------------------------------------------------------------

include ("conn/dbconnection.php");
include ("conn/showerrors.php");


//filter (search shows query)
$UserID = $_SESSION["user_id"];

$VenueEvent = $conn->real_escape_string($_GET['filter']);
    $readquery = "SELECT registeredperformers.PerformerID, junction.ScheduleID, registeredperformers.image, registeredperformers.PerformerCategory, "
            . " registeredperformers.PerformerName, schedule.ShowDate, schedule.ShowTime, venues.VenueName, venues.VenueID, "
            . "reservations.ReservationID, reservations.No_of_Tickets_Sold As MyTickets "
            . " FROM reservations INNER JOIN tickets ON reservations.TicketID = tickets.TicketID INNER JOIN "
            . " junction ON tickets.ScheduleID = junction.ScheduleID INNER JOIN registeredperformers ON junction.PerformerID = "
            . " registeredperformers.PerformerID INNER JOIN schedule ON schedule.ID = junction.ScheduleID INNER JOIN venues on junction.VenueID = venues.VenueID "
            . " WHERE reservations.RegisteredMemberID ='$UserID' ORDER BY `registeredperformers`.`PerformerID` ASC";



$result =  $conn -> query($readquery);
if(!$result)
{
    die("ERROR HAPPENED".$conn->error);
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
            <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
 <link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
 <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
 <link href="css/css.css" rel="stylesheet" type="text/css"/>
         
        <title>My Reservations</title>  
    </head>
        <style>
    @media only screen and (min-width: 550px) {
    
    .card{
    height:580px;
    }  
}
</style>
   <body>	
 <h1 style="text-align: center">Big Fest Belfast</h1>
                   

                    <div class="row">
                        <em><h3 style="text-align: center">My Events</h3></em>
                    </div>
             <!--nav starts here-->
            <div class="row"> <!--row 2 of the container-->
           
                    <ul class="topnav" id="myTopnav2">
                        <li><a href="editProfile.php" class="brand">Profile</a></li>
                         <li><a href="venuesPublic.php" class="active">Venues</a></li>  
                         <li><a href="searchexample_1.php" class="active">Search Shows</a></li>
                        <li><a href="events.php" class="active">Events</a></li>
                        <li><a href="myevents.php" class="active">My Reservations</a></li>  
                        <li style="float:right;"><a href="loginPublic.php" >Log Out</a></li>
                        <li class="-icon">
                            <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
                        </li>
                    </ul>
                </div>   
                    
                    <!--adding events for the BigFest Belfast Music Festival-->
                    
                    <div class='row'>
                        <?php
                        
                        while ($row = $result->fetch_assoc()){
                           $getPerformerID =$row["PerformerID"];
                           $getScheduleID = $row["ScheduleID"];
                           $getPerformerImage = $row["PerformerImage"];
                           $_Image = $row["image"];
                           $getPerformerCategory = $row["PerformerCategory"];
                           $getPerformerName = $row["PerformerName"];
                           $getShowDate = $row["ShowDate"];
                           $getShowTime = $row["ShowTime"];
                           $getVenueName = $row["VenueName"];
                           $MyTickets = $row["MyTickets"];
                           $ReservationID = $row["ReservationID"];
                           
                          //Render image  
                       $_varImage =  '<img src="data:image/jpeg;base64,'.base64_encode( $_Image ).'"/>'; 
                                              
                        echo "<div class='col m4'>
                                
                            <div class='card _alignCenter containerEvent'>
                            
                            <strong><p>$getPerformerCategory</p></strong>
                            $_varImage
                            <h5>$getPerformerName</h5>
                            $getShowDate</br>
                            $getShowTime</br>
                            $getVenueName</br>
    <a href='eventsinfoPublic.php?PerformerID=$getPerformerID&ScheduleID=$getScheduleID'><button class='_pink _small _round'>Read More</button></a>
                            <p>$MyTickets Tickets Already Booked</br></br>"
      
?>
 <form id="form1" action="releasetickets.php" method="post" onsubmit="return validateForm()">
<?php
echo '<input type="hidden" id="ReservationID" name="ReservationID" value="'.$ReservationID.'">';
echo 'Release Tickets ? : <select name="NoOfTickets" id="NoOfTickets">';
    
                   
        
     
for ($x = 0; $x <= $MyTickets; $x++) {
    
    if ($x == $_Day) {

$select_attribute = 'selected';
}
else
   $select_attribute = ''; 


 
  echo '<option value="'.$x.'" '. $select_attribute . '>'.$x.'</option>';
  
  $select_attribute = ''; 
}
?>  <?php 
        echo '</select><br/>'; 
        echo ' <input type="submit" value="Release Ticket(s)" style="font-size:10px;color:white;font-family:Arial;background-color:red"/>';        
 //---------------------------------------------------------------  
        
   ?>
     </form>
 <?php 
                            echo "</div>
                        </div>";
                        }
                  ?>
  
         </div> 
         </div> <!--container ends here-->
    </body>
</html>