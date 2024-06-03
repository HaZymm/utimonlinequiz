<?php
/* include db connection file */
session_start();
include("db.php");
$subjectcode = $_SESSION['subjectcode'];
$classcode = $_SESSION['classcode'];
$num_form = $_SESSION['num_form'];

    if (isset($_POST['backsubmit'])) {
        echo "<script>window.location='subjectmenulecturer.php'</script>";
    }
    //if($_POST["questionid_$i"] == '' && $_POST["questionStatement_$i"] =='' &&  $_POST["optionA_$i"]=='' && $_POST["optionB_$i"]=='' && $_POST["optionC_$i"] == '' && $_POST["optionD_$i"] == '' && $_POST["questionMarks_$i"] =='' &&  $_POST["questionAnswer_$i"] == ''){
        //echo "<script>alert('please do not leave it empty')
            //window.location='questionUpdate.php'</script>";
    //}

    if(isset($_POST['nextsubmit'])) {
        for ($i = 1; $i <= $num_form ; $i++) {

            $questionId = $_POST["questionid_$i"];  
            $questionStatement = $_POST["questionStatement_$i"];  
            $optionA = $_POST["optionA_$i"]; 
            $optionB = $_POST["optionB_$i"];
            $optionC = $_POST["optionC_$i"]; 
            $optionD = $_POST["optionD_$i"]; 
            $questionMarks = $_POST["questionMarks_$i"];
            $questionAnswer = $_POST["questionAnswer_$i"];

            $sql = "UPDATE question SET questionStatement = '$questionStatement', 
                    A = '$optionA', B = '$optionB', C = '$optionC', D = '$optionD',
                    questionMarks = '$questionMarks', questionAnswer = '$questionAnswer' 
                    WHERE questionid = '$questionId'";
            
            $result = mysqli_query($connect, $sql); 
        }


        if ($result) {
            echo "<script>alert('All questions have been successfully updated!')
            window.location='subjectmenulecturer.php'</script>";
        }else {
         echo "Error: " . mysqli_error($connect);
        }
        
        mysqli_close($connect); // Close the database connection
    }
?>