<?php 
//session_start(); 
include('..\connect.php');  
include('verify_customer_login.php');
include('..\customer\cus_header.php');

if (!isset($_GET['OrderID'])) {
		echo "<script>
				window.location = 'view_checkout.php';
			</script>";
	}
else{
	$OrderID=$_GET['OrderID'];
	$query="
	SELECT o.*,m.Photo1,m.Merchandise_Name,m.MerchandiseID 
	FROM orders o,merchandise m  
	WHERE OrderID='$OrderID'
    AND m.MerchandiseID=o.MerchandiseID
	";
	$retrieve=mysqli_query($connection,$query);
	$count=mysqli_num_rows($retrieve);
	$array=mysqli_fetch_array($retrieve);
	$MImage=$array['Photo1'];   
    $OImage=$array['Photo'];
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
<form action="" method="POST" enctype="multipart/form-data">
	<div class="contact" id="contact">
		<div class="container">
			<div class="contact-two-grids">
				<h3 class="title clr">Your Order Detail</h3>
				<legend> Check Order Detail: </legend>

				<table id="tableid" class="display" >	

					<tr>
						<td colspan="2">
							<img src="<?php echo $MImage ?>" width="250" height="150" />
							<img src="<?php echo $OImage ?>" width="250" height="150" />
						</td>
					</tr>	

					<tr>
	                    <td>Merchandise </td>
	                    <td>  
	                    	<?php echo $array['Merchandise_Name'] ?>   
	                    </td>
                	</tr>

                	<tr>
						<td>Order Code No</td>
                    	<td> ORD-No-
                        	<?php echo $array['OrderID'] ?>
                    	</td>   
					</tr>

                	<tr>
	                    <td>Order Date </td>
	                    <td>  
	                    	<?php echo $array['Order_Date'] ?>  
	                    </td>
                	</tr>

                	<!-- TotalQuantity    -->
	                <tr>
	                    <td>TotalQuantity</td>
	                    <td>
	                    	<?php echo $array['TotalQuantity'] ?>
	                    </td>
	                </tr>

	                <!-- TotalAmount    -->
	                <tr>
	                    <td>TotalAmount</td>
	                    <td>
	                    	<?php echo $array['TotalAmount'] ?>
	                    </td>
	                </tr>

					<!-- VAT	 -->
					<tr>
						<td>VAT </td>
						<td>
							<?php echo $array['VAT'] ?>
						</td>
					</tr>

	                <!-- GrandTotal    -->
	                <tr>
	                    <td>GrandTotal</td>
	                    <td>
	                    	<?php echo $array['GrandTotal'] ?>
	                    </td>
	                </tr>

	                <!-- Payment_Method-->
	                <tr>
	                    <td>Payment Method</td>
	                    <td>
	                    	<?php echo $array['Payment_Method']?>
	                    </td>
	                </tr>

	                <!-- Bank_Card    -->
	                <tr>
	                    <td>Bank Card No</td>
	                    <td>
	                    	<?php echo $array['Bank_Card'] . 'hour' ?>
	                    </td>
	                </tr>

	                <!-- Status    -->
	                <tr>
	                    <td>Status</td>
	                    <td>
	                    	<?php echo $array['Status'] ?>
	                    </td>
	                </tr>

					<tr>
						<td>Description </td>
						<td>
							<?php echo $array['Description'] ?>
						</td>
					</tr>

					<tr>
						<td>
						<?php   

                        echo "<a href='orderdetail_entry.php?OrderID=$OrderID'> 
                        Customize your orders
                        </a>";

                         ?>
                        </td>
					</tr>


				</table> 
			</div>
		</div>
	</div>	
</form>

<?php
include('..\footer.php');
?>
