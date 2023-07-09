<?php

include('verify_customer_login.php');
include('..\connect.php');

include('..\customer\cus_header.php');

$CustomerID=$_SESSION['customerid'];

$selectW="
SELECT w.* ,m.Merchandise_Name,m.Photo1
From wishing_list w,merchandise m
where w.CustomerID=$CustomerID
And w.MerchandiseID=m.MerchandiseID
";
$retrieveW=mysqli_query($connection,$selectW);
$countW=mysqli_num_rows($retrieveW);


?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script>
	function imageDisplay(pic){
		var freader=new FileReader();
		freader.onload=function(e){
			document.getElementById("img").src=e.target.result;
		};
		freader.readAsDataURL(pic.files[0]);
	}
</script>
<script>
	$(document).ready
	( function ()
	{
		$('#tableid').DataTable();
	}
	);
</script>
<form action="View_WishingList.php" method="POST">
	<div class="contact" id="contact">
		<div class="container">
			<div class="row contact-block">
				<h3 class="title clr">Wishing List</h3>
				<br>	
				<a class="block" href='merchandise_display.php?CustomerID=$CustomerID'>Back </a>
				<hr>
				
						<?php

						for ($i=0; $i < $countW; $i++) 
						{ 
							$array=mysqli_fetch_array($retrieveW);
							$MerchandiseID=$array['MerchandiseID'];
							$Merchandise_Name=$array['Merchandise_Name'];
							$Image=$array['Photo1'];
							list($width,$height)=getimagesize($Image);
							$w=$width/2.5;
							$h=$height/2.5;

							echo "<div class='col-lg-4 col-md-4 col-sm-6 col-6'>";
							echo "<fieldset>";
							echo "<table id='tableid' class='display block'>";
							echo "<tr>";
							?>
							<td>
								<img src="<?php echo $Image ?>" style="width: 100px; height: 100px;" />
							</td>
							<?php
							echo "<td>";
							echo "<a href='merchandise_detail.php?MerchandiseID=$MerchandiseID'> 
							$Merchandise_Name
							</a>";

							echo "</td>";     
							echo "</tr>";
							echo "</table>";
							echo "</fieldset>";
							echo "</div>";
						}
						?>

			</div>
			<br/>
		</div>
	</div>
</form>
<?php
include('..\footer.php');
?>
