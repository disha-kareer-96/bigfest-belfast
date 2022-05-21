<?php

session_start();

if ($_SESSION["user_id"] == '') {

//destroy the session
session_destroy();
/* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/loginPublic.php");
}
//----------------------------------------------------------------------------

include ("conn/dbconnection.php");
include ("conn/showerrors.php");

$getPerformerID = $_GET['PerformerID'];
$getScheduleID = $_GET['ScheduleID'];

$readeventsinfoquery = "SELECT registeredperformers.PerformerID, registeredperformers.PerformerName,registeredperformers.PerformerInfo, registeredperformers.PerformerEmail,registeredperformers.image,schedule.ShowDate, schedule.ShowTime,venues.VenueName, venues.VenueAddress FROM registeredperformers INNER JOIN junction ON junction.PerformerID = registeredperformers.PerformerID INNER JOIN schedule ON schedule.ID = junction.ScheduleID INNER JOIN venues ON venues.VenueID = junction.VenueID WHERE junction.ScheduleID = $getScheduleID AND junction.PerformerID = $getPerformerID";
$result = $conn->query($readeventsinfoquery);

if (!$result) {
         die("ERROR HAPPENED" . $conn->error);
      }
//--------------------------------------------------------

$sqlTicketsOnSale = "SELECT No_of_Tickets_Available AS NoOfTicketsOnSale FROM tickets WHERE ScheduleID = $getScheduleID ";
$TicketsOnSale = $conn->query($sqlTicketsOnSale);

$sqlTicketsSOLD = "SELECT SUM(reservations.No_of_Tickets_Sold) AS TicketsSOLD  FROM tickets LEFT JOIN reservations ON tickets.TicketID = reservations.TicketID WHERE tickets.ScheduleID = $getScheduleID ";
$TicketsSOLD = $conn->query($sqlTicketsSOLD);
     
      
     // output data of each row
    while($row = $TicketsOnSale->fetch_assoc()) {     
    
    $NoOfTicketsOnSale = $row["NoOfTicketsOnSale"];
    
  }
  //----------------------------------------------------------------
  while($row = $TicketsSOLD->fetch_assoc()) {     
    
    $NoOfTicketsSOLD = $row["TicketsSOLD"];
    
  } 
    
    $NoOfTicketsAvailable = $NoOfTicketsOnSale - $NoOfTicketsSOLD;
  
  If ($NoOfTicketsAvailable > 0) {
      $NoOfTicketsAvailableText = $NoOfTicketsAvailable . " Tickets Available";
     } else {                     
          $NoOfTicketsAvailableText = "SOLD OUT";
  }
  
  echo $NoOfTicketsAvailableText;
?>