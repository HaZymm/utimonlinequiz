<?php
	session_start();
	include 'db.php';
	$id = $_SESSION['id'];
	$subjectcode = $_SESSION['subjectcode'];
	$classcode = $_SESSION['classcode'];
	$_SESSION['questiontopic'] = $_POST['questionTopic'];
	$question_topic = $_SESSION['questiontopic']; 
	//Get Total Num Questions
	/*echo $id,$subjectcode,$classcode,$question_topic;*/

	$topic = "SELECT COUNT(*) AS questionCount
					FROM question
					WHERE subjectCode = '$subjectcode' AND
					classCode = '$classcode' AND
					questionTopic = '$question_topic'";

	

	$result = mysqli_query($connect,$topic);
	$total = mysqli_fetch_assoc($result);
	echo $total['questionCount'];

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Go Quiz Inno.</title>
	<link rel="stylesheet" type="text/css" href="question.css">
	<link rel="stylesheet" type="text/css" href="master.css">
</head>
<body>
	<div class="body2">
	<header>
	</header>
		<div class="app2">
			<form action="question.php" method="post">
				<h2><?php echo $question_topic; ?></h2><br>
				
				<ul class="text">
					<li><strong>Number of  Questions:</strong><?php echo $total['questionCount']; ?></li>
					<li><strong>Question Type:</strong>Multiple Choice </li>
					<li><strong>Estimated Time:</strong><?php echo $total['questionCount'] *3 ?> Minutes</li>
				</ul>
				<button class="start" name="start" value="<?php echo $question_topic; ?>">Start Quiz</button>
		</form>
	</div>
	</div>
	<footer class="footer">
        <p>© 2024 Go Guiz - All Rights Reserved</p>
   </footer>
</body>
</html>