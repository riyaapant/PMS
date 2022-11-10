<?php


    require("config.php");
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $sql = "DELETE FROM projects where p_id = '$id'";
        $result = $conn->query($sql);
        if($result == true)
        {
            header("location:welcome.php");
        }
        else 
            echo ("Some problem occured!");
    }
?>
