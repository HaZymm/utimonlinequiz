<!-- resultanswer.php -->
<?php
include 'db.php';
session_start();
$id = $_SESSION['id'];
$subjectcode = $_SESSION['subjectcode'];
$classcode = $_SESSION['classcode'];

    if (isset($_POST['questionTopic'])) {
        $question_topic = $_POST['questionTopic'];
    }
    else{
        $question_topic = $_SESSION['questiontopic'];
    }
$answeredTopicsQuery = "SELECT sum(q.totalmarks) as totalmarks
                            FROM question qs
                            JOIN quiziz q ON q.questionid = qs.questionid
                            WHERE q.studentNumber = '$id' AND qs.subjectCode = '$subjectcode' AND qs.classCode = '$classcode' AND
                            qs.questionTopic = '$question_topic'";

$answeredTopicsResult = mysqli_query($connect, $answeredTopicsQuery);

if (!$answeredTopicsResult) {
    die('Invalid query: ' . mysqli_error($connect));
}
$mysqlirun = mysqli_fetch_assoc($answeredTopicsResult);
$finalScore = $mysqlirun['totalmarks'];


   $topStudentsQuery = "SELECT q.studentNumber, SUM(q.totalmarks) as totalmarks, st.studentName
                     FROM quiziz q 
                     JOIN student st ON q.studentNumber = st.studentNumber
                     JOIN registration r ON r.studentNumber = st.studentNumber
                     JOIN question qs ON q.questionid = qs.questionid
                     WHERE qs.classCode = '$classcode' 
                     AND r.subjectCode = '$subjectcode'
                     AND qs.subjectCode = '$subjectcode' 
                     AND qs.questionTopic = '$question_topic'
                     GROUP BY q.studentNumber, st.studentName
                     ORDER BY totalmarks DESC
                     LIMIT 3";



    $topStudentsResult = mysqli_query($connect, $topStudentsQuery);

    if (!$topStudentsResult) {
        die('Invalid query: ' . mysqli_error($connect));
    }

    $topStudents = [];
    while ($row = mysqli_fetch_assoc($topStudentsResult)) {
        $topStudents[] = $row;
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Go Quiz Inno.</title>
    <link rel="stylesheet" type="text/css" href="question.css">
    <link rel="stylesheet" type="text/css" href="master.css">
     <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .podium {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            margin-top: 10px;
            padding: 20px;
            border-radius: 10px;
        
        }

        .podium div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 150px; /* Increased width */
            height: 200px; /* Increased height */
            margin: 0 15px; /* Increased margin */
            border-radius: 10px;
            color: white;
            font-size: 24px; /* Increased font size */
            font-weight: bold;
            position: relative;
        }

        .podium .first {
            height: 300px; /* Increased height */
            background-color: gold;
            border: 2px solid #FFD700;
        }

        .podium .second {
            height: 250px; /* Increased height */
            background-color: silver;
            border: 2px solid #C0C0C0;
            margin-bottom: -50px; /* Adjusted margin */
        }

        .podium .third {
            height: 200px; /* Increased height */
            background-color: #cd7f32;
            border: 2px solid #8B4513;
            margin-bottom: -100px; /* Adjusted margin */
        }

        .podium .position {
            position: absolute;
            top: -40px; /* Adjusted position */
            font-size: 30px; /* Increased font size */
            background-color: #fff;
            width: 50px; /* Increased width */
            height: 50px; /* Increased height */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            border: 2px solid #ddd;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="body2">
    <header>
        <!-- Header content -->
    </header>
    <main>
        <div class="app">
            <div class="container">
                <h2>You're Done!</h2>
                <p>Congrats! You Have Completed the Test!</p>
                <p>Final Score: <?php echo $finalScore; ?></p>
            </div>
            <?php if (!empty($topStudents)): ?>
            <div class="podium">
                <?php if (isset($topStudents[2])): ?>
                    <div class="third">
                        <div class="position">3</div>
                        <p><?php echo $topStudents[2]['studentName']; ?></p>
                        <p><?php echo $topStudents[2]['totalmarks']; ?> Marks</p>
                    </div>
                <?php endif; ?>
                <?php if (isset($topStudents[0])): ?>
                    <div class="first">
                        <div class="position">1</div>
                        <p><?php echo $topStudents[0]['studentName']; ?></p>
                        <p><?php echo $topStudents[0]['totalmarks']; ?> Marks</p>
                    </div>
                <?php endif; ?>
                <?php if (isset($topStudents[1])): ?>
                    <div class="second">
                        <div class="position">2</div>
                        <p><?php echo $topStudents[1]['studentName']; ?></p>
                        <p><?php echo $topStudents[1]['totalmarks']; ?> Marks</p>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div style="text-align: left; margin-top: 100px;">
                <a href="subjectmenustudent.php" class="button">Back to Subjects</a>
            </div>
        </div>

    </main>
    <footer class="footer">
        <p>© 2024 Go Guiz - All Rights Reserved</p>
   </footer>
</body>
</html>
