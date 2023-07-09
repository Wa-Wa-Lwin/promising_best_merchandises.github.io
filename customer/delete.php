<?php
	session_start();
	include('connect.php');

	if (isset($_SESSION['customerid'])) {
		$CustomerID = $_SESSION['customerid'];
		$searchcustomer = "SELECT * FROM customers WHERE CustomerID = '$CustomerID'";
		$run_searchcustomer = mysqli_query($connection,$searchcustomer);

		if ($run_searchcustomer->num_rows !== 1) {
			echo "<script>window.alert('An unexpected error occured! Please login.')</script>";
    		echo "<script>window.location = 'login.php'</script>";
		} else {
			$tempcustomerinfo = mysqli_fetch_assoc($run_searchcustomer);

			if (isset($_POST['btnDelete'])) {
				$password = $_POST['txtPassword'];
				$hashedpassword = md5($password);
				if ($hashedpassword == $tempcustomerinfo['Password']) {
					$customerid = $tempcustomerinfo['CustomerID'];
					$deleteaccount = "DELETE FROM customers WHERE CustomerID = '$customerid'";
					$run_deleteaccount = mysqli_query($connection, $deleteaccount);
					if ($run_deleteaccount) {
						session_destroy();
						echo "<script>window.alert('Your account is deleted!')</script>";
    					echo "<script>window.location = 'index.php'</script>";
					} else {
						echo "<script>window.alert('Sorry, an unexpected error occured!')</script>";
    					echo "<script>window.location = 'profile.php'</script>";
					}
				} else {
					$error = "incorrect password";
					echo "<script>window.location = 'delete.php?error=$error'</script>";
				}
			}
		}
	}
	else {
		$CustomerID = "";
		echo "<script>window.alert('Please Login First!')</script>";
		echo "<script>window.location = 'index.php'</script>";
	}
?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Account Deletion</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 </head>

 <body>
 	<div class="container">
 		<div class="row d-flex align-items-center justify-content-center" style="height: 50vh;">
	        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
	          <div class="card bg-light bg-gradient text-dark mt-5" style="border-radius: 1rem;">
	            <form action="delete.php" method="POST" enctype="multipart/form-data">
	              <div class="card-body p-5 text-left">

	                <h6 class="mb-4">Enter password to delete your account!</h6>

	                <?php if (isset($_GET['error'])) {?> <p class="error text-danger"> <?php echo $_GET['error']; ?></p> <?php } ?>

	                <div class="form-outline mb-4">
	                  <input type="password" name="txtPassword" class="form-control form-control-md" placeholder="Password" />
	                </div>

	                <button class="btn btn-danger btn-md btn-block" type="submit" name="btnDelete">Delete</button>
	                <div><a href="">Forgot password?</a></div>
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
 	</div>
 </body>
 </html>