<?php
    include 'db.php';
    session_start();
    $id = $_SESSION['id'];
    $subjectcode = $_SESSION['subjectcode'];
    $classcode = $_SESSION['classcode'];

    if (isset($_POST['delete'])) {
        $_SESSION['videoCode'] = $_POST['delete'];
        echo "<script>window.location='videoDelete.php'</script>";
    }
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <link rel="stylesheet" href="upload.css">
    <link rel="stylesheet" type="text/css" href="master.css">
    <script>
        function toggleUploadType() {
            const uploadType = document.querySelector('input[name="upload_type"]:checked').value;
            const videoFileInput = document.getElementById('video_file_input');
            const videoLinkInput = document.getElementById('video_link_input');

            if (uploadType === 'file') {
                videoFileInput.style.display = 'block';
                videoFileInput.style.opacity = '1';
                videoFileInput.style.transform = 'translateY(0)';
                videoLinkInput.style.display = 'none';
                videoLinkInput.style.opacity = '0';
                videoLinkInput.style.transform = 'translateY(-10px)';
            } else {
                videoFileInput.style.display = 'none';
                videoFileInput.style.opacity = '0';
                videoFileInput.style.transform = 'translateY(-10px)';
                videoLinkInput.style.display = 'block';
                videoLinkInput.style.opacity = '1';
                videoLinkInput.style.transform = 'translateY(0)';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php if(isset($_GET['error'])){ ?>
                <p class="error-message"><?=$_GET['error']?></p>
            <?php } ?>
            <form action="uploadlinkvideo.php" method="post" enctype="multipart/form-data">
                <input type="text" name="video_name" placeholder="Enter Video Name">
                <div class="radio-group">
                    <label>
                        <input type="radio" name="upload_type" value="file" checked onclick="toggleUploadType()">
                        <span class="checkmark"></span> Upload Video File
                    </label>
                    <label>
                        <input type="radio" name="upload_type" value="link" onclick="toggleUploadType()">
                        <span class="checkmark"></span> Upload Video Link
                    </label>
                </div>
                <div id="video_file_input">
                    <input type="file" name="my_video">
                </div>
                <div id="video_link_input" style="display: none;">
                    <input type="text" name="video_link" placeholder="Enter Video Link">
                </div>
                <input type="submit" name="submit" value="Upload">
            </form>
        </div>
    </div>
</body>
</html>
