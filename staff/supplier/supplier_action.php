<?php
   // Include config.php file
   include_once('supplier_config.php');

   $dbObj = new Database();

   // Insert Record   
   if (isset($_POST['action']) && $_POST['action'] == "insert") {

      $txtName = $_POST['txtName'];
      $txtDes = $_POST['txtDes'];
      $txtPhone = $_POST['txtPhone'];
      $txtEmail = $_POST['txtEmail'];
 

      $dbObj->insertRecord($txtName, $txtDes, $txtPhone , $txtEmail/*, $FileName*/);
   }

   // View record
   if (isset($_POST['action']) && $_POST['action'] == "view") 
   {
      $output = "";
      $tCount = 0;
      $supplierList = $dbObj->displayRecord();

      if ($dbObj->totalRowCount() > 0) {
         $output .="<table class='table table-hover'>
                 <thead class='bg-primary text-light'>
                   <tr>
                     <th>No</th>
                     <th>SupplierID</th>
                     <th>Supplier_Name</th>
                     <th>Description</th>
                     <th>Phone</th>
                     <th>Email</th>
                     
                     <th>Action</th>                     
                     </tr>
                 </thead> 
                 <tbody>";
         foreach ($supplierList as $supplier) {
                    $tCount+=1;
         $output.="<tr>

                     <td>".$tCount."</td>

                     <td>".$supplier['SupplierID']."</td>

                     <td>".$supplier['Supplier_Name']."</td>

                     <td>".$supplier['Description']."</td> 

                     <td>".$supplier['Phone_Number']."</td> 

                     <td>".$supplier['Email']."</td> 
 
     
                     <td>

                       <a href='#editModal' style='color:green' data-toggle='modal' 
                       class='editBtn' id='".$supplier['SupplierID']."'>

                       <i class='fa fa-pencil'></i>

                       </a>

                       &nbsp; 

                       <a href='' style='color:red' class='deleteBtn' id='".$supplier['SupplierID']."'>

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
      $txtPhone = $_POST['txtPhone'];
      $txtEmail = $_POST['txtEmail'];

      $dbObj->updateRecord($id, $txtName, $txtDes, $txtPhone, $txtEmail);
   }

    // Delete Record  

   if (isset($_POST['deleteBtn'])) 
   {
      $deleteBtn = $_POST['deleteBtn'];
      $dbObj->deleteRecord($deleteBtn);
   }


?>