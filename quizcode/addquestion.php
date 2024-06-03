<?php
	include 'db.php';
	session_start();
	$subjectcode = $_SESSION['subjectcode'];
	$classcode = $_SESSION['classcode'];

	/*echo $classcode ;*/

	$num_form = $_POST['totalQuestion'];
	$enteredTopic = $_POST['questionTopic'];

	// Set default value for num_form
	$_SESSION['num_form'] = $_POST['totalQuestion'] ;
	$_SESSION['topic'] = $_POST['questionTopic'];



	$sql = "SELECT * FROM question WHERE questionTopic = '$enteredTopic' AND classCode = '$classcode' AND subjectCode = '$subjectcode'";
	$query = mysqli_query($connect,$sql);

	$result = mysqli_query($connect, $sql);

	$row = mysqli_fetch_assoc($query);

	if(isset($_POST['nextbutton'])){
	    if ($_POST['questionTopic'] == '' || $_POST['totalQuestion'] == '') {
	        echo "<script>alert('enter question topic and total question')
	                window.location='addquestiondetail.php';</script>"; 
	        /*unset($_SESSION['alert']);*/
	    }
	    if (mysqli_num_rows($result) > 0) {
	        echo "<script>alert('Topic already exists. Please enter a different topic.'); window.location='addquestiondetail.php';</script>";
		} 
	} 
    //this for to go back

	
	if (isset($_POST['backbutton'])) {
		echo "<script>window.location='subjectmenulecturer.php'</script>";
	}

	



?>

<html>
<head>
    <link rel="stylesheet" href="addquestion.css">
    <link rel="stylesheet" type="text/css" href="master.css">
    <title>Questions</title>
</head>
<body>
    <div class="wrapper">

       
    	<br><br>
    	<form name="soalanForm_<?php echo $i; ?>" method="post" action="questionInsert.php">
	        <?php
	        for($i = 1; $i <= $num_form; $i++) {
	        ?>
		        <fieldset>
			        <h1>Question</h1>

			        <h2>question <?php echo $i; ?></h2>

			        <div class = "input-box">
			        	<input type = "hidden" value="<?php echo $i; ?>" name = "questionCode_<?php echo $i; ?>" >
			        </div>

			        <h3>Please enter the question : </h3>
			        <div class = "input-box"> <input type = "text" placeholder = "Enter your question" name = "questionStatement_<?php echo $i; ?>" ></div>

			        <h3>Please enter the answer for option A :</h3>
			        <div class = "input-box"> <input type = "text"  placeholder = "Option A" name = "optionA_<?php echo $i; ?>"></div>

			        <h3>Please enter the answer for option B :</h3>
			        <div class = "input-box"> <input type = "text"  placeholder = "Option B" name = "optionB_<?php echo $i; ?>"></div>

			        <h3>Please enter the answer for option C :</h3>
			        <div class = "input-box"> <input type = "text"  placeholder = "Option C" name = "optionC_<?php echo $i; ?>"></div>

			        <h3>Please enter the answer for option D :</h3>
			        <div class = "input-box"> <input type = "text"   placeholder = "Option D" name = "optionD_<?php echo $i; ?>"></div>

			        <h3>Please enter the answer for the question : </h3>
			        <div class = "input-box">
			        	<select name = "questionAnswer_<?php echo $i; ?>">
							<option selected>Choose the Answer</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
						</select>
			        </div>

			        <h3>Please enter the marks for this question : </h3>
			        <div class = "input-box"><input type = "number"  placeholder = "Enter marks" name = "questionMarks_<?php echo $i; ?>"></div>

		     	</fieldset>
	           
	            <?php
	            }
	            ?>
	            <br>
	            <div class="button-container">
	                <button type="reset" class="button" value="Reset">Reset</button>
	                <button type="submit" class="button" name="submit" value="Submit">Submit</button>
	                <button type="submit" class="button" name="back" value="Submit">Back</button>
	            </div>
        </form>
    </div>
</body>
</html>