<?php   
//session_start();
include('..\connect.php');
include('verify_staff_login.php');
include('header.php');

//

if (isset($_GET['OrderID'])) 
{
    $StaffID=$_SESSION['StaffID']; 
    
    $OrderID=$_GET['OrderID'];
    $update="UPDATE orders
    SET Status='Confirm',StaffID='$StaffID'
    WHERE OrderID='$OrderID'";
    $ret=mysqli_query($connection,$update);
    if($ret)
    {
        echo"<script>
        window.alert('You Confirmed this orders transaction! ');
        window.location='manage_order.php';
        </script>"; 
    }
}

else
{

}

if (isset($_GET['Cancel_OrderID'])) 
{
    $OrderID=$_GET['Cancel_OrderID'];
    $update="UPDATE orders
    SET Status='Cancel',StaffID='$StaffID'
    WHERE OrderID='$OrderID'";
    $ret=mysqli_query($connection,$update);
    if($ret)
    {
        echo"<script>
        window.alert('You cancel this orders transaction! ');
        window.location='manage_order.php';
        </script>"; 
    }
}

?>

<div class="tbdisplay container" style="overflow-x:auto;" id="tbdisplay">
    <h3 class="title clr">Information of orders :</h3><br/>
    <div class="banner-bottom-girds text-center" >
        <script type="text/javascript" src="js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
        <script type="text/javascript" src="DataTables/datatables.min.js"></script>
        <script>
            $(document).ready( function ()
            {
                $('#tableid').DataTable();
            });
        </script>
        <table id="tableid" class="display border">
            <tr>

                
                <!-- <th>#</th> -->

                <th>OrderID</th>
                <th>MerchandiseID</th>
                <th>CustomerID</th>
                <th>StaffID</th>
                <!-- <th>Photo</th> -->
                <!-- <th>Description</th> -->
                <th>Order_Date</th>
                <th>TotalQuantity</th>
                <th>TotalAmount</th>
                <th>VAT</th>
                <th>GrandTotal</th> 
                <th>Payment_Method</th> 
                <th>Bank_Card</th> 
                <th>Status</th> 
                <th>Action</th> 
            </tr>   
            <?php  
            $query="SELECT * FROM orders";
            $Sret=mysqli_query($connection,$query);
            $Scount=mysqli_num_rows($Sret);

            for ($i=0; $i < $Scount; $i++) 
            { 
                $rows=mysqli_fetch_array($Sret); 

                $OrderID=$rows['OrderID'];
                $Cancel_OrderID=$rows['OrderID'];

                echo "<tr>";

                echo "<td>" . $rows['OrderID'] . "</td>";
                echo "<td>" . $rows['MerchandiseID'] . "</td>";
                echo "<td>" . $rows['CustomerID'] . "</td>";
                echo "<td>" . $rows['StaffID'] . "</td>";

                /*echo "<td>" . $rows['Photo'] . "</td>";*/

                echo "<td>" . $rows['Order_Date'] . "</td>";


                echo "<td>" . $rows['TotalQuantity'] . "</td>";
                echo "<td>" . $rows['TotalAmount'] . "</td>";
                echo "<td>" . $rows['VAT'] . "</td>";
                echo "<td>" . $rows['GrandTotal'] . "</td>";
                echo "<td>" . $rows['Payment_Method'] . "</td>";

                echo "<td>" . $rows['Bank_Card'] . "</td>";
                echo "<td>" . $rows['Status'] . "</td>";

                echo "<td>";

                echo "<a href='manage_order.php?OrderID=".$rows['OrderID']."'>Confirm</a>"; 

                echo "<br>";

                echo "<a href='manage_order.php?Cancel_OrderID=".$rows['OrderID']."'>Cancel</a>";                   
                echo "</td>";
                echo "</tr>";

            }
            ?>
        </table>
        <div class="clearfix"> </div>
    </div>
</div>
<br/>
<?php
include('..\footer.php');
?>