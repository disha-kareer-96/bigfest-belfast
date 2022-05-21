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
$ReviewID = $_GET["ReviewID"];

$PerformerID = $_GET["PerformerID"]; 
$ScheduleID = $_GET["ScheduleID"];

$DeleteFlag = $_GET["DeleteFlag"];

   
    If ($DeleteFlag == "Y") {
        
      $sql = "DELETE FROM reviews WHERE ReviewID = ".$ReviewID."";
           
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
