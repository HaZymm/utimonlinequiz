<?php
session_start();

include 'db.php';
// Retrieve and validate POST data
$subjectCode = isset($_POST['subjectCode']) ? $_POST['subjectCode'] : '';
$classCode = isset($_POST['classCode']) ? $_POST['classCode'] : '';
$questionTopic = isset($_POST['questionTopic']) ? $_POST['questionTopic'] : '';

if ($subjectCode && $classCode && $questionTopic) {
    // Fetch total marks for each student for the selected subject, class, and question topic
    $sql = "
        SELECT student.studentNumber AS studentNumber, SUM(quiziz.totalmarks) AS totalMarks
        FROM student
        JOIN quiziz ON student.studentNumber = quiziz.studentNumber
        JOIN question ON quiziz.questionid = question.questionid
        WHERE question.subjectCode = ? AND question.classCode = ? AND question.questionTopic = ?
        GROUP BY student.studentNumber";
    $stmt = $connect->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $subjectCode, $classCode, $questionTopic);
        $stmt->execute();
        $result = $stmt->get_result();

        $studentNames = [];
        $marks = [];

        while ($row = $result->fetch_assoc()) {
            $studentNames[] = htmlspecialchars($row['studentNumber']);
            $marks[] = htmlspecialchars($row['totalMarks']);
        }

        $stmt->close();

        // Store the chart data in session
        $_SESSION['chartData'] = [
            'studentNames' => $studentNames,
            'marks' => $marks,
            'subjectCode' => $subjectCode,
            'classCode' => $classCode,
            'questionTopic' => $questionTopic
        ];

        // Redirect back to homeAdmin.php
        header('Location: adminmenu.php');
        exit();
    } else {
        die("Statement preparation failed: " . $connect->error);
    }
} else {
    die("Invalid input parameters.");
}

$connect->close();
?>
