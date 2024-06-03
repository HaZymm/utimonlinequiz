<?php  
	session_start();
	include("db.php");


	if(isset($_POST['password_reset_link']))
	{
		if(isset($_POST['uName'])){

			$email = $_POST['uName'];
			$newpass = $_POST['newpwd'];
			$conpass = $_POST['confpwd'];

			$check_emailstudent = "SELECT * FROM student WHERE studentEmail='$email'";
			$run_emailstudent = mysqli_query($connect,$check_emailstudent);

			$check_emaillecturer = "SELECT * FROM lecturer WHERE lecturerEmail='$email'";
			$run_emaillecturer = mysqli_query($connect,$check_emaillecturer);


			if ($newpass == $conpass) {
				if(mysqli_num_rows($run_emailstudent) >0)
				{

					$update_pass = "UPDATE student set studentPassword= '$newpass' WHERE studentEmail ='$email' ";
					$run_pass = mysqli_query($connect,$update_pass);


					if ($run_pass)
					{
						echo "<script>alert('your password have been reset')
						window.location='login.html'</script>";
					}
					else
					{
						echo "<script>alert('password did not update')
						window.location='enterEmail.html' </script>";
		
					}	
			
				}
				else if(mysqli_num_rows($run_emaillecturer) >0)
				{

					$update_pass = "UPDATE lecturer set lecturerPassword= '$newpass' WHERE lecturerEmail ='$email' ";
					$run_pass = mysqli_query($connect,$update_pass);


					if ($run_pass)
					{
						echo "<script>alert('your password have been reset')
						window.location='login.html'</script>";
					}
					else
					{
						echo "<script>alert('password did not update')
						window.location='enterEmail.html' </script>";
		
					}	
			
				}
				else
				{
					echo "<script>alert('email not exist')
					window.location='enterEmail.html' </script>";
		
				}	
			}
			else{
				echo "<script>alert('password need to be same')
					window.location='enterEmail.html' </script>";
			}
		}
	}
	


	/*//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';
	

	function send_reset_password($get_email,$token, $get_name)
	{	
		$mail = new PHPMailer(true);
		$mail -> isSMTP();
		$mail -> SMTPAuth = true;

   		 $mail-> Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
   		 $mail-> Username   = 'muhammadhazim439@gmail.com';                     //SMTP username
   		 $mail-> Password   = "***";    
   		                            //SMTP password
   		 $mail-> SMTPSecure = "tls";            //Enable implicit TLS encryption
   		 $mail-> Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    	//Recipients
    	$mail-> setFrom('muhammadhazim439@gmail.com', $get_name);
   		$mail-> addAddress($get_email); 

   		$mail -> isHTML(true);
   		$mail -> subject = "reset password";

   		$email_template = "<h2>hello</h2>
   		<h3>your are receiving this email because we receive a reset password request</h3>
   		<a href='http://localhost/GROUP%20PROJECT/resetpassword.html?token=$token&email=$get_email'>click me</a>";    

	}*/
?>