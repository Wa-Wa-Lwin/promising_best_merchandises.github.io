<?php 	

include('..\connect.php'); 
include('..\order\verify_customer_login.php');
include('..\customer\cus_header.php');

$CustomerID=$_SESSION['customerid'];

?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
<script>
	function imageDisplay(pic){
		var freader=new FileReader();
		freader.onload=function(e){
			document.getElementById("img").src=e.target.result;
		};
		freader.readAsDataURL(pic.files[0]);
	}
</script>
<style type="text/css">
    .price
    {
        color: red;
        background: #000;
        font-size: 20pt;
        font-family:Century Gothic;
        padding: 10px;
    }
    .price:hover
    {
        color: #000;
        background: #CCC;
        font-size: 20pt;
        font-family:Century Gothic;
        padding: 10px;
    }
</style>
<script>
	$(document).ready
	( function ()
	{
		$('#tableid').DataTable();
	}
	);
</script>

<form action="ask_for_deli.php" method="POST" enctype="multipart/form-data">
    <div class="contact container" id="contact">
        <div class="contact-block">
            <div class="row">
                <h3 class="title clr">Book Delivery</h3>
                <a class="block" href='/PB_M/customer/profile.php?CustomerID=$CustomerID'>Back </a>

                <!--     echo" <script> window.location = '/PB_M/customer/login.php'</script>" ; -->
                <hr>
                <legend>Your Merchandises </legend>
                <!-- <div class="col-lg-6 col-md-6"> -->
                <?php
                $selectM="
                SELECT o.*,m.Photo1,m.Merchandise_Name,m.MerchandiseID,d.Status as DeliveryStatus
                from orders o
                inner join merchandise m on o.MerchandiseID=m.MerchandiseID
                left join delivery d on o.OrderID=d.OrderID
                where o.CustomerID=$CustomerID
                
                ";
                $retrieveP=mysqli_query($connection,$selectM);
                $countP=mysqli_num_rows($retrieveP);
                for ($i=0; $i < $countP; $i++) 
                { 
                  $array=mysqli_fetch_array($retrieveP);

                  $MerchandiseID=$array['MerchandiseID'];
                  $Merchandise_Name=$array['Merchandise_Name']; 
                  $OrderID=$array['OrderID']; 

                  ?>
                  <div class="col-lg-6 col-md-6">
                  <fieldset>
                    <table id="tableid" class="display">

                    <!-- Name    -->
                    <tr>
                        <td>Merchandise </td>
                        <td>
                            <?php   
                            echo "<a href='..\order\merchandise_detail.php?MerchandiseID=$MerchandiseID'> 
                            $Merchandise_Name
                            </a>";
                            ?>  
                        </td>
                    </tr>
                    <!-- OrderNo    -->
                    <tr>
                        <td>Order Code No</td>
                        <td> ORD-No-
                           <?php echo $OrderID ?>
                       </td>
                    </tr>
                       <!-- Order_Date  -->
                    <tr>
                        <td>Order_Date</td>
                        <td>
                            <?php echo $array['Order_Date'] ?>
                        </td>
                    </tr>
                    <!-- Status    -->
                    <tr>
                        <td>Order Status</td>
                        <td>
                            <?php echo $array['Status'] ?>
                        </td>
                    </tr>
                    <tr>
                        <!-- <td colspan="7" align="right">  -->
                        <td>Delivery Status</td>
                        <td>
                            <?php
                            if(is_null($array['DeliveryStatus']))
                            {
                                echo "<a href='deli_create.php?OrderID=$OrderID'>Book Delivery</a>";
                            }   
                            elseif (!empty($array['DeliveryStatus'])) 
                            {
                                 echo $array['DeliveryStatus'];
                            }                         
                            ?>
                        </td>
                    </tr>
                    </table>
                    </fieldset>
                    <hr>
                    </div>
                    
                <?php
                }
                ?>
                  
        </div>
    </div>
</form>
<?php   
    include('..\footer.php');
?>