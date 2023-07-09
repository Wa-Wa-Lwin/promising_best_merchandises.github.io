<?php  
session_start(); 
include('..\connect.php'); 

if (isset($_SESSION['StaffID'])) 
{
	$StaffID=$_SESSION['StaffID'];

	$select="SELECT * FROM staff Where StaffID=$StaffID";
	$retrieve=mysqli_query($connection,$select);
	$count=mysqli_num_rows($retrieve);
	$array=mysqli_fetch_array($retrieve);

	if ($count < 1) 
	{
		echo" <script>window.alert('ERROR : Please Login first to access ! ') </script>";
		echo" <script> window.location = '/PB_M/staff/profile/login.php'</script>" ;
	}

	else
	{

	}

}


?>