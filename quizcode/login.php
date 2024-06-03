<?php
session_start();
include("db.php");


 $username = $_POST['uName'];  //aaa
 $password = $_POST['pwd'];  //aaa
 $type =$_POST['type'];

 if($type == "student"){
 	$sql = "SELECT * FROM student WHERE studentEmail = '$username' AND studentPassword = '$password'";

	$kueri = mysqli_query($connect,$sql);

	$bacarekod = mysqli_num_rows($kueri);

	if($bacarekod == 0)
		{
			echo "<script>alert('error, wrong password or username')
			window.location='login.html'</script>";
		}
	else 
		{
			$sid = mysqli_fetch_assoc($kueri);
			$_SESSION['email'] = $sid['studentEmail']; //userName = depend on database
			$_SESSION['id'] = $sid['studentNumber'];
			echo "<script>alert('log in success')
			window.location='menustudent.php'</script>";

			
		}
 }
 else if($type == "lecturer"){
 	$sql = "SELECT * FROM lecturer WHERE lecturerEmail = '$username' AND lecturerPassword = '$password'";

	$kueri = mysqli_query($connect,$sql);

	$bacarekod = mysqli_num_rows($kueri);

	if($bacarekod == 0)
		{
			echo "<script>alert('error, wrong password or username')
			window.location='login.html'</script>";
		}
	else 
		{
			$sid = mysqli_fetch_assoc($kueri);
			$_SESSION['email'] = $sid['lecturerEmail']; //userName = depend on database
			$_SESSION['id'] = $sid['staffID'];
			echo "<script>alert('log in success')
			window.location='menulecturer.php'</script>";
		}
 }
 else if($type == "admin"){
 	$sql = "SELECT * FROM admin WHERE adminEmail = '$username' AND adminPassword = '$password'";

	$kueri = mysqli_query($connect,$sql);

	$bacarekod = mysqli_num_rows($kueri);

	if($bacarekod == 0)
		{
			echo "<script>alert('error, wrong password or username')
			window.location='login.html'</script>";
		}
	else 
		{
			$sid = mysqli_fetch_assoc($kueri);
			$_SESSION['email'] = $sid['adminEmail']; //userName = depend on database
			$_SESSION['id'] = $sid['staffID'];
			echo "<script>alert('log in success')
			window.location='adminmenu.php'</script>";
		}
 }



?>