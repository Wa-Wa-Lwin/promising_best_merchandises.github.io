<?php 
session_start();
    include('../header.php');
include ('connect.php');
	// include ('id_auto_increment.php');

if(isset(($_SESSION['staffid'])))
{
 echo "<script>
 if(confirm('You are currently logged in. Do you want to logout of this account?')) {
    window.location = 'logout.php';
    } else {
        window.location = 'index.php';
    }</script>";
}
else 
{
 if (isset($_POST['btnSave'])) {
    $name = $_POST['txtName'];
    $dob = $_POST['txtDob'];
    $gender = $_POST['rdoGender'];
    $workmail = $_POST['txtWorkmail'];
    $personalmail = $_POST['txtPersonalmail'];
    $phone = $_POST['txtPhone'];
    $address = $_POST['txtAddress'];
    $department = $_POST['txtDepartment'];
    $position = $_POST['txtPosition'];
    $level = $_POST['txtLevel'];
    $password = $_POST['txtPassword'];
    $cpassword = $_POST['txtCpassword'];


     if ($password != $cpassword || strlen($password) < 8) {
         if ($password != $cpassword) {
          echo "<script>window.alert('The passwords do not match. Please re-enter again!')</script>";
          echo "<script>history.go(-1)</script>";
      } 
      else 
      {
          echo "<script>window.alert('Password must contain at least 8 characters!')</script>";
          echo "<script>history.go(-1)</script>";
      }
  } 
  else {
      $checkemail = "SELECT * FROM staff WHERE Work_Mail = '$workmail'";
      $run_checkemail = mysqli_query($connection,$checkemail);
      $count = mysqli_num_rows($run_checkemail);

      if ($count > 0) {
          echo "<script>
          if(confirm('This email is already connected to an account! Do you want to login?')) {
            window.location = 'login.php'
            } else {
                window.location = 'signup.php'
            } </script>";
        }
        else {
          $hashedpassword = md5($password);
          $insertstaff = "INSERT INTO staff (Staff_Name, Date_Of_Birth, Gender, Work_Mail, Personal_Mail, Phone_Number, Address, Department, Position, Level, Password) 
          VALUES ('$name', '$dob', '$gender', '$workmail','$personalmail', '$phone', '$address', '$department', '$position', '$level', '$hashedpassword')";

          if (mysqli_query($connection, $insertstaff)) {
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
                                            <input type="text" name="txtName" id="Name" class="form-control form-control-md" placeholder="USER NAME" required="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="email" name="txtWorkmail" id="emailAddress" class="form-control form-control-md" placeholder="WORK MAIL" required="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="email" name="txtPersonalmail" id="" class="form-control form-control-md" placeholder="PERSONAL MAIL" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <select class="form-control" name="txtDepartment" >
                                                <option selected disabled>DEPARTMENT</option>
                                                <option value="Marketing">Marketing</option>
                                                <option value="Finance">Finance</option>
                                                <option value="Sales">Sales</option>
                                                <option value="Human Resource">Human Resource</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <select class="form-control" name="txtPosition">
                                                <option selected disabled>POSITION</option>
                                                <option value="Director"> Director</option>
                                                <option value="Manager">Manager</option>                                         
                                                <option value="Employee"> Employee</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <select class="form-control" name="txtLevel">
                                                <option selected disabled>LEVEL</option>
                                                <option value="Exceutive">Exceutive</option>
                                                <option value="Senior">Senior</option>
                                                <option value="Junior">Junior</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="date" name="txtDob" id="" class="form-control form-control-md" />
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
include('..\..\footer.php');
?>