<?php
include("header.php");
session_start();

//if user is not logged in, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="heading" id="welcomeHeading">
        <h2>Welcome to our site, <?php  echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    </div>
    
    <div class="controlBtns">

        <div class="homepage">
            <form action="index.php">
                <button class="btn" id="homepageBtn">Go To Homepage</button>
            </form>
        </div>
        
        <div class="create">
            <form action="createProject.php">
                <button class="btn" id="createBtn">Create Projects</button>
            </form>
        </div>
        
        <div class="logOut">
            <form action="logout.php" method="post">
                <button class="btn danger" id="logoutBtn">Log Out</button>
            </form>
        </div>
        
    </div>
    <div class="container">

    <?php include("projects.php"); ?>

    </div>

</body>
</html>


<?php

include("footer.php");

?>