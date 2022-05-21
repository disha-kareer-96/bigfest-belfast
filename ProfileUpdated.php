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

$UserID = $_POST["fieldID"];

$FirstName  = str_replace("'", "", $_POST["field1"] );
$LastName  = str_replace("'", "", $_POST["field2"] );
$EmailAddress = str_replace("'", "", $_POST["field3"] );
$ContactNumber = str_replace("'", "", $_POST["field4"] );

$Address1 = strtoupper(str_replace("'", "", $_POST["Address1"] ));
$Address2 = strtoupper(str_replace("'", "", $_POST["Address2"] ));
$PostCode = strtoupper(str_replace("'", "", $_POST["PostCode"] ));

$Day =  $_POST["Day"];
$Month =  $_POST["Month"];
$Year =  $_POST["Year"];

$DOB = $Year."-".$Month."-".$Day;

$Bio = str_replace("'", "", $_POST["field6"] );
$EmailUpdates = $_POST["field7"];


//check if new or update exisiting
//UPDATE
if ($_SESSION["user_id"] <> '') {
    
$URL = "http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/editProfile.php?UserID={$UserID}&UpdatedFlag=Y";

$sql = "UPDATE registeredmembers SET FirstName = '".$FirstName."',  LastName ='".$LastName."', EmailAddress = '".$EmailAddress."', 
    ContactNumber = '".$ContactNumber."', DOB = '".$DOB."', Bio = '".$Bio."', EmailUpdates = '".$EmailUpdates."', "
        . "Address1 = '".$Address1."', Address2 = '".$Address2."', Postcode = '".$PostCode."'"
        . " WHERE RegisteredMemberID = '".$_SESSION["user_id"]."' ";

echo $sql;

}
//ADD NEW
else { 
    
$URL = "http://jmcmorrow05.web.eeecs.qub.ac.uk/FestivalSite/src/editProfile.php?UpdatedFlag=Y";

    
$sql = "INSERT INTO registeredmembers (RegisteredMemberID, FirstName, LastName, EmailAddress, ContactNumber, Bio, EmailUpdates)
 VALUES ('".$UserID."', '".$FirstName."', '".$LastName."', '".$EmailAddress."', '".$ContactNumber."',"
        . " '".$Bio."', '".$EmailUpdates."')";
}
   


if ($conn->query($sql) === TRUE) {
    /* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/editProfile.php");
//header("Location: <?php echo $URL; 
    
     
/* Make sure that code below does not get executed when we redirect. */
exit;

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
