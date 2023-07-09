<?php 
//session_start(); 
include('verify_customer_login.php');
include('..\connect.php'); 
include('shopping_cart_functions.php');
include('..\customer\cus_header.php');

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if($action === 'remove') 
	{
		$MerchandiseID=$_GET['MerchandiseID'];
		RemoveProduct($MerchandiseID);	
	}
	elseif($action === 'clearall')
	{
		Clearall();
	}
}

//$PutCustomerID=$_SESSION['CustomerID'];


?>
<form>
	<div class="contact" id="contact">
		<div class="container">
			<div class="contact-block">
				<h3 class="title clr">Your Shopping Cart</h3>
				<?php  
				if(!isset($_SESSION['ShoppingCart_Functions'])) 
				{
					echo "<p>Empty Cart.</p>";
					echo "<a href='merchandise_display.php'>Back to Merchandise Display</a>";
				}
				else
				{
					?>
					<div style="overflow-x:auto;">
					<table border="1" cellpadding="5px" align="center" width="100%" class="block" >
						<tr>
							<th>Image</th>
							<th>MerchandiseID</th>
							<th>Merchandise_Name</th>

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
							$MerchandiseID=$_SESSION['ShoppingCart_Functions'][$i]['MerchandiseID'];

							echo "<tr align='center'>";
							echo "<td> <img src='$Image' style='width:100px; heigh:100px;'/> </td>";

							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['MerchandiseID'] ."</td>";

							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['Merchandise_Name'] ."</td>";

							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] ." MMK</td>";

							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'] ." pcs</td>";

							echo "<td>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] * $_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity']
							. " </td>";

							echo "<td class='block'> 
							<a href='shopping_cart.php?MerchandiseID=$MerchandiseID&action=remove'>Remove</a> 
							</td>";
							echo "</tr>";
						}

						?>
						<tr>
							<td colspan="7" align="right">
								<a href="merchandise_display.php">Continue Shopping</a>
								|
								<a href="shopping_cart.php?action=clearall">ClearAll</a>
								|
								<a href="checkout.php">Make Checkout</a>
							</td>
						</tr>
					</table>
				</div>
					<?php
				}

				?>
				<hr/>
			</div>
		</div>
	</div>
</form>
<?php
include('..\footer.php');
?>
