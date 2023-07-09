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

			if (isset($_POST['btnUpdate'])) {
		    	$StaffID = $_SESSION['StaffID'];
		        $name = $_POST['txtName'];
	            $workmail = $_POST['txtWorkmail'];
	            $personalmail = $_POST['txtPersonalmail'];
	            $phone = $_POST['txtPhone'];
	            $address = $_POST['txtAddress'];
	            $department = $_POST['txtDepartment'];
	            $position = $_POST['txtPosition'];
	            $level = $_POST['txtLevel'];
	            $dob = $_POST['txtDob'];
		        
		        if (isset($_POST['rdoGender'])) {
		        	$gender = $_POST['rdoGender'];
		        } else {
		        	$gender = $tempstaffinfo['Gender'];
		        }

		        if (empty($name) || empty($workmail)) {
		        	echo "<script>alert('Please fill up required form inputs!')</script>";
		        	echo "<script>history.go(-1)</script>";
		        } else {

		        	/*if ($workmail !== $tempstaffinfo['Workmail']) 
		        	{
		        		$checkemail = "SELECT * FROM staff WHERE Work_Mail = '$workmail'";
						$run_checkemail = mysqli_query($connection,$checkemail);
						$count = mysqli_num_rows($run_checkemail);

						if ($count > 0) {
							echo "<script>alert('This email is connected to another account!')</script>";
							echo "<script>history.go(-1)</script>";
						}
		        	}*/

		        	$updateaccount = "UPDATE staff
		        						SET Staff_Name = '$name',
		        						Date_Of_Birth = '$dob',
		        						Gender = '$gender',
		        						Work_Mail = '$workmail',
		        						Personal_Mail = '$personalmail',
		        						Phone_Number = '$phone',
		        						Address = '$address',
		        						Department = '$department',
		        						Position = '$position',
		        						Level = '$level'
		        						WHERE StaffID = '$StaffID';";
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
		$StaffID = "";
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
							<input type="text" name="txtName" value="<?php echo $tempstaffinfo['Staff_Name'] ?>">
						</td>
					</tr>
					<tr>
						<td>Work Mail </td>
						<td><input type="email" name="txtWorkmail" value="<?php echo $tempstaffinfo['Work_Mail'] ?>"></td>
					</tr>
					<tr>
						<td>Personal Mail </td>
						<td><input type="email" name="txtPersonalmail" value="<?php echo $tempstaffinfo['Personal_Mail'] ?>"></td>
					</tr>
					<tr>
						<td>Department </td>
						<td>
							<select name="txtDepartment">
	                            <option value="<?php echo $tempstaffinfo['Department'] ?>" selected>
	                            	<?php echo $tempstaffinfo['Department'] ?>
	                        	</option>
	                        	<option value="Marketing">Marketing</option>
	                            <option value="Finance">Finance</option>
                                <option value="Sales">Sales</option>
                                <option value="Human Resource">Human Resource</option>                                
	                        </select>
	                    </td>
					</tr>
					<tr>
						<td>Position </td>
						<td>
							<select name="txtPosition">
	                            <option value="<?php echo $tempstaffinfo['Position'] ?>" selected>
	                            	<?php echo $tempstaffinfo['Position'] ?>
	                        	</option>
	                        	<option value="Director">Director</option>
	                            <option value="Manager">Manager</option>
                                <option value="Employee">Employee select</option>
	                        </select>
	                    </td>
					</tr>
					<tr>
						<td>Level </td>
						<td>
							<select name="txtLevel">
	                            <option value="<?php echo $tempstaffinfo['Level'] ?>" selected>
	                            	<?php echo $tempstaffinfo['Level'] ?>
	                        	</option>
	                        	<option value="Exceutive">Exceutive</option>
	                            <option value="Senior">Senior</option>
                                <option value="Junior">Junior</option>
	                        </select>
	                    </td>
					</tr>
					<tr>
						<td>Date of Birth </td>
						<td><input type="date" name="txtDob" value="<?php echo $tempstaffinfo['Date_Of_Birth'] ?>"></td>
					</tr>
					<tr>
						<td>Phone </td>
						<td><input type="text" name="txtPhone" value="<?php echo $tempstaffinfo['Phone_Number'] ?>"></td>
					</tr>
					<tr>
						<td>Address </td>
						<td>
							<textarea name="txtAddress"><?php echo $tempstaffinfo['Address'] ?></textarea>
						</td>
					</tr>
					<tr>
						<td>Gender </td>
						<td>
							<?php echo $tempstaffinfo['Gender'] ?>
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
include('..\..\footer.php');
?>