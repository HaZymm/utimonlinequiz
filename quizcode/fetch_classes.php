<?php
include 'db.php';
$subjectCode = $_POST['subjectCode'];

$classSql = "SELECT Distinct classCode FROM question WHERE subjectCode = ?";
$stmt = $connect->prepare($classSql);
$stmt->bind_param("s", $subjectCode);
$stmt->execute();
$result = $stmt->get_result();

$classes = [];
while ($row = $result->fetch_assoc()) {
    $classes[] = $row;
}

echo json_encode($classes);
?>
