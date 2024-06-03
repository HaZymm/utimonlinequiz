<?php
include("db.php");
session_start();

if(isset($_SESSION['topic'])) {
    $classcode = $_SESSION['classcode'];
    $subjectcode =  $_SESSION['subjectcode'];
    $questionTopic = $_SESSION['topic'];
    

    $delete_quiziz = "DELETE qz FROM quiziz qz
                      JOIN question q ON qz.questionid = q.questionid
                      WHERE q.questionTopic = '$questionTopic' AND 
                            q.classCode = '$classcode' AND q.subjectCode = '$subjectcode'";

    // Then delete from the `question` table
    $delete_query = "DELETE FROM question WHERE questionTopic = '$questionTopic' AND classCode = '$classcode' AND subjectCode = '$subjectcode'";

    // Execute the queries
    if(mysqli_query($connect, $delete_quiziz)) {
        if(mysqli_query($connect, $delete_query)) {
            echo "<script>alert('All questions have been successfully deleted!');
                  window.location='subjectmenulecturer.php';</script>";
        } else {
            echo "Error deleting records from question table: " . mysqli_error($connect);
        }
    } else {
        echo "Error deleting records from quiz table: " . mysqli_error($connect);
    }
     
    
}


?>