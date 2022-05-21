<?php
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        /*
         * Insert image data into database
         */
        
        //DB details
        include ('password.php');

$conn = new mysqli("lamp-17.eeecs.qub.ac.uk", "csc2043Group0320", $password, "csc2043Group0320");

if($conn->connect_error) {
    echo "Failed to connect to my database".$conn->connect_errno;
}
        
        $dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
        $insert = $conn->query("UPDATE registeredmembers SET image = ('$imgContent') WHERE RegisteredMemberID = 12");
        if($insert){
            echo "File uploaded successfully.</br></br>";
            //echo "<a href='viewphoto.php?id=12'>Click here to View Photo</a>";
            header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/editProfile.php");
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
}
?>