<?php
/* include db connection file */
include 'db.php';
session_start();

$subjectcode = $_SESSION['subjectcode'];
$classcode = $_SESSION['classcode'];

echo $classcode ;

$num_form = $_SESSION['num_form'];
$enteredTopic = $_SESSION['topic'];

if (isset($_POST['back'])) {
    echo "<script>window.location='addquestiondetail.php'</script>";
}

    if(isset($_POST['submit'])) {

        
        for ($i = 1; $i <= $num_form; $i++) {
            /* capture values from HTML form */ 

            $questionCode = $_POST["questionCode_$i"]; 
            $questionAnswer = $_POST["questionAnswer_$i"]; 
            $optionA = $_POST["optionA_$i"]; 
            $optionB = $_POST["optionB_$i"]; 
            $optionC = $_POST["optionC_$i"]; 
            $optionD = $_POST["optionD_$i"]; 
            $questionMarks = $_POST["questionMarks_$i"];
            $subjectCode = $subjectcode;
            $questionStatement = $_POST["questionStatement_$i"]; 
            $questionTopic = $enteredTopic;
            $classCode = $classcode;


            // Prepare the SQL statement using prepared statements
            $sql = "INSERT INTO question (questionCode, questionAnswer, A, B, C, D, questionMarks, subjectCode, questionStatement, questionTopic, classCode) VALUES ('$questionCode', '$questionAnswer', '$optionA', '$optionB', '$optionC', '$optionD', '$questionMarks', '$subjectCode', '$questionStatement', '$questionTopic','$classCode')";
            
          $result = mysqli_query($connect, $sql);  // Execute the query

        }
         if ($result) {
                echo "<script>alert('QUIZ SUCESSFULLY INSERT');window.location='subjectmenulecturer.php'</script>";
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        mysqli_close($connect); // Close the database connection outside the loop
    }
?>

