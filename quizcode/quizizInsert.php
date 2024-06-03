<?php
/* include db connection file */
session_start();

include 'db.php';
$id = $_SESSION['id'];
$subjectcode = $_SESSION['subjectcode'];
$classcode = $_SESSION['classcode'];
$num_form = $_SESSION['num_form'];
$question_topic = $_SESSION['questiontopic'];
$wronganswer = 0;

    if(isset($_POST['submit'])) {
        for ($i = 1; $i <= $num_form; $i++) {
    // Get the selected option value
            if (isset($_POST["option_$i"])) {
                $selected_option = $_POST["option_$i"];
                $questionId = $_POST["questionid_$i"]; 

                // Fetch the question ID and marks
                $topic = "SELECT questionCode, questionMarks, questionAnswer 
                          FROM question 
                          WHERE subjectCode = '$subjectcode' 
                          AND classCode = '$classcode' 
                          AND questionTopic = '$question_topic' AND
                          questionid = '$questionId'";
                $result = mysqli_query($connect, $topic);
                if ($result) {
                    $fetchdata = mysqli_fetch_assoc($result);
                    $question_code = $fetchdata['questionCode'];
                    $question_marks = $fetchdata['questionMarks'];

                    // Determine if the selected answer is correct
                    if ($fetchdata['questionAnswer'] == $selected_option) {
                        $sql = "INSERT INTO quiziz (studentNumber, questionid, answerChoice, totalmarks) 
                                VALUES ('$id', '$questionId', '$selected_option', '$question_marks')";
                    } else {
                        $sql = "INSERT INTO quiziz (studentNumber, questionid, answerChoice, totalmarks) 
                                VALUES ('$id', '$questionId', '$selected_option', '$wronganswer')";
                    }
                    $sqlrun = mysqli_query($connect, $sql);
                    // Execute the query and check for errors
                    if (!$sqlrun) {
                        die("Error inserting data: " . mysqli_error($connect));
                    }
                } 
                else {
                    die("Error fetching question data: " . mysqli_error($connect));
                }
            }
        }
        if ( $sqlrun){
            $_SESSION['questiontopic'] = $question_topic;
            echo "<script>alert('All questions have been successfully answered!')
            window.location='resultanswer.php'</script>";
        }
    }
?>
