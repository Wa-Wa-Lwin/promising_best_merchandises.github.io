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

			if (isset($_POST['btnUpdate'])) {
		    	$customerid = $_SESSION['customerid'];
		        $name = $_POST['txtName'];
		        $email = $_POST['txtEmail'];
		        
		        if (isset($_POST['rdoGender'])) {
		        	$gender = $_POST['rdoGender'];
		        } else {
		        	$gender = $tempcustomerinfo['Gender'];
		        }
		        $phone = $_POST['txtPhone'];
		        $address = $_POST['txtAddress'];

		        if (empty($name) || empty($email)) {
		        	echo "<script>alert('Please fill up required form inputs!')</script>";
		        	echo "<script>history.go(-1)</script>";
		        } else {
		        	if ($email !== $tempcustomerinfo['Email']) {
		        		$checkemail = "SELECT * FROM customers WHERE Email = '$email'";
						$run_checkemail = mysqli_query($connection,$checkemail);
						$count = mysqli_num_rows($run_checkemail);

						if ($count > 0) {
							echo "<script>alert('This email is connected to another account!')</script>";
							echo "<script>history.go(-1)</script>";
						}
		        	}
		        	$updateaccount = "UPDATE customers
		        						SET Name = '$name',
		        						Email = '$email',
		        						Gender = '$gender',
		        						Phone = '$phone',
		        						Address = '$address'
		        						WHERE CustomerID = '$customerid'";
		        	$run_updateaccount = mysqli_query($connection, $updateaccount);
		        	if ($run_updateaccount) {
		        		echo "<script>alert('Account information updated!')</script>";
						echo "<script>window.location = 'profile.php'</script>";
		        	} else {
		        		echo "<script>alert('Sorry, an unexpected error occured!')</script>";
						echo "<script>window.location = 'update.php'</script>";
		        	}
		        }
			}
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
	<title>Update</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background: #CFD2CF;">

	<div class="container">
		<form action="update.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<legend>UPDATE INFORMATION</legend>
				<table>
					<tr>
						<td>Name </td>
						<td>
							<input type="text" name="txtName" value="<?php echo $tempcustomerinfo['Name'] ?>">
						</td>
					</tr>
					<tr>
						<td>Email </td>
						<td><input type="email" name="txtEmail" value="<?php echo $tempcustomerinfo['Email'] ?>"></td>
					</tr>
					<tr>
						<td>Gender </td>
						<td>
							<?php echo $tempcustomerinfo['Gender'] ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
			               	<div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rdoGender" value="Male" />
                                <label class="form-check-label" for="femaleGender">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rdoGender" value="Female" />
                                <label class="form-check-label" for="maleGender">Female</label>
                            </div>
                        </td>
					</tr>
					<tr>
						<td>Phone </td>
						<td><input type="text" name="txtPhone" value="<?php echo $tempcustomerinfo['Phone'] ?>"></td>
					</tr>
					<tr>
						<td>Address </td>
						<td>
							<textarea name="txtAddress"><?php echo $tempcustomerinfo['Address'] ?></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<button type="submit" class="btn btn-success btn-rounded" name="btnUpdate">UPDATE</button>
							<a type="button" class="btn btn-outline-light btn-rounded" href="profile.php">PROFILE</a>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<a href="update_password.php" class="btn btn-success btn-rounded">UPDATE PASSWORD</button>
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
</body>
</html>
<?php   
    include('..\footer.php');
?>