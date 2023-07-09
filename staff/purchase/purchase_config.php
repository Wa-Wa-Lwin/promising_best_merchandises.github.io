<?php
   
   class Database 
   {
      private $servername = "localhost";
      private $username   = "root";
      private $password   = "";
      private $dbname = "pbm";
      public $con;
      public $purchaseTable = "purchase"; 

      public function __construct()
      {
         try {
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);   
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }
 
      // Insert Record
      public function insertRecord($txtName, $txtDes, $txtDate, $txtSupplierID, $txtResourceID, $txtPaymentVoucher)
      {
         $sql = "INSERT INTO $this->purchaseTable 
                  (Purchase_Name, Description, Purchase_Date, SupplierID, ResourceID, Payment_Voucher)
                  VALUES('$txtName', '$txtDes', '$txtDate', '$txtSupplierID', '$txtResourceID', '$txtPaymentVoucher')";

         $query = $this->con->query($sql);
         if ($query) {
            return true;
         }else{
            return false;
         }
      } 

      // Update Record
      public function updateRecord($id, $txtName, $txtDes, $txtDate, $txtSupplierID, $txtResourceID, $txtPaymentVoucher)
      {
         $sql = "UPDATE $this->purchaseTable SET 

         Purchase_Name = '$txtName',
         Description = '$txtDes',
         Purchase_Date = '$txtDate',
         SupplierID = '$txtSupplierID',
         ResourceID = '$txtResourceID',
         Payment_Voucher = '$txtPaymentVoucher'

         WHERE PurchaseID = '$id'";

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
         $sql = "DELETE FROM $this->purchaseTable WHERE PurchaseID = '$id'";
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
         $sql = "SELECT * FROM $this->purchaseTable";
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
         $query = "SELECT * FROM $this->purchaseTable WHERE PurchaseID = '$id'";
         $result = $this->con->query($query);
         if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
         }else{
            return false; 
         }
      } 

      public function totalRowCount(){
         $sql = "SELECT * FROM $this->purchaseTable";
         $query = $this->con->query($sql);
         $rowCount = $query->num_rows;
         return $rowCount;
      }
   }
?>