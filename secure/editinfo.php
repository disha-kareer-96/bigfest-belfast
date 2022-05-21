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
        <title>Edit Home Page</title>
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
        <h1>Edit Info</h1>
        <p>Edit information on the homepage.</p>
        <form method="POST" action="editinfo.php">
            
            <label class="form-label">Information</label>
            <p>Fill in any relevant bit of information here.</p>
            <input class="form-input" name="info" type="text" placeholder="Information here..">
            
            <input type="submit" name='submit' class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default">
            
        </form>
    </div>
    <?php 
    if(isset($_POST['submit'])) {
       
        $newinfo = $conn-> real_escape_string($_POST["info"]);
        
        $anotherinsert = "INSERT INTO homepage(id, info)VALUES(NULL, '$newinfo')";
        $result4 = $conn->query($anotherinsert);
        if(!$result4) {
            $conn->error;
        } else {
            echo "<p> Updated the homepage!</p>";
        }
    }
    ?>
    <a href="homeoptions.php">Back</a>
</body>
</html>
