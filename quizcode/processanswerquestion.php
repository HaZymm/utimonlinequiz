<?php
include 'db.php';
session_start();

// Check if the score is set, if not, initialize it to 0
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

// Check if the form is submitted
if (isset($_POST['choice']) && isset($_POST['number'])) {
    // Get the question number and user's selected choice



    $sql = "INSERT INTO quizziz (studentNumber, answerChoice, totalMarks) VALUES ('$studentNumber', '$answerChoice', '$totalMarks')";

    // Prepare and execute the query to get the correct answer and question marks
    $query = "SELECT questionAnswer, questionMarks FROM question WHERE questionCode = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $number);
    $stmt->execute();
    $stmt->bind_result($correct_choice, $question_marks);
    $stmt->fetch();
    $stmt->close();

    $number = $_POST['number'];
    $selected_choice = $_POST['choice'];

    $studentNumber = $_SESSION['studentNumber'];
    $answerChoice = $_SESSION['choice'];
    $totalMarks = $_SESSION['score'];

     $sql = "INSERT INTO quizziz (studentNumber, answerChoice, totalMarks) VALUES ('$studentNumber', '$answerChoice', '$totalMarks')";

      $result = mysqli_query($connect, $sql);  // Execute the query

    // Compare answer
    if ($selected_choice == $correct_choice) {
        $_SESSION['score'] += $question_marks;
    }

    // Check if it's the last question
    $query_total = "SELECT COUNT(*) AS total FROM question";
    $result_total = $connect->query($query_total);
    $row_total = $result_total->fetch_assoc();
    $total_questions = $row_total['total'];

    if ($number == $total_questions) {
        // Redirect to the final page if it's the last question
        header("Location: resultanswer.php");
        exit();
    } else {
        // Redirect to the next question
        $next = $number + 1;
        header("Location: question.php?n=" . $next);
        exit();
    }
} else {
    // Redirect to the question page if the form is not submitted correctly
    header("Location: question.php?n=1");
    exit();
}
?>
