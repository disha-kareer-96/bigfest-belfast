<?php
include ("../conn/dbconnection.php");
include ("../conn/password.php");
include ("../conn/showerrors.php");

$readvenuenamesquery = "SELECT * FROM venues";

$result = $conn->query($readvenuenamesquery);
if (!$result) {
    die("read venue names query error" . $conn->error);
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add New Shows</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">    
        <link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>  
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col m1"></div>
                <div class="col m10">

                    <form method="POST" enctype="multipart/form-data" action="addnewshows.php">
                        <h3><legend>Add New Shows</legend></h3>
                        <div class="row">
                            <div class="col m4">
                                <label for="PerformerName">Enter Performer Name</label>
                            </div>
                            <div class="col m8">
<input class="_width75" type="text" placeholder="Enter New Performer Name Here" name="PerformerName"> 
                            </div>
                        </div>

                        <div class="row">
                            
                           <div class="col m4">
                                <label for="Category">Category</label>
                            </div>
                            <div class="col m8">
        <input class="_width75" type="text" placeholder="Enter Performer Category" name="PerformerCategory">
                      </div>
                        </div>
                           
                            
                        <div class="row">
                            <div class="col m4">
                                <label for="PerformerInfo">Performer Information</label>
                            </div>
                            <div class="col m8">
          <textarea class="_width75" placeholder="Write a brief description about yourself"                     name="PerformerInfo" rows="10" cols="20"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col m4">
                                <label for="ShowDate">Show Date</label>
                            </div>
                            <div class="col m8">
                    <input type="date" name="ShowDate">            
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col m4">
                                <label for="ShowTime">Show Time</label>
                            </div>
                            <div class="col m8">
                        <input type="time" name="ShowTime">            
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col m4">
                                <label for="Venues">Venue</label>
                            </div>

                 <div class="col m8">
                    <select class="_width75" name= "VenueName">
                        <?php
                        echo "<option value=''>Choose Venue</option>";
                        
                         while($row = $result->fetch_assoc()){
                            $getVenueID = $row["VenueID"];
                            $getVenueName = $row["VenueName"];
                            
                        echo "<option value='$getVenueID'>$getVenueName</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
                        
                <div class="row">
                           <div class="col m4">
                                <label for="Email">Performer Contact</label>
                            </div>
                            <div class="col m8">
        <input class="_width75" type="email" placeholder="Enter Performer Contact" name="PerformerEmail">
                      </div>
                </div>
                        
                
                
                        <div class="row">
                            <div class="col m12">
                                <label for="file:">Please upload the image of new performer</label>
                                <input type="file" name="uploadFile">
                            </div>
                        </div>
                  
                <input class=" _pink button" type="submit" value="Submit" name="Submit">
                    </form>
                    
                    <?php
                        if(isset($_POST ["Submit"])){
                            echo "<p>in post back section</p>";
                        //$sendPerformerID = $_POST['PerformerID'];
                        $sendPerformerName = $_POST['PerformerName'];
                        $sendPerformerCategory = $_POST['PerformerCategory'];
                        $sendPerformerInfo = $_POST['PerformerInfo'];
                        //$sendScheduleID = $_POST['ScheduleID'];
                        $sendShowDate = $_POST['ShowDate'];
                        $sendShowTime = $_POST['ShowTime'];
                        //$getVenueID = $_POST["VenueID"];
                        $sendVenueName = $_POST['VenueName'];
                        $sendPerformerEmail = $_POST['PerformerEmail'];
                    	//$sendPerformerImage = $_POST['PerformerImage'];
		  
			$sendfilename = $_FILES['uploadFile']['name'];
			$sendfiletemp = $_FILES['uploadFile']['tmp_name'];
		  
                     //echo "<p>Show Performer: $sendPerformerName</p>";
                        //echo "<p>Show venue value: $sendVenueName</p>";
                        
                //enable the above code to add a new image of performer.
		  //move_uploaded_file($sendfiletemp, "../img/".$sendfilename);
		  
$insertnewshowquery = "INSERT INTO registeredperformers (`PerformerName`,`PerformerEmail`,`PerformerInfo`,`PerformerImage`,`PerformerCategory`) VALUES ('$sendPerformerName','$sendPerformerEmail','$sendPerformerInfo',   '$sendfilename', '$sendPerformerCategory')";

echo "<p>Query: $insertnewshowquery</p>";

  $result = $conn->query($insertnewshowquery);
		  
		  if(!$result){
			  echo "Performer Error: ".$conn->error."<br>";
		  }else{
			  echo "<p>New Performer Data Added</p>";
                          $newPerformerID = $conn->insert_id;
                          
                          echo "<p>New Performer id: $newPerformerID</p>";
                         
		  }

$insertnewshowquerytwo = "INSERT INTO schedule (`ShowTime`,`ShowDate`)
VALUES ('$sendShowTime', '$sendShowDate')";

  $result = $conn->query($insertnewshowquerytwo);
		  
		  if(!$result){
			  echo "Schedule Error: ".$conn->error."<br>";
		  }else{
			  echo "<p>New Schedule Data Added</p>";
                          $newScheduleID = $conn->insert_id;
		  }
                    
$insertnewshowquerythree = "INSERT INTO junction (`VenueID`, `PerformerID`,`ScheduleID`)
VALUES ('$sendVenueName','$newPerformerID','$newScheduleID')";

		  
		  $result = $conn->query($insertnewshowquerythree);
		  
		  if(!$result){
			  echo "Junction Error: ".$conn->error."<br>";
		  }else{
			  echo "<p>New Performer and Schedule Record Added</p>";
		  }
                  }
                    ?>  
                </div>
                
                <div class="col m1"></div>
            </div>
        </div>
    </body>
</html>