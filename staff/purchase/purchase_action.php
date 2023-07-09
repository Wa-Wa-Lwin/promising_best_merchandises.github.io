<?php
   // Include config.php file
   include_once('purchase_config.php');

   $dbObj = new Database();

   // Insert Record
   if (isset($_POST['action']) && $_POST['action'] == "insert") {

      $txtName = $_POST['txtName'];
      $txtDes = $_POST['txtDes'];
      $txtDate = $_POST['txtDate'];
      $txtSupplierID = $_POST['txtSupplierID'];
      $txtResourceID = $_POST['txtResourceID'];
      $txtPaymentVoucher = $_POST['txtPaymentVoucher'];
 

      $dbObj->insertRecord($txtName, $txtDes, $txtDate, $txtSupplierID, $txtResourceID, $txtPaymentVoucher);
   }

   // View record
   if (isset($_POST['action']) && $_POST['action'] == "view") 
   {
      $output = "";
      $tCount = 0;
      $purchaseList = $dbObj->displayRecord();



      if ($dbObj->totalRowCount() > 0) {
         $output .="<table class='table table-hover'>
                 <thead class='bg-primary text-light'>
                   <tr>
                     <th>No</th>
                     <th>PurchaseID</th>
                     <th>Purchase_Name</th>
                     <th>Description</th>
                     <th>Purchase_Date</th>
                     <th>SupplierID</th>
                     <th>ResourceID</th>
                     
                     <th>Action</th>
                     </tr>
                 </thead> 
                 <tbody>";
         foreach ($purchaseList as $purchase) {
                    $tCount+=1;
         $output.="<tr>

                     <td>".$tCount."</td>

                     <td>".$purchase['PurchaseID']."</td>

                     <td>".$purchase['Purchase_Name']."</td>

                     <td>".$purchase['Description']."</td> 

                     <td>".$purchase['Purchase_Date']."</td> 

                     <td>".$purchase['SupplierID']."</td> 

                     <td>".$purchase['ResourceID']."</td> 

                     

                     <td>

                       <a href='#editModal' style='color:green' data-toggle='modal' 
                       class='editBtn' id='".$purchase['PurchaseID']."'>

                       <i class='fa fa-pencil'></i>

                       </a>

                       &nbsp; 

                       <a href='' style='color:red' class='deleteBtn' id='".$purchase['PurchaseID']."'>

                       <i class='fa fa-trash' ></i>

                       </a>

                     </td>

                 </tr>";
            }
         $output .= "</tbody> 
            </table>";
            echo $output;   
      }else{
         echo '<h3 class="text-center mt-5">No records found</h3>';
      }
   }


   // Edit Record  --> Binding Record 
   if (isset($_POST['editId'])) {
      $editId = $_POST['editId'];
      $row = $dbObj->getRecordById($editId);
      echo json_encode($row);
   }

   // Update Record
   if (isset($_POST['action']) && $_POST['action'] == "update") 
   {
      $id = $_POST['id'];

      $txtName = $_POST['txtName'];
      $txtDes = $_POST['txtDes'];
      $txtDate = $_POST['txtDate'];
      $txtSupplierID = $_POST['txtSupplierID'];
      $txtResourceID = $_POST['txtResourceID'];
      $txtPaymentVoucher = $_POST['txtPaymentVoucher'];

      $dbObj->updateRecord($id, $txtName, $txtDes, $txtDate, $txtSupplierID, $txtResourceID, $txtPaymentVoucher);
   }

    // Delete Record  

   if (isset($_POST['deleteBtn'])) 
   {
      $deleteBtn = $_POST['deleteBtn'];
      $dbObj->deleteRecord($deleteBtn);
   }


?>