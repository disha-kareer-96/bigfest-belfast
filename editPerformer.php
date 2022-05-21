<?php
session_start();

if ($_SESSION["user_id"] == '') {

//destroy the session
session_destroy();
/* Redirect browser */
header("Location: http://jmcmorrow05.web.eeecs.qub.ac.uk/bigfestbelfast/loginPublic.php");
}
//----------------------------------------------------------------------------

include ('password.php');

$conn = new mysqli("lamp-17.eeecs.qub.ac.uk", "csc2043Group0320", $password, "csc2043Group0320");

if($conn->connect_error) {
    echo "Failed to connect to my database".$conn->connect_errno;
}

$_UpdatedFlag =  $_GET["UpdatedFlag"];
                        
$sqlResults = "SELECT * FROM registeredperformers WHERE userID = '".$_SESSION["user_id"]."'";      
$result = $conn->query($sqlResults );

//----------------------------------------------

    while($row=mysqli_fetch_assoc($result))  {              
    
    
      $_PerformerName = $row["PerformerName"];
      //$_LastName = $row["LastName"];      
      $_EmailAddress = $row["PerformerEmail"];
      $_ContactNumber = $row["ContactNumber"];
      $_Bio = $row["PerformerInfo"];
      //$_DOB = $row["DOB"];
      $_PerformerCategory = $row["PerformerCategory"];
      //$_Address2 = $row["Address2"];
      //$_PostCode = $row["Postcode"];
      
      //$_Day = substr($_DOB, 8, 2);
      //$_Month = substr($_DOB, 5, 2);
      //$_Year = substr($_DOB, 0, 4);     
      
      $_EmailUpdates = $row["EmailUpdates"];
      $_Image = $row["image"];        
      
          
      $_ButtonText = "Update";
      
      }
     
 ?>
<!DOCTYPE html>
<html>
<title></title>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        <link href="css/toggleswitch.css" rel="stylesheet" type="text/css"/>
      

    <!--header-->
  
<script>
function validateForm() {
    
  if (form1.field1.value == "") {
    alert("Performer Name must be entered");
    form1.field1.focus();	
    form1.field1.style.borderColor='red';	
    return false ;
  }
      
  if (form1.field3.value == "") {
    alert("Email must be entered");
    form1.field3.focus();	
    form1.field3.style.borderColor='red';	
    return false ;
  }
  
  
  
  
}
</script>
</head>	
<body>	
 	
 <h1 style="text-align: center">Big Fest Belfast</h1>
                   

                    <div class="row">
                        <em><h3 style="text-align: center">Profile</h3></em>
                    </div>
             <!--nav starts here-->
            <div class="row"> <!--row 2 of the container-->
           
                    <ul class="topnav" id="myTopnav2">
                        <li><a href="editPerformer.php" class="brand">Profile</a></li>
                         <li><a href="venues.php" class="active">Venues</a></li>  
                         <li><a href="searchaxmple_1.php" class="active">Search Shows</a></li>
                        <li><a href="events.php" class="active">Events</a></li> 
                        <li style="float:right;"><a href="userlogin.php" >Log Out</a></li>
                        <li class="-icon">
                            <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
                        </li>
                    </ul>
                </div>   
  <br>
  
  <div class="jumbo _pink">
      <h1>Welcome back <?php echo "". $_PerformerName . "";  ?> </h1>
  <?php   //Render image
  if ($_Image != "") {
    echo '<img src="data:image/jpeg;base64,'.base64_encode( $_Image ).'"/></br>';
} else {
    echo '<a href="selectfile.php">Upload a Profile Photo</a></br>';
}
    
  ?>
      <?php   //Render image
  if ($_Image != "") {
    echo '<a href="selectfile.php">Change Profile Photo?</a></br>';
} else {
    echo '';
}  
  ?>
<h3>Profile Details</h3>
<?php
if ($_GET["UpdatedFlag"] == "Y") {
    

echo  "Details Successfully Updated on " . date("d/m/yy") . " at " . date("h:i") . " </Br>";
}
else
    echo '';

?>
                <br>
                <form id="form1" action="PerformerUpdated.php" method="post" onsubmit="return validateForm()">

 <?php           
        
        echo 'Performer Name : <input type="text" name="field1" maxlength="20" size="20" value="'.$_PerformerName.'"><br/>'; 
        //echo 'Last Name : <input type="text" name="field2" maxlength="20" size="15" value="'.$_LastName.'"><br/>';
        echo 'Email :  <input type="text" name="field3" maxlength="30" size="25" value="'.$_EmailAddress.'"><br/>';
       // echo 'Contact Number :  <input type="text" name="field4" maxlength="15" size="15" value="'.$_ContactNumber.'"><br/>'; 
        //echo 'DOB : <input type="text" name="Day" maxlength="2" size="1" value="'.$_Day.'"> - '; 
        //echo '<input type="text" name="Month" maxlength="2" size="1" value="'.$_Month.'"> - ';
        //echo '<input type="text" name="Year" maxlength="4" size="2" value="'.$_Year.'"><br/>';         
        echo 'Bio : <br/><textarea rows="6" name="field6" cols="30">'.$_Bio.'</textarea><br/>';       
        echo 'Performer Category :  <input type="text" name="PerformerCategory" maxlength="30" size="25" value="'.$_PerformerCategory.'"><br/>';
        //echo 'Address 2 :  <input type="text" name="Address2" maxlength="30" size="25" value="'.$_Address2.'"><br/>';
        //echo 'Post Code :  <input type="text" name="PostCode" maxlength="8" size="6" value="'.$_PostCode.'"><br/>';
        
        
        //echo '<input type="hidden" id="fieldID" name="fieldID" value="'.$_UserID.'">';        
        
        
        if ($_EmailUpdates == 'Y') {

$select_attribute = 'checked';
}
else
   $select_attribute = ''; 
    
         
// Rounded switch -->
      echo 'Receive Email Updates : <label class="switch"><input type="checkbox" '. $select_attribute . ' name="field7" value="Y"><span class="slider round"></span></label><br/><br/>'; 
       
           

      echo ' <input type="submit" value="'.$_ButtonText.'" style="font-size:20px;font-family:Arial;background-color:lightgreen"/>';
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
 
</html>

