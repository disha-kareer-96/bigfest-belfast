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

if($conn->connect_error) {
    echo "Failed to connect to my database".$conn->connect_errno;
}
                      
$sqlResults = "SELECT * FROM registeredmembers WHERE RegisteredMemberID = '".$_SESSION["user_id"]."'";      
$result = $conn->query($sqlResults );

//----------------------------------------------

    while($row=mysqli_fetch_assoc($result))  {              
    
    
      $_FirstName = $row["FirstName"];
      $_LastName = $row["LastName"];      
      $_EmailAddress = $row["EmailAddress"];
      $_ContactNumber = $row["ContactNumber"];
      $_Bio = $row["Bio"];
      $_DOB = $row["DOB"];
      
      $_Day = substr($_DOB, 8, 2);
      $_Month = substr($_DOB, 5, 2);
      $_Year = substr($_DOB, 0, 4);
      
      
      $_EmailUpdates = $row["EmailUpdates"];
      $_Image = $row["image"];
     // $_ImageScr  = str_replace("images/", "", $row["ImageScr"] );         
          
      $_ButtonText = "Update";
      
      }
     
 ?>
<!DOCTYPE html>
<html>
<title></title>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        <link href="css/toggleswitch.css" rel="stylesheet" type="text/css"/>
      

    <!--header-->
  
<script>
function validateForm() {
    
  if (form1.image.value == "") {
    alert("Please Select a File to Upload");
    form1.image.focus();	
    form1.image.style.borderColor='red';	
    return false ;
  }

  
}
</script>
</head>	
<body>	
 <h1 style="text-align: center">Big Fest Belfast</h1>
                   

                    <div class="row">
                        <em><h3 style="text-align: center">Profile</h3></em>
                    </div>
             <!--nav starts here-->
            <div class="row"> <!--row 2 of the container-->
           
                    <ul class="topnav" id="myTopnav2">
                        <li><a href="editProfile.php" class="brand">Profile</a></li>
                         <li><a href="venuesPublic.php" class="active">Venues</a></li>  
                         <li><a href="searchexample_1.php" class="active">Search Shows</a></li>
                        <li><a href="events.php" class="active">Events</a></li>
                        <li><a href="myevents.php" class="active">My Reservations</a></li>  
                        <li style="float:right;"><a href="loginPublic.php" >Log Out</a></li>
                        <li class="-icon">
                            <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
                        </li>
                    </ul>
                </div>   
  
  <div class="jumbo _pink">
      <h1>Upload a Profile Photo <?php echo "". $_FirstName . "";  ?> </h1>
</br>

<form action="fileuploaded.php" id="form1" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    Select image to upload:
    <input type="file" name="image"/></br>
        <input type="submit" name="submit" value="UPLOAD"/>
</form>
			<Center> </center>
		<br>
		
		</div>
                    
		</div>
  
</div>
<script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
</body>
 
</html>

