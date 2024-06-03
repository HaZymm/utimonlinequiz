<?php
include("db.php");
session_start();

if(isset($_SESSION['videoCode'])) {
    $classcode = $_SESSION['classcode'];
    $subjectcode =  $_SESSION['subjectcode'];
    $videoCode = $_SESSION['videoCode'];
    

    $delete_video = "DELETE  FROM video 
                     WHERE videoCode = '$videoCode'";

    

    // Execute the queries
    if(mysqli_query($connect, $delete_video)) {
            echo "<script>alert('Selected video have been successfully deleted!');
                  window.location='videolecturer.php';</script>";
    } else {
        echo "Error deleting records from quiz table: " . mysqli_error($connect);
    }
     
    
}


?>