<?php
include ("../conn/dbconnection.php");
include ("../conn/password.php");
include ("../conn/showerrors.php");

//receiving ID's from the editshowdetails page
$getPerformerID = $conn->real_escape_string($_GET['PerformerID']);
$getScheduleID = $conn->real_escape_string($_GET['ScheduleID']);

//editshowdetailsprocess query (form)
$readquery = "SELECT schedule.ShowDate, schedule.ShowTime, venues.VenueName, venues.VenueAddress    
FROM schedule 
INNER join junction
ON schedule.id = junction.ScheduleID 
INNER join venues
ON junction.VenueID = venues.VenueID
INNER join registeredperformers
ON junction.PerformerID = registeredperformers.PerformerID
where junction.PerformerID = $getPerformerID AND junction.ScheduleID=$getScheduleID";

$result =  $conn -> query($readquery);
if(!$result)
{
    die("ERROR HAPPENED".$conn->error);
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
        <title>Edit Show Details Process</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">    
<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
 <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>  
    </head>
    <body>
        
        <div class="container">
            <?php
echo "<form method = 'POST' action='editshowdetailsprocess.php?PerformerID=$getPerformerID&ScheduleID=          $getScheduleID'>";
        ?>
                <div class='row'>
                    
                    <div class='col m12'>
                        <legend>Edit Show Details</legend>
                    </div>

                    <div class='row'>
                        <?php
                        while ($row =$result->fetch_assoc()){
                        $getShowDate = $row["ShowDate"];
                        $getShowTime = $row["ShowTime"];
                        $getVenueName = $row["VenueName"];
                        $getVenueAddress = $row["VenueAddress"];
                        
                        echo "<div class='col m6'>
                            <div class='row'>
                    <label for='ShowDate'>Show Date</label>
        <input class='_width50' type='text' id='ShowDate' name='ShowDate' value='$getShowDate'>
                            </div>
                            
                        <div class='row'>
                    <label for='ShowTime'>Show Time</label>
        <input class='_width50' type='text' id='ShowTime' name='ShowTime' value='$getShowTime'>
                        </div>
                        </div>";


                        echo "<div class='col m6'>
                   <div class='row'>
                    <label for='VenueName'>Venue Name</label>
        <input class='_width50' type='text' id='ShowDate' name='VenueName' value='$getVenueName'>
                            </div>
                            
                        <div class='row'>
                    <label for='VenueAddress'>Venue Address</label>
             <textarea class='_width50' id='VenueAddress'>$getVenueAddress</textarea>
                        </div>
                        </div>";
                        }
                        ?>
                    </div>
                    <input class='_pink button' type='submit' value='Update' name="Update">
        </div>
            </form>
        
            <?php
            if(isset($_POST["Update"])){
                $getnewshowtime = $conn->real_escape_string($_POST["ShowTime"]);
                $getnewshowdate = $conn->real_escape_string($_POST["ShowDate"]);
                
//updateshowdetailsquery based on PerformerID and ScheduleID              
$updateshowdetailsquery = "UPDATE schedule 
INNER join junction
ON schedule.id = junction.ScheduleID
INNER join registeredperformers
ON junction.PerformerID = registeredperformers.PerformerID
SET ShowTime= '$getnewshowtime', ShowDate= '$getnewshowdate'
where junction.PerformerID = $getPerformerID AND junction.ScheduleID=$getScheduleID";

    $result= $conn->query($updateshowdetailsquery);
                
                if($result){ //if the update query is successful do the following...
                        echo "<p>Show Details updated successfully</p>";
                }
                else{
                    echo "update error ".$conn->error; //if unsuccessful show error
                }
            }
            ?>
            
  </div>  <!--container ends here-->
    </body>
</html>