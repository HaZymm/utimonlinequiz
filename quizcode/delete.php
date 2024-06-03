<?php

$successMessage = "";

if (isset($_GET['studentNumber'])) {
    $studentNumber = $_GET['studentNumber'];

    // Validate studentNumber as an integer
    if (!is_numeric($studentNumber)) {
        die("Invalid student number.");
    }

    $studentNumber = intval($studentNumber);

    include("db.php");

    // Begin transaction
    $connect->begin_transaction();

    try {
        $stmt = $connect->prepare("DELETE FROM quiziz WHERE studentNumber = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("i", $studentNumber);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        // First, delete from the registration table
        $stmt = $connect->prepare("DELETE FROM registration WHERE studentNumber = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("i", $studentNumber);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Then, delete from the student table
        $stmt = $connect->prepare("DELETE FROM student WHERE studentNumber = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("i", $studentNumber);
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

    // Redirect to studentList.php
    echo "<script>alert('Record deleted successfully')
            window.location='studentlist.php'</script>";
} else {
    echo "No studentNumber provided.";
}
?>
