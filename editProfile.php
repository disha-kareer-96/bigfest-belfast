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
                        
$sqlResults = "SELECT * FROM registeredmembers WHERE RegisteredMemberID = '".$_SESSION["user_id"]."'";      
$result = $conn->query($sqlResults );

//----------------------------------------------

    while($row=mysqli_fetch_assoc($result))  {              
    
    
      $_FirstName = $row["FirstName"];
      $_LastName = $row["LastName"];      
      $_EmailAddress = $row["EmailAddress"];
      $_ContactNumber = $row["ContactNumber"];
      $_Bio = $row["Bio"];
      $_DOB = $row["DOB"];
      $_Address1 = $row["Address1"];
      $_Address2 = $row["Address2"];
      $_PostCode = $row["Postcode"];
      
      $_Day = substr($_DOB, 8, 2);
      $_Month = substr($_DOB, 5, 2);
      $_Year = substr($_DOB, 0, 4);
      
      
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
    
    var varDay = parseInt(form1.Day.value, 10);
    var varMonth = form1.Month.value;
    
  if (form1.field1.value === "") {
    alert("First Name must be entered");
    form1.field1.focus();	
    form1.field1.style.borderColor='red';	
    return false ;
  }
  
  if (form1.field2.value ===  "") {
    alert("Last Name must be entered");
    form1.field2.focus();	
    form1.field2.style.borderColor='red';	
    return false ;
  }
  
  if (form1.field3.value ===  "") {
    alert("Email must be entered");
    form1.field3.focus();	
    form1.field3.style.borderColor='red';	
    return false ;
  }
  
  if (form1.field4.value ===  "") {
    alert("Contact Number must be entered");
    form1.field4.focus();	
    form1.field4.style.borderColor='red';	
    return false ;
  }
  
  //------------------------------------------------------------
  if (varDay > 30 && varMonth ===  "09") {
    alert("There are only 30 days in September");
    form1.Month.focus();	
    form1.Month.style.borderColor='red';	
    return false ;
  }
  
  if (varDay > 30 && varMonth ===  "04") {
    alert("There are only 30 days in April");
    form1.Month.focus();	
    form1.Month.style.borderColor='red';	
    return false ;
  }
  
  if (varDay > 30 && varMonth ===  "06") {
    alert("There are only 30 days in June");
    form1.Month.focus();	
    form1.Month.style.borderColor='red';	
    return false ;
  }
  
  if (varDay > 30 && varMonth ===  "11") {
    alert("There are only 30 days in November");
    form1.Month.focus();	
    form1.Month.style.borderColor='red';	
    return false ;
  }
  
  if (varDay > 28 && varMonth ===  "02") {
    alert("There are only 28 days in February\nExcept on a leap year (29)\nHaven't coded Leap Years yet...Sorry!");
    form1.Month.focus();	
    form1.Month.style.borderColor='red';	
    return false ;
  }
    
    
 return true ;
}
//-->
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
                        <li><a href="editProfile.php.php" class="brand">Profile</a></li>
                         <li><a href="venuesPublic.php" class="active">Venues</a></li>  
                         <li><a href="searchexample_1.php" class="active">Search Shows</a></li>
                        <li><a href="events.php" class="active">Events</a></li>
                        <li><a href="myevents.php" class="active">My Reservations</a></li>  
                        <li style="float:right;"><a href="loginPublic.php" >Log Out</a></li>
                        <li class="-icon">
                            <a href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>
                        </li>
                    </ul>
                </div>   
    
  
  <div class="jumbo _pink">
      <h1>Welcome back <?php echo "". $_FirstName . "";  ?> </h1>
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
                <form id="form1" action="ProfileUpdated.php" method="post" onsubmit="return validateForm()">

 <?php           
        
        echo 'First Name : <input type="text" name="field1" maxlength="20" size="15" value="'.$_FirstName.'"><br/>'; 
        echo 'Last Name : <input type="text" name="field2" maxlength="20" size="15" value="'.$_LastName.'"><br/>';
        echo 'Email :  <input type="text" name="field3" maxlength="30" size="25" value="'.$_EmailAddress.'"><br/>';
        echo 'Contact Number :  <input type="text" name="field4" maxlength="15" size="15" value="'.$_ContactNumber.'"><br/>'; 
        echo 'DOB : <select name="Day" id="Day">';
   ?> 
        
      
   <?php  
for ($x = 0; $x <= 31; $x++) {
    
    if ($x == $_Day) {

$select_attribute = 'selected';
}
else
   $select_attribute = ''; 

//-----------------------
if ($x < 10) {
    $strx = 0 .$x; 
     } else {
 $strx = $x;
}
//----------------------------------    
 
  echo '<option value="'.$strx.'" '. $select_attribute . '>'.$strx.'</option>';
  
  $select_attribute = ''; 
}
?>  <?php 
        echo '</select>';  
 //---------------------------------------------------------------  
        echo ' <select name="Month" id="Month">';
   ?>         
      
   <?php  
for ($x = 0; $x <= 12; $x++) {
    
    if ($x == 1) {
       $strMonth= "Jan";
  } elseif ($x == 2) {
        $strMonth= "Feb";
  } elseif ($x == 3) {
        $strMonth= "Mar";      
 } elseif ($x == 4) {
        $strMonth= "Apr"; 
 } elseif ($x == 5) {
        $strMonth= "May"; 
} elseif ($x == 6) {
        $strMonth= "Jun"; 
} elseif ($x == 7) {
        $strMonth= "Jul"; 
} elseif ($x == 8) {
        $strMonth= "Aug";     
} elseif ($x == 9) {
        $strMonth= "Sep"; 
} elseif ($x == 10) {
        $strMonth= "Oct"; 
} elseif ($x == 11) {
        $strMonth= "Nov"; 
} elseif ($x == 12) {
        $strMonth= "Dec"; 
}

if ($x < 10) {
    $strx = 0 .$x; 
     } else {
 $strx = $x;
}
//------------------------
   
    if ($x == $_Month) {

$select_attribute = 'selected';
}
else
   $select_attribute = '';     
    
   echo '<option value="'.$strx.'" '. $select_attribute . '>'.$strMonth.'</option>';
  
  $select_attribute = ''; 
}
?>  <?php 
        echo '</select>'; 
        
 //year year
 echo ' <select name="Year" id="Year">';
   ?> 
        
      
   <?php  
for ($x = 1910; $x <= 2020; $x++) {
    
    if ($x == $_Year) {

$select_attribute = 'selected';
}
else
   $select_attribute = '';     
    
    echo '<option value="'.$x.'" '. $select_attribute . '>'.$x.'</option>';
  
  $select_attribute = ''; 
}
?>  <?php 
        echo '</select></BR>'; 
        
        //echo '<input type="text" name="Month" maxlength="2" size="1" value="'.$_Month.'"> - ';
        //echo '<input type="text" name="Year" maxlength="4" size="1" value="'.$_Year.'"><br/>';         
        echo 'Bio : <br/><textarea rows="6" name="field6" cols="30">'.$_Bio.'</textarea><br/>';       
        echo 'Address 1 :  <input type="text" name="Address1" maxlength="30" size="25" value="'.$_Address1.'"><br/>';
        echo 'Address 2 :  <input type="text" name="Address2" maxlength="30" size="25" value="'.$_Address2.'"><br/>';
        echo 'Post Code :  <input type="text" name="PostCode" maxlength="8" size="6" value="'.$_PostCode.'"><br/>';
        
        
        //echo '<input type="hidden" id="fieldID" name="fieldID" value="'.$_UserID.'">';        
        
        
        if ($_EmailUpdates == 'Y') {

$select_attribute = 'checked';
}
else
   $select_attribute = ''; 
    
         
// Rounded switch -->
      echo 'Receive Email Updates : <label class="switch"><input type="checkbox" '. $select_attribute . ' name="field7" value="Y"><span class="slider round"></span></label>'; 
      echo '<hr>'; 
           

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

