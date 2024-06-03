<?php
	session_start();
	include("db.php");
	$email = $_SESSION['email'];
	$id = $_SESSION['id'];

	//if (isset($_POST['buttonalllist']) && $_POST['buttonalllist'] != '') {
		/*$subject = $_POST['buttonalllist'];
		$sql = "SELECT DISTINCT s.subjectName,l.lecturerName,s.subjectCode,c.classCode 
		   FROM subject s,registration r, staff d, lecturer l, class c, student st
		   WHERE s.subjectCode = r.subjectCode AND
		   d.staffID = r.staffID AND 
		   d.staffID = l.staffID AND
		   c.classCode = st.classCode AND
		   st.studentNumber = r.studentNumber AND
		   r.staffID = '$id' AND
		   s.subjectCode = '$subject'";*/


	//}
	//else{
		$sql = "SELECT DISTINCT s.subjectName,l.lecturerName,s.subjectCode,c.classCode 
		   FROM subject s,registration r, staff d, lecturer l, class c, student st
		   WHERE s.subjectCode = r.subjectCode AND
		   d.staffID = s.staffID AND 
		   d.staffID = l.staffID AND
		   c.classCode = st.classCode AND
		   st.studentNumber = r.studentNumber AND
		   s.staffID = '$id'";

		

		  
	$output2 = mysqli_query($connect,$sql);

	$output3 = mysqli_query($connect,$sql);

	$runlectname = mysqli_fetch_assoc($output3);



	if (!$output2) {
   	 die('Error: ' . mysqli_error($connect));
	}




	if (isset($_POST['buttonsublist'])) {
	
		$_SESSION['combinecode'] = $_POST['buttonsublist'];
		echo "<script>window.location='subjectmenulecturer.php'</script>";
		}

	


?>

<!DOCTYPE html>
<html>
	<title>SUBJECT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="master.css">
	<link rel="stylesheet" type="text/css" href="menulecturer.css">

<body id="body">
				
			<div class="sidebar">
		        <ul>
		            <li class="logo" style="--bg:#333">
		                <a href="#">
		                    <div class="icon"><ion-icon name="logo-amplify"></ion-icon></div>
		                    <div class="text">Go Quiz Inno.</div>
		                </a>
		            </li>
		            <li style="--bg:#f44336" class="active">
		                <a href="menulecturer.php">
		                    <div class="icon"><ion-icon name="home-outline"></ion-icon></div>
		                    <div class="text">HOME</div>
		                </a>
		            </li>
		            <li style="--bg:#0fa117">
		                <a href="profilemenulecturer.php">
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
	    			<h1 id="namepage">WELCOME <?php echo $runlectname['lecturerName']?></h1>
	  			</div>
			</div>

			<form action="menulecturer.php" method="post">
				<main id="main">
					<?php
						while ($row = mysqli_fetch_assoc($output2)) {
					?>
					<div id="div3">
						<fieldset id="field2st">
							<div id="div3rd">
								<div class="caption">
									<p class="subject_code"><?php echo $row['subjectCode']?> - <?php echo $row['subjectName']?></p><br><br>
									<p class="class_code" name="classcode" ><?php echo $row['classCode']?></p><br><br>
									<p class="subject_lecturer">🧑‍🏫 BY: <?php echo $row['lecturerName']?></p>
									<input type="hidden" name="classcodepass" value="<?php echo $row['classCode']?>">
								</div>		
								<button value="<?php echo $row['subjectCode']?><?php echo $row['classCode']?>" class="buttonsublist" name="buttonsublist">VIEW</button>
								<script type="text/javascript">
									let products = {
		 							 data: [
		   							 {
		     							category: $row['subjectCode'],
									}]}
								</script>
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

