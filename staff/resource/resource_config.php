<?php
   
   class Database 
   {
      private $servername = "localhost";
      private $username   = "root";
      private $password   = "";
      private $dbname = "pbm";
      public $con;
      public $resourceTable = "resource"; 

      public function __construct()
      {
         try {
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);   
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }
 
      // Insert Record
      public function insertRecord($txtName, $txtDes, $txtPrice, $txtAvaliableQuantity/*, $FileName*/)

      {
         $sql = "INSERT INTO $this->resourceTable (Resource_Name , Description, Price, Avaliable_Quantity/*, Photo */) 
            VALUES('$txtName', '$txtDes', '$txtPrice', '$txtAvaliableQuantity'/*, '$FileName'*/)";

         $query = $this->con->query($sql);
         if ($query) {
            return true;
         }else{
            return false;
         }
      } 

// txtAvaliableQuantity txtPrice ResourceID  Resource_Name  Description Price Avaliable_Quantity  Photo 

      // Update Record
      public function updateRecord($id, $txtName, $txtDes, $txtPrice, $txtAvaliableQuantity)
      {
         $sql = "UPDATE $this->resourceTable SET 

         Resource_Name = '$txtName',
         Description = '$txtDes',
         Price = '$txtPrice',
         Avaliable_Quantity = '$txtAvaliableQuantity'

         WHERE ResourceID = '$id'";

         $query = $this->con->query($sql);
         if ($query) {
            return true;
         }else{
            return false;
         }
      }
 

      // Delete Record
      public function deleteRecord($id)
      {
         $sql = "DELETE FROM $this->resourceTable WHERE ResourceID = '$id'";
         $query = $this->con->query($sql);
         if ($query) {
            return true;
         }else{
            return false;
         }
      }
 
      // Fetch records 
      public function displayRecord()
      {
         $sql = "SELECT * FROM $this->resourceTable";
         $query = $this->con->query($sql);
         $data = array();
         if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
               $data[] = $row;
            }
            return $data;
         }else{
            return false;
         }
      }

      // Fetch single Record for edit
      public function getRecordById($id)
      {
         $query = "SELECT * FROM $this->resourceTable WHERE ResourceID = '$id'";
         $result = $this->con->query($query);
         if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
         }else{
            return false; 
         }
      } 

      public function totalRowCount(){
         $sql = "SELECT * FROM $this->resourceTable ";
         $query = $this->con->query($sql);
         $rowCount = $query->num_rows;
         return $rowCount;
      }

   }
?>