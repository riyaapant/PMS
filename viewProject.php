<?php

//this page loads when the user click 'View Details' on a project
include("header.php");
require_once("config.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //fetch the id of the project to view its details
    $project_id = $_POST['id'];

    //retrieve the project from the db
    $sql = "SELECT * from projects where p_id = '$project_id'";
    $result = $conn->query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $summary = $row['summary'];
        $content = $row['content'];
        $published_by = $row['published_by'];
        $published_at = $row['published_at'];
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>

<body>
    <div class="container">
        <div class="expandProjects">
            <div class="expandProjectHeading">
                <h2 class="heading"> <?php echo $title; ?> </h2>
            </div>

            <div class="projectDetails publishDetails">
                <p>Published by <strong> <?php echo $published_by; ?> </strong> on <strong> <?php echo $published_at; ?> </strong> </p>
            </div>
            <div class="projectDetails summary">
                <strong> Project Brief: </strong> 
                <p><?php echo $summary; ?> </p>
            </div>
            <div class="projectDetails content">
                <strong>Project description: </strong>
                <p> <?php echo $content; ?> </p>
            </div>
            <div class="homepage">
                <form action="index.php">
                    <button class="btn" id="homepageBtn">Go To Homepage</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php include("footer.php"); ?>