<?php
    session_start();
    $subjectcode = $_SESSION['subjectcode'];
    $classcode = $_SESSION['classcode'];

    /*echo $classcode;*/ 

    //this for go update
    if (isset($_POST['update'])) {
        $_SESSION['topic'] = $_POST['update'];
        echo "<script>window.location='questionUpdate.php'</script>";
    }

    //this for go delete
    if (isset($_POST['delete'])) {
        $_SESSION['topic'] = $_POST['delete'];
        echo "<script>window.location='questionDelete.php'</script>";
    }

?>

<html>
<head>
    <link rel="stylesheet" href="addquestiondetail.css">
    <link rel="stylesheet" type="text/css" href="master.css">
    <title>Enter Quiz Details</title>
</head>
<body>
    <div class="wrapper">
        <form name="detailForm" method="post" action="addquestion.php">
            <h1>Enter Quiz Details</h1>

            Enter number of questions:
            <div class="input-box">
                <input type="number" placeholder="Enter Number of Questions" name="totalQuestion">
            </div>

           Enter topic:
            <div class="input-box">
                <input type="text" placeholder="Enter Topic" name="questionTopic">
            </div>

            <ul>
                <div>
                    <div class = "button-container">
                        <button type="submit" class="button" name="nextbutton" value="Submit">Submit</button>
                        <button type="submit" class="button" name="backbutton" value="Submit">back</button>
                    </div>
                </div>
            </ul>
        </form>
    </div>
</body>
</html>