<?php
    session_start();
    include("db.php");
    $id = $_SESSION['id'];

    $sql = "SELECT * FROM student
            WHERE studentNumber = '$id'";

    $output = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($output);

    if(isset($_POST['buttonback'])){
        echo "<script>window.location='menustudent.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PROFILE</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="profilemenustudent.css">
<link rel="stylesheet" type="text/css" href="master.css">
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
                        <a href="menustudent.php">
                            <div class="icon"><ion-icon name="home-outline"></ion-icon></div>
                            <div class="text">HOME</div>
                        </a>
                    </li>
                    <li style="--bg:#0fa117" class="active">
                        <a href="profilemenustudent.php">
                            <div class="icon"><ion-icon name="person-circle-outline"></ion-icon></div>
                            <div class="text">PROFILE</div>
                            
                        </a>
                    </li>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br>
                    
                    <li style="--bg:#333">
                        <a href="logout.php">
                            <div class="icon"><ion-icon name="log-out-outline"></ion-icon></div>
                            <div class="text">log out</div>
                        </a>
                    </li>
                </ul>      
            </div>
<form action="profilemenustudent.php" method="post">
<div class="container">
    <div class="row gutters">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Personal Details</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <label class="form-control" id="fullName"><?php echo $row['studentName'] ?></label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="eMail">Email</label>
                                <label class="form-control" id="fullName"><?php echo $row['studentEmail'] ?></label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone">Matrix Number</label>
                                <label class="form-control" id="fullName"><?php echo $row['studentNumber'] ?></label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="website">class</label>
                                <label class="form-control" id="fullName"><?php echo $row['classCode'] ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <button id="submit" name="buttonback" class="btn btn-secondary">BACK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
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