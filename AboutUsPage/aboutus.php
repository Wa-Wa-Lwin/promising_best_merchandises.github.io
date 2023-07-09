<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="aboutus.css">
</head>
<?php 
include('../customer/cus_header.php');
?>
<body>

	<div class="d-flex align-items-center justify-content-center">
		<div class="flex-column">
			<h1>About Us</h1>
			<div class="headerAboutUs"></div>
		</div>
	</div>

	<div class="_215zd5">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="title478">
						<h2>Promising Best Merchandises</h2>
						<img class="line-title" src="line.svg" alt="">
						<p>The Promising Best Merchandises Company, a Myanmar corporation founded in 2012 and today engaged primarily in the manufacture and sale of customised merchandise. This local business is trying to nationalise along with the development of technology. It concentrates for customers from Yangon and has been a local symbol of Myanmar people’s taste. </p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="story125">
						<img src="https://img.freepik.com/free-vector/warehouse-staff-wearing-uniform-loading-parcel-box-checking-product-from-warehouse-delivery-logistic-storage-truck-transportation-industry-delivery-logistic-business-delivery_1150-60909.jpg" class="CartImage" alt="" >
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="_215zd5">
		<div class="container">
			<div class="row">
				
				<div class="col-md-6">
					<div class="story125">
						<img src="https://img.freepik.com/free-vector/industry-4-0-illustration-with-robotic-arm-smart-industrial-revolution-factory-process_1150-41582.jpg" class="CartImage" alt="manufacturing">
					</div>
				</div>
				<div class="col-md-6">
					<div class="title478">
						<h2>What We Do </h2>
						<img class="line-title" src="line.svg" alt="">
						<p>The company also produces and sells both customers-customised and company produced merchandise. There are over 8 types of merchandise available. Beside manufacturing and selling customers-customised and company-produced merchandise, the company also delivers the products to their customers.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="_215zd5">
		<div class="container">
			<div class="row">

				<div class="col-md-6">
					<div class="title478">
						<h2>Where are we </h2>
						<img class="line-title" src="line.svg" alt="">
						<p>Promising Best Merchandises is one of the largest merchandise manufacturers and distributors in Yangon. Head office is in Hlaing Township and the manufacturing factory is in Hlaing Thar Yar Township. Furthermore, Promising Best Merchandises has long-term business partners and suppliers for ensuring their sustainable future.</p>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="story125">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61086.70239322181!2d96.05487395!3d16.87990595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1be3059b6950d%3A0xd6800d4f4a9cec42!2sHlaingthaya%20Township%2C%20Yangon!5e0!3m2!1sen!2smm!4v1669478197774!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<form action="" method="post">
		<div class="_215zd5">
			<div class="container">
				<div class="row">
					<h3 class="text-center">Subscribe for Update of Our New Merchandise Arrival</h3>
					<hr/>
					<div class="col-md-8 col-12">
						<div class="title478 letter">
							<input class="email" type="email" placeholder="Your email..." required="">
						</div>
					</div>
					
					<div class="col-md-4 col-12">
						<div class="story125 newsletter">
							<input type="submit" name="btnSub" value="Subscribe">
							<?php
					            if(isset($_POST['btnSub'])) {
					              echo "<script>window.alert('Subscribe Successfully.')</script>";
					            }
					        ?>
						</div>
					</div>
					
				</div>
				<hr/>
			</div>
		</div>
	</form>
</body>
<?php 
include('../footer.php');
?>
</html>