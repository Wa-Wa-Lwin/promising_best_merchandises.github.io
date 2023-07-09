<?php  
session_start();
include('..\connect.php');
include('header.php');

if (isset($_SESSION['StaffID'])) 
{
	$StaffID=$_SESSION['StaffID'];

	$select="SELECT * FROM Staff Where StaffID=$StaffID";
	$retrieve=mysqli_query($connection,$select);
	$count=mysqli_num_rows($retrieve);
}
if ($count < 1) 
{
	echo" <script>window.alert('ERROR : Please Login to access your profile ! ') </script>";
	echo" <script> window.location = '/PB_M/staff/profile/login.php'</script>" ;
}
else
{
 	if (isset($_GET['qid'])) {
 		$questionid = $_GET['qid'];
 		$selectquestion = "SELECT * FROM question WHERE QuestionID='$questionid'";
 		$run_selectquestion = mysqli_query($connection, $selectquestion);
 		$arr = mysqli_fetch_array($run_selectquestion);
 		$Question = $arr['Question'];
 		$Answer = $arr['Answer'];

 	}

 	 if (isset($_POST['btnAnswer'])) {
 		$QuestionID = $_POST['txtQid'];
 		$Answer = $_POST['txtAnswer'];
 		$Status = "Answered";
 		$updatequestion = "UPDATE question SET Answer = '$Answer', Status = '$Status' WHERE questionID = '$QuestionID'";
 		$run_updatequestion = mysqli_query($connection,$updatequestion);
 		if ($run_updatequestion) {
 			echo "<script>window.alert('Answer updated.')</script>";
			echo "<script>window.location='question_display.php'</script>";
 		}
 		else {
 			echo mysqli_error($connection);
 		}
 	}
}
?>

<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Questions</title>
</head>
<body>

<div class="container light-grey" style="padding:15vh 0; min-height: 50vh;">
	<form action="answer.php" method="POST">
		<input type="hidden" name="txtQid" value="<?php echo $questionid ?>">

		<h4 align="center"><?php echo $Question ?></h4>
		<textarea name="txtAnswer" class="form-control" rows=3 required></textarea>
		<table align="center">
			<tr>
				<td><button type="submit" name="btnAnswer" value="Answer" class="btn btn-dark">Answer</td>
				<td><a href="question_display.php" class="btn btn-outline-dark">Back</a></td>
			</tr>
		</table>
	</form>
</div>

<?php
	include('..\footer.php');
?>
</body>
</html>