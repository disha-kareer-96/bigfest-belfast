<?php
include('../conn/dbconnection.php');
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
        
       <?php echo"  <ul class='topnav' id='myTopnav2'> 
            <li><a href='venuemanagerhome.php?filter=$managerid1'>Home</a></li>
  <li><a href='VMperformances.php?filter=$managerid1'>Performances</a></li>
  <li><a href='VMeditprofile.php?filter=$managerid1'>Edit Profile</a></li>
  <li><a href='VMsetdetails.php?filter=$managerid1'>Image Upload</a></li>
  <li><a href='VMcommunication.php?filter=$managerid1'>Messages</a></li> 
            <li style='float:right;'><a href='login.php' >Logout</a></li>
            <li class='-icon'>
                <a href='javascript:void(0);' onclick='topnav('myTopnav2')'>☰</a>
            </li>
        </ul> ";
        ?>
        
        <div class='centering'>
            <h1> Discussion Board</h1>
        </div>
        <div class="centering">
        <?php
        $messagequery2 = "SELECT * FROM message INNER JOIN users ON users.id = message.userid";
        $queryresult2 = $conn->query($messagequery2);

        while ($row6 = $queryresult2->fetch_assoc()) {
            
            $usermessage = $row6["username"];
            $message = $row6["message"];
            $date = $row6["date"];
            
            echo "
                <div class='centering'>
                <div class='row'>
            <div class= 'card' style = 'width:600px; margin-bottom: 10px;'>
            <div class = '-content _alignCenter'>
            <h3 style='text-align:left;'><strong>$usermessage</strong></h3>
                <p style='text-align:left;'>$date</p>
                    <h5> $message</h5>


                    </div>
                    </div>
                    </div>
                            
            
            <br>
            </div>
            






                       </div>  
                       ";

        }
        ?>
            
        
    
    <div class='centering'>
      <?php echo " <form method='POST' action='VMcommunication.php?filter=$managerid1' style='background-color: #fafafa; border-radius: 10px; padding: 50px;'>" ;?>
            
            <?php echo "<textarea hidden readonly name='user'>$arg</textarea>"; ?>
            
                <label for="message"></label>
                <textarea required placeholder="Post a Message.." name="message" id="message" cols="45" rows="5"></textarea>
            
            <div class='centering'>
                <button style="display:flex;"class="editbutton" type="submit" name="submit" id="submit" >Post </button>
            </div>
           
        </form>
</div>
     

        <?php
        
        if (isset($_POST['submit'])) {
   
    
    $message1=$conn->real_escape_string($_POST["message"]);
    $username1=$conn->real_escape_string($_POST["user"]);
    $date1=date('Y-m-d');
    
   
    $messagequery="INSERT INTO message(messageid,userid,usernameM, message, date) VALUES(NULL,$arg,'$username1','$message1','$date1')";
     $resultmesssage = $conn->query($messagequery);
     

    

        }
?>
    
    







    </body>
</html>
