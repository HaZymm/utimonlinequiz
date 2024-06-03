<?php
    session_start();
    include 'db.php';
    $id = $_SESSION['id'];
    $subjectcode = $_SESSION['subjectcode'];
    $classcode = $_SESSION['classcode'];
    $_SESSION['questiontopic'] = $_POST['start'];
    $question_topic = $_SESSION['questiontopic'];
   
    $sql = "SELECT count(*) AS total FROM question WHERE questionTopic = '$question_topic' AND classCode = '$classcode' AND subjectCode = '$subjectcode'";

    $output = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($output);
    $num_form = $row['total']; // Extracting the count value from the result set
    $_SESSION['num_form'] = $row['total'];


    $topic = "SELECT * 
            FROM question 
            WHERE subjectCode = '$subjectcode' AND
            classCode = '$classcode' AND questionTopic = '$question_topic'";

    $result = mysqli_query($connect,$topic);

 ?>

 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
    <link rel="stylesheet" type="text/css" href="question.css">
    <link rel="stylesheet" type="text/css" href="master.css">
    <style>
        /* General reset for margin and padding */

        .radio-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        /* Hide the default radio button */
        input[type="radio"] {
            display: none;
        }

        /* Style the label to look like a button */
        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            font-size: 18px;
            color: #007bff;
            background-color: transparent;
            border: 2px solid #007bff;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
            text-align: left;
            min-width: 200px;
        }

        /* Change the background and border color when the button is hovered over */
        .btn:hover {
            background-color: #007bff;
            color: white;
        }

        /* Change the background and border color when the button is active (checked) */
        input[type="radio"]:checked + .btn {
            background-color: #0056b3;
            border-color: #0056b3;
            color: white;
        }
    </style>
</head>
<body onload="startTimer()">
    <div class="app">
        <form id="quizForm" method="post" action="quizizInsert.php">
            <h1><?php echo $question_topic; ?></h1>
            <?php
                for($i = 1; $i <= $num_form; $i++) {
                $fetchdata = mysqli_fetch_assoc($result);
            ?>
                <div class="current">Question <?php echo $i; ?> of <?php echo $num_form; ?></div>
                <div class="quiz">

                <input type="hidden" name="questionid_<?php echo $i; ?>" value="<?php echo $fetchdata["questionid"]; ?>">

                <p class="question">
                    <?php echo $fetchdata['questionStatement']; ?>
                </p>
                    <div id="answer-buttons">
                            <?php
                            $option_ids = ['A', 'B', 'C', 'D'];
                            foreach($option_ids as $option_id) {
                                $label_id = "option{$i}_{$option_id}";
                                $name = "option_{$i}";
                                $value = $option_id;
                            ?>
                            <input type="radio" id="<?php echo $label_id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" required>
                            <label for="<?php echo $label_id; ?>" class="btn" required><?php echo $fetchdata[$option_id]; ?></label>
                            <?php
                                }
                            ?>
                    </div>
                </div>
            <?php
                }
            ?>
            <div class="submit-button">
                <button name="submit" type="submit" class="btn">Submit Quiz</button>
            </div>
        </form>   
       
    </div>
</body>
</html>

