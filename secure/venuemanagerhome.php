<?php
include('../conn/dbconnection.php');
$arg = $conn->real_escape_string($_GET["filter"]);
 $findusername1 = "SELECT * FROM users INNER JOIN venuemanagers ON venuemanagers.loginid = users.id WHERE venuemanagers.managerid = '$arg'";
 
     $queryresult1 = $conn->query($findusername1) or die($conn->error);
         
         while ($row = $queryresult1->fetch_assoc()) {
             $managerid1 = $row["managerid"];
         }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/venuemanager.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <title>Venue Manager</title>
    </head>
    
         <div class='container'>
      <div class="row">
          <div class="col m6">
           <?php echo "<a class='homebutton' href='VMperformances.php?filter=$managerid1'> Performances</a>"; ?>
          </div>
          
          <div class="col m6">
              <?php echo "<a class='homebutton' href='VMeditprofile.php?filter=$managerid1'> Edit Profile</a>"; ?>
          </div>
      </div>
        </div>
      
        <div class='container'>
        <div class='row'>
              <div class="col m6">
              <?php echo "<a class='homebutton' href='VMsetdetails.php?filter=$managerid1'>Image Upload</a> "; ?>
          </div>
          
            
            
           <div class="col m6">
             <?php echo "<a class='homebutton'  href='VMcommunication.php?filter=$managerid1'> Messages </a> "; ?>
          </div>
        </div>         
        </div>
    
        
    </body>
</html>

        
    </body>
</html>