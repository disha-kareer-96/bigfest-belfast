<?php
include('../conn/dbconnection.php');
$arg = $conn->real_escape_string($_GET["filter"]);
 $findusername1 = "SELECT * FROM users INNER JOIN venuemanagers ON venuemanagers.loginid = users.id WHERE venuemanagers.managerid = '$arg'";
 
     $queryresult1 = $conn->query($findusername1) or die($conn->error);
         
         while ($row = $queryresult1->fetch_assoc()) {
             $managerid1 = $row["managerid"];
         }


?>
<html>
    <head>
        <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="venuemanger.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="../css/venuemanager.css" rel="stylesheet" type="text/css"/>
        <title>Venue Manager</title>
        <title></title>
    </head>
    <body>
        <ul class="topnav" id="myTopnav2"> 
 <?php echo" <li><a href='venuemanagerhome.php?filter=$managerid1'>Home</a></li>
  <li><a href='VMperformances.php?filter=$managerid1'>Performances</a></li>
  <li><a href='VMeditprofile.php?filter=$managerid1'>Edit Profile</a></li>
  <li><a href='VMsetdetails.php?filter=$managerid1'>Image Upload</a></li>
  <li><a href='VMcommunication.php?filter=$managerid1'>Messages</a></li> "; ?>
  <li style="float:right;"><a href="login.php" >Logout</a></li>
  <li class="-icon">
    <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
  </li>
</ul>
        
       
            <?php
            $arg = $conn->real_escape_string($_GET["filter"]);
            
            $profilequery = "SELECT * FROM `venues` INNER JOIN venuemanagers ON venuemanagers.venueid = venues.VenueID WHERE venuemanagers.venueid = '$arg'";
            
            $profileresult = $conn->query($profilequery) or die($conn->error);
            
            while ($row = $profileresult->fetch_assoc()) {            
            $venueName = $row["VenueName"];
            $venueid = $row["VenueID"];
            $venuedescrip = $row["VenueDescription"];
            $venueaddress = $row["VenueAddress"];
            $venuenum = $row["VenueContactNumber"];
            
            }
            
             echo "
                  
             <div class='centering'>
            
            <div class='row'>
            <div class= 'card' style = 'width:600px; margin-bottom: 10px;'>
            <div class = '-content _alignCenter'>
            <h1> Edit Profile</h1>
            <form method='POST' action='UpdateVMProfile.php?filter=$managerid1'>
            <h3>Name:</h3>
            <h5><textarea name='VenueName'style='width:500px; height:100px;'required='required' >$venueName</textarea></h5> 
                
             <h3>Description</h3>
             <h5><textarea style='width:500px; height:100px;' name='VenueDescription' required='required' >$venuedescrip</textarea></h5> 
               
             <h3>Address</h3>
             <h5><textarea  style='width:500px; height:100px;' name='VenueAddress' required='required' >$venueaddress</textarea></h5> 

             <h3>Number</h3>
             <h5><textarea style='width:500px; height:100px;' name='VenueContactNumber' required='required' >$venuenum</textarea></h5> 
                 
            

             
                        
            <div class='button1'>
            <button class='editbutton' type='submit'> Submit </button>
            </div>
            
            </form>
            </div>
            </div>
            </div>
                     </div>";
                     

            
            ?>
            
            
        </div>
        
        
        
        
        
        
        
        
        
    </body>
</html>
