<?php  
session_start(); 
include('..\connect.php'); 

if (isset($_SESSION['customerid'])) 
{
	$CustomerID=$_SESSION['customerid'];

	$select="SELECT * FROM customers Where CustomerID=$CustomerID";
	$retrieve=mysqli_query($connection,$select);
	$count=mysqli_num_rows($retrieve);
	$array=mysqli_fetch_array($retrieve);

	if ($count < 1) 
	{
		echo" <script>window.alert('ERROR : Please Login first ! ') </script>";
		echo" <script> window.location = '/PB_M/customer/login.php'</script>" ;
	}

	else
	{

	}

}
else {
	echo" <script>window.alert('ERROR : Please Login first ! ') </script>";
	echo" <script> window.location = '/PB_M/customer/login.php'</script>" ;
}

?>