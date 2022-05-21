<?php
include '../conn/dbconnection.php';
session_start();

$theuser = $_SESSION["user_username"];
$userid = $_SESSION["user_id"];

if (!isset($theuser)) {
    header("Location:/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="../css/admin.css" rel="stylesheet" type="text/css"/>
        <title>Administration Home</title>
</head>

<body>
    <br>
    <!--nav-->
<ul class="topnav" id="myTopnav2">
    <li><a href="adminhome.php" class="brand">Home</a></li>
    
    <li style="float:right;"><a href="logout.php" >Logout</a></li>
  <li class="-icon">
    <a href="javascript:void(0);" onclick="topnav('myTopnav2')">â˜°</a>
  </li>
</ul>
    <div class="row">
	<div class="col m3"><div class="card" style="width:300px">

                <div class="-content _alignCenter">
                <strong>Edit Home Page</strong>
                <p>Click here to edit on the home page.</p>
                <button class="_small _yellow"onclick="window.location.href = 'editinfo.php';">Click Here</button>
                </div>
                </div>
        </div>
        	
</div>




</body>

</html>
