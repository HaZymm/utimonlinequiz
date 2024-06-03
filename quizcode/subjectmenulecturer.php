<?php
	session_start();
	include 'db.php';
	$id = $_SESSION['id'];
	$combinestring = $_SESSION['combinecode'];
	$_SESSION['subjectcode'] = substr($combinestring, 0, 6);
	$_SESSION['classcode'] = substr($combinestring, 6);
	$subjectcode = $_SESSION['subjectcode'];
	$classcode = $_SESSION['classcode'];
	


	$topic = mysqli_query($connect, "SELECT DISTINCT COUNT(*) AS questionCount, questionTopic 
							FROM question 
							WHERE subjectCode = '$subjectcode' AND
							classCode = '$classcode'
							GROUP BY questionTopic");
	if (!$topic) {
    	die('Invalid query: ' . mysqli_error($connect));
	}

?>

<!DOCTYPE html>
<html>
	<title>SUBJECT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="master.css">
	<link rel="stylesheet" type="text/css" href="subjectlecturer.css">
	<link rel="stylesheet" type="text/css" href="delete.css">

<body id="body">
  	<div class="sidebar">
        <ul>
            <li class="logo" style="--bg:#333">
                <a href="#">
                    <div class="icon"><ion-icon name="logo-amplify"></ion-icon></div>
                    <div class="text">Go Quiz Inno.</div>
                </a>
            </li>
            <li style="--bg:#f44336">
                <a href="menulecturer.php">
                    <div class="icon"><ion-icon name="home-outline"></ion-icon></div>
                    <div class="text">Home</div>
                </a>
            </li>
            <li style="--bg:#0fc70c" class="active">
                <a href="subjectmenulecturer.php">
                    <div class="icon"><ion-icon name="hourglass-outline"></ion-icon></div>
                    <div class="text">Quiz</div>
                </a>
            </li>
            <li style="--bg:#2196f3">
                <a href="videolecturer.php">
                    <div class="icon"><ion-icon name="videocam-outline"></ion-icon></div>
                    <div class="text">Video</div>
                </a>
            </li>
            <li style="--bg:#b145e9">
                <a href="allstudentlecturer.php">
                    <div class="icon"><ion-icon name="people-circle-outline"></ion-icon></div>
                    <div class="text">Class</div>
                </a>
            </li>
        </ul>
    </div>

	

	<div id="main">
		<div class="w3-teal-custom">
  			<button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  			<div class="w3-container">
    			<h1 id="namepage"><?php echo $subjectcode ?></h1>
  			</div>
		</div>

		<form method="post" action="addquestiondetail.php">
			<div class="w3-container" id="table">
				<button id="addbutton">➕ADD QUIZ</button>
				<table id="customers">
			        <tr>
			            <td>Topic</td>
			            <td>Total Questions</td>
			            <td>Action</td>
			        </tr>
			        <?php
			        while ($row = mysqli_fetch_assoc($topic)) {
			        ?>
			            <tr>
			                <td><?php echo $row["questionTopic"]; ?></td>
			                <td><?php echo $row['questionCount'];?></td>
			                <td>
			                    <button class = "button" name="update" value="<?php echo $row["questionTopic"]; ?>">UPDATE</a></button>
			                    <button class = "button" name="delete" value="<?php echo $row["questionTopic"]; ?>">
							   DELETE
							  </button>
			                </td>
			            </tr>
			        <?php
			        }
			        ?>
	    		</table>
			</div>
		</form>
	</div>
	<footer class="footer">
        <p>© 2024 Go Guiz - All Rights Reserved</p>
    </footer>
	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        let menuToggle = document.querySelector('.logo');
        let sidebar = document.querySelector('.sidebar');
        menuToggle.onclick = function() {
            sidebar.classList.toggle('active');
        }

        let Menulist = document.querySelectorAll('.sidebar ul li:not(.logo)');
        function activelink() {
            Menulist.forEach((item) => item.classList.remove('active'));
            this.classList.add('active');
        }
        Menulist.forEach((item) => item.addEventListener('click', activelink));
    </script>
</body>
</html>