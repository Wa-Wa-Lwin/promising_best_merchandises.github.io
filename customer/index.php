<?php
    include('..\order\verify_customer_login.php');
    include('connect.php');
    include('cus_header.php');

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <!-- <a href="profile.php">PROFILE</a> -->


	<div class="container">
		<div class="contact-two-grids">
			<div class=" col-md-6 contact-icons text-right" style=" /* margin-top: 35px; */ color: blue;">
				<p>Welcome : 
					<?php 
					if(is_null($Customer_Name)){
						echo "<a href='login.php'>Log In</a>";
					}
					else{
						echo $Customer_Name;
					}					 
					?>  | <a href="logout.php">Logout</a></p>
			</div>
		</div>  
	</div>
	<div class="container">
			<h3 class="title clr text-center">Home</h3>
			
			<div class="banner-bottom-girds text-center">
			<div class="row">
				<!-- Start -->
				<div class="col-6 col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='../order/view_Checkout.php'>View Orders</a><br>
					</div>
				</div> 
				
				<!-- End -->
				<!-- Start -->
				<div class="col-6 col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='../delivery/ask_for_deli.php'>View Delivery</a><br>
					</div>
				</div>
				<div class="col-6 col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid">
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='../order/view_wishinglist.php'>View Wishing List</a><br>
					</div>
				</div> 
				<!-- End -->
				<!-- Start -->
				<div class="col-6 col-lg-6 col-md-6  col-sm-6 col-xs-6  its-banner-grid"> 
					<div class="white-shadow">
						<span class="fa  fa-heart  banner-icon" aria-hidden="true"></span>
						<br>
						<a href='profile.php'>View Profile</a><br>
					</div>
				</div>
				<!-- End -->				
				<div class="clearfix"> </div>
			</div>
		</div>
		<hr/>
		</div>

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
							WHERE o.MerchandiseID=m.MerchandiseID) DESC
							LIMIT 3";
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
</body>
<?php   
    include('..\footer.php');
?>