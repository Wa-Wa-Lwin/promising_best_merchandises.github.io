<?php
   
   class Database 
   {
      private $servername = "localhost";
      private $username   = "root";
      private $password   = "";
      private $dbname = "pbm";
      public $con;
      public $supplierTable = "supplier"; 

      public function __construct()
      {
         try {
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);   
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }
 
      // Insert Record
      public function insertRecord($txtName, $txtDes, $txtPhone, $txtEmail/*, $FileName*/)

      {
         $sql = "INSERT INTO $this->supplierTable (Supplier_Name , Description, Phone_Number, Email) 
            VALUES('$txtName', '$txtDes', '$txtPhone', '$txtEmail')";

         $query = $this->con->query($sql);
         if ($query) {
            return true;
         }else{
            return false;
         }
      } 

      // Update Record
      public function updateRecord($id, $txtName, $txtDes, $txtPhone, $txtEmail)
      {
         $sql = "UPDATE $this->supplierTable SET 

         Supplier_Name = '$txtName',
         Description = '$txtDes',
         Phone_Number = '$txtPhone',
         Email = '$txtEmail'

         WHERE SupplierID = '$id'";

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
         $sql = "DELETE FROM $this->supplierTable WHERE SupplierID = '$id'";
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
         $sql = "SELECT * FROM $this->supplierTable";
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
         $query = "SELECT * FROM $this->supplierTable WHERE SupplierID = '$id'";
         $result = $this->con->query($query);
         if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
         }else{
            return false; 
         }
      } 

      public function totalRowCount(){
         $sql = "SELECT * FROM $this->supplierTable ";
         $query = $this->con->query($sql);
         $rowCount = $query->num_rows;
         return $rowCount;
      }

   }
?>