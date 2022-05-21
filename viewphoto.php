<?php
if(!empty($_GET['id'])){
    //DB details
    //---------------------------------------------
include ('password.php');

$conn = new mysqli("lamp-17.eeecs.qub.ac.uk", "csc2043Group0320", $password, "csc2043Group0320");
// Check connection
if($conn->connect_error) {
    echo "Failed to connect to my database".$conn->connect_errno;
}
    
    //Get image data from database
    $result = $conn->query("SELECT image FROM registeredmembers WHERE RegisteredMemberID = {$_GET['id']}");
    
    if($result->num_rows > 0){
        $imgData = $result->fetch_assoc();
        
        //Render image
        header("Content-type: image/jpg"); 
        echo $imgData['image']; 
    }else{
        echo 'Image not found...';
    }
}
?>