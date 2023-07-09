<?php   
//session_start();
include('..\connect.php');
include('verify_staff_login.php');
include('header.php'); 

if (isset($_GET['DeliveryID'])) 
{
    $StaffID=$_SESSION['StaffID']; 
    
    $DeliveryID=$_GET['DeliveryID'];
    $update="UPDATE delivery
    SET Status='Confirm',StaffID='$StaffID'
    WHERE DeliveryID='$DeliveryID'";
    $ret=mysqli_query($connection,$update);
    if($ret)
    {
        echo"<script>
        window.alert('You Confirmed this delivery transaction! ');
        window.location='manage_delivery.php';
        </script>"; 
    }
}

else
{

}

if (isset($_GET['Cancel_DeliveryID'])) 
{
    $DeliveryID=$_GET['Cancel_DeliveryID'];
    $update="UPDATE delivery
    SET Status='Cancel',StaffID='$StaffID'
    WHERE DeliveryID='$DeliveryID'";
    $ret=mysqli_query($connection,$update);
    if($ret)
    {
        echo"<script>
        window.alert('You cancel this delivery transaction! ');
        window.location='manage_delivery.php';
        </script>"; 
    }
}

?>

<div class="tbdisplay text-center" id="tbdisplay">
    <h3 class="title clr">Information of Customers :</h3>
    <br/>
    <div class="banner-bottom-girds text-center" style="overflow-x:auto;">
        <script type="text/javascript" src="js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
        <script type="text/javascript" src="DataTables/datatables.min.js"></script>
        <script>
            $(document).ready( function ()
            {
                $('#tableid').DataTable();
            });
        </script>
        <table id="tableid" class="display text-center border" style="margin-left: auto; margin-right: auto;">
            <tr>
                <th>CustomerID</th>
                <th>Name</th>
                <th>Email</th>             
                <th>Gender</th>
                <th>Phone</th>
                <th>Address</th> 
                <th>Orders</th> 
            </tr>   
            <?php  
            $query="SELECT * from customers";
            $Sret=mysqli_query($connection,$query);
            $Scount=mysqli_num_rows($Sret);

            for ($i=0; $i < $Scount; $i++) 
            { 
                $rows=mysqli_fetch_array($Sret); 

                $CustomerID=$rows['CustomerID'];
                // $Cancel_CustomerID=$rows['CustomerID'];
                $queryorder="SELECT COUNT(o.OrderID) AS Orders
                FROM orders o
                WHERE o.CustomerID=$CustomerID
                ";
                $Sretorder=mysqli_query($connection,$queryorder);
                $orders=mysqli_fetch_array($Sretorder);

                echo "<tr>";

                echo "<td>" . $rows['CustomerID'] . "</td>";
                echo "<td>" . $rows['Name'] . "</td>";
                echo "<td>" . $rows['Email'] . "</td>"; 

                echo "<td>" . $rows['Gender'] . "</td>";

                echo "<td>" . $rows['Phone'] . "</td>";
                echo "<td>" . $rows['Address'] . "</td>";
                echo "<td>" . $orders['Orders'] . "</td>";

                // echo "<td>";

                // echo "<a href='manage_delivery.php?DeliveryID=".$rows['DeliveryID']."'>Confirm</a>"; 

                // echo "<br>";

                // echo "<a href='manage_delivery.php?Cancel_DeliveryID=".$rows['DeliveryID']."'>Cancel</a>";                   
                // echo "</td>";
                echo "</tr>";

            }
            ?>
        </table>
        <div class="clearfix"> </div>
    </div>
</div>
<br/>
<?php
include('../footer.php'); 
?>