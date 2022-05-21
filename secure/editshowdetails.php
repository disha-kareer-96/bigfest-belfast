<?php
include ("../conn/dbconnection.php");
include ("../conn/password.php");
include ("../conn/showerrors.php");

//reading show details query based on Performer Name( Performer ID)and Schedule ID so that the details can be edited.
$readshowdetailsquery = "SELECT registeredperformers.PerformerID, junction.ScheduleID, registeredperformers.PerformerName FROM registeredperformers INNER JOIN junction ON junction.PerformerID = registeredperformers.PerformerID INNER JOIN schedule ON schedule.ID = junction.ScheduleID";

$result =  $conn -> query($readshowdetailsquery);
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
        <title>Edit Show Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">    
<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
 <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
        <link href="../css/css.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
     <div class="container"> <!--container holding PHP elements-->
        <div class="row">
        
        <div class='col m12'>
            <div class='row'>
                 
                  <?php
                while ($row = $result->fetch_assoc()) {
                    $getPerformerID = $row["PerformerID"];
                    $getScheduleID = $row["ScheduleID"];
                    $getPerformerName = $row["PerformerName"];
echo "<div class = 'col m12'><h3><button><a href='editshowdetailsprocess.php?PerformerID=$getPerformerID&ScheduleID=$getScheduleID'>$getPerformerName</a></button></h3></div>";
                }
                ?>
            </div>
        </div>
        </div>
    </div> <!--container closed which holds the PHP elements-->
    </body>
</html>
