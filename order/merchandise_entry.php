<?php 
session_start();
include('..\connect.php'); 
include('..\staff\header.php');
//include('C:\xampp\htdocs\PB_M\staff\header.php');
if(isset($_POST['btnSave']))

{  

    $txtName=$_POST['txtName'];
    $txtDes=$_POST['txtDes'];  
    $txtPrice=$_POST['txtPrice']; 
    $txtQuantity=$_POST['txtQuantity'];
    
    $txtPrintingTypeID=$_POST['txtPrintingTypeID'];
    $txtProductTypeID=$_POST['txtProductTypeID'];
    $txtMaterialTypeID=$_POST['txtMaterialTypeID'];

            //Image Upload ---------------------------------------------------------
    $Image1=$_FILES['Image']['name'];
    $Image2=$_FILES['Image1']['name']; 
   // $Folder="./order/Merchandise_Image/";

    $Folder="Merchandise_Image/";

    // $Folder="C:\xampp\htdocs\PB_M\order\Merchandise_Image/";

    $FileName=$Folder . '_' . $Image1;  
    $FileName1=$Folder . '_' . $Image2;  
    $copied=copy($_FILES['Image']['tmp_name'], $FileName);
    $copied1=copy($_FILES['Image1']['tmp_name'], $FileName1);

    if(!$copied || !$copied1)
    {
        echo "<p> Image cannot upload!</p>";
        exit();
    }
            //Image Upload             ---------------------------------------------------------
    /* MerchandiseID   Merchandise_Name    Description Photo1  Photo2  Price   Avaliable_Quantity  PrintingTypeID  ProductTypeID   MaterialTypeID */

    $InsertMerchandise=" 
    INSERT INTO merchandise
    (Merchandise_Name,Description,Photo1,Photo2,Price,Avaliable_Quantity,PrintingTypeID,ProductTypeID,MaterialTypeID)
    VALUES
    ('$txtName','$txtDes','$FileName','$FileName1','$txtPrice','$txtQuantity','$txtPrintingTypeID','$txtProductTypeID','$txtMaterialTypeID') 
    ";

    $RunInsertMerchandise=mysqli_query($connection,$InsertMerchandise);

    if ($RunInsertMerchandise) 
    {
        echo "<script>window.alert('Merchandise is Successfully Registered!')</script>"; 
        echo "<script>window.location='merchandise_entry.php'</script>";
    }
    else 
    {
        echo "<p>Something went wrong in Merchandise Entry :" . mysqli_error($connection) . "</p>";

    }


}

?>

<head>
    <title>Merchandise</title>
</head>
<body>

    <script>
        function imageDisplay(pic){
            var freader=new FileReader();
            freader.onload=function(e){
                document.getElementById("img").src=e.target.result;
            };
            freader.readAsDataURL(pic.files[0]);
        }
        function imageDisplay1(pic){
            var freader1=new FileReader();
            freader1.onload=function(e){
                document.getElementById("img1").src=e.target.result;
            };
            freader1.readAsDataURL(pic.files[0]);
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <form action="merchandise_entry.php" method="POST" enctype="multipart/form-data">
        <div class="contact" id="contact">
           <div class="container">
               <div class="contact-two-grids">
                   <h3 class="title clr">Merchandise Registeration</h3>

                   <div class="form-group">
                    <label for="name">Merchandise Name</label>
                    <input type="text" class="form-control" id="name" name="txtName" required>
                </div>

                <div class="form-group">
                    <label for="des">Description</label>
                    <textarea class="form-control" id="des" name="txtDes" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="txtPrice">
                </div>

                <div class="form-group">
                    <label for="qunatity">Available Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="txtQuantity">
                </div>

                <div class="form-group">
                    <label for="txtPrintingTypeID">Printing Type</label>
                    <select name="txtPrintingTypeID" id="txtPrintingTypeID" class="form-control" required>
                    <?php
                        $query="SELECT * FROM printing_type";
                        $retrieve=mysqli_query($connection,$query);
                        $count=mysqli_num_rows($retrieve);
                        for ($i=0; $i < $count; $i++){
                            $array=mysqli_fetch_array($retrieve);
                            $PrintingTypeID=$array['PrintingTypeID'];
                            $Printing_Type_Name=$array['Printing_Type_Name'];
                            echo "<option value='$PrintingTypeID'>$Printing_Type_Name</option>";
                        }
                    ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="txtPrintingTypeID" name="txtPrintingTypeID"> -->
                </div>

                <div class="form-group">
                    <label for="txtProductTypeID">Product Type</label>
                    <select id="txtProductTypeID" name="txtProductTypeID" class="form-control" required>
                    <?php
                        $query="SELECT * FROM product_type";
                        $retrieve=mysqli_query($connection,$query);
                        $count=mysqli_num_rows($retrieve);
                        for ($i=0; $i < $count; $i++){
                            $array=mysqli_fetch_array($retrieve);
                            $ProductTypeID=$array['ProductTypeID'];
                            $Product_Type_Name=$array['Product_Type_Name'];
                            echo "<option value='$ProductTypeID'>$Product_Type_Name</option>";
                        }
                    ?>
                    </select>
<!--                     <input type="text" class="form-control" id="txtProductTypeID" name="txtProductTypeID"> -->
                </div>

                <div class="form-group">
                    <label for="txtMaterialTypeID">Material Type</label>
                    <select id="txtMaterialTypeID" name="txtMaterialTypeID" class="form-control" required>
                    <?php
                        $query="SELECT * FROM material_type";
                        $retrieve=mysqli_query($connection,$query);
                        $count=mysqli_num_rows($retrieve);
                        for ($i=0; $i < $count; $i++){
                            $array=mysqli_fetch_array($retrieve);
                            $MaterialTypeID=$array['MaterialTypeID'];
                            $Material_Name=$array['Material_Name'];
                            echo "<option value='$MaterialTypeID'>$Material_Name</option>";
                        }
                    ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="txtMaterialTypeID" name="txtMaterialTypeID"> -->
                </div>


                <div class="form-group">
                    <label for="img">Merchandise Photo 1</label>
                    <input type="file" name="Image" onchange="imageDisplay(this)" />                            
                    <img style="width: 100px; height: 100px;" id="img" >
                </div>

                <div class="form-group">
                    <label for="img1">Merchandise Photo 2</label>
                    <input type="file" name="Image1" onchange="imageDisplay1(this)" />                            
                    <img style="width: 100px; height: 100px;" id="img1" >
                </div>

                <button type="submit" id="btnSave" name="btnSave" class="btn btn-primary">Save</button>
                <button type="reset" name="btnReset" class="btn btn-secondary">Clear</button>
                
                <br>
                <br>
                <p class="flip" onclick="myFunction()">Click to show the Merchandises.</p>
            </div>
        </div>
    </div>
    <!-- MerchandiseID   Merchandise_Name    Description Photo1  Photo2  Price   Avaliable_Quantity  PrintingTypeID  ProductTypeID   MaterialTypeID   -->
    <!-- Display -->
    <div id="panel contact">
        <!--Tb Display-->
        <div class="tbdisplay container" style="overflow-x:auto;" id="tbdisplay">
            <h3 class="title clr">Merchandises</h3>
            <div class="banner-bottom-girds text-center">
             <table id="tableid" class="display">
                <tr>
                    <th>#</th>
                    <th>MerchandiseID</th>

                    <th>Merchandise_Name</th>
                    <th>Description</th>
                    <th>Photo1 Name</th>
                    <th>Photo1</th>
                    <th>Photo2 Name</th>
                    <th>Photo2</th>

                    <th>Price</th> 
                    <th>Avaliable_Quantity</th>
                    <th>PrintingTypeID</th>
                    <th>ProductTypeID</th>
                    <th>MaterialTypeID</th>

                    <th>Action</th>
                </tr>   

                <?php  
                $query="SELECT * FROM merchandise";
                $Sret=mysqli_query($connection,$query); 
                $Scount=mysqli_num_rows($Sret);

                for ($i=0; $i < $Scount; $i++) 
                { 
                    $rows=mysqli_fetch_array($Sret); 
                    
                    $MerchandiseID=$rows['MerchandiseID'];
                    
                    echo "<td>" . ($i + 1) . "</td>";
                    echo "<td>" . $rows['MerchandiseID'] . "</td>";

                    echo "<td>" . $rows['Merchandise_Name'] . "</td>";

                    echo "<td>" . $rows['Description'] . "</td>";

                    echo "<td>" . $rows['Photo1'] . "</td>";
                    ?>
                    <td> <img style="width: 100px; height: 100px;" src="<?php echo $rows['Photo1']?>"> </td>
                    <?php

                    echo "<td>" . $rows['Photo2'] . "</td>";
                    ?>
                    <td> <img style="width: 100px; height: 100px;" src="<?php echo $rows['Photo2']?>"> </td>
                    
                    <?php

                    echo "<td>" . $rows['Price'] . "</td>";
                    echo "<td>" . $rows['Avaliable_Quantity'] . "</td>";
                    echo "<td>" . $rows['PrintingTypeID'] . "</td>";
                    echo "<td>" . $rows['ProductTypeID'] . "</td>";
                    echo "<td>" . $rows['MaterialTypeID'] . "</td>";

                    echo "<td>
                    <a href='Merchandise_Delete.php?MerchandiseID=$MerchandiseID'>Delete</a> |
                    <a href='Merchandise_Update.php?MerchandiseID=$MerchandiseID'>Edit</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <div class="clearfix"> </div>
        </div>
    </div>

    <!--//Tb Display-->
</div>
<!-- Display -->
</form>
<script>
    function myFunction() {
      document.getElementById("panel").style.display = "block";
  }
</script>

</body>
</html>

<?php
include('..\footer.php');
?>