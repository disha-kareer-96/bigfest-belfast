<?php
include '../conn/dbconnection.php';
session_start();

$theuser = $_SESSION["user_username"];
$userid = $_SESSION["user_id"];

if (!isset($theuser)) {
    header("Location:login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="../css/admin.css" rel="stylesheet" type="text/css"/>
        <title>Reset Password</title>
</head>
    <!--nav-->
<ul class="topnav" id="myTopnav2">
  <li><a href="index.php" class="brand">Home</a></li>
  <li><a href="venue.php" class="active">Venues</a></li>
  <li><a href="events.php" class="active">Events</a></li>
  <li><a href="search.php" class="active">Search Shows</a></li>
  <li style="float:right;"><a href="personal.php" >Account</a></li>
   <li style="float:right;"><a href="logout.php" >Logout</a></li>
  <li class="-icon">
    <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
  </li>
</ul>

<body>
    <div class="container">
        <h1>User Details for forgotten password</h1>
    </div>
    
    <div>
        <?php
        $reading = $conn -> query ($readingquery);
        
        if(!$reading) {
            echo $conn ->error;
        }
        while ($row = $reading->fetch_assoc()) {
            $receiveduser = $row["username"];
            $receivedemail = $row["email"];
            
            echo "<div class='container'>
             <h4>$receiveduser</h4> <br/>
              <a href='mailto: $receivedemail'>$receivedemail</a><br/></div>";
            
        }
        ?>
    </div>
    <?php
    function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
randomPassword() = $pass;
?>
    <div class="wrapper">
        <?php    echo randomPassword(); ?>
    </div>
    <br>
    <!form>
    <div class="card" style="width:300px">
        <div class="-content _alignCenter">
        <strong>Change user Password</strong>
        <p>Fill out the form to change password.</p>
        <form method='POST' action="changepassword.php">
            <label class="form-label">Username</label>
            <input class="form-input" name="username1" type="text" placeholder="username" required>
            
            <label class="form-label">New Password</label>
            <input class="form-input" name="password1" type="text" placeholder="password" required>

            <label class="form-label">Re-enter New Password</label>
            <input class="form-input" name="password2" type="text" placeholder="Password" required>
            
            <input type="submit" name='sub' class="btn btn-primary"  value="Submit">
            <input type="reset" class="btn btn-default">
        </form>
        </div>
    </div>
    <?php
    if(isset($_POST['sub'])) {
        $newpassword1 = $conn->real_escape_string($_POST["password1"]);
        $newpassword2 = $conn->real_escape_string($_POST["password2"]);
        $usernamedata1 = $conn->real_escape_string($_POST["username1"]);
        $passnew = ($newpassword1 === $newpassword2);
        if($passnew) {
       $letsupdate = "UPDATE users SET password='$passnew' WHERE username='$usernamedata1'";
        $result3 = $conn->query($letsupdate);
        }elseif(!$result3){
        
            $conn->error;
        } else{
            echo "<p> Password has now been changed! </p>";
        }
    }
    ?>
    <br>
</body>

</html>