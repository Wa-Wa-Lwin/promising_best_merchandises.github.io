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
	//PB_M/staff
}
else
{
	
}
?>
</body>
<form method="POST" enctype="multipart/form-data">

	<?php   
	
		$rows=mysqli_fetch_array($retrieve); 
		$StaffID=$rows['StaffID'];
		$Staff_Name=$rows['Staff_Name'];
		$Position=$rows['Position'];
		//$Image=$rows['Image'];
	
	?>

	<!--Services-->
	<div class="services" id="services">
		<div class="container">
			<div class="contact-two-grids">
				<div class=" col-md-6 contact-icons text-right" style=" /* margin-top: 35px; */ color: blue;">
					<!-- <p>Welcome : <?php //echo $_SESSION['Staff_Name'] ?>  | <?php //echo $_SESSION['Position'] ?> | <a href="..\staff\profile.php">Logout</a></p> -->
					<p>Welcome : <?php echo $Staff_Name; ?>  | <?php echo $Position; ?> | <a href="..\staff\profile\profile.php">Profile</a>
						<br> <a href="..\staff\profile\Logout.php">Logout</a>
					</p>
				</div>
			</div>  
		</div>

		<div class="container">
			<h3 class="title clr text-center">Services</h3>

			<div class="row banner-bottom-girds text-center">
				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='manage_order.php?StaffID=$StaffID'>Manage Orders</a><br>
					</div>
				</div> 
				<!-- End -->
				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='manage_delivery.php?StaffID=$StaffID'>Manage Delivery</a><br>
					</div>
				</div>
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='manage_customer.php?StaffID=$StaffID'>View Customer</a><br>
					</div>
				</div> 
				<!-- End -->
				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid"> 
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='..\order\merchandise_entry.php?StaffID=$StaffID'>Manage Merchandise</a><br>
					</div>
				</div>
				<!-- End -->	

				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='product_type\pt_index.php?StaffID=$StaffID'>Manage Products</a><br>
					</div>
				</div> 
				<!-- End -->

				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='supplier\supplier_index.php?StaffID=$StaffID'>Manage Supplier</a><br>
					</div>
				</div> 
				<!-- End -->

				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='purchase\purchase_index.php?StaffID=$StaffID'>Manage Purchase</a><br>
					</div>
				</div> 
				<!-- End -->


				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='material_type\index.php?StaffID=$StaffID'>Manage Material Type</a><br>
					</div>
				</div>
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='resource\resource_index.php?StaffID=$StaffID'>Manage Resources</a><br>
					</div>
				</div> 
				<!-- End -->
				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid"> 
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='printing_type\index.php?StaffID=$StaffID'>Manage Printing Type</a><br>
					</div>
				</div>
				<!-- End -->

				<!-- Start -->
				<div class="col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
				<br> 
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='question_display.php?StaffID=$StaffID'>View and AnswerFAQs</a><br>
					</div>
				</div>
				<!-- End -->

		

				<div class="clearfix"> </div>
			</div>
		</div>
		<br>
		<div class="container">
			<h3 class="title clr text-center">Our Marchandises Popularity</h3>

			<div class="row text-center">
				<!-- Start -->
				<div class="col-md-12" style="overflow-x:auto;">
					<table cellpadding="5px" width="100%" id="tableid" class="display">
                        <?php  
                        
                            //$query1="SELECT * FROM merchandise";
                        	$query1="SELECT m.* 
							FROM merchandise m
							Order by (
							SELECT COUNT(o.OrderID) AS Orders
							FROM orders o
							WHERE o.MerchandiseID=m.MerchandiseID) DESC";
                            $ret1=mysqli_query($connection,$query1);
                            $count1=mysqli_num_rows($ret1);

                            // for($i=0;$i<$count1;$i+=3) 
                            // { 
                            //     $query2="SELECT * FROM merchandise LIMIT $i,3";
                            //     $ret2=mysqli_query($connection,$query2);
                            //     $count2=mysqli_num_rows($ret2);

                                echo "<tr>";
                                for($x=0;$x<$count1;$x++) 
                                { 
                                    $row=mysqli_fetch_array($ret1);

                                    $MerchandiseID=$row['MerchandiseID'];
                                    $Merchandise_Name=$row['Merchandise_Name'];
                                    $Price=$row['Price'];
                                    $Image='../order/'. $row['Photo1'];

                                    list($width,$height)=getimagesize($Image);
                                    $w=$width/2.5;
                                    $h=$height/2.5;

                                    $queryorder="SELECT COUNT(o.OrderID) AS Orders
					                FROM orders o
					                WHERE o.MerchandiseID=$MerchandiseID
					                ";
					                $Sretorder=mysqli_query($connection,$queryorder);
					                $orders=mysqli_fetch_array($Sretorder);
                                    ?>
                                    <td align="center">
                                        <img src="<?php echo $Image ?>" style="width: 150px; height: 150px;" />
                                        <hr/>
                                        <b><?php echo $Merchandise_Name ?></b>
                                        <hr/>
                                        <b class="price"><?php echo $Price ?> MMK </b>
                                        <hr/> 
                                        <b>No of Orders : <?php echo $orders['Orders'];?></b>                    
                                    </td>
                                    <?php
                                }
                                echo "</tr>";
                            // }
                        

                        ?>
                    </table>
				</div>
			</div>
		</div>
		<br>
	</div>
	
	<!--//Services-->
</form>
</body>
<!-- 
Manage 

Colloborator - CRUD in Collaborator_Entry //Done
Customer - View //Done
Consultation - View Manage_Consultation //Done
Payment - Confirm / Update Manage_Paymnent
Package - CRUD in Package_Entry //Done 
Wishing Lists - View Manage_WishingList //Done

-->

<?php
	include('..\footer.php');
?>