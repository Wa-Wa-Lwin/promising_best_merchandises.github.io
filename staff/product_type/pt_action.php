<?php
   // Include config.php file
   include_once('pt_config.php');

   $dbObj = new Database();

   // Insert Record   
   if (isset($_POST['action']) && $_POST['action'] == "insert") {

      $txtName = $_POST['txtName'];
      $txtDes = $_POST['txtDes'];
// txtName txtDes ProductTypeID Product_Type_Name Description
   
      $dbObj->insertRecord($txtName, $txtDes);
   }

   // View record
   if (isset($_POST['action']) && $_POST['action'] == "view") 
   {
      $output = "";
      $tCount = 0;
      $producttypeList = $dbObj->displayRecord();

      if ($dbObj->totalRowCount() > 0) {
         $output .="<table class='table table-hover'>
                 <thead class='bg-primary text-light'>
                   <tr>
                     <th>No</th>
                     <th>ProductTypeID</th>
                     <th>Product_Type_Name</th>
                     <th>Description</th>
                     <th>Action</th>
                     
                     </tr>
                 </thead> 
                 <tbody>";
         foreach ($producttypeList as $producttype) {
                    $tCount+=1;
         $output.="<tr>

                     <td>".$tCount."</td>

                     <td>".$producttype['ProductTypeID']."</td>

                     <td>".$producttype['Product_Type_Name']."</td>

                     <td>".$producttype['Description']."</td> 

                     <td>

                       <a href='#editModal' style='color:green' data-toggle='modal' 
                       class='editBtn' id='".$producttype['ProductTypeID']."'>

                       <i class='fa fa-pencil'></i>

                       </a>

                       &nbsp; 

                       <a href='' style='color:red' class='deleteBtn' id='".$producttype['ProductTypeID']."'>

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

      $dbObj->updateRecord($id, $txtName, $txtDes);

    }

    // Delete Record  

    if (isset($_POST['deleteBtn'])) 
    {
      $deleteBtn = $_POST['deleteBtn'];
      $dbObj->deleteRecord($deleteBtn);
    }


?>