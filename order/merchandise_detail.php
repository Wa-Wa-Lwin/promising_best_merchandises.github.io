  <?php 
  //session_start(); 
  include('verify_customer_login.php');
  include('..\connect.php'); 
  include('shopping_cart_functions.php');
  include('..\customer\cus_header.php');

  if(isset($_POST['btnWishingList'])) 
  {

  	$date = date('m/d/Y h:i:s', time());

  	$txtMerchandiseID=$_POST['txtMerchandiseID'];
    $CustomerID=$_SESSION['customerid'];

    $Insert=" 
    INSERT INTO wishing_list
    (MerchandiseID,CustomerID,Date) 
    VALUES
    ('$txtMerchandiseID','$CustomerID','$date' ) 
    ";

    $RunInsert=mysqli_query($connection,$Insert);             


    if ($RunInsert) 
    {
      echo "<script>window.alert('This item is added to your wishing list !')</script>"; 
      echo "<script>window.location='merchandise_display.php'</script>";
    }
    else 
    {
      echo "<p>Something went wrong in adding to your wishing list :" . mysqli_error($connection) . "</p>";

    }


  }

  if(isset($_POST['btnAdd2Cart'])) 
  {

  	include('verify_customer_login.php');


  	$txtMerchandiseID=$_POST['txtMerchandiseID'];
  	$txtBuyingQuantity=$_POST['txtBuyingQuantity'];

    //echo "<script>window.alert('Account logged in!')</script>";

  	AddProduct($txtMerchandiseID,$txtBuyingQuantity);

  }

//Get Product Information------------------------------------------------

  $MerchandiseID=$_GET['MerchandiseID'];

  $query="SELECT m.*
  FROM Merchandise m
  WHERE m.MerchandiseID='$MerchandiseID' 
  ";
  $ret=mysqli_query($connection,$query);
  $row=mysqli_fetch_array($ret);

  $Image=$row['Photo1']; 

  list($width,$height)=getimagesize($Image);
  $w=$width/1.5;
  $h=$height/1.5;

  $Image2=$row['Photo2'];

  //list($width,$height)=getimagesize($Image2);
 /* $w=$width/1.5;
 $h=$height/1.5;*/

//----------------------------------------------------------------------
 ?>
 <form action="merchandise_detail.php" method="post">
   <div class="contact" id="contact">
    <div class="container">
     <div class="contact-block">
      <h4 class="title clr">Merchandise Detail Information</h4>
      <table align="center">
       <tr>
        <td rowspan="10">
         <img id="PImage" src="<?php echo $Image ?>" width="350" height="250" />
         <hr>
       </td>
     </tr>
     
     <!-- Merchandise_Name	 -->
     <tr>
      <td>Name</td>
      <td>: <b><?php echo $row['Merchandise_Name'] ?></b></td>
    </tr>

    <!-- Description    -->
    <tr>
      <td>Description </td>
      <td>:
       <b><?php echo $row['Description'] ?></b>
     </td>
   </tr>

   <!-- Price -->
   <tr>
    <td>Price
    </td>
    <td>:<b><?php echo $row['Price'] ?> MMK</b>
    </td>
  </tr>
  
  <!-- PrintingTypeID -->
  <tr>
    <td>PrintingTypeID </td>
    <td>: <b><?php echo $row['PrintingTypeID'] ?></b> 
    </td>
  </tr>
  
  <!-- ProductTypeID -->
  <tr>
    <td>ProductTypeID </td>
    <td>: <b><?php echo $row['ProductTypeID'] ?></b> 
    </td>
  </tr>

  <!-- MaterialTypeID -->
  <tr>
    <td>MaterialTypeID </td>
    <td>: <b><?php echo $row['MaterialTypeID'] ?></b> 
    </td>
  </tr>

  <!-- Avaliable_Quantity -->
  <tr>
    <td>Avaliable Quantity </td>
    <td>:
     <b><?php echo $row['Avaliable_Quantity'] ?></b> pcs
   </td>
 </tr>

 <!-- Buying Quantity -->
 <tr>
  <td>Buying Quantity  :</td>
  <td> 
   <input type="hidden" name="txtMerchandiseID" value="<?php echo $row['MerchandiseID']  ?>" />
   <input type="text" name="txtBuyingQuantity" value="1" size="3" />
 </td>
</tr>
<tr>
  <td>
   <input type="submit" name="btnAdd2Cart" value="Buy" />
 </td>

 <td>
   <input type="submit" name="btnWishingList" value="Add To Wishing List"/> 

 </td>
</tr>

<tr> 
  <td rowspan="10">
    <img id="PImage" src="<?php echo $Image2 ?>" width="350" height="250" />
    <hr>
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
