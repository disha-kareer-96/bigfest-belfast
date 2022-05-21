<?php
include ('password.php');

$conn = new mysqli("lamp-17.eeecs.qub.ac.uk", "csc2043Group0320", $password, "csc2043Group0320");

if($conn->connect_error) {
    echo "Failed to connect to my database".$conn->connect_errno;
}

$_EmailAddress = $_GET["Email"]; 


$sqlResults = "SELECT * FROM registeredmembers WHERE EmailAddress = '".$_EmailAddress."'";
$result = $conn->query($sqlResults );


//echo "User Info <br>";

if ($result_Venues->num_rows > 0) {
    // output data of each row
    while($row = $result_Venues->fetch_assoc()) {
        //echo "<br> UserID : ". $row["UserID"]. " - First Name: ". $row["FirstName"]. " Last Name " . $row["LastName"] . "<br>";
        
    session_start(); // Create session & settings
    
    $_SESSION['UserID'] = $row["RegisteredMemberID"];    
    $_SESSION['EmailAddress'] = $row["EmailAddress"];    
    $_SESSION['FirstName'] = $row["FirstName"];
    $_SESSION['LastName'] = $row["LastName"];
    
$conn->close();
    
    /* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/editProfile.php");
 
/* Make sure that code below does not get executed when we redirect. */
exit;
        
         //echo "<br> Sessions UserID : ". $_SESSION['UserID']. " - First Name: ". $_SESSION['FirstName']. " Last Name " . $_SESSION['LastName'] . "<br>";
        
        
    }
} else {
    echo "UnAuthorised Access";
}


?>








