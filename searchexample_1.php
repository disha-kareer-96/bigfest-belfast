<?php

include('conn/dbconnection.php');


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="css/csssearch_1.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Zion</title>
    </head>
    <body>
        <div class="header">
            <h1>Zion</h1>
            <p>My supercool header</p>
        </div>
       
         <ul class="topnav" id="myTopnav2">
  <li><a href="index.php">Home</a></li>
  <li><a href="venue.php">Venues</a></li>
  <li><a href="events.php">Events</a></li>
  <li><a href="searchexample_1.php" class="active">Search Shows</a></li>
  <li style="float:right;"><a href="login.php" >Login</a></li>
  <li class="-icon">
    <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
  </li>
</ul>
        

        <div class="contain">
            
            <img id="imgages" src="img/searchbar1.jpg" style="width:100%; height:300px;">
            <div class="cent">
<h1 style="text-align: left; color: white;"> Which Show Next? </h1>
<form class="form-inline" method="post" id="mysearch" style="border-radius: 5px;">
                <fieldset>
                <div class="form-group">
                   
   <input  class="form-control" required name="searchperformer" type="text" placeholder="Search for Performer or Venue" style="width: 500px;height: 50px;font-size: 30px;font-weight: bold;font-family: 'Averta', helvetica , ariel ,sans-serif;">
                </div>

                    <div class="form-group">
                        <input class="form-control"class="btn" type="submit" value="Search" name="search" style="font-size: 16px; color: white;">
                    </div>
                    
                </div>
                <br>
            </fieldset>
            </form>
            </div>
             
    
                       <br>
                       
                       
                       <div class='row'>
            <div class='off-1'> 
                       <h1> Results:  </h1>
            </div>
                       </div>
                       
<?php
      if (isset($_POST['search'])) {
          
          
    $mysearchperformer = $_POST["searchperformer"];
   
    $searchdata = "SELECT * FROM registeredperformers INNER JOIN junction ON registeredperformers.PerformerID =  junction.PerformerID INNER JOIN venues ON venues.VenueID = junction.VenueID INNER JOIN schedule ON  schedule.ID = junction.ScheduleID WHERE PerformerName LIKE '%$mysearchperformer%' OR venues.VenueName LIKE '%$mysearchperformer%'";

    $searchresult = $conn->query($searchdata) or die($conn->error);


    
        
        while ($row = $searchresult->fetch_assoc()) {

            $performername = $row["PerformerName"];
            $performerid = $row["PerformerID"];
            $performerinfo = $row["PerformerInfo"];
            $PerformerCategory = $row["PerformerCategory"];
            
            $venueid = $row["VenueID"];
            $venuename = $row["VenueName"];
            $venuedescription = $row["VenueDescription"];
            $venueaddress = $row["VenueAddress"];
            $venuenumber = $row["VenueContactNumber"];
            
            
            $showdate = $row["ShowDate"];
            $showtime = $row["ShowTime"];
            
            
            
            
         
                     
        
        echo "<br>
            
            <div class='row'>
            <div class='off-3'> 
            
            <div class='centering'>
            <div class= 'card' style = 'width:600px; margin-bottom: 10px;'>
            <div class = '-content _alignCenter'>
            <h1><strong>$performername - $venuename</strong></h1>
                
                <h3> $PerformerCategory</h3>
                    <h3> $showdate - $showtime</h3>
                            
            </div>
            </div>
            </div>
            </div>
            
       

        </ul>";
        }
    }else{
        echo "<p> No results found</p>";

       
    }
      

?>    
                       
                       <br>
                       <div class="footer">
                          
                       </div>

                       <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
    </body>
</html>
