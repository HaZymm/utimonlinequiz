<?php
include ("db.php");
session_start();
$id = $_SESSION['id'];
$subjectcode = $_SESSION['subjectcode'];
$classcode = $_SESSION['classcode'];

if(isset($_POST['submit']) && isset($_POST['video_name']) && isset($_POST['upload_type'])) {
    $video_name = $_POST['video_name'];
    $upload_type = $_POST['upload_type'];

    if ($upload_type == 'file' && isset($_FILES['my_video'])) {
        $video_file_name = $_FILES['my_video']['name'];
        $tmp_name = $_FILES['my_video']['tmp_name'];
        $error = $_FILES['my_video']['error'];

        if($error === 0) {
            $video_ex = pathinfo($video_file_name, PATHINFO_EXTENSION);
            $video_ex_lc = strtolower($video_ex);
            $allowed_exs = array("mp4", "webm", "avi", "flv", "mkv");

            if(in_array($video_ex_lc, $allowed_exs)) {
                $new_video_name = uniqid("video-", true) . '.' . $video_ex_lc;
                $video_upload_path = 'uploads/' . $new_video_name;
                move_uploaded_file($tmp_name, $video_upload_path);

                $video_url = $video_upload_path;

                $sql = "INSERT INTO video (videoName, videoURL, subjectCode, classCode, videoType) VALUES ('$video_name', '$video_url', '$subjectcode', '$classcode', '$upload_type')";
                if (mysqli_query($connect, $sql)){
                    echo "<script>alert('VIDEO HAS SUCESSFULLY INSERT')
                    window.location='videolecturer.php'</script>";
                }else{
                     die("Error fetching question data: " . mysqli_error($connect));
                }
            } else {
                $em = "You can't upload this type of file!";
                header("Location: insertvideo.php?error=$em");
                exit();
            }
        } else {
            $em = "Invalid Video File!";
            header("Location: insertvideo.php?error=$em");
            exit();
        }
    } elseif ($upload_type == 'link' && isset($_POST['video_link'])) {
        $video_link = $_POST['video_link'];

        if (filter_var($video_link, FILTER_VALIDATE_URL)) {
            $sql = "INSERT INTO video (videoName, videoURL, subjectCode,classCode,videoType) VALUES ('$video_name', '$video_link', '$subjectcode', '$classcode','$upload_type')";

           if (mysqli_query($connect, $sql)){
                    echo "<script>alert('VIDEO HAS SUCESSFULLY INSERT')
                    window.location='videolecturer.php'</script>";
            }else{
                     die("Error fetching question data: " . mysqli_error($connect));
                }

        } else {
            $em = "Invalid Video Link!";
            header("Location: insertvideo.php?error=$em");
            exit();
        }
    } else {
        $em = "Please provide a video file or link!";
        header("Location: insertvideo.php?error=$em");
        exit();
    }
} else {
     echo "<script>alert('salaha')
    window.location='insertvideo.php'</script>";
}
?>
