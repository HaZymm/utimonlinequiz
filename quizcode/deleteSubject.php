<?php

if (isset($_GET['subjectCode'])) {
    $subjectCode = $_GET['subjectCode'];

    include("db.php");

    // Begin transaction
    $connect->begin_transaction();

    try {
        // Delete from the quiziz table (assuming you need to delete from quiziz where related questions belong to the subject)
        $stmt = $connect->prepare("DELETE q FROM quiziz q JOIN question qu ON q.questionid = qu.questionid WHERE qu.subjectCode = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("s", $subjectCode); // Bind as string
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Delete from the video table
        $stmt = $connect->prepare("DELETE FROM video WHERE subjectCode = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("s", $subjectCode); // Bind as string
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Delete from the question table
        $stmt = $connect->prepare("DELETE FROM question WHERE subjectCode = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("s", $subjectCode); // Bind as string
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Delete from the registration table
        $stmt = $connect->prepare("DELETE FROM registration WHERE subjectCode = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("s", $subjectCode); // Bind as string
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Delete from the subject table
        $stmt = $connect->prepare("DELETE FROM subject WHERE subjectCode = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("s", $subjectCode); // Bind as string
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Commit transaction
        $connect->commit();

        
    } catch (Exception $e) {
        // Rollback transaction on error
        $connect->rollback();
        echo "Error deleting record: " . $e->getMessage();
    }

    // Close the connection
    $connect->close();

    // Redirect to subjectList.php
    echo "<script>alert('Record deleted successfully')
            window.location='subjectList.php'</script>";
} else {
    echo "No subjectCode provided.";
}
?>
