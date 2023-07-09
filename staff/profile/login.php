<?php
	session_start();
	include('connect.php');
	include('login_timeout.php');
	include('../header.php');
	//include('cus_header.php');

	if (isset($_SESSION['StaffID'])) {
		echo "<script>
			if(confirm('You are currently logged in. Do you want to logout of this account?')) {
				window.location = 'logout.php';
			} else {
				window.location = '../index.php';
			}</script>";
	} else {
		if(isset($_POST['btnLogin'])) {

			$email = $_POST['txtEmail'];
			$password = $_POST['txtPassword'];

			$loginattempt = getloginattempt("GET", $connection);
			if ($loginattempt == 0) {
				if (empty($email) || empty($password)) {
					waitingtime($loginattempt);
					echo "<script>alert('Please enter your account email and password!')</script>";
				} else {
					$hashedpassword = md5($password);
					$searchAccount = "SELECT * FROM staff WHERE Work_Mail='$email' AND Password='$hashedpassword'";
					$result = mysqli_query($connection, $searchAccount);

					if ($result->num_rows == 1) {
						$loginattempt = getloginattempt("SUCCESS", $connection);
						$tmpAccinfo = mysqli_fetch_assoc($result);
						$_SESSION['StaffID'] = $tmpAccinfo['StaffID'];
						echo "<script>window.alert('Account logged in!')</script>";
						echo "<script>window.location = '../index.php'</script>";
					} else {
						$loginattempt = getloginattempt("FAIL", $connection);
	                    waitingtime($loginattempt);
	                    echo "<script>window.alert('Email or password is invalid! Please try again.')</script>";
						echo "<script>window.location = '../index.php'</script>";
					}
				}
			} else {
				waitingtime($loginattempt);
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

	<section class="vh-100" >
	    <div class="container py-5 h-100">
	      <div class="row d-flex justify-content-center align-items-center h-100">
	        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
	          <div class="card shadow-2-strong" style="border-radius: 1rem;">
	            <form action="login.php" method="POST" enctype="multipart/form-data">
	              <div class="card-body p-5 text-center">

	                <h3 class="mb-4 text-dark">Sign In</h3>

	                <?php if (isset($_GET['error'])) {?> <p class="error"> <?php echo $_GET['error']; ?></p> <?php } ?>

	                <div class="form-outline mb-4">
	                  <input type="email" name="txtEmail" id="typeEmailX-2" class="form-control form-control-md" placeholder="Email" />
	                </div>

	                <div class="form-outline mb-4">
	                  <input type="password" name="txtPassword" id="typePasswordX-2" class="form-control form-control-md" placeholder="Password" />
	                </div>

	                <button class="btn btn-primary btn-md btn-block" type="submit" name="btnLogin">Login</button>
	                <div>
	                	<p class="text-dark">Do you want to sign up? <a href="signup.php">Click Here</a></p>
	                </div>
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
  	</section>
</body>
</html>

<?php
include('..\..\footer.php');
?>