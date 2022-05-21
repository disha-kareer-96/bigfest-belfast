<?php
session_start();

if ($_SESSION["user_id"] == '') {

//destroy the session
session_destroy();
/* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/loginPublic.php");
}
//----------------------------------------------------------------------------

include ('password.php');

$conn = new mysqli("lamp-17.eeecs.qub.ac.uk", "csc2043Group0320", $password, "csc2043Group0320");
// Check connection
if($conn->connect_error) {
    echo "Failed to connect to my database".$conn->connect_errno;
}
//----------------------------------------------------------------------------

$ScheduleID  = $_POST["ScheduleID"];
$NoOfTickets  =  $_POST["NoOfTickets"];
$TicketID = $_POST["TicketID"] ;

//$EmailUpdates = $_POST["EmailUpdates"];


//check if new or update exisiting
//UPDATE
if ($_SESSION["user_id"] <> '') {
    
$sql = "INSERT INTO reservations (TicketID, RegisteredMemberID, No_of_Tickets_Sold)
 VALUES ('".$TicketID."', '".$_SESSION["user_id"]."', '".$NoOfTickets."' )";
}
   
if ($conn->query($sql) === TRUE) {
    /* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/myevents.php?TicketID=".$TicketID."");
//header("Location: <?php echo $URL; 
    
     
/* Make sure that code below does not get executed when we redirect. */
exit;

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
