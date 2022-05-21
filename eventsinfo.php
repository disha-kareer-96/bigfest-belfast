<?php

session_start();

if ($_SESSION["user_id"] == '') {

//destroy the session
session_destroy();
/* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/login.php");
}
 else {
    
$URLLoginText = "<a href=".login.php." >Login</a>";
 }
//----------------------------------------------------------------------------

include ("conn/dbconnection.php");
include ("conn/showerrors.php");

$getPerformerID = $_GET['PerformerID'];
$getScheduleID = $_GET['ScheduleID'];

$readeventsinfoquery = "SELECT registeredperformers.PerformerID, registeredperformers.PerformerName,registeredperformers.PerformerInfo, "
        . "registeredperformers.PerformerEmail,registeredperformers.image, schedule.ShowDate, schedule.ShowTime,venues.VenueName, venues.VenueAddress "
        . "FROM registeredperformers INNER JOIN junction ON junction.PerformerID = registeredperformers.PerformerID INNER JOIN "
        . "schedule ON schedule.ID = junction.ScheduleID INNER JOIN venues ON venues.VenueID = junction.VenueID "
        . "WHERE junction.ScheduleID = $getScheduleID AND junction.PerformerID = $getPerformerID";
$result = $conn->query($readeventsinfoquery);

if (!$result) {
         die("ERROR HAPPENED" . $conn->error); 
      }
//-----------------------------------------------------------------------

$sqlTicketsOnSale = "SELECT No_of_Tickets_Available AS NoOfTicketsOnSale, TicketID FROM tickets WHERE ScheduleID = $getScheduleID ";
$TicketsOnSale = $conn->query($sqlTicketsOnSale);

$sqlTicketsSOLD = "SELECT SUM(reservations.No_of_Tickets_Sold) AS TicketsSOLD  FROM tickets LEFT JOIN reservations ON tickets.TicketID = reservations.TicketID WHERE tickets.ScheduleID = $getScheduleID ";
$TicketsSOLD = $conn->query($sqlTicketsSOLD);
     
      
     // output data of each row
    while($row = $TicketsOnSale->fetch_assoc()) {     
    
    $NoOfTicketsOnSale = $row["NoOfTicketsOnSale"];
    $TicketID = $row["TicketID"];
        
  }
  
  //--------------------------------------------------------------
      
  //----------------------------------------------------------------
  while($row = $TicketsSOLD->fetch_assoc()) {     
    
    $NoOfTicketsSOLD = $row["TicketsSOLD"];
    
  } 
    
    $NoOfTicketsAvailable = $NoOfTicketsOnSale - $NoOfTicketsSOLD;
  
  If ($NoOfTicketsAvailable > 0) {
      $NoOfTicketsAvailableText = $NoOfTicketsAvailable . " Tickets Still Available";
     } else {                     
          $NoOfTicketsAvailableText = "SOLD OUT";
  }
  
   
  //--------------------------------------------------------
//CHECK IF USER HAS ALREADY BOOKED TICKETS FOR THIS SHOW'
   $UserID = $_SESSION["user_id"];
   
$sqlMyTickets = "SELECT SUM(No_of_Tickets_Sold) AS MyTickets FROM reservations WHERE RegisteredMemberID = $UserID AND TicketID =  $TicketID ";
$MyTickets = $conn->query($sqlMyTickets);

while($row = $MyTickets->fetch_assoc()) {     
    
    $MyBookedTickets = $row["MyTickets"];
    
  }
  //-------------------------------
  If ($MyBookedTickets > 0) {
      $MyBookedTicketsText = " You have already booked " . $MyBookedTickets . " tickets for this Event";
     } else {                     
          $MyBookedTicketsText = " You haven't booked any tickets yet for this Event";
  }
  
  //--------------------------------
  //REVIEWS'
  $sqlReviews = "SELECT ReviewID, Comments, Rating FROM reviews  INNER JOIN tickets ON reviews.TicketID = tickets.TicketID "
          . " WHERE reviews.TicketID = $TicketID AND reviews.UserID = $UserID ";
$Reviews = $conn->query($sqlReviews);

$ReviewCounter = 0;

while($row = $Reviews->fetch_assoc()) { 

$ReviewCounter =  $ReviewCounter + 1 ;
    
    $ReviewID = $row["ReviewID"];
    $Review = $row["Comments"];
    $Rating = $row["Rating"];
    $AddUppdate = "Update Review";
    
  }
  
  If ($ReviewCounter > 0) {
      $AddUppdate = "Update Review";
      $AddUpdateHeading = "Youve Left a Review, Feel Free to Update it Below";
      $AddUpdateFlag = "Y";
      $DeleteFlag = "Y";
     } else {                     
          $AddUppdate = "Leave a Review";
          $AddUpdateHeading = "Youve bought tickets so you can Leave a Review Below";
          $AddUpdateFlag = "N";
          $DeleteFlag = "N";
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
<script>
function validateForm() {    
    
  if (form1.NoOfTickets.value === "") {
    alert("Please Select the Number of Tickets You Require");
    form1.NoOfTickets.focus();	
    form1.NoOfTickets.style.borderColor='red';	
    return false ;
  }
  
  if (form1.NoOfTickets.value === "0") {
    alert("Please Select the Number of Tickets You Require");
    form1.NoOfTickets.focus();	
    form1.NoOfTickets.style.borderColor='red';	
    return false ;
  }
     
    
 return true ;
}
//-->
</script>
<script>
function validateReview() {    
    
  if (form2.Review.value === "") {
    alert("Please Leave a Review");
    form2.Review.focus();	
    form2.Review.style.borderColor='red';	
    return false ;
  }
  
  if (form2.Rating.value === "0") {
    alert("Please Leave a Rating");
    form2.Rating.focus();	
    form2.Rating.style.borderColor='red';	
    return false ;
  }
     
    
 return true ;
}
//-->
</script>
    <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
 <link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        <title>Events Information</title>
    </head>
    <body>
        <div class="container">
                   <div class="row"> <!--row 1 of the container-->
                <div class="col m4"></div>

                <div class="col m4">
                    <div class="row">
                        <h1 style="text-align: center">Zion</h1>
                    </div>

                    <div class="row">
                        <em><h3 style="text-align: center">Events Information</h3></em>
                    </div>
                </div>

                <div class="col m4"></div>      
            </div> <!--row 1 of the container ends here-->
   
                 <!--nav starts here-->
           <body>	
 <h1 style="text-align: center">Big Fest Belfast</h1>
                   

                    <div class="row">
                        <em><h3 style="text-align: center">Events</h3></em>
                    </div>
             <!--nav starts here-->
            <div class="row"> <!--row 2 of the container-->
           
                    <ul class="topnav" id="myTopnav2">
                        <li><a href="editProfile.php.php" class="brand">Profile</a></li>
                         <li><a href="venues.php" class="active">Venues</a></li>  
                         <li><a href="searchaxmple_1.php" class="active">Search Shows</a></li>
                        <li><a href="eventsPublic.php" class="active">Events</a></li>
                        <li><a href="myevents.php" class="active">My Reservations</a></li>  
                        <li style="float:right;"><a href="userlogin.php" >Log Out</a></li>
                        <li class="-icon">
                            <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
                        </li>
                    </ul>
                </div>   

 <?php
 
        while ($row = $result->fetch_assoc()){
                 $getPerformerID = $row["PerformerID"];
                 $getPerformerName = $row["PerformerName"];
                 $getPerformerInfo = $row["PerformerInfo"];
                $getEventDate = $row["ShowDate"];
                $getEventTime = $row["ShowTime"];
                $getVenueName = $row["VenueName"];
                $getVenueAddress = $row["VenueAddress"];
                $getPerformerEmail = $row["PerformerEmail"];
                $getPerformerImage = $row["image"];
                $_varImage =  '<img src="data:image/jpeg;base64,'.base64_encode( $getPerformerImage ).'"/>'; 
     echo "<div class='col m12'>
                    <em><h3 style='text-align: center'> $getPerformerName</h3></em>
                </div>
            
                <div class='row'>
                    <div class='col m12'>
            <p>$getPerformerInfo</p>
                   </div>
                    
                    <div class='row'>
                        <div class='col m6'>
                            <h4>Event Details</h4>
                            <dl>
                                <dt>When?</dt>
                                <dd>$getEventDate</dd>
                                <dd>$getEventTime</dd>
                                <dt>Where?</dt>
                                <dd>$getVenueName</dd>
                                <dd>$getVenueAddress</dd>
                                 <dt>Contact?</dt>
                                <dd>$getPerformerEmail</dd>
<a href='editregisteredperformerspersonaldetailsprocess.php?PerformerID=$getPerformerID'></a>
                            </dl>"
   
   ?>
   <form id="form1" action="TicketsReserved.php" method="post" onsubmit="return validateForm()">
 <?php
 
 echo '<input type="hidden" id="TicketID" name="TicketID" value="'.$TicketID.'">';
 
 If ($NoOfTicketsAvailable > 0) {
    echo  "<h4>Reserve Tickets Below</h4> * $NoOfTicketsAvailableText *  </br>  $MyBookedTicketsText </br>";
    
    echo 'Number of Tickets Required : <select name="NoOfTickets" id="NoOfTickets">';   
    
     ?> 
        
      
   <?php  
for ($x = 0; $x <= $NoOfTicketsAvailable; $x++) {
    
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
        echo ' <input type="submit" value="Reserve Ticket(s)" style="font-size:20px;font-family:Arial;background-color:lightgreen"/>';
 //---------------------------------------------------------------  
        
   ?> 
    <?php  
    
    
    
     } else {                     
      echo "<h4>SORRY - SOLD OUT !!</h4>";
  }
?>
<?php
   
                    echo    "</div>
                        
                        <div class='col m6'>
                    $_varImage
                        </div>
                        <div class='col m6'>"
                            ?>
                         </form>
<form id="form2" action="ReviewAdded.php" method="post" onsubmit="return validateReview()">
                     <?php 
                     
             If ($MyBookedTickets > 0) {
          
        echo '<input type="hidden" id="ReviewID" name="ReviewID" value="'.$ReviewID.'">';           
        echo '<input type="hidden" id="AddUpdateFlag" name="AddUpdateFlag" value="'.$AddUpdateFlag.'">';         
        echo '<input type="hidden" id="PerformerID" name="PerformerID" value="'.$getPerformerID.'">';
        echo '<input type="hidden" id="ScheduleID" name="ScheduleID" value="'.$getScheduleID.'">';
        echo '<input type="hidden" id="TicketID" name="TicketID" value="'.$TicketID.'">';
        echo $AddUpdateHeading. '<br/><textarea rows="6" id="Review" name="Review" cols="30">'.$Review.'</textarea></br>';
        
        
        //---------------
        echo 'Star Rating : <select name="Rating" id="Rating">';   
    
     ?> 
        
      
   <?php  
for ($x = 0; $x <= 5; $x++) {
    
    if ($x == $Rating) {

$select_attribute = 'selected';
}
else
   $select_attribute = ''; 


 
  echo '<option value="'.$x.'" '. $select_attribute . '>'.$x.'</option>';
  
  $select_attribute = ''; 
}
?>  <?php 
        echo '</select><br/>'; 
        
        echo ' <input type="submit" value="' .$AddUppdate. '" style="font-size:10px;font-family:Arial;background-color:lightgreen"/>';
        If ($DeleteFlag == "Y") {         
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
        echo '<a href="DeleteReview.php?ReviewID=$ReviewID=PerformerID=$PerformerID&ScheduleID=$ScheduleID">Delete Review</a>';
        
         }       
             }
                    ?>
     <?php
        }
   ?>
        </div> <!--container ends here-->
        </form>

        </br></br></br></br></br>
    </body>
</html>