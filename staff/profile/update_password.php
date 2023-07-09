<?php
	session_start();
	include('connect.php');

	if (isset($_SESSION['staffid'])) {
		$StaffID = $_SESSION['staffid'];
		$searchstaff = "SELECT * FROM staff WHERE StaffID = '$StaffID'";
		$run_searchstaff = mysqli_query($connection,$searchstaff);

		if ($run_searchstaff->num_rows !== 1) {
			echo "<script>window.alert('An unexpected error occured! Please login.')</script>";
    		echo "<script>window.location = 'login.php'</script>";
		} else {
			$tempstaffinfo = mysqli_fetch_assoc($run_searchstaff);

			if (isset($_POST['btnUpdate'])) {
				$opassword = $_POST['txtOpassword'];
				$password = $_POST['txtPassword'];
				$cpassword = $_POST['txtCpassword'];

				if (empty($opassword) || empty($password) || empty($cpassword)) {
					echo "<script>alert('Please enter all form inputs!')</script>";
					echo "<script>history.go(-1)</script>";
				} else if ($opassword == $password) {
					echo "<script>alert('Please enter different password!')</script>";
					echo "<script>history.go(-1)</script>";
				} else if (md5($opassword) != $tempstaffinfo['Password']) {
					echo "<script>alert('Incorrect password!')</script>";
					echo "<script>history.go(-1)</script>";
				} else if ($password != $cpassword || strlen($password) < 8) {
	                if ($password != $cpassword) {
	                	echo "<script>window.alert('The passwords do not match. Please re-enter again!')</script>";
	                	echo "<script>history.go(-1)</script>";
	                } else {
	                	echo "<script>window.alert('Password must contain at least 8 characters!')</script>";
	                	echo "<script>history.go(-1)</script>";
	                }
	            } else {
	            	$password = md5($password);
	            	$updatepassword = "UPDATE staff SET Password = '$password' WHERE StaffID = '$StaffID'";
	            	$run_updatepassword = mysqli_query($connection, $updatepassword);

	            	if ($run_updatepassword) {
		        		echo "<script>alert('Password updated!')</script>";
						echo "<script>window.location = 'profile.php'</script>";
		        	} else {
		        		echo "<script>alert('Sorry, an unexpected error occured!')</script>";
						echo "<script>window.location = 'update_password.php'</script>";
		        	}
	            }
			}
		}
	}
	else {
		$StaffID = "";
		echo "<script>window.alert('Please Login First!')</script>";
		echo "<script>window.location = 'login.php'</script>";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Password Reset</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background: #CFD2CF;">

	<div class="container">
		<form action="update_password.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<legend>UPDATE PASSWORD</legend>
				<table>
					<tr>
						<td>Old Password </td>
						<td>
							<input type="password" name="txtOpassword" required />
						</td>
					</tr>
					<tr>
						<td>New Password </td>
						<td><input type="password" name="txtPassword" required /></td>
					</tr>
					<tr>
						<td>Confirm Password </td>
						<td><input type="password" name="txtCpassword" required /></td>
					</tr>
					
					<tr>
						<td></td>
						<td>
							<button type="submit" class="btn btn-success btn-rounded" name="btnUpdate">UPDATE</button> 
							<a type="button" class="btn btn-outline-light btn-rounded" href="profile.php">PROFILE</a>
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