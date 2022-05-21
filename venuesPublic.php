<?php
include ("conn/dbconnection.php");
include ("conn/showerrors.php");

$readvenuesquery = "SELECT VenueID, VenueName, VenueImage,VenueDescription FROM venues ORDER BY VenueID";

$result =  $conn -> query($readvenuesquery);
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
        <link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        <title>Venues</title>
    </head>
    <style>
    @media only screen and (min-width: 550px) {
    
    .card{
    height:320px;
    }  
}
</style>
    <body>
        <div class="container"> <!--the container will hold everything together-->
            <div class="row"> <!--row 1 of the container-->
                <div class="col m4"></div>

                <div class="col m4">
                    <div class="row">
                        <h1 style="text-align: center">Big Fest Belfast</h1>
                    </div>

                    <div class="row">
                        <em><h3 style="text-align: center">Venues</h3></em>
                    </div>
                </div>

                <div class="col m4"></div>      
            </div>

            <!--nav starts here-->
            <div class="row"> <!--row 2 of the container-->
                <div class="col m12">
                    <ul class="topnav" id="myTopnav2">
                        <li><a href="editProfile.php" class="brand">Profile</a></li>
                        <li><a href="venuesPublic.php" class="active">Venues</a></li>
                        <li><a href="events.php" class="active">Events</a></li>
                        <li><a href="searchexample_1.php" class="active">Search Shows</a></li>
                        <li style="float:right;"><a href="loginPublic.php" >Login</a></li>
                        <li class="-icon">
                            <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="row"><!--row 3 of the container-->
                <div class="col m2"></div>
                <div class="col m8">
                    <h5 style="text-align: center;">Check out our venues today for different events!</h5>
                </div>
                <div class="col m2"></div>
            </div>

            <div class='row'>
                <?php
                
                 while ($row = $result->fetch_assoc()){
                           $getVenueID = $row["VenueID"];
                           $getVenueName = $row["VenueName"];
                           $getVenueImage= $row["VenueImage"];
                           $getVenueDescription = $row["VenueDescription"];
                        
                        echo "<div class='col m6'>
                            <a class='mycard' href='events.php?filter=$getVenueID'>
                                <div class='card containerWidth'>
                                <div class='-content _alignCenter'>
                                    <strong>$getVenueName</strong>
                                    <img src='img/$getVenueImage' style='margin-top:10px;'/>
                            <p style='color: black'>$getVenueDescription</p>
                                </div>
                            </div>
                             </a> 
                        </div>";      
                 }
                ?>
                </div> 
            
                    <div class="row"> <!--footer starts here-->
                        <div class="footer">
                        <p style="text-align: center">Footer</p>
                        </div>
                        </div>
                        </div> <!--container ends here-->
</body>
</html>