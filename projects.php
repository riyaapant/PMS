<?php

require_once("config.php");
session_start();

// gives the filename of php_self
$location = basename($_SERVER['PHP_SELF']);

//display user's projects inside their profile
if($location == "welcome.php"){
        $uname = $_SESSION['username'];
        $sql = "SELECT * FROM projects where published_by = '$uname'  ORDER BY published_at DESC ";
        $result = mysqli_query($conn, $sql);
}

//display all projects in the homepage
else{
        $sql = "SELECT * FROM projects ORDER BY published_at DESC ";
        $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
</head>

<body>
        <div class="projectsContainer">
                <?php
                /* executes one or the other query above and fetches result */
                while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['p_id'];
                        $published_by = $row['published_by'];
                        $title = $row['title'];
                        $summary = $row['summary'];
                        $content = $row['content'];

                        echo '<div class="projects">
                                <div class="projectInfo">
                                        <div class="detail title"> ' . $title . '</div>
                                        <div class="detail published_by"> Published by: <strong>' . $published_by . ' </strong> </div>
                                        <div class="detail summary"> ' . $summary . '</div>
                                </div>
                                <div class="expandProject">
                                <form action="viewProject.php" method="post">
                                                <button class="btn" id="expandBtn" name= "id" value = ' . $id . ' >View Details</button>
                                        </form>
                                </div>
                        </div>';
                        echo "<hr>";
                }
                //send the project id of a project through the form value
                ?>

        </div>
</body>

</html>