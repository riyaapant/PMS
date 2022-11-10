<?php

//include the header file
include("header.php");

//start a session to retrieve all session variables (if any)
session_start();
?>

<!-- the first page where the user lands -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>

    <div class="controlBtns">

        <div class="create">
            <form action="createProject.php">
                <button class="btn" id="createBtn">Create Projects</button>
            </form>
        </div>

        <?php

        /* include these buttons only if the user is logged in */
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo ('
            <div class="profile">
                <form action="welcome.php" method="post">
                    <button class="btn" id="profileBtn" name="profile">Your Profile</button>
                </form>
            </div>
            ');

            echo ('
            <div class="logOut">
                <form action="logout.php" method="post">
                    <button class="btn danger" id="logoutBtn">Log Out</button>
                </form>
            </div>
            ');
            
        } 
        else {
            echo ('
            <div class="login">
                <form action="login.php" method="post">
                    <button class="btn" id="loginBtn" name="login">Login</button>
                </form>
            </div>
            ');

            echo ('
            <div class="register">
                <form action="register.php" method="post">
                    <button class="btn" id="registerBtn" name="register">Register</button>
                </form>
            </div>
            ');
        }
        ?>

    </div>

    <div class="container">
        <?php
        /* this section displays all projects added to the database */
        include("projects.php");
        ?>
    </div>


</body>

</html>

<?php
//include the footer file
include("footer.php");
?>