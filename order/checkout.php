<?php 
//session_start(); 
include('..\connect.php'); 
include('shopping_cart_functions.php');

include('verify_customer_login.php');
include('..\customer\cus_header.php');


if(isset($_POST['btnCheckout'])) 
{

 	//Insert Order Data
	$size=count($_SESSION['ShoppingCart_Functions']);

	for ($i=0;$i<$size;$i++) 
	{ 
		
		$MerchandiseID=$_SESSION['ShoppingCart_Functions'][$i]['MerchandiseID'];

		$Price=$_SESSION['ShoppingCart_Functions'][$i]['Price'];
		$Quantity=$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity']; 
		
		//$CustomerID=$_SESSION['CustomerID'];
		$PutCustomerID=$_SESSION['customerid'];
		$Status="Pending";

		/*Payment*/

		$orderDate =$_POST['orderDate']; 

		$txtCardNo=$_POST['txtCardNo'];
		$rdoPayment=$_POST['rdoPayment'];

		/*Payment*/

		$TotalQuantity=CalculateTotalQuantity();
		$TotalAmount=CalculateTotalAmount();
		$VAT=CalculateVAT();
		$GrandTotal=CalculateTotalAmount() + CalculateVAT();

	//Insert Orders Data (1)
		echo $Insert="INSERT INTO
		orders(
		MerchandiseID,
		CustomerID,	
		Order_Date,
		TotalQuantity,
		TotalAmount,
		VAT,
		GrandTotal,
		Payment_Method,
		Bank_Card,
		Status
		)
		VALUES
		('$MerchandiseID ',
		'$PutCustomerID',
		'$orderDate ',
		'$TotalQuantity',
		'$TotalAmount',
		'$VAT',
		'$GrandTotal',
		'$rdoPayment',
		'txtCardNo',
		'$Status') 
		";
		$ret=mysqli_query($connection,$Insert);
		
	}

	if($ret) 
	{
		echo "<script>window.alert('Customer Payment for checking out is successfully Created!')</script>";
		unset($_SESSION['ShoppingCart_Functions']);

		echo "<script>window.location='View_Checkout.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Payment for check out:" . mysqli_error($connection) . "</p>";
	}
}


?>
<script type="text/javascript">


	function COD()
	{
		document.getElementById('CardPayment').style.display="none";
		document.getElementById('Kpay').style.display="none";
		document.getElementById('Wavepay').style.display="none";
	}

	function CardPayment()
	{
		document.getElementById('CardPayment').style.display="block";
		document.getElementById('Kpay').style.display="none";
		document.getElementById('Wavepay').style.display="none";
	}

	function Kpay()
	{
		document.getElementById('CardPayment').style.display="none";
		document.getElementById('Kpay').style.display="block";
		document.getElementById('Wavepay').style.display="none";
	}

	function Wavepay()
	{
		document.getElementById('CardPayment').style.display="none";
		document.getElementById('Kpay').style.display="none";
		document.getElementById('Wavepay').style.display="block";
	}

</script>
<form action="checkout.php" method="POST">
	<fieldset>
		<div class="contact" id="contact">
			<div class="container">
				<div class="contact-block">
					<h3 class="title clr">Thank you for buying our merchandises.</h3>
					<legend>Checkout Informations :</legend>

					<table cellpadding="5px">
						<tr>

							<td>Total Amount</td>
							<td>
								: <b><?php echo CalculateTotalAmount() ?></b> MMK
							</td>
							<td>Tax (5%)</td>
							<td>
								: <b><?php echo CalculateVAT() ?></b> MMK
							</td> 
						</tr>
						<tr>
							<td>Order Date</td>
							<td>
								: <input type="text" name="orderDate" value="<?php echo date('Y-m-d') ?>"  readonly />
							</td>
							<td>Total Quantity</td>
							<td>
								: <b><?php echo CalculateTotalQuantity() ?></b> pcs
							</td>
							<td>Grand Total</td>
							<td>
								: <b><?php echo CalculateVAT() + CalculateTotalAmount() ?></b> MMK
							</td> 
						</tr>
					</table>

					<!-- Payment -->

					<hr/>
					<div class="block">
						<b><u>Payment Details :</u></b>
						<br>
						<input type="radio" name="rdoPayment" value="COD" onClick="COD()" checked />Cash on Delivery
						<input type="radio" name="rdoPayment" value="CARD" onClick="CardPayment()" />Card Payment
						<input type="radio" name="rdoPayment" value="KPAY" onClick="Kpay()" />K Pay 
						<input type="radio" name="rdoPayment" value="WAVEPAY" onClick="Wavepay()" />Wave Pay

						<div id="CardPayment" style="display: none;">
							<table cellpadding="3px">
								<tr>
									<td>
										<input type="text" name="txtCardNo" placeholder="Card Number" size="20" />
									</td>
									<td>
										<input type="text" name="txtSecurityCode" placeholder="Security Code" size="10" />
									</td>
								</tr>
								<tr>
									<td>
										<input type="text" name="txtMonth" placeholder="Month" size="7"/>
										<input type="text" name="txtYear" placeholder="Year" size="7" />
									</td>
								</tr>
							</table>
						</div>


						<div id="Kpay" style="display: none;">
							KPay No (23273272093)
							<br/>
							<img src="images/QR.png" width="150px" height="150px" />
						</div>

						<div id="Wavepay" style="display: none;">
							Wave Pay No (112233445566)
							<br/>
							<img src="images/QR.png" width="150px" height="150px" />
						</div>
					</div>
					<hr/>



					<!-- Payment End -->

					<input type="submit" name="btnCheckout" value="Checkout" />
					<input type="reset"  value="Cancel" />
					<hr/>

					<b><u>Your Cart Details :</u></b>
					<br>

					<table border="1" cellpadding="5px" align="center" width="100%">
						<tr>
							<th>Image</th>
							<th>MerchandiseID </th>
							<th>Merchandise Name</th>
							<th>Price</th>
							<th>BuyQuantity</th>
							<th>Sub-Total</th>
							<th>Action</th>
						</tr>
						<?php  

						$size=count($_SESSION['ShoppingCart_Functions']);

						for ($i=0;$i<$size;$i++) 
						{ 
							$Image=$_SESSION['ShoppingCart_Functions'][$i]['Image'];

							$MerchandiseID =$_SESSION['ShoppingCart_Functions'][$i]['MerchandiseID'];

							echo "<tr align='center'>";
							echo "<td> <img src='$Image' width='100px' height='120px'/> </td>";

							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['MerchandiseID'] ."</td>";
							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['Merchandise_Name'] ."</td>";
							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] ." MMK</td>";
							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'] ." pcs</td>";

							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] * 
							$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity']
							. " MMK</td>";

							echo "<td> 
							<a href='Shopping_Cart.php?MerchandiseID =$MerchandiseID &action=remove'>Remove</a> 
							</td>";
							echo "</tr>";
						}

						?>
					</table>
				</div>
			</div>
		</div>
	</fieldset>

</form>

<?php
include('..\footer.php');
?>
