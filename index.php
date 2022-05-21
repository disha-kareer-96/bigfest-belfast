<?php

include ('conn/dbconnection.php');

$readquery = "SELECT * FROM homepage";

$result2 = $conn -> query($readquery);

if(!$result2) {
    echo $conn -> error;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        ​<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Home Page</title>
</head>

<body>
    <div class='header'>
        <h1>BigFestBelfast</h1>
    </div>
    
<div class="row">
                <div class="col m12">
                    <ul class="topnav" id="myTopnav2">
                        <li><a href="index.php" class="brand">Home</a></li>
                        <li><a href="venues.php" class="active">Venues</a></li>
                        <li><a href="events.php" class="active">Events</a></li>
                        <li><a href="search.php" class="active">Search Shows</a></li>
                        <li style="float:right;"><a href="login.php" >Login</a></li>
                        <li class="-icon">
                            <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
                        </li>
                    </ul>
                </div>
            </div>
    <br>

    <div class="wrapper">
<div class="row">
    <div class="col m3"><h1>Key Dates</h1>
        <h2>We can't wait to see you this August.</h2>
        <h3>More information is being gathered about next years festival so stay tuned for more updates!</h3>
    </div>
    <div class="col m9"><h1>About Us</h1>
        <h2>We're a festival company, interested in precuring up and coming artists for your entertainment. It is OUR job to make sure all your entertainment needs have been met! Browse through our website and see what catches your eye!</h2></div>
</div>
    </div>
    
    <br>
    
    <div class="wrapper">
    <div class="row">
    <div class="col m3">
        <h2>Keep checking back here for new updates, on what's happening with this year's festival.</h2>
       
    </div>
    <div class="col m9">
        <h2>Make sure to keep checking your account to see all your new shows, if you don't have an account make sure to sign up below.</h2></div>
</div>
    </div>
    <br>
    <div class="row">
<div class="col m12 ">  <h1>Different types of entertainment we have to offer</h1></div>
</div>
  
<div class="row">
    <div class="col m3">
        <div class="img"> <img src="img/comedy.jpg" alt=""/></div>
        <h3>Comedy</h3>
    </div>
    <div class="col m3">
        <img src="img/theatre.jpg" alt=""/>
        <h3>Theatre</h3>
    </div>
    <div class="col m3">
        <img src="img/music.jpg" alt=""/>
        <h3>Music</h3>
    </div>
	
</div>
    <br>
<div class="row">
<div class="col m12 ">  <h1>See What's happening with Us!</h1></div>
</div>

<br>
<div class="wrapper">
<?php
$count=1;
while ($rowdata = $result2->fetch_assoc()) {
    $info=$rowdata["info"];
    
    echo "<div class='row'>"
    . "<div class='col m3'>"
            . "<div class='card' style='width:300px'>"
                . "<div class='-content _alignCenter'>"
                . "<h4> $info </h4></div></div></div>";
}
?>
</div>
<br>
<div class="row">
    <div class="col m3">
        <div class="card" style="width:300px">

            <div class="-content _alignCenter">
            <strong>Venues</strong>
            <p>Click here to view our list of venues. Each venue shown upholds our strict health and safety regulations, creating a more enjoyable experience for you and fellow festival goers.</p>
            <button class="_small _yellow"onclick="window.location.href = 'venues.php';">Click Here</button>
            </div>
        </div>
    </div>
    
    <div class="col m3">
        <div class="card" style="width:300px">

            <div class="-content _alignCenter">
            <strong>Events</strong>
            <p>Click here to view our exciting list of events coming to you in 2020. We can't wait to see you there!</p>
            <button class="_small _yellow"onclick="window.location.href = 'events.php';">Click Here</button>
            </div>
        </div>
        
    </div>
     
    <div class="col m3">
        <div class="card" style="width:300px">

            <div class="-content _alignCenter">
            <strong>Search Shows</strong>
            <p>Click here to search all of our upcoming shows. Search for an event that you'll love!</p>
            <button class="_small _yellow"onclick="window.location.href = 'searchexample_1.php';">Click Here</button>
            </div>
        </div>            
    </div>
        
    <div class="col m3">
        <div class="card" style="width:300px">

            <div class="-content _alignCenter">
            <strong>Login</strong>
            <p> Click down below to login to our community and take part in all we have to offer.</p>
            <button class="_small _yellow"onclick="window.location.href = 'userlogin.php';">Click Here</button>
            </div>
        </div>
    </div>
</div>
    

<br>
<div class="footer">
    <p>
        <br>
    </p>
</div>
<script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
</body>

</html>
