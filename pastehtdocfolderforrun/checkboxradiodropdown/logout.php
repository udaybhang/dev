
<?php
session_start();
if(!isset($uname)){
		header("location: login.php");	
	session_destroy();

	}
?>



