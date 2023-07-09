<?php 
	session_start();
	include ('connect.php');
    include('cus_header.php');
	include ('id_auto_increment.php');

	if(isset(($_SESSION['customerid']))){
	    echo "<script>
			if(confirm('You are currently logged in. Do you want to logout of this account?')) {
				window.location = 'logout.php';
			} else {
				window.location = 'index.php';
			}</script>";
	} else {
	    if (isset($_POST['btnSave'])) {
	    	$customerid =CustomerID();
	        $name = $_POST['txtName'];
	        $email = $_POST['txtEmail'];
	        $password = $_POST['txtPassword'];
	        $cpassword = $_POST['txtCpassword'];
	        $gender = $_POST['rdoGender'];
	        $phone = $_POST['txtPhone'];
	        $address = $_POST['txtAddress'];

	        if (empty($customerid) || empty($name) || empty($email) || empty($password) || empty($cpassword)) {
	        	echo "<script>alert('Please fill up all form inputs!')</script>";
	        	echo "<script>history.go(-1)</script>";
	        } else {
	            if ($password != $cpassword || strlen($password) < 8) {
	                if ($password != $cpassword) {
	                	echo "<script>window.alert('The passwords do not match. Please re-enter again!')</script>";
	                	echo "<script>history.go(-1)</script>";
	                } else {
	                	echo "<script>window.alert('Password must contain at least 8 characters!')</script>";
	                	echo "<script>history.go(-1)</script>";
	                }
	            } else {
	            	$checkemail = "SELECT * FROM customers WHERE Email = '$email'";
					$run_checkemail = mysqli_query($connection,$checkemail);
					$count = mysqli_num_rows($run_checkemail);

					if ($count > 0) {
						echo "<script>
							if(confirm('This email is already connected to an account! Do you want to login?')) {
								window.location = 'login.php'
							} else {
								window.location = 'signup.php'
							} </script>";
					} else {
						$hashedpassword = md5($password);
						$insertcustomer = "INSERT INTO customers (CustomerID, Name, Email, Password, Gender, Phone, Address) VALUES ('$customerid', '$name', '$email', '$hashedpassword', '$gender','$phone', '$address')";

						if (mysqli_query($connection, $insertcustomer)) {
							echo "<script>window.alert('Account created successfully!')</script>";
							echo "<script>window.location = 'login.php'</script>";
						} else {
							echo "<p>ERROR : Something went wrong in ".mysqli_error($connection)."</p>";
							header("signup.php");
							echo "<script>history.go(-1)</script>";
						}
					}
	            }
	        }
	    }
	}
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>

<body>
    <section class="gradient-custom">
        <div class="container py-5 h-110">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-5">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5 text-dark">
                            <center>
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Create Account</h3>
                            </center>
                            
                            <form action="signup.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-outline">
                                            <input type="text" name="txtName" id="Name" class="form-control form-control-md" placeholder="USER NAME" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="email" name="txtEmail" id="emailAddress" class="form-control form-control-md" placeholder="EMAIL" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="text" name="txtPhone" id="phoneNumber" class="form-control form-control-md" placeholder="PHONE NO" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <textarea name="txtAddress" class="form-control form-control-md" placeholder="ADDRESS"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rdoGender" value="Female"checked />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rdoGender" value="Male" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="password" name="txtPassword" id="Password" class="form-control form-control-md" placeholder="PASSWORD" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="password" name="txtCpassword" id="Password" class="form-control form-control-md" placeholder="CONFIRM" />
                                        </div>
                                    </div>
                                </div>

                                <center>
                                <div class="mt-2 pt-2">
                                    <input class="btn btn-primary btn-lg" type="submit" name="btnSave" value="Create" />
                                </div>
                                <div class="mt-2 pt-2">
                                    Already have an account? <a href="login.php">Login</a>
                                </div>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php   
    include('..\footer.php');
?>


