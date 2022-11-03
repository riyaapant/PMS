<?php

include("header.php");
require_once("config.php");

//initializing empty variables
$username = $password = $confirmPassword = "";
$username_err = $password_err = $confirm_password_err = "";

//processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
        $username = trim($_POST['username']);

        //check if username matches the criteria
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            echo ("<script alert('Username can only contain letters, numbers and underscore');
                 </script>");
        } 
        
        else {

            //check if the entered username already exists
            $sql = "SELECT id from users where username = '$username'";
            $result = $conn->query($sql);
            $num = $result->num_rows;
            if ($num > 0) {
                echo ("<script alert('This username is already taken!');
                    </script>");
            } 
            else {

                //if username is available, check both passwords
                $password = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirmPassword']);

                if ($password != $confirmPassword) {
                    echo ("<script alert('Passwords don't match!');
                    </script>");
                } 
                else {

                    //hash the user-given password
                    $pwd = password_hash($password, PASSWORD_DEFAULT);

                    //creates new user account
                    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$pwd')";
                    $result = $conn->query($sql);

                    //if successful, prompt user to log in again
                    if ($result == true) {
                        header("location: login.php");
                    } else
                        echo ("<script alert('Some error occured!');
                    </script>");
                }
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="heading" id="registerHeading">
        <h2>Let's Register</h2>
    </div>
    <div class="container">
        <div class="form" id="registerForm">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="formInput">

                    <div class="formFields">
                        <label class="inputLabel">Username</label>
                        <input type="text" required name="username" class="input" value="<?php echo $username; ?>">
                    </div>

                    <div class="formFields">
                        <label class="inputLabel">Password</label>
                        <input type="password" required name="password" class="input" value="<?php echo $password; ?>">
                    </div>

                    <div class="formFields">
                        <label class="inputLabel">Confirm Password</label>
                        <input type="password" required name="confirmPassword" class="input" value="<?php echo $confirm_password; ?>">
                    </div>
                </div>

                <div class="formBtns">
                    <input type="submit" class="btn formBtn" value="Create account">
                </div>

            </form>
            <p class="advice">Already have an account? <a href="login.php" class="links">Login Here</a> </p>
        </div>
    </div>

</body>

</html>

<?php include("footer.php"); ?>