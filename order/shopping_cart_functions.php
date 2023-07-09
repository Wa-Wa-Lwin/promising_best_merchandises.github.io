<?php  

function AddProduct($MerchandiseID,$BuyQuantity)
{
include('..\connect.php'); 

	$query="SELECT * FROM merchandise 
		 	WHERE MerchandiseID='$MerchandiseID'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret); 
	$rows=mysqli_fetch_array($ret);

	if($count < 1) 
	{
		echo "<p>No Merchandise Information Found!</p>";
		exit();
	}

	if($BuyQuantity < 1) 
	{
		echo "<p>Please enter correct quantity to purchase!</p>";
		exit();
	}

	if(isset($_SESSION['ShoppingCart_Functions'])) 
	{
		$index=IndexOf($MerchandiseID);

		//Condi 2
		if ($index == -1) 
		{
			$count=count($_SESSION['ShoppingCart_Functions']);

			$_SESSION['ShoppingCart_Functions'][$count]['MerchandiseID']=$MerchandiseID;
			$_SESSION['ShoppingCart_Functions'][$count]['BuyQuantity']=$BuyQuantity;

			$_SESSION['ShoppingCart_Functions'][$count]['Price']=$rows['Price'];

			$_SESSION['ShoppingCart_Functions'][$count]['Merchandise_Name']=$rows['Merchandise_Name'];

			$_SESSION['ShoppingCart_Functions'][$count]['Image']=$rows['Photo1'];

		}
		//Condi 3
		else
		{
			$_SESSION['ShoppingCart_Functions'][$index]['BuyQuantity']+=$BuyQuantity;
		}
	}
	else
	{
		//Condi 1
		$_SESSION['ShoppingCart_Functions']=array(); // Creating Session Array 

		$_SESSION['ShoppingCart_Functions'][0]['MerchandiseID']=$MerchandiseID;
		$_SESSION['ShoppingCart_Functions'][0]['Merchandise_Name']=$rows['Merchandise_Name'];
		$_SESSION['ShoppingCart_Functions'][0]['BuyQuantity']=$BuyQuantity;		

		$_SESSION['ShoppingCart_Functions'][0]['Price']=$rows['Price'];		
		$_SESSION['ShoppingCart_Functions'][0]['Image']=$rows['Photo1'];

	}

	echo "<script>window.location='shopping_cart.php'</script>";
}

function RemoveProduct($MerchandiseID)
{
	$index=IndexOf($MerchandiseID);

	unset($_SESSION['ShoppingCart_Functions'][$index]);
	$_SESSION['ShoppingCart_Functions']=array_values($_SESSION['ShoppingCart_Functions']);
	echo "<script>window.location='shopping_cart.php'</script>";
}

function Clearall()
{
	unset($_SESSION['ShoppingCart_Functions']);
	echo "<script>window.location='shopping_cart.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$size=count($_SESSION['ShoppingCart_Functions']);

	for($i=0;$i<$size;$i++) 
	{ 
		$Price=$_SESSION['ShoppingCart_Functions'][$i]['Price'];
		$BQuantity=$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];

		$TotalAmount+=($Price * $BQuantity);
	}

	return $TotalAmount;
}

function CalculateVAT()
{
	$VAT=CalculateTotalAmount() * 0.05;

	return $VAT;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	$size=count($_SESSION['ShoppingCart_Functions']);

	for($i=0;$i<$size;$i++) 
	{ 
		$BQuantity=$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];

		$TotalQuantity+=$BQuantity;
	}

	return $TotalQuantity;
}

function IndexOf($MerchandiseID)
{	
	if(!isset($_SESSION['ShoppingCart_Functions'])) 
	{
		return -1;
	}

	$size=count($_SESSION['ShoppingCart_Functions']);

	if ($size < 1) 
	{
		return -1;
	}

	for ($i=0; $i < $size; $i++) 
	{ 
		if ($MerchandiseID == $_SESSION['ShoppingCart_Functions'][$i]['MerchandiseID']) 
		{
			return $i;
		}
	}
	return -1;
}
?>