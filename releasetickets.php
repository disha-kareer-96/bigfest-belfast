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

$ReservationID  = $_POST["ReservationID"];
$NoOfTickets  =  $_POST["NoOfTickets"];

//check if new or update exisiting
//UPDATE
if ($_SESSION["user_id"] <> '') {
    
$sql = "UPDATE reservations SET No_of_Tickets_Sold = No_of_Tickets_Sold - ".$NoOfTickets." WHERE ReservationID = ".$ReservationID."";

$sqlDelete = "DELETE FROM reservations WHERE No_of_Tickets_Sold = 0";

}
   
if ($conn->query($sql) === TRUE) {
    /* Redirect browser */

//header("Location: <?php echo $URL; 
 if ($conn->query($sqlDelete) === TRUE) {   
     
    header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/myevents.php");
 }
/* Make sure that code below does not get executed when we redirect. */
exit;

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

