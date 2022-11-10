 <?php

    //form to add a project to database only if the user is logged in
    require("config.php");
    include("header.php");
    session_start();

/* if editing, update the values in the form. if not editing, display an empty form an insert new row into database */
    if (isset($_POST["editId"])) {
        $id = $_POST['editId'];
        $title = trim($_POST['title']);
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $sql = "UPDATE projects set title = '$title', summary = '$summary', content = '$content' where p_id = '$id'";
        $result = $conn->query($sql);
        if ($result == true) {
            header("location: welcome.php");
        } else
        echo ("<script> alert('Some error occured!');
                </script>");
    } else {
        //if user is not logged in, ask to login first
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            header("location: login.php");
            exit;
        } else {

            $title = $summary = $content = $uname = "";

            //add a new project to the db
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!empty($_POST['title']) && !empty($_POST['summary']) && !empty($_POST['content'])) {
                    $title = trim($_POST['title']);
                    $summary = $_POST['summary'];
                    $content = $_POST['content'];
                    $uname = $_SESSION['username'];
                    $sql = "INSERT INTO projects (title,summary,content,published_by) VALUES ('$title','$summary','$content','$uname')";
                    $result = $conn->query($sql);
                    echo "$title <br> $summary <br> $content <br> $uname";
                    echo "<br> $uname";
                    if ($result == true) {
                        header("location: welcome.php");
                    } else
                    echo "<script> alert('Your project was not uploaded'); </script>";
                } else
                    echo ("Some error occured");
            }
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
             <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                 <div class="formBtns">
                     <button type="submit" class="btn">Add Project</button>
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