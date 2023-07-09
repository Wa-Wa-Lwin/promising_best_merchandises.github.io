<?php 
//session_start(); 
include('..\connect.php');  
include('verify_customer_login.php');
include('..\customer\cus_header.php');

if (!isset($_GET['OrderID'])) {
		echo "<script>
				window.location = 'view_checkout.php';
			</script>";
	}
else{
	$OrderID=$_GET['OrderID'];
	$query="
	SELECT o.*,m.Photo1,m.Merchandise_Name,m.MerchandiseID 
	FROM orders o,merchandise m  
	WHERE OrderID='$OrderID'
    AND m.MerchandiseID=o.MerchandiseID
	";
	$retrieve=mysqli_query($connection,$query);
	$count=mysqli_num_rows($retrieve);
	$array=mysqli_fetch_array($retrieve);
	$MImage=$array['Photo1']; 
    list($width,$height)=getimagesize($MImage);
    $w=$width/2.5;
    $h=$height/2.5;
}

if(isset($_POST['btnSave'])) 
{
	$txtOrderID=$OrderID; 
	$txtDescription=$_POST['txtDescription'];
    
	$Image1=$_FILES['Image']['name']; 
   // $Folder="./order/Merchandise_Image/";

    $Folder="OrderDetail_Image/";

    // $Folder="C:\xampp\htdocs\PB_M\order\Merchandise_Image/";

    $FileName=$Folder . '_' . $Image1;  
    $copied=copy($_FILES['Image']['tmp_name'], $FileName);

    if(!$copied)
    {
        echo "<p> Image cannot upload!</p>";
        exit();
    }

	$InsertOrderDetail=" 
	UPDATE orders SET
	Photo='$FileName',
	Description='$txtDescription'
	WHERE OrderID='$OrderID'
	";	

	$RunInsert=mysqli_query($connection,$InsertOrderDetail);				
	if ($RunInsert) 
	{
		echo "<script>window.alert('Successfully saved your merchantise order detail!');
			window.location='orderdetail_view.php'</script>"; 
	}
	else 
	{
		echo "<p>Something went wrong in booking delivery services :" . mysqli_error($connection) . "</p>";

	}
}
?>
<script>
	$(document).ready
	( function ()
	{
		$('#tableid').DataTable();
	}
	);
	function imageDisplay(pic){
		var freader=new FileReader();
		freader.onload=function(e){
			document.getElementById("img").src=e.target.result;
		};
		freader.readAsDataURL(pic.files[0]);
	};
</script>
<form action="" method="POST" enctype="multipart/form-data">
	<div class="contact" id="contact">
		<div class="container">
			<div class="contact-two-grids">
				<h3 class="title clr">Your Order Detail</h3>
				<legend> Enter Order Detail: </legend>
				<img src="<?php echo $MImage ?>" width="350" height="250" />
				<table id="tableid" class="display" >		

					<tr>
	                    <td>Merchandise </td>
	                    <td>  
	                    	<input type="text" name="txtMerchandise" value="<?php echo $array['Merchandise_Name'] ?>" disabled>   
	                    </td>
                	</tr>

                	<tr>
						<td>Order No </td>
						<td>
							<input type="text" name="txtOrderID" value="<?php echo $array['OrderID'] ?>" disabled>
						</td>     
					</tr>

                	<tr>
	                    <td>Order Date </td>
	                    <td>  
	                    	<input type="text" name="txtOrderDate" value="<?php echo $array['Order_Date'] ?>" disabled>   
	                    </td>
                	</tr>

					<tr>
						<td>Description </td>
						<td>
							<textarea name="txtDescription" rows="4" cols="50" required></textarea>
						</td>
					</tr>
					<tr>
						<td>Photo of Your Design </td>
						<td>
							<input type="file" name="Image" onchange="imageDisplay(this)" />                            
                    <img style="width: 100px; height: 100px;" id="img" >
						</td>
					</tr>


					<!-- Save / Reset -->
					<tr>
						<td>							
							<input type="submit" name="btnSave" value="Save">
						</td>
						<td>
							<input type="reset" name="btnReset" value="Reset">   
						</td>

					</tr>


				</table> 
			</div>
		</div>
	</div>	
</form>
<?php
include('..\footer.php');
?>