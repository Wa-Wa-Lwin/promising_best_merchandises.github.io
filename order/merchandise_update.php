<?php 
session_start();
include('..\connect.php'); 
include('..\staff\header.php');


if(isset($_GET['MerchandiseID'])) 
{
	$MerchandiseID=$_GET['MerchandiseID'];

	$query="SELECT * FROM Merchandise WHERE MerchandiseID='$MerchandiseID' ";
	$retrieve=mysqli_query($connection,$query);
	$array=mysqli_fetch_array($retrieve);

}

//MerchandiseID Merchandise_Name Description Photo1 Photo2 Photo3 Price Avaliable_Quantity PrintingTypeID ProductTypeID MaterialTypeID


if(isset($_POST['btnUpdate'])) 
{ 

    $txtMerchandiseId=$_POST['txtMerchandiseId'];
    $txtName=$_POST['txtName']; 
    $txtDes=$_POST['txtDes'];  
    $txtPrice=$_POST['txtPrice']; 
    $txtQuantity=$_POST['txtQuantity']; 
    $txtPrintingTypeID=$_POST['txtPrintingTypeID'];
    $txtProductTypeID=$_POST['txtProductTypeID'];
    $txtMaterialTypeID=$_POST['txtMaterialTypeID'];

    if(empty($_FILES['Image']['name']) && empty($_FILES['Image1']['name']))
    {
        $Update= "UPDATE Merchandise SET 
        Merchandise_Name='$txtName',
        Description='$txtDes',
        Price='$txtPrice',
        Avaliable_Quantity='$txtQuantity',
        PrintingTypeID='$txtPrintingTypeID',
        ProductTypeID='$txtProductTypeID',
        MaterialTypeID='$txtMaterialTypeID'

        WHERE MerchandiseID='$txtMerchandiseId' 
        ";
        $RunUpdate=mysqli_query($connection,$Update);	
        if ($RunUpdate) 
        {
            echo "<script>window.alert('Merchandise Information Successfully Updated !')</script>"; 
            echo "<script>window.location='merchandise_entry.php'</script>";
        }
        else 
        {
            echo "<p>Something went wrong in Merchandise Update :" . mysqli_error($connection) . "</p>";
        }
    }
    else if(empty($_FILES['Image1']['name']))
    {
        //Image Upload --------------------------------------
        $Image1=$_FILES['Image']['name']; 
        $Folder="Merchandise_Image/";

        $FileName=$Folder . '_' . $Image1;  
        $copied=copy($_FILES['Image']['tmp_name'], $FileName);

        if(!$copied)
        {
            echo "<p> Image cannot upload!</p>";
            exit();
        }

        //Image Upload ---------------------------------------

        $Update= "UPDATE Merchandise SET 

        Merchandise_Name='$txtName',
        Description='$txtDes',
        Price='$txtPrice',
        Avaliable_Quantity='$txtQuantity',
        PrintingTypeID='$txtPrintingTypeID',
        ProductTypeID='$txtProductTypeID',
        MaterialTypeID='$txtMaterialTypeID',
        Photo1='$FileName'

        WHERE MerchandiseID='$txtMerchandiseId' 
        ";

        $RunUpdate=mysqli_query($connection,$Update);				

        if ($RunUpdate) 
        {
            echo "<script>window.alert('Merchandise Information Successfully Updated !')</script>"; 
            echo "<script>window.location='merchandise_entry.php'</script>";
        }
        else 
        {
            echo "<p>Something went wrong in Merchandise Update :" . mysqli_error($connection) . "</p>";
        }
    }
    else
    {
        //Image Upload --------------------------------------
        $Image1=$_FILES['Image1']['name']; 
        $Folder="Merchandise_Image/";

        $FileName=$Folder . '_' . $Image1;  
        $copied=copy($_FILES['Image1']['tmp_name'], $FileName);

        if(!$copied)
        {
            echo "<p> Image cannot upload!</p>";
            exit();
        }

        //Image Upload ---------------------------------------

        $Update= "UPDATE Merchandise SET 

        Merchandise_Name='$txtName',
        Description='$txtDes',
        Price='$txtPrice',
        Avaliable_Quantity='$txtQuantity',
        PrintingTypeID='$txtPrintingTypeID',
        ProductTypeID='$txtProductTypeID',
        MaterialTypeID='$txtMaterialTypeID',
        Photo2='$FileName'

        WHERE MerchandiseID='$txtMerchandiseId' 
        ";

        $RunUpdate=mysqli_query($connection,$Update);               

        if ($RunUpdate) 
        {
            echo "<script>window.alert('Merchandise Information Successfully Updated !')</script>"; 
            echo "<script>window.location='merchandise_entry.php'</script>";
        }
        else 
        {
            echo "<p>Something went wrong in Merchandise Update :" . mysqli_error($connection) . "</p>";
        }
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <title>Merchandise</title>
</head>
<body>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <script>
        function imageDisplay(pic)
        {
            var freader=new FileReader();
            freader.onload=function(e)
            {
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
    <script>
       $(document).ready
       ( function ()
       {
          $('#tableid').DataTable();
      }
      );
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <form action="merchandise_update.php" method="POST" enctype="multipart/form-data">
      <div class="contact" id="contact">
        <div class="container">
            <div class="contact-two-grids">
                <h3 class="title clr">Merchandise Update</h3>

                <div class="form-group">
                    <label for="name">Merchandise Name</label>
                    <input type="text" class="form-control" id="name" name="txtName" value="<?php echo $array['Merchandise_Name'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="des">Description</label>
                    <input type="text" class="form-control" id="des" name="txtDes" value="<?php echo $array['Description'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="txtPrice" value="<?php echo $array['Price'] ?>">
                </div>

                <div class="form-group">
                    <label for="qunatity">Available Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="txtQuantity" value="<?php echo $array['Avaliable_Quantity'] ?>">
                </div>

                <div class="form-group">
                    <label for="txtPrintingTypeID">Printing Type</label>
                    <select name="txtPrintingTypeID" id="txtPrintingTypeID" class="form-control" required>
                        <option value="<?php echo $array['PrintingTypeID'] ?>"><?php echo $array['PrintingTypeID'] ?></option>
                    <?php
                        $querypt="SELECT * FROM printing_type";
                        $retrievept=mysqli_query($connection,$querypt);
                        $countpt=mysqli_num_rows($retrievept);
                        for ($i=0; $i < $countpt; $i++){
                            $arraypt=mysqli_fetch_array($retrievept);
                            $PrintingTypeID=$arraypt['PrintingTypeID'];
                            $Printing_Type_Name=$arraypt['Printing_Type_Name'];
                            echo "<option value='$PrintingTypeID'>$Printing_Type_Name</option>";
                        }
                    ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="txtPrintingTypeID" name="txtPrintingTypeID" value="<?php //echo $array['PrintingTypeID'] ?>"> -->
                </div>

                <div class="form-group">
                    <label for="txtProductTypeID">Product Type</label>
                    <select id="txtProductTypeID" name="txtProductTypeID" class="form-control" required>
                        <option value="<?php echo $array['ProductTypeID'] ?>"><?php echo $array['ProductTypeID'] ?></option>
                    <?php
                        $querypd="SELECT * FROM product_type";
                        $retrievepd=mysqli_query($connection,$querypd);
                        $countpd=mysqli_num_rows($retrievepd);
                        for ($i=0; $i < $countpd; $i++){
                            $arraypd=mysqli_fetch_array($retrievepd);
                            $ProductTypeID=$arraypd['ProductTypeID'];
                            $Product_Type_Name=$arraypd['Product_Type_Name'];
                            echo "<option value='$ProductTypeID'>$Product_Type_Name</option>";
                        }
                    ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="txtProductTypeID" name="txtProductTypeID" value="<?php //echo $array['ProductTypeID'] ?>"> -->
                </div>

                <div class="form-group">
                    <label for="txtMaterialTypeID">Material Type</label>
                    <select id="txtMaterialTypeID" name="txtMaterialTypeID" class="form-control" required>
                        <option value="<?php echo $array['MaterialTypeID']?>"><?php echo $array['MaterialTypeID']?></option>
                    <?php
                        $querymt="SELECT * FROM material_type";
                        $retrievemt=mysqli_query($connection,$querymt);
                        $countmt=mysqli_num_rows($retrievemt);
                        for ($i=0; $i < $countmt; $i++){
                            $arraymt=mysqli_fetch_array($retrievemt);
                            $MaterialTypeID=$arraymt['MaterialTypeID'];
                            $Material_Name=$arraymt['Material_Name'];
                            echo "<option value='$MaterialTypeID'>$Material_Name</option>";
                        }
                    ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="txtMaterialTypeID" name="txtMaterialTypeID" value="<?php //echo $array['MaterialTypeID'] ?>"> -->
                </div>


                <div class="form-group">
                    <label for="img">Merchandise Photo 1</label>
                    <input type="file" name="Image" onchange="imageDisplay(this)" />                            
                    <img src="<?php echo $array['Photo1']?>" style="width: 100px; height: 100px;" id="img" >
                </div>

                <div class="form-group">
                    <label for="img1">Merchandise Photo 2</label>
                    <input type="file" name="Image1" onchange="imageDisplay1(this)" />                            
                    <img src="<?php echo $array['Photo2']?>" style="width: 100px; height: 100px;" id="img1" >
                </div>

                <div class="form-group">
                    <input type="hidden" name="txtMerchandiseId" value="<?php echo $array['MerchandiseID'] ?>" >

                    <button type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-primary">Update</button>

                    <button type="reset" name="btnReset" class="btn btn-secondary">Clear</button>
                </div>



            </div>
        </div>
    </div>	
</form>


</body>
</html>

<?php
include('..\footer.php');
?>
