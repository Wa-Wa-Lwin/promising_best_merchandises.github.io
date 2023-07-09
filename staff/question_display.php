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
	$selectquestion = "SELECT * FROM question";
 	$run_selectquestion = mysqli_query($connection,$selectquestion);
 	$count = mysqli_num_rows($run_selectquestion);
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

<div class="container light-grey" style="padding:5vh; min-height: 70vh;">
	<h3 class="text-center">QUESTIONS</h3>
	<form>
		<table align="center" class="table">
			<thead class="thead-dark">
				<th>Question</th>
				<th>Question Date</th>
				<th>Name</th>
				<th>Status</th>
				<th>Answer</th>
				<th>Update Answer</th>
			</thead>
			<?php 
				for ($i=0; $i < $count; $i++) { 
				 	$arr = mysqli_fetch_array($run_selectquestion);
				 	echo "<tr>";
				 		echo "<td>".$arr['Question']."</td>";
				 		echo "<td>".$arr['Date']."</td>";
				 		echo "<td>".$arr['Name']."</td>";
				 		echo "<td>".$arr['Status']."</td>";
				 		echo "<td>".$arr['Answer']."</td>";

				 		echo '
				 			<td>
				 				<a class="pg-transfer-link" href="answer.php?qid='.$arr['QuestionID'].'">
				 					Answer question
				 				</a>
				 			</td>';
				 		// echo "<td><a class=\"pg-transfer-link\" href='staff_answer.php?QID=".$arr['questionID']."'>Answer this question</a></td>";
				 	echo "</tr>";
				 } ?>
		</table>
	</form>
</div>

<?php
	include('..\footer.php');
?>
</body>
</html>