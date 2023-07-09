<?php 
	session_start();
	session_destroy();
	echo "<script>window.alert('You have been logged out!')</script>";
	echo "<script>window.location='../index.php'</script>"

	//echo "<script>window.location='../staff/index.php'</script>"

	//echo "<script>window.location='http://localhost:8080/PB_M/staff/index.php'</script>"
?>