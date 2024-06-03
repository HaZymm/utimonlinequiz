<?php
	session_start();
	include("db.php");
	$email = $_SESSION['email'];
	$id = $_SESSION['id'];


	/*$sql = "SELECT s.subjectName,l.lecturerName,s.subjectCode, st.classCode 
		   FROM subject s,registration r, staff d, lecturer l,student st
		   WHERE s.subjectCode = r.subjectCode AND
		   d.staffID = r.staffID AND 
		   d.staffID = l.staffID AND
		   r.studentNumber = st.studentNumber AND
		   r.studentNumber = '$id'";*/

	$sql = "SELECT DISTINCT s.subjectName,l.lecturerName,s.subjectCode,c.classCode 
		   FROM subject s,registration r, staff d, lecturer l, class c, student st
		   WHERE s.subjectCode = r.subjectCode AND
		   d.staffID = s.staffID AND 
		   d.staffID = l.staffID AND
		   c.classCode = st.classCode AND
		   st.studentNumber = r.studentNumber AND
		   r.studentNumber = '$id'";

	$output1 = mysqli_query($connect,$sql);
	$output2 = mysqli_query($connect,$sql);

	$sqlname = "SELECT studentName FROM student WHERE studentNumber = '$id'";

	$output3 = mysqli_query($connect,$sqlname);
	$runname = mysqli_fetch_assoc($output3);

	if (!$output1) {
    	die('Error: ' . mysqli_error($connect));
	}
	if (!$output2) {
   	 die('Error: ' . mysqli_error($connect));
	}


	if (isset($_POST['buttonsublist'])) {
		$_SESSION['combinecode'] = $_POST['buttonsublist'];
		echo "<script>window.location='subjectmenustudent.php'</script>";
		}
	
?>

<!DOCTYPE html>
<html>
	<title>SUBJECT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="master.css">
	<link rel="stylesheet" type="text/css" href="menustudent.css">

<body onload="w3_open()" id="body">
		<div class="sidebar">
		        <ul>
		            <li class="logo" style="--bg:#333">
		                <a href="#">
		                    <div class="icon"><ion-icon name="logo-amplify"></ion-icon></div>
		                    <div class="text">Go Quiz Inno.</div>
		                </a>
		            </li>
		            <li style="--bg:#f44336" class="active">
		                <a href="menustudent.php">
		                    <div class="icon"><ion-icon name="home-outline"></ion-icon></div>
		                    <div class="text">HOME</div>
		                </a>
		            </li>
		            <li style="--bg:#0fa117">
		                <a href="profilemenustudent.php">
		                    <div class="icon"><ion-icon name="person-circle-outline"></ion-icon></div>
		                    <div class="text">PROFILE</div>
		                    
		                </a>
		            </li>
		            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		            
		            <li style="--bg:#333">
		                <a href="logout.php">
		                    <div class="icon"><ion-icon name="log-out-outline"></ion-icon></div>
		                    <div class="text">log out</div>
		                </a>
		            </li>
		        </ul>      
    		</div>
		
		<div id="main">
			<div class="w3-teal-custom">
	  			<button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
	  			<div class="w3-container">
	    			<h1 id="namepage">WELCOME <?php echo $runname['studentName']?></h1>
	  			</div>
			</div>

			<form action="menustudent.php" method="post">
				<main>
			<?php
				while ($row = mysqli_fetch_assoc($output2)) {
			?>
			<div id="div3">
				<fieldset id="field2st">
					<div id="div3rd">
						<div class="caption">
							<p class="subject_code"><?php echo $row['subjectCode']?> - <?php echo $row['subjectName']?></p><br>
							<p class="subject_lecturer">CLASS : <?php echo $row['classCode']?></p><br>
							<p class="subject_lecturer">🧑‍🏫 BY: <?php echo $row['lecturerName']?></p>
						</div>		
						<button value="<?php echo $row['subjectCode']?><?php echo $row['classCode']?>" class="buttonsublist" name="buttonsublist">VIEW</button>
					</div>
				</fieldset>	
			</div>
			<?php
				}
			?>
			</main>
			</form>
		</div>

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
<footer class="footer">
        <p>© 2024 Go Guiz - All Rights Reserved</p>
   </footer>
</body>
</html>