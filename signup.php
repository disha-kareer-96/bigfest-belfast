<?php
// Include config file
include "conn/dbconnection.php";

 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="signtest_1_1.php" method="POST">
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="form-input" name="username" type="text">
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="form-input" name="password" type="text">
            </div>
           
                <input type="submit" class="btn btn-primary" name="reg_user1" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
           
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
                                <?php


if(isset($_POST['reg_user1'])){
    //get the values from the signup form
    $newusername = $conn->real_escape_string($_POST["username"]);
    $newpassword = $conn->real_escape_string($_POST["password"]);
    $inserting = "INSERT INTO signup(id, username, password)VALUES(NULL,'$newusername', '$newpassword') ";
       $result6 = $conn->query($inserting);
       if(!$result6){
           $conn->error;
       }else{
        echo "<p> Success! </p>";
    
}
}
?>
    </div>    
</body>
</html>