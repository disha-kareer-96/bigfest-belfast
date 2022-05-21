<?php
session_start();

$theuser = $_SESSION["user_username"];
$userid = $_SESSION["user_id"];

if(!isset($theuser)) {
    header("Location:/login.php");
}

include("../conn/dbconnection.php");


$read5 = "SELECT * FROM users";

$readresult = $conn->query($read5);

if(!$readresult) {
    
    echo $conn->error;
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="../css/admin.css" rel="stylesheet" type="text/css"/>
        <title>Select Delete</title>
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
    <br>
    
    <div class="wrapper">
                <h1 align="center"><b>Please select the user you would like to delete.</b></h1>

    </div>
                        

    <?php
             while ($row = $readresult->fetch_assoc()) {
                            
                $userid2 = $row['id'];
                $userusername = $row['username'];
                
                            
             echo "<a href='deleteuser.php?rowid=$userid2'>
                   <h4 align='center'> <b>$userusername</b></h4>
                   
                   
                   </a>";
                            
                        
                        }
                        ?>
                       
                
    </head>
</html>
