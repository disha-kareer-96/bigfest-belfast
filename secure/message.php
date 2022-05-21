<?php

include('dbconnection.php');
$arg = $conn->real_escape_string($_GET["filter"]);
$findusername1 = "SELECT * FROM users INNER JOIN venuemanagers ON venuemanagers.loginid = users.id WHERE venuemanagers.managerid = '$arg'";

$queryresult1 = $conn->query($findusername1) or die($conn->error);

while ($row = $queryresult1->fetch_assoc()) {
    $managerid1 = $row["managerid"];
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="../css/venuemanger.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
        <link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="../css/venuemanager.css" rel="stylesheet" type="text/css"/>
        <title>Venue Manager</title>
        <title></title>
    </head>
    <body>
        <ul class="topnav" id="myTopnav2"> 
            <?php echo" <li><a href='venuemanagerhome.php?filter=$managerid1'>Home</a></li>
  <li><a href='VMperformances.php?filter=$managerid1'>Performances</a></li>
  <li><a href='VMeditprofile.php?filter=$managerid1'>Edit Profile</a></li>
  <li><a href='VMsetdetails.php?filter=$managerid1'>Image Upload</a></li>
  <li><a href='VMcommunication.php?filter=$managerid1'>Messages</a></li> "; ?>
            <li style="float:right;"><a href="login.php" >Logout</a></li>
            <li class="-icon">
                <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
            </li>
        </ul>

          </body>
</html>


