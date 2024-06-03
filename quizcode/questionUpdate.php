<?php
    include 'db.php';
    session_start();

    $subjectcode = $_SESSION['subjectcode'];
    $classcode = $_SESSION['classcode'];
    $topic = $_SESSION['topic'];

    /*echo $classcode.$topic*/ ;


    $sql = "SELECT count(*) AS total FROM question WHERE questionTopic = '$topic' AND classCode = '$classcode' AND subjectCode = '$subjectcode'";

    $output = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($output);
    $num_form = $row['total']; // Extracting the count value from the result set
    $_SESSION['num_form'] = $row['total'];

    //dif

    $sqlalloutput = "SELECT * FROM question
                    WHERE questionTopic = '$topic' AND classCode = '$classcode'";

    $runalloutput = mysqli_query($connect,$sqlalloutput);

    
?>

<html>
<head>
    <title>Update question</title>
    <link rel="stylesheet" href="questionupdate.css">
    <link rel="stylesheet" type="text/css" href="master.css">
</head>
<body>
    <div class="wrapper">
    <form name="updateQuestion" method="post" action="questionUpdate2.php">

        <?php
                // Loop through the result set to display each question
           for($i = 1; $i <= $num_form; $i++) {
            $fetchdata = mysqli_fetch_assoc($runalloutput);
        ?>
            <fieldset class="field2">
                <input type="hidden" name="questionid_<?php echo $i; ?>" value="<?php echo $fetchdata["questionid"]; ?>">
                <input type="hidden" name="questionCode_<?php echo $i; ?>" value="<?php echo $fetchdata["questionCode"]; ?>">
                <input type="hidden" name="num_form" value="<?php echo $fetchdata["questionid"]; ?>">

                <br><h3>Question Statement : </h3>
                <div class="input-box">
                    <input type="text" name="questionStatement_<?php echo $i; ?>" value="<?php echo $fetchdata["questionStatement"]; ?>">
                </div>

                <h3>Option A : </h3>
                <div class="input-box">
                    <input type="text" name="optionA_<?php echo $i; ?>" value="<?php echo $fetchdata["A"]; ?>">
                </div>

                <h3>Option B : </h3>
                <div class="input-box">
                    <input type="text" name="optionB_<?php echo $i; ?>" value="<?php echo $fetchdata["B"]; ?>">
                </div>

                <h3>Option C : </h3>
                <div class="input-box">
                    <input type="text" name="optionC_<?php echo $i; ?>" value="<?php echo $fetchdata["C"]; ?>">
                </div>

                <h3>Option D :</h3>
                <div class="input-box">
                    <input type="text" name="optionD_<?php echo $i; ?>" value="<?php echo $fetchdata["D"]; ?>">
                </div>

                <h3>Question Marks : </h3>
                <div class="input-box">
                    <input type="number" name="questionMarks_<?php echo $i; ?>" value="<?php echo $fetchdata["questionMarks"]; ?>">
                </div>
 
                <h3>Question Answer : </h3>
                <div class="input-box">
                    <select name = "questionAnswer_<?php echo $i; ?>">
                            <option selected>Choose the Answer</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                </div>
                
                
            </fieldset>
            <?php
                }
            ?>
    
            <div class = "button-container">
                <button type="submit" name="nextsubmit" class = "button" value="Submit">SUBMIT</button>
                <button type="submit" name="backsubmit" class = "button" value="Submit">BACK</button>
            </div>
    </form>
    </div>
</body>
</html>