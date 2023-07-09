<?php
    include('..\order\verify_customer_login.php');
    include('connect.php');
    include('cus_header.php');

    $selectquestion = "SELECT * FROM question WHERE Status = 'Answered'";
	$run_selectquestion = mysqli_query($connection, $selectquestion);
	$count = mysqli_num_rows($run_selectquestion);

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

	$if_ask = false;

	if (isset($_POST['btnAsk'])) {
		$Question = $_POST['txtQuestion'];
		$Name = $_POST['txtName'];
		$if_ask = true;
	}

	if (isset($_POST['btnSubmit'])) {
		$question = $_POST['txtQuestion'];
		$date = date('Y-m-d');
		$name = $_POST['txtName'];
		if ($name == "") {
			$name = "Anonymous";
		}
		$status = "Not Answered";

		$insertQuestion = "INSERT INTO question (Question, Date, Name, Status) VALUES ('$question','$date','$name','$status')";
		$run_insertquestion = mysqli_query($connection,$insertQuestion);
		
		if ($run_insertquestion) {
			echo "<script>window.alert('Your question is submitted.')</script>";
			echo "<script>window.location='index.php'</script>";
		}
		else {
			echo mysqli_error($connection);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>FAQ</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


<div class="container" style="padding:5vh 0;" >
	<h3 class="center mb-4">FREQUENTLY ASKED QUESTIONS (FAQ)</h3>
	<?php 
		for ($i=0; $i < $count; $i++) { 
			$arr = mysqli_fetch_array($run_selectquestion);
			$question = $arr['Question'];
			$answer = $arr['Answer'];
			$name = $arr['Name'];

			echo '
				<div class="card mb-3">
	 				<div class="card-body">
						<h5 class="card-title">'.$question.'</h5>
						<p class="card-text">'.$answer.'</p>
					</div>
					<div class="card-footer text-muted">
						'.$name.'
					</div>
				</div>';
		}
	

		if ($if_ask) {
			echo '
			<form action="faq.php" method="POST">
				<p>
					<h5>Your Question: '.$Question.'</h5>
					'.date('Y-m-d').'
				</p>
				<input type="hidden" name="txtQuestion" value="'.$Question.'">
				<input type="hidden" name="txtName" value="'.$Name.'">

				<input type="submit" name="btnSubmit" class="btn btn-dark" value="ASK QUESTION">
				<a href="contact.php" class="btn btn-outline-dark">Back</a>
			</form>';
		}
	?>
</div>

</body>
<?php   
    include('..\footer.php');
?>