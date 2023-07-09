<?php
	session_start();
	include('connect.php');
	include('../header.php');
 

	if (isset($_SESSION['StaffID'])) {
		$StaffID = $_SESSION['StaffID'];
		$searchstaff = "SELECT * FROM staff WHERE StaffID = '$StaffID'";
		$run_searchstaff = mysqli_query($connection,$searchstaff);

		if ($run_searchstaff->num_rows !== 1) {
			echo "<script>window.alert('An unexpected error occured! Please login.')</script>";
    		echo "<script>window.location = 'login.php'</script>";
		} else {
			$tempstaffinfo = mysqli_fetch_assoc($run_searchstaff);

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
					<td><?php echo $tempstaffinfo['Staff_Name'] ?></td>
				</tr>
				<tr>
					<td>Work Mail</td>
					<td><?php echo $tempstaffinfo['Work_Mail'] ?></td>
				</tr>
				<tr>
					<td>Personal Mail</td>
					<td><?php echo $tempstaffinfo['Personal_Mail'] ?></td>
				</tr>
				<tr>
					<td>Gender </td>
					<td><?php echo $tempstaffinfo['Gender'] ?></td>
				</tr>
				<tr>
					<td>Phone </td>
					<td><?php echo $tempstaffinfo['Phone_Number'] ?></td>
				</tr>
				<tr>
					<td>Address </td>
					<td><?php echo $tempstaffinfo['Address'] ?></td>
				</tr>
				<tr>
					<td>Department </td>
					<td><?php echo $tempstaffinfo['Department'] ?></td>
				</tr>
				<tr>
					<td>Position </td>
					<td><?php echo $tempstaffinfo['Position'] ?></td>
				</tr>
				<tr>
					<td>Level </td>
					<td><?php echo $tempstaffinfo['Level'] ?></td>
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
include('..\..\footer.php');
?>