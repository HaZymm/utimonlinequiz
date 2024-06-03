<?php

if (isset($_GET['staffID'])) {
    $staffID = $_GET['staffID'];

    // Validate staffID as an integer
    if (!is_numeric($staffID)) {
        die("Invalid staff ID.");
    }

    $user = "root"; // mysql username
    $pass = ""; // mysql password
    $host = "localhost"; // server name or IP address
    $dbname = "quiz1";

    // Establish the connection
    $connect = new mysqli($host, $user, $pass, $dbname);

    // Check the connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Begin transaction
    $connect->begin_transaction();

    try {
        // First, delete from the lecturer table
        $stmt = $connect->prepare("DELETE FROM lecturer WHERE staffID = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("i", $staffID);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Then, delete from the staff table
        $stmt = $connect->prepare("DELETE FROM staff WHERE staffID = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $connect->error);
        }
        $stmt->bind_param("i", $staffID);
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

    // Redirect to Lecturer Database.php
    echo "<script>alert('Record deleted successfully')
            window.location='Lecturer Database.php'</script>";
} else {
    echo "No staff ID provided.";
}
?>
