<?php 	

include('..\connect.php'); 
include('verify_customer_login.php');
include('..\customer\cus_header.php');

$CustomerID=$_SESSION['customerid'];

        $selectM="
        SELECT o.*,m.Photo1,m.Merchandise_Name,m.MerchandiseID
        from orders o,merchandise m 
        where o.CustomerID=$CustomerID
        And m.MerchandiseID=o.MerchandiseID
        ";
		$retrieveP=mysqli_query($connection,$selectM);
		$countP=mysqli_num_rows($retrieveP);


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

<form action="View_Checkout.php" method="POST" enctype="multipart/form-data">
<div class="contact" id="contact">
<div class="container">
<div class="row contact-block">
<h3 class="title clr">Your Checkout Merchandises</h3>
    <a class="block" href='/PB_M/customer/profile.php?CustomerID=$CustomerID'>Back </a>

<!--     echo" <script> window.location = '/PB_M/customer/login.php'</script>" ; -->
                    <hr>
 <legend>Your Merchandises </legend>

			<?php
				for ($i=0; $i < $countP; $i++) 
{ 
		$array=mysqli_fetch_array($retrieveP);

                    $Image=$array['Photo1'];
                    $MerchandiseID=$array['MerchandiseID'];
                    $Merchandise_Name=$array['Merchandise_Name'];
                    $OrderID=$array['OrderID']; 

            // list($width,$height)=getimagesize($Image);
            // $w=$width/2.5;
            // $h=$height/2.5;
        ?>
    <div class='col-lg-6 col-md-6 col-sm-12 col-12'>
		<fieldset>

			<table id="tableid" class="display">
				
                <!-- Name    -->
                <tr>
                    <td>Merchandise </td>
                    <td>
                        <img src="<?php echo $Image ?>" width="350" height="250" />

                         <br>   

                        <?php   

                        echo "<a href='merchandise_detail.php?MerchandiseID=$MerchandiseID'> 
                        $Merchandise_Name
                        </a>";

                         ?>
                        <br>   
                        <?php   

                        echo "<a href='orderdetail_view.php?OrderID=$OrderID'> 
                        Order Customization
                        </a>";

                         ?>
                    </td>
                </tr>


                <!-- Payment_No    -->
                <tr>
                    <td>Order Code No</td>
                    <td> ORD-No-
                       <?php echo $array['OrderID'] ?>
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
                    <td>Status</td>
                    <td>
                    	<?php echo $array['Status'] ?>
                    </td>
                </tr>

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
    </div>
	</form>
<?php
include('..\footer.php');
?>