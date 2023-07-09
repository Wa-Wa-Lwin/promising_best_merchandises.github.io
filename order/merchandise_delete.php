<?php 	
session_start();
include('..\connect.php'); 

$MerchandiseID=$_GET['MerchandiseID'];

$Delete="DELETE FROM merchandise where MerchandiseID=$MerchandiseID";
$ret=mysqli_query($connection,$Delete);
if($ret)
{
	echo "<script>window.alert('Merchandise is successfully deleted !')</script>"; 
	echo "<script>window.location='Merchandise_Entry.php'</script>";
}
else
{
	echo "<p>Something went wrong in Merchandise Delete :" . mysqli_error($connection) . "</p>";
}

 ?> 
