<?php
include('../conn/dbconnection.php');
$arg = $conn->real_escape_string($_GET["filter"]);
 $findusername1 = "SELECT * FROM users INNER JOIN venuemanagers ON venuemanagers.loginid = users.id WHERE venuemanagers.managerid = '$arg'";
 
     $queryresult1 = $conn->query($findusername1) or die($conn->error);
         
         while ($row = $queryresult1->fetch_assoc()) {
             $managerid1 = $row["managerid"];
         }
         
    if(isset($_POST["insert"]))       
 {  
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
      $query = "INSERT INTO images(name) VALUES ('$file')";  
      if(mysqli_query($conn, $query))  
      {  
           echo '<script>alert("Image Inserted into Database")</script>';  
      }  
 }


?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="venuemanger.css" rel="stylesheet" type="text/css"/>
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
        
        <div class="centering">
              <div class='row'>
            <div class= 'card' style = 'width:600px; margin-bottom: 10px;'>
            <div class = '-content _alignCenter'>
                <form method="post" enctype="multipart/form-data">
                <h2><strong>Select an image to upload:</strong></h2>
                 <input type="file" name="image" id="image"/>
                 <br/>
                 <div class='button1'>
            <button class='editbutton' name='insert'id='insert' type='submit'> Submit </button>
            </div>
                </form>
                    </div>
                
                <table class='centering'> 
                    <tr>
                <th>Images Already Uploaded</th>
                    </tr>
                <?php
                $query = "SELECT * FROM images ORDER BY id DESC";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result))
                {
                    echo '
                        <tr>
                        <td>
                        <img src="data:image/jpeg;base64,'.base64_encode($row['name']).'"/>
                        </td>
                        </tr>


                    ';
                }
                ?>
                </table>
                    </div>
                            
            
            <br>
            </div>
        </div>
        
        
        
        
        
    </body>
</html>

 <script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  
