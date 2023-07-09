<?php
    include('..\order\verify_customer_login.php');
    include('connect.php');
    include('cus_header.php');

if (isset($_SESSION['customerid'])) 
{
	$CustomerID=$_SESSION['customerid'];

	$query="SELECT * FROM customers WHERE CustomerID=$CustomerID";
    $Sret=mysqli_query($connection,$query);
    $Scount=mysqli_num_rows($Sret);
    $rows=mysqli_fetch_array($Sret);
    $CustomerID =$rows['CustomerID'];
	$Customer_Name=$rows['Name'];
}

if (isset($_POST['btnAsk'])) {
	$Question = $_POST['txtQuestion'];
	$Name = $_POST['txtName'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <!-- <a href="profile.php">PROFILE</a> -->






<div class="container light-grey" style="padding:25vh 10vw;">
	<h3 class="text-center">CONTACT</h3>
	<p class="text-center">Lets get in touch.</p>
	<div style="margin-top:48px">

		<form action="faq.php" method="POST">
			<p><input class="form-control" type="text" placeholder="Question" required name="txtQuestion"></p>
			<div class="form-row">
				<div class="col">
					<p><input class="form-control" type="text" placeholder="Your Name" name="txtName" value=""></p>
				</div>
				<div class="col">
					<p><input class="form-control" type="text" name="txtDate" value="<?php echo date('Y-m-d') ?>" disabled></p>
				</div>
			</div>
			<input type="submit" name="btnAsk" class="btn btn-dark" value="ASK QUESTION">
		</form>
	</div>
</div>
</body>
<?php   
    include('..\footer.php');
?>