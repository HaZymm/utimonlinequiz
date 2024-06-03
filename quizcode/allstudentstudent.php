<?php
	session_start();
	include 'db.php';
	$id = $_SESSION['id'];
	$subjectcode = $_SESSION['subjectcode'];
	$classcode = $_SESSION['classcode'];

	
?>

<!DOCTYPE html>
<html>
	<title>SUBJECT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="master.css">
	<link rel="stylesheet" type="text/css" href="subjectstudent.css">

<body onload="w3_open()" id="body">
	<div class="sidebar">
        <ul>
            <li class="logo" style="--bg:#333">
                <a href="#">
                    <div class="icon"><ion-icon name="logo-amplify"></ion-icon></div>
                    <div class="text">Go Quiz Inno.</div>
                </a>
            </li>
            <li style="--bg:#f44336">
                <a href="menustudent.php">
                    <div class="icon"><ion-icon name="home-outline"></ion-icon></div>
                    <div class="text">Home</div>
                </a>
            </li>
            <li style="--bg:#0fc70c">
                <a href="subjectmenustudent.php">
                    <div class="icon"><ion-icon name="hourglass-outline"></ion-icon></div>
                    <div class="text">Quiz</div>
                </a>
            </li>
            <li style="--bg:#2196f3">
                <a href="videostudent.php">
                    <div class="icon"><ion-icon name="videocam-outline"></ion-icon></div>
                    <div class="text">Video</div>
                </a>
            </li>
            <li style="--bg:#b145e9" class="active">
                <a href="allstudentstudent.php">
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

		<div class="w3-container" id="search">
			<form method="POST" action="allstudentstudent.php">
				<input type="text" name="search" placeholder="Search by student name">
				<button type="submit">Search</button>
			</form>
		</div>


		<div class="w3-container" id="table">
			<table id="customers">
	  			<tr>
	    			<th>Student Number</th>
	    			<th>Student Name</th>
	    			<th>Class Code</th>
	  			</tr>
	  			<?php
					if (isset($_POST['search'])) {
						$search = mysqli_real_escape_string($connect, $_POST['search']);
						$sql = "SELECT st.studentNumber, st.studentName, st.classCode FROM student st, registration r WHERE 
								st.studentNumber = r.studentNumber AND
								st.classCode = '$classcode' AND r.subjectCode = '$subjectcode' AND st.studentName LIKE '%$search%'";
					} else {
						$sql = "SELECT st.studentNumber, st.studentName, st.classCode FROM student st, registration r 
								WHERE st.studentNumber = r.studentNumber AND
								st.classCode = '$classcode' AND r.subjectCode = '$subjectcode'";
					}
					$runqsl = mysqli_query($connect, $sql);
					while ($row = mysqli_fetch_assoc($runqsl)) {
				?>
	  			<tr>
	    			<td><?php echo $row["studentNumber"]; ?></td>
	    			<td><?php echo $row["studentName"]; ?></td>
	    			<td><?php echo $row["classCode"]; ?></td>
	  			</tr>
	  			<?php
			        }
			    ?>
			</table>
		</div>

	</div>
	<footer class="footer">
        <p>© 2024 Go Guiz - All Rights Reserved</p>
   </footer>
</body>
</html>
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
