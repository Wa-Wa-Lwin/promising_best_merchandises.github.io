<?php
   // Include config.php file
   include_once('config.php');

   $dbObj = new Database();

   // Insert Record   
   if (isset($_POST['action']) && $_POST['action'] == "insert") {

      $txtName = $_POST['txtName'];
      $txtDes = $_POST['txtDes'];
      $txtResourceID = $_POST['txtResourceID'];
 
      $dbObj->insertRecord($txtName, $txtDes, $txtResourceID);
   }

   // View record
   if (isset($_POST['action']) && $_POST['action'] == "view") 
   {
      $output = "";
      $tCount = 0;
      $printingtypeList = $dbObj->displayRecord();
// PrintingTypeID    Printing_Type_Name  Description ResourceID 
// txtName txtDes txtResourceID  
      if ($dbObj->totalRowCount() > 0) {
         $output .="<table class='table table-hover'>
                 <thead class='bg-primary text-light'>
                   <tr>
                     <th>No</th>
                     <th>PrintingTypeID</th>
                     <th>Printing_Type_Name</th>
                     <th>Description</th>
                     <th>ResourceID</th>
                     <th>Action</th>
                     
                     </tr>
                 </thead> 
                 <tbody>";
         foreach ($printingtypeList as $printingtype) {
                    $tCount+=1;
         $output.="<tr>

                     <td>".$tCount."</td>

                     <td>".$printingtype['PrintingTypeID']."</td>

                     <td>".$printingtype['Printing_Type_Name']."</td>

                     <td>".$printingtype['Description']."</td> 

                     <td>".$printingtype['ResourceID']."</td> 

                     <td>

                       <a href='#editModal' style='color:green' data-toggle='modal' 
                       class='editBtn' id='".$printingtype['PrintingTypeID']."'>

                       <i class='fa fa-pencil'></i>

                       </a>

                       &nbsp; 

                       <a href='' style='color:red' class='deleteBtn' id='".$printingtype['PrintingTypeID']."'>

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
      $txtResourceID = $_POST['txtResourceID'];   

      $dbObj->updateRecord($id, $txtName, $txtDes, $txtResourceID );

    }

    // Delete Record  

    if (isset($_POST['deleteBtn'])) 
    {
      $deleteBtn = $_POST['deleteBtn'];
      $dbObj->deleteRecord($deleteBtn);
    }


?>