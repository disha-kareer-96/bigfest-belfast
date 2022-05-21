<?php

include '../conn/dbconnection.php';
session_start();

$theuser = $_SESSION["user_username"];
$userid = $_SESSION["user_id"];

if (!isset($theuser)) {
    header("Location:/login.php");
}


$id = $_GET['rowid'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="../css/admin.css" rel="stylesheet" type="text/css"/>
        <title>Delete User</title>
</head>

<body>
    <div class="wrapper">
        <h1>User Updated</h1>
        
        <?php
        $deletequery = "DELETE FROM users WHERE id='$id'";
        $updateresult = $conn->query($deletequery);
        
        if($updateresult) {
            echo "<h3>User has now been deleted.</h3>";
        }else{
            echo $conn->error;
        }
        ?>
    </div>
    <a href="userfunctions.php"> Back</a>
    
</body>