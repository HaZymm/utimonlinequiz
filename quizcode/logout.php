<?php 
/* session_unset just clears out the session for usage.the session is still on
	the users computer. note that by using session_unser, the variable still
	exists. session_unset just remove all session variables

	session_destroy destroys all of the data associated with the current
	session*/

	session_start();
	session_unset();
	session_destroy();
	header("Location: login.html");
 ?>