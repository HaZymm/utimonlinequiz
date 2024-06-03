<?php
    if (isset($_POST['back'])) {
        echo "<script>window.location='videostudent.php'</script>";
    }
?>

<html>
<head>
    <title>View</title>
    <style>
         body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background: rgb(48,42,158);
            background: linear-gradient(90deg, rgba(48,42,158,1) 0%, rgba(20,20,156,1) 35%, rgba(0,212,255,1) 100%);
        }
        video {
            width: 640px;
            height: 360px;
            margin-bottom: 20px; /* Add space between video and button */
        }
        .button, .addbutton {
            background-color: #1e90ff; /* Blue background */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none; /* Ensure anchor buttons don't have underline */
            display: inline-block; /* Ensure buttons behave the same */
        }
        .button:hover, .addbutton:hover {
            background-color: #1c86ee; /* Darker blue on hover */
            transform: scale(1.05);
        }
        .button:active, #addbutton:active {
            background-color: #187bcd; /* Even darker blue on click */
            transform: scale(1);
        }
    </style>
</head>
<body>
    <div class="alb">
        <?php 
        include "db.php";
        session_start();
        $videocode = $_POST['link'];
        $sql = "SELECT * FROM video WHERE
                videoCode = '$videocode'";
        $res = mysqli_query($connect, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($video = mysqli_fetch_assoc($res)) { 
                $videoURL = $video['videoURL'];
                $videoExtension = pathinfo($videoURL, PATHINFO_EXTENSION);
                if (in_array(strtolower($videoExtension), ["mp4", "webm", "avi", "flv", "mkv"])) {
                    ?>
                    <video src="<?= $videoURL ?>" controls></video>
                    <?php 
                } else {
                    ?>
                    <a href="<?= $videoURL ?>" target="_blank"><?= $video['videoName'] ?></a>
                    <?php 
                }
            }
        } else {
            echo "<h1>Empty</h1>";
        }
        ?>
        <br><br>
    </div>
    <form action="viewvideostudent.php" method="post">
        <button name="back" class="button">BACK</button>
    </form>
</body>
</html>
