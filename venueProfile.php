<?php

include ('password.php');

$conn = new mysqli("lamp-17.eeecs.qub.ac.uk", "csc2043Group0320", $password, "csc2043Group0320");

if($conn->connect_error) {
    echo "Failed to connect to my database".$conn->connect_errno;
}

$_SESSION["user_id"] = 12;
$_SESSION["user_type"] = 3;

 
$_UpdatedFlag =  $_GET["UpdatedFlag"];


if($_SESSION["user_type"] == 3) {
                        
$sqlResults = "SELECT * FROM registeredmembers WHERE RegisteredMemberID = '".$_SESSION["user_id"]."'";      

} elseif($_SESSION["user_type"] == 4) {
                        
$sqlResults = "SELECT * FROM registeredperformers WHERE PerformerID = '".$_SESSION["user_id"]."'";

}

$sqlResults = "SELECT * FROM registeredmembers WHERE RegisteredMemberID = '".$_SESSION["user_id"]."'";
$result = $conn->query($sqlResults );

echo "<br> user_username: ". $_SESSION["user_username"];

//----------------------------------------------

    while($row=mysqli_fetch_assoc($result))    
    
    if($_SESSION["user_type"] == 3) {
        
      $_UserTitle = "First Name"; 
      
      $_FirstName = $row["FirstName"];
      $_LastName = $row["LastName"];      
      $_EmailAddress = $row["EmailAddress"];
      $_ContactNumber = $row["ContactNumber"];
      $_Bio = $row["Bio"];
      $_EmailUpdates = $row["EmailUpdates"]; 
     // $_ImageScr  = str_replace("images/", "", $row["ImageScr"] );         
          
      $_ButtonText = "Update";
    
    } elseif($_SESSION["user_type"] == 4) {
    
      $_UserTitle = "Performer Name";
      
      $_FirstName = $row["FirstName"];
      $_LastName = $row["LastName"];
      $_PerfomerName = $row["PerformerName"];
      $_EmailAddress = $row["PerformerEmail"];      
      $_PerformerCategory = $row["PerformerCategory"];
      $_Bio = $row["PerformerInfo"];
      $_EmailUpdates = $row["EmailUpdates"]; 
     // $_ImageScr  = str_replace("images/", "", $row["ImageScr"] );
         
          
      $_ButtonText = "Update";
      
}

   
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
 <link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
 <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
 <link href="css/css.css" rel="stylesheet" type="text/css"/>
         
        <title>Venue Manager Profile</title>  
    </head>
        <style>
    @media only screen and (min-width: 550px) {
    
    .card{
    height:500px;
    }  
}
</style>
    <body>
         <div class="container"> <!--the container will hold everything together-->
            <div class="row"> <!--row 1 of the container-->
                <div class="col m4"></div>

                <div class="col m4">
                    <div class="row">
                        <h1 style="text-align: center">Zion</h1>
                    </div>

                    <div class="row">
                        <em><h3 style="text-align: center">Events</h3></em>
                    </div>
                </div>

                <div class="col m4"></div>      
            </div>
             
             <!--nav starts here-->
            <div class="row"> <!--row 2 of the container-->
                <div class="col m12">
                    <ul class="topnav" id="myTopnav2">
                        <li><a href="index.php" class="brand">Home</a></li>
                        <li><a href="venues.php" class="active">Venues</a></li>
                        <li><a href="events.php" class="active">Events</a></li>
                        <li><a href="secure/searchexample_1.php" class="active">Search Shows</a></li>
                        <li style="float:right;"><a href="login.php" >Login</a></li>
                        <li class="-icon">
                            <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
                        </li>
                    </ul>
                </div>
            </div>
                   
    <!--header-->
  
<script>
function validateForm() {
    
  if (form1.field1.value == "") {
    alert("Performer Name must be entered");
    form1.field1.focus();	
    form1.field1.style.borderColor='red';	
    return false ;
  }
  
  if (form1.field2.value == "") {
    alert("Email must be entered");
    form1.field2.focus();	
    form1.field2.style.borderColor='red';	
    return false ;
  }
  
  
}
</script>
</head>	
<body>	
  <ul class="topnav" id="myTopnav2">
  <center>
  <li><a href="index.php" class="brand">Home</a></li>
  <li><a href="venues.php" class="active">Venues</a></li>
  <li><a href="events.php" class="active">Events</a></li>
  <li><a href="search.php" class="active">Search Shows</a></li>
  <li style="float:right;"><a href="login.php" >Login</a></li>
  <li style="float:right;"><a href="#" >Sign In</a></li>
  <li class="-icon">
    <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
  </li>
  <br>
  
  <div class="jumbo _pink">
<h1>Hi, Welcome back <?php echo "". $_FirstName . "";  ?> </h1>
<h3>Profile Details</h3>

<?php
if ($_GET["UpdatedFlag"] = "Y") {
    

echo  "Details Successfully Updated! </Br>";
}
else
    echo '';

?>
                <br>
                <form id="form1" action="ProfileUpdated.php" method="post" onsubmit="return validateForm()">

 <?php           
        echo "". $_UserTitle . " : " ;
        echo '<input type="text" name="field1" maxlength="20" size="15" value="'.$_FirstName.'"><br/>'; 
        echo 'Last Name :  <input type="text" name="field2" maxlength="20" size="15" value="'.$_LastName.'"><br/>'; 
        echo 'Email :  <input type="text" name="field3" maxlength="30" size="25" value="'.$_EmailAddress.'"><br/>';
        echo 'Performer Category :  <input type="text" name="field4"  value="'.$_PerformerCategory.'"><br/>';
        echo 'Bio : <br/><textarea rows="6" name="field5" cols="30">'.$_Bio.'</textarea><br/>';       
        //echo '<input type="hidden" id="fieldID" name="fieldID" value="'.$_UserID.'">';
        
        if ($_EmailUpdates = 'Y') {

$select_attribute = 'checked';
}
else
   $select_attribute = ''; 
    
         
// Rounded switch -->
      echo 'Receive Email Updates : <label class="switch"><input type="checkbox" '. $select_attribute . ' name="field6"><span class="slider round"></span></label><br/>'; 
       echo 'Receive Email : '.$_EmailUpdates.'';
           

      echo ' <input type="submit" value="'.$_ButtonText.'"/>';
 $conn->close();
?>
</div>                   
</form>
			<Center> </center>
		<br>
		
		</div>
                    
		</div>
  
</div>
<script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
</body>

