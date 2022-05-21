<?php
     
        include("conn/dbconnection.php");

        if(isset($_POST["sign"])){

            $newusername = $conn->real_escape_string($_POST["username"]);
            $newpassword = $conn->real_escape_string($_POST["password"]);
            $iduser = $conn->real_escape_string($_POST["id"]);
            
            $findusername1 = "SELECT * FROM signup WHERE username = '$newusername' AND password = '$newpassword' AND id = '$iduser'";
            
          

            $signinresult = $conn->query($findusername1);

            $rowcount1 = $signinresult -> num_rows;

            if($rowcount1 > 0){

                echo "Logged in";

                while($row2 = $signinresult->fetch_assoc()){
                    $_SESSION["user_username"] = $row2["username"];
                    $_SESSION["user_id"] = $row2["id"];
                    
                    
                    $person = $row2["id"];
                    
                    if($persontype == $iduser){
                        
                        header("Location:index.php");

                    } else {
                        header("Location:signtest_1_1.php");
                    }

                }
                

            } else {
                echo "<p> Wrong Password- Please try again </p>";
            }

        }
        ?>