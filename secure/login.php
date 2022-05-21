<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/csslogin.css" rel="stylesheet" type="text/css"/>
        <title>Login</title>
    </head>
    <body>
        
        <div class="container">
            
                      
                                <h3> BigFestBelfast Login </h3>
                            
                            <form method="POST" action="login.php">
                               
                              
                            <label class="form-label" for="input-example-1">Username</label>
                            <input class="form-input" name="username" type="text" placeholder="Username">

                            <label class="form-label" for="input-example-1">Password</label>
                            <input class="form-input" name="password" type="password" placeholder="Password">
                            
        
                            

                                <?php
        session_start();
        include("../conn/conn.php");

        if(isset($_POST["sign"])){

            $usernamedata = $conn->real_escape_string($_POST["username"]);
            $passworddata = $conn->real_escape_string($_POST["password"]);
            $findusername = "SELECT * FROM users INNER JOIN venuemanagers ON venuemanagers.loginid = users.id WHERE username = '$usernamedata' AND password=MD5('$passworddata')";

            $signinresult = $conn->query($findusername);

            $rowcount = $signinresult -> num_rows;

            if($rowcount > 0){

                echo "Logged in";

                while($row2 = $signinresult->fetch_assoc()){
                    $_SESSION["user_username"] = $row2["username"];
                    $_SESSION["user_id"] = $row2["id"];

                    
                    $persontype = $row2["type_id"];
                    $managerid = $row2["managerid"];
                    
                    if($persontype == 1){
                        
                        header("Location:secure/adminhome.php");
                        
                    } elseif($persontype == 2) {
                        
                       header("Location:venuemanagerhome.php?filter=$managerid");
                        
                    } elseif($persontype == 3){
                        
                        header("Location:index.php");
                        
                    } elseif($persontype == 4) {
                        
                        header("Location:secure/");
                        
                    } else {
                        header("Location:signup.php");
                    }

                }
                

            } else {
                echo "<p> Wrong Password- Please try again </p>";
            }

        }
?>
                                
        
            
        <button type="submit" name="sign" class="btn">Login</button>
        <br> <br>
        <p> Or <a href="signup.php"> Sign Up </a> for free now </p>
                            
        
                </form>    
</div>
                      
    </body>
</html>
