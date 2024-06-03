
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="subject.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title>Subject List</title>
</head>
<style>
	
	
</style>

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
            <li style="--bg:#0fa117">
                <a href="Lecturer Database.php">
                    <div class="icon"><ion-icon name="briefcase-outline"></ion-icon ></div>
                    <div class="text">Lecture List</div>
                </a>
            </li>
            <li style="--bg:#0fa117">
                <a href="studentList.php">
                    <div class="icon"><ion-icon name="book-outline"></ion-icon></div>
                    <div class="text">Student List</div>
                </a>
            </li>
            <li style="--bg:#b145e9" class="active">
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
            	<h1 id="namepage">LIST OF SUBJECTS</h1>
        	</div>        	
        </div>

   

    <div class="w3-container" id="table">
    	<a class='button' href="insertSubject.php" role="button">Insert New Subject</a>
         <div class="w3-container" id="search">
            <form method="POST" action="subjectList.php">
                <input type="text" name="search" placeholder="Search by Subject Code">
                <button type="submit">Search</button>
            </form>
        </div>
        <table id="customers" class="table-container">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Staff ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("db.php");

                if (isset($_POST['search'])) {
                        $search = mysqli_real_escape_string($connect, $_POST['search']);
                        $sql = "SELECT * FROM subject WHERE subjectCode LIKE '%$search%'";
                } else {
                        $sql = "SELECT * FROM subject";
                }


                $result = $connect->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connect->error);
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td>{$row['subjectCode']}</td>
                        <td>{$row['subjectName']}</td>
                        <td>{$row['staffID']}</td>
                        <td>
                            <a class='button1' href='editSubject.php?subjectCode={$row['subjectCode']}'>EDIT</a>
                            <a class='button1' href='deleteSubject.php?subjectCode={$row['subjectCode']}'>DELETE</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

	</body>
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



	</html>