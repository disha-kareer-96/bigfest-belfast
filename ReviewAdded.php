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
$ReviewID = $_POST["ReviewID"];

$TicketID = $_POST["TicketID"];
$Review = str_replace("'", "", $_POST["Review"] );
$TicketID = $_POST["TicketID"];
$Rating = $_POST["Rating"];

$PerformerID = $_POST["PerformerID"]; 
$ScheduleID = $_POST["ScheduleID"];

$AddUpdateFlag = $_POST["AddUpdateFlag"];

//check if new or update exisiting
//UPDATE

    
    If ($AddUpdateFlag == "Y") {
        
      $sql = "UPDATE reviews SET Comments = '".$Review."', Rating = ".$Rating." WHERE ReviewID = ".$ReviewID."";
      
     } else {                     
          $sql = "INSERT INTO reviews (UserID, TicketID, Comments, Rating)
 VALUES ('".$_SESSION["user_id"]."', '".$TicketID."', '".$Review."', '".$Rating."')";
  }
    
  

if ($conn->query($sql) === TRUE) {
    /* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/eventsinfo.php?PerformerID=$PerformerID&ScheduleID=$ScheduleID");
//header("Location: <?php echo $URL; 
    
     
/* Make sure that code below does not get executed when we redirect. */
exit;

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
