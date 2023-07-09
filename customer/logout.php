<?php 
	session_start();
	session_destroy();
	echo "<script>window.alert('You have been logged out!')</script>";
	echo "<script>window.location='login.php'</script>"
?>