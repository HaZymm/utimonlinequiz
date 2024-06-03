<?php
    include 'db.php';
    session_start();
    $id = $_SESSION['id'];
    $subjectcode = $_SESSION['subjectcode'];
    $classcode = $_SESSION['classcode'];

    $sqlvideo = "SELECT * FROM video
                WHERE subjectCode = '$subjectcode' AND
                classCode = '$classcode' AND videoType = 'file' ";
    $output = mysqli_query($connect,$sqlvideo);

    $sqllink = "SELECT * FROM video
                WHERE subjectCode = '$subjectcode' AND
                classCode = '$classcode' AND videoType = 'link'";
    $output1 = mysqli_query($connect,$sqllink);
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
            <li style="--bg:#2196f3" class="active">
                <a href="videostudent.php">
                    <div class="icon"><ion-icon name="videocam-outline"></ion-icon></div>
                    <div class="text">Video</div>
                </a>
            </li>
            <li style="--bg:#b145e9">
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

        <div class="w3-container" id="table">
            <table id="customers">
                <tr>
                    <td>Video Name</td>
                    <td>Link</td>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($output)) {
                ?>
                    <tr>
                        <td><?php echo $row["videoName"]; ?></td>
                        
                            <td>
                                <button class="button" onclick="openLink('<?php echo $row['videoURL']; ?>')">LINK</button>
                            </td>
                        
                    </tr>
                <?php
                }
                ?>
                <?php
                while ($row1 = mysqli_fetch_assoc($output1)) {
                ?>
                    <tr>
                        <td><?php echo $row1["videoName"]; ?></td>
                        <td>
                            <a href="<?php echo $row1['videoURL']; ?>" class="button" target="_blank">LINK</a>
                        </td>
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
    <script>
    function openLink(url) {
        window.open(url, '_blank');
    }
</script>

</body>
</html>