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

//$UserID = $_POST["fieldID"];

$PerformerName  = str_replace("'", "", $_POST["field1"] );
//$LastName  = str_replace("'", "", $_POST["field2"] );
$EmailAddress = str_replace("'", "", $_POST["field3"] );
//$ContactNumber = str_replace("'", "", $_POST["field4"] );

$PerformerCategory = strtoupper(str_replace("'", "", $_POST["PerformerCategory"] ));

$Bio = str_replace("'", "", $_POST["field6"] );
$EmailUpdates = $_POST["field7"];


//check if new or update exisiting
//UPDATE
if ($_SESSION["user_id"] <> '') {
    
$URL = "http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/editPerformer.php?UpdatedFlag=Y";

$sql = "UPDATE registeredperformers SET PerformerName = '".$PerformerName."',  PerformerEmail = '".$EmailAddress."', 
    PerformerInfo = '".$Bio."', EmailUpdates = '".$EmailUpdates."', "
        . "PerformerCategory = '".$PerformerCategory."'"
        . " WHERE userID = '".$_SESSION["user_id"]."' ";

echo $sql;

}
//ADD NEW
else { 
    
$URL = "http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/editPerformer.php?UpdatedFlag=Y";

    
$sql = "INSERT INTO registeredperformers (userID, PerformerName, PerformerEmail, PerformerInfo, EmailUpdates)
 VALUES ('".$UserID."', '".$PerformerName."', '".$EmailAddress."', '".$Bio."', '".$EmailUpdates."')";
}
   


if ($conn->query($sql) === TRUE) {
    /* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/editPerformer.php?UpdatedFlag=Y");
//header("Location: <?php echo $URL; 
    
     
/* Make sure that code below does not get executed when we redirect. */
exit;

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
