<!doctype html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
	<link rel="stylesheet" type="text/css" href="subject.css">
	<title>Lecturer Database</title>
</head>

<body>
	<div class="sidebar">
        <ul>
            <li class="logo" style="--bg:#333">
                <a href="#">
                    <div class="icon"><ion-icon name="logo-amplify"></ion-icon></div>
                    <div class="text">Go Quiz Inno.</div>
                </a>
            </li>
            <li style="--bg:#f44336" >
                <a href="adminmenu.php">
                    <div class="icon"><ion-icon name="home-outline"></ion-icon></div>
                    <div class="text">Home</div>
                </a>
            </li>
            <li style="--bg:#0fa117" class="active">
                <a href="Lecturer Database.php">
                    <div class="icon"><ion-icon name="briefcase-outline"></ion-icon ></div>
                    <div class="text">Lecture List</div>
                </a>
            </li>
            <li style="--bg:#0fa117" >
                <a href="studentList.php">
                    <div class="icon"><ion-icon name="book-outline"></ion-icon></div>
                    <div class="text">Student List</div>
                </a>
            </li>
            <li style="--bg:#b145e9">
                <a href="subjectList.php">
                    <div class="icon"><ion-icon name="people-circle-outline"></ion-icon></div>
                    <div class="text">Subject</div>
                </a>
            </li>
            <li style="--bg:#333">
                <a href="logout.php">
                    <div class="icon"><ion-icon name="log-out-outline"></ion-icon></div>
                    <div class="text">Logout</div>
                </a>
            </li>
        </ul>
    </div>

    <div id="main">
        <div class="w3-teal-custom">
	            <div class="w3-container">
                <h1 id="namepage">LIST OF LECTURER</h1>
            </div>
        </div>

		<div class="w3-container table-container" id="table">
			<a class="button" href="registerLect.php" role="button">Insert New Lecturer</a>
            <div class="w3-container" id="search">
                <form method="POST" action="Lecturer Database.php">
                    <input type="text" name="search" placeholder="Search by Lecturer Name">
                    <button type="submit">Search</button>
                </form>
            </div>
			<table id="customers" class="table-container">
				<thead>
					<tr>
        		<th>Staff ID</th>
        		<th>Lecturer Name</th>
        		<th>Lecturer Email</th>
        		<th>Lecturer Password</th>
        		<th>Action</th>
      		</tr>

				</thead>
				<tbody>
					<?php
					$user = "root"; //mysqlusername
					$pass = ""; //mysqlpassword
					$host = "localhost"; //server name or ipaddress
					$dbname= "quiz1";

					$connect = mysqli_connect($host,$user,$pass,$dbname);

					if ($connect->connect_error) {
						die("Connection failed: " . $connect->connect_error);
					}

                    if (isset($_POST['search'])) {
                        $search = mysqli_real_escape_string($connect, $_POST['search']);
                        $sql = "SELECT * FROM lecturer WHERE lecturerName LIKE '%$search%'";
                    } else {
                        $sql = "SELECT * FROM lecturer";
                    }

					$result = $connect->query($sql);

					if (!$result) {
						die("Invalid query: " . $connect->error);
					}

          while($row = mysqli_fetch_assoc($result)) {
          	echo "
          	<tr>
          		<td>$row[staffID]</td>
          		<td>$row[lecturerName]</td>
          		<td>$row[lecturerEmail]</td>
          		<td>$row[lecturerPassword]</td>
          		<td>
              	<a class='button1' href='editLect.php?staffID=$row[staffID]'>EDIT</a>
                <a class='button1' href='deleteLect.php?staffID=$row[staffID]'>DELETE</a>
            	</td>
      			</tr>";
        
     			 }
				?>
			</tbody>
		</table>
	</div>
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
</body>
<footer class="footer">
        <p>© 2024 Go Guiz - All Rights Reserved</p> </footer>
</html>