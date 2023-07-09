<?php 
//session_start(); 
include('..\connect.php');  
include('..\order\verify_customer_login.php');
include('..\customer\cus_header.php');

if (!isset($_GET['OrderID'])) {
		echo "<script>
				window.location = 'ask_for_deli.php';
			</script>";
	}
else{
	$OrderID=$_GET['OrderID'];
	$query="SELECT * FROM orders WHERE OrderID='$OrderID' ";
	$retrieve=mysqli_query($connection,$query);
	$count=mysqli_num_rows($retrieve);
	$array=mysqli_fetch_array($retrieve);
}

if(isset($_POST['btnDelivery'])) 
{

	$txtOrderID=$OrderID; 
	$txtBookingDate=date('Y-m-d');
	$txtExpectedDate=$_POST['txtExpectedDate'];
	$txtStatus="Pending";

	$Insert=" 
	INSERT INTO Delivery
	(OrderID,BookingDate,ExpectedDate,Status)
	VALUES
	('$txtOrderID','$txtBookingDate','$txtExpectedDate','$txtStatus' ) 
	";

	echo $Insert;

	$RunInsert=mysqli_query($connection,$Insert);				
	if ($RunInsert) 
	{
		echo "<script>window.alert('Successfully booked for delivery!');
			window.location='ask_for_deli.php'</script>"; 
	}
	else 
	{
		echo "<p>Something went wrong in booking delivery services :" . mysqli_error($connection) . "</p>";

	}
}
?>
<script>
	$(document).ready
	( function ()
	{
		$('#tableid').DataTable();
	}
	);
</script>
<form action="" method="POST">
	<div class="contact" id="contact">
		<div class="container">
			<div class="contact-two-grids">
				<br>
				<h3 class="title clr">Book Delivery Services</h3>
				<legend> Enter Delivery Information: </legend>
				<table id="tableid" class="display" >

					<tr>
						<td>Order No </td>
						<td>
							<input type="text" name="txtOrderID" value="<?php echo $array['OrderID'] ?>" class="form-control" disabled>
						</td>     
					</tr>

					<tr>
						<td>Booking Date </td>
						<td>
							<input type="text" name="txtBookingDate" value="<?php echo date('Y-m-d') ?>" class="form-control" readonly disabled/>
						</td>
					</tr>
					<tr>
						<td>Expected Date </td>
						<td>
							<input type="date" name="txtExpectedDate" required="" class="form-control"/>
						</td>
					</tr>


					<!-- Save / Reset -->
					<tr>
						<td>							
							<input type="submit" class="btn btn-secondary" name="btnDelivery" value="Book">
						</td>
						<td>
							<input type="reset" class="btn btn-danger" name="btnReset" value="Reset">   
						</td>

					</tr>


				</table> 
			</div>
		</div>
	</div>	
</form>
<br/>
<?php   
    include('..\footer.php');
?>
