<?php
   
   class Database 
   {
      private $servername = "localhost";
      private $username   = "root";
      private $password   = "";
      private $dbname = "pbm";
      public $con;
      public $producttypeTable = "product_type"; 

      public function __construct()
      {
         try {
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);   
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }


      // Insert Record
      public function insertRecord($txtName, $txtDes)

      {
         $sql = "INSERT INTO $this->producttypeTable (Product_Type_Name , Description) VALUES('$txtName', '$txtDes')";

         $query = $this->con->query($sql);
         if ($query) {
            return true;
         }else{
            return false;
         }
      } 

// txtName txtDes ProductTypeID Product_Type_Name Description

      // Update Record
      public function updateRecord($id, $txtName, $txtDes)
      {
         $sql = "UPDATE $this->producttypeTable SET 

         Product_Type_Name = '$txtName',
         Description = '$txtDes'

         WHERE ProductTypeID = '$id'";

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
         $sql = "DELETE FROM $this->producttypeTable WHERE ProductTypeID = '$id'";
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
         $sql = "SELECT * FROM $this->producttypeTable";
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
         $query = "SELECT * FROM $this->producttypeTable WHERE ProductTypeID = '$id'";
         $result = $this->con->query($query);
         if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
         }else{
            return false;
         }
      }


      public function totalRowCount(){
         $sql = "SELECT * FROM $this->producttypeTable ";
         $query = $this->con->query($sql);
         $rowCount = $query->num_rows;
         return $rowCount;
      }

   }
?>