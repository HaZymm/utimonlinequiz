<?php
include 'db.php';

$classCode = $_POST['classCode'];

$topicSql = "SELECT DISTINCT questionTopic FROM question WHERE classCode = ?";
$stmt = $connect->prepare($topicSql);
$stmt->bind_param("s", $classCode);
$stmt->execute();
$result = $stmt->get_result();

$topics = [];
while ($row = $result->fetch_assoc()) {
    $topics[] = $row;
}

echo json_encode($topics);
?>
