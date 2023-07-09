<?php
   // Include config.php file
   include_once('resource_config.php');

   $dbObj = new Database();

   // Insert Record   
   if (isset($_POST['action']) && $_POST['action'] == "insert") {

      $txtName = $_POST['txtName'];
      $txtDes = $_POST['txtDes'];
      $txtPrice = $_POST['txtPrice'];
      $txtAvaliableQuantity = $_POST['txtAvaliableQuantity'];

/*      //Image Upload ---------------------------------------------------------
            $Image1=$_FILES['Image']['name']; 
            $Folder="resource_image/";

            $FileName=$Folder . '_' . $Image1;  
            $copied=copy($_FILES['Image']['tmp_name'], $FileName);

            if(!$copied)
            {
                echo "<p> Image cannot upload!</p>";
                exit();
            }
      //Image Upload             ---------------------------------------------------------
*/

      $dbObj->insertRecord($txtName, $txtDes, $txtPrice , $txtAvaliableQuantity/*, $FileName*/);
   }

   // View record
   if (isset($_POST['action']) && $_POST['action'] == "view") 
   {
      $output = "";
      $tCount = 0;
      $resourceList = $dbObj->displayRecord();
// txtAvaliableQuantity txtPrice ResourceID  Resource_Name  Description Price Avaliable_Quantity  Photo 
      if ($dbObj->totalRowCount() > 0) {
         $output .="<table class='table table-hover'>
                 <thead class='bg-primary text-light'>
                   <tr>
                     <th>No</th>
                     <th>ResourceID</th>
                     <th>Resource_Name</th>
                     <th>Description</th>
                     <th>Price</th>
                     <th>Avaliable Quantity</th>
                     
                     <th>Action</th>                     
                     </tr>
                 </thead> 
                 <tbody>";
         foreach ($resourceList as $resource) {
                    $tCount+=1;
         $output.="<tr>

                     <td>".$tCount."</td>

                     <td>".$resource['ResourceID']."</td>

                     <td>".$resource['Resource_Name']."</td>

                     <td>".$resource['Description']."</td> 

                     <td>".$resource['Price']."</td> 

                     <td>".$resource['Avaliable_Quantity']."</td> 
     
                     <td>

                       <a href='#editModal' style='color:green' data-toggle='modal' 
                       class='editBtn' id='".$resource['ResourceID']."'>

                       <i class='fa fa-pencil'></i>

                       </a>

                       &nbsp; 

                       <a href='' style='color:red' class='deleteBtn' id='".$resource['ResourceID']."'>

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
      $txtPrice = $_POST['txtPrice'];
      $txtAvaliableQuantity = $_POST['txtAvaliableQuantity'];

      $dbObj->updateRecord($id, $txtName, $txtDes, $txtPrice, $txtAvaliableQuantity);
    }

    // Delete Record  

    if (isset($_POST['deleteBtn'])) 
    {
      $deleteBtn = $_POST['deleteBtn'];
      $dbObj->deleteRecord($deleteBtn);
    }


?>