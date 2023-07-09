<?php
	session_start();
	include('connect.php');
	include('cus_header.php');

	if (isset($_SESSION['customerid'])) {
		$CustomerID = $_SESSION['customerid'];
		$searchcustomer = "SELECT * FROM customers WHERE CustomerID = '$CustomerID'";
		$run_searchcustomer = mysqli_query($connection,$searchcustomer);

		if ($run_searchcustomer->num_rows !== 1) {
			echo "<script>window.alert('An unexpected error occured! Please login.')</script>";
    		echo "<script>window.location = 'login.php'</script>";
		} else {
			$tempcustomerinfo = mysqli_fetch_assoc($run_searchcustomer);
		}
	}
	else {
		$CustomerID = "";
		echo "<script>window.alert('Please Login First!')</script>";
		echo "<script>window.location = 'login.php'</script>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="py-3">
		<fieldset>
			<legend>PROFILE</legend>
			<table>
				<tr>
					<td>Name </td>
					<td><?php echo $tempcustomerinfo['Name'] ?></td>
				</tr>
				<tr>
					<td>Email	</td>
					<td><?php echo $tempcustomerinfo['Email'] ?></td>
				</tr>
				<tr>
					<td>Gender </td>
					<td><?php echo $tempcustomerinfo['Gender'] ?></td>
				</tr>
				<tr>
					<td>Phone </td>
					<td><?php echo $tempcustomerinfo['Phone'] ?></td>
				</tr>
				<tr>
					<td>Address </td>
					<td><?php echo $tempcustomerinfo['Address'] ?></td>
				</tr>
			</table>
		</fieldset>
		</div>

		<hr>

		<div class="d-flex">
			<div class="d-block mx-2">
				<a type="button" class="btn btn-success btn-rounded" data-mdb-ripple-color="dark" href="update.php">UPDATE</a>
			</div>
			<div class="d-block mx-2">
				<a type="button" class="btn btn-warning btn-rounded" data-mdb-ripple-color="dark" href="logout.php">LOGOUT</a>
			</div>
			<div class="d-block mx-2">
				<a type="button" class="btn btn-danger btn-rounded" data-mdb-ripple-color="dark" href="delete.php">DELETE</a>
			</div>
			<div class="d-block mx-2">
				<a type="button" class="btn btn-outline-light btn-rounded" data-mdb-ripple-color="dark" onClick="history.go(-1);">BACK</a>
			</div>
		</div>
	</div>
</body>
</html>
<?php   
    include('..\footer.php');
?>