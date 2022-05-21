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

<div class="wrapper">
            
                <h2> User login Details</h2>
           
            
</div>       
            <br>

        <div class="wrapper">
            <div class="top">
                <?php
                include("../conn/dbconnection.php");
                    $details = "SELECT * FROM users";
                    $read = $conn -> query($details);
                    
                    if(!$read) {
                        echo $conn->error;
                    }
                    while ($row = $read->fetch_assoc()) {
                        $userid = $row["id"];
                        $unamedata = $row["username"];
                        $passdata = $row["password"];
                        
                        
                        echo"<div class = 'wrapper'>
                        <h5>$unamedata</h5>
                         <div class='wrapper'> $passdata<br>  
                                </div> 
                                
                                </div> <br>";
                        
                    }
                        
                        ?>

            </div>
            
        </div>
            
                 <br>
                 
</body>

</html>