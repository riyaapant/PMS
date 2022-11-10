<?php

/*
    ->this file requires config.php
    ->page doesn't load if connection to database fails
*/
require_once("config.php");
include("header.php");

//session start
session_start();

//if user is logged in, redirect them to the welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

//set empty username and password variables
$username = $password = "";

//a post request arrives from the html form below
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password'])){

        //remove unwanted space from the username and password variables
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        //check if the entered username exists in the database
        $sql = "SELECT id, name, username, password FROM users WHERE username = '$username'";

        //executes the query
        $result = $conn->query($sql);

        //gives the number of rows affected by the query
        $num = $result->num_rows;
        if($num==1){

            //fetches the result of the query in array form
            $row = mysqli_fetch_array($result);

            //hashed password from the database
            $pwd = $row['password'];

            //password verification
            if(password_verify($password, $pwd)){

                //start a session and set session variables if username and password match
                session_start();
                $_SESSION["loggedin"]=true;
                $_SESSION["username"]=$row['username'];
                $_SESSION["name"] = $row['name'];
                $_SESSION["id"]=$row['id'];
                header("location: welcome.php");
            }
            else{
                echo("<script> alert('Password doesn't match');
             </script>");
            }
            
        }
        else{
            echo("<script> alert('Invalid username'); </script>");
        }
    }
}
    //close the db connection
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="heading" id="loginHeading">
        <h2>Log In To Your Account</h2>
    </div>

    <div class="container">

        <div class="form" id="loginForm">

        <!-- post request passed to the same file -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="formInput">

                <div class="formFields">
                    <label class="inputLabel">Username</label>
                    <input type="text"  required name="username" class="input" value="<?php echo $username; ?>">
                </div>
                
                <div class="formFields">
                    <label class="inputLabel">Password</label>
                    <input type="password" required name="password" class="input" value="<?php echo $password; ?>">
                </div>
                
            </div>
            <div class="formBtns">
                        <input type="submit" name="submit" class="btn formBtn" value="Let's go!">
            </div>

            </form>
            <p class="advice">Don't have an account? <a href="register.php" class="links">Register here!</a> </p>

        </div>

    </div>
    <?php include("footer.php"); ?>
</body>

</html>
