<?php

//form to add a project to database only if the user is logged in
require("config.php");
include("header.php");
session_start();

/* display the content of the project to be edited */
$title = $summary = $content = "";
if (isset($_POST['edit'])) {
    $id = $_POST['edit'];
    $_SESSION['editID'] = $id;
    $sql = "SELECT * from projects where p_id = '$id'";
    $result = $conn->query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $summary = $row['summary'];
        $content = $row['content'];
    }
}

//close the connection
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Project</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="heading" id="createHeading">
        <h2>Create a Project</h2>
        <p>Fill the following details</p>
    </div>
    <div class="container" id="createProject">


        <div class="form" id="createProjectForm">
            <form action="createProject.php" method="POST">
                <div class="formInput">

                    <div class="formFields">
                        <label class="inputLabel">Title</label>
                        <textarea name="title" id="title" class="input" cols="100" rows="1" placeholder="Make it short and precise"><?php echo $title; ?></textarea>
                    </div>

                    <div class="formFields">
                        <label class="inputLabel">Summary</label>
                        <textarea name="summary" id="summary" class="input" cols="100" rows="5" placeholder="Explain your project in a line or two"><?php echo $summary; ?></textarea>
                    </div>

                    <div class="formFields">
                        <label class="inputLabel">Content</label>
                        <textarea name="content" id="content" class="input" cols="100" rows="30" placeholder="Detailed technical description of your project"><?php echo $content; ?></textarea>
                    </div>

                </div>
                <!-- send the id of the project to be edited to createProject.php -->
                <div class="formBtns">
                    <button type="submit" class="btn" name="editId" value="<?php echo $id; ?>">Update Project</button>
                    <p class="advice"></p>
                </div>
            </form>
        </div>
    </div>
</body>


</html>

<?php
include("footer.php");
?>