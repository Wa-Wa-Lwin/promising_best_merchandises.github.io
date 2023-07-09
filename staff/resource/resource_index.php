<?php 

session_start();
include('../header.php');

class Database 
{
    private $servername = "localhost";
    private $username   = "root";
    private $password   = "";
    private $dbname = "PBM";
    public $con;
}

$servername="localhost";
$username="root";
$password="";
$dbname="PBM";

$con=mysqli_connect($servername,$username,$password,$dbname);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Resource </title>
</head>

<body>  

    <div class="card text-center">
        <h3> Resource </h3>
    </div><br><br>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> Add New Resource 
                </button>
            </div>
        </div><br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive" id="tblResource">
                    <h3 class="text-center text-success">Loading...</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Record  Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Resource</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">

                    <script>
                        function imageDisplay(pic){
                            var freader=new FileReader();
                            freader.onload=function(e){
                                document.getElementById("img").src=e.target.result;
                            };
                            freader.readAsDataURL(pic.files[0]);
                        }
                    </script>

                    <form id="formCreate">

                        <div class="form-group">
                            <label for="txtName">Resource Name</label>
                            <input type="text" class="form-control" name="txtName"  placeholder="Enter Resource Name" required>
                        </div>

                        <div class="form-group">
                            <label for="txtDes">Description</label>
                            <textarea class="form-control" name="txtDes" rows="3" placeholder="Enter Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="txtPrice">Price</label>
                            <textarea class="form-control" name="txtPrice" placeholder="Enter Price (MMK)"></textarea>
                        </div> 

                        <div class="form-group">
                            <label for="txtAvaliableQuantity">Avaliable Quantity </label>
                            <textarea class="form-control" name="txtAvaliableQuantity" rows="3" placeholder="Enter Avaliable Quantity"></textarea>
                        </div>

                        <!-- <div class="form-group">
                            <label for="Image1">Image </label>
                            <input type="file" name="Image" onchange="imageDisplay(this)" />
                            <img style="width: 100px; height: 100px;" id="img" >
                        </div> -->

                        <hr> 

                        <!-- Button --> 

                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success" id="submit">Post</button>
                            <button type="reset" class="btn btn-secondary">Clear</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>

                        <!-- Button End --> 
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Record  Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Resource</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">

                    <form id="fromEdit">

                        <input type="hidden" name="id" id="edit-form-id">

                        <div class="form-group">
                            <label for="txtName">Resource Name</label>
                            <input type="text" class="form-control" id="txtName" name="txtName"  required>
                        </div>

                        <div class="form-group">
                            <label for="txtDes">Description</label>
                            <textarea class="form-control" id="txtDes" name="txtDes" rows="3" ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="txtPrice">Price</label>
                            <textarea class="form-control" id="txtPrice" name="txtPrice" ></textarea>
                        </div> 

                        <div class="form-group">
                            <label for="txtAvaliableQuantity">Avaliable Quantity </label>
                            <textarea class="form-control" id="txtAvaliableQuantity" name="txtAvaliableQuantity" rows="3" ></textarea>
                        </div>

                        <hr>

                        <!-- Button --> 

                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-primary" id="btnUpdate">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                        </div>

                        <!-- Button End --> 

                    </form>

                </div>
            </div>
        </div>
    </div>

   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {

            showAllResource();
            //View Record
            function showAllResource() 
            {
                $.ajax({
                    url: "resource_action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        $("#tblResource").html(response);
                        $("table").DataTable({
                            order: [0, 'DESC']
                        });
                    }
                });
            }

            //Insert Record
            $("#submit").click(function(e) 
            {
                if ($("#formCreate")[0].checkValidity()) {
                    e.preventDefault();

                    $.ajax({
                        url: "resource_action.php",
                        type: "POST",
                        data: $("#formCreate").serialize() + "&action=insert",
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Created successfully!',
                            });
                            $("#addModal").modal('hide');
                            $("#formCreate")[0].reset();
                            showAllResource();
                            
                        }
                    });
                }
            });

            //Edit Record --> Binding Record
            $("body").on("click", ".editBtn", function(e) {
                e.preventDefault();
                var editId = $(this).attr('id');
                $.ajax({
                    url: "resource_action.php",
                    type: "POST",
                    data: {
                        editId: editId
                    }, 
                    success: function(response) {
                        var data = JSON.parse(response);
                        $("#edit-form-id").val(data.ResourceID);
                        $("#txtName").val(data.Resource_Name);
                        $("#txtDes").val(data.Description);
                        $("#txtPrice").val(data.Price);
                        $("#txtAvaliableQuantity").val(data.Avaliable_Quantity);
                        
                    }
                });
            });


            //Update Record
            $("#btnUpdate").click(function(e) {
                if ($("#fromEdit")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "resource_action.php",
                        type: "POST",
                        data: $("#fromEdit").serialize() + "&action=update",
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated successfully!',
                            });
                            $("#editModal").modal('hide');
                            $("#fromEdit")[0].reset();
                            showAllResource();
                        }
                    });
                }
            });

            //Delete Record
            $("body").on("click", ".deleteBtn", function(e) 
            {
                e.preventDefault();
                var tr = $(this).closest('tr');
                var deleteBtn = $(this).attr('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "resource_action.php",
                            type: "POST",
                            data: {
                                deleteBtn: deleteBtn
                            },
                            success: function(response) {
                                tr.css('background-color', '#ff6565');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Delete successfully!',
                                });
                                showAllResource();
                            }
                        });
                    }
                })
            });
            
        });
    </script>
</body>



<?php
include('..\..\footer.php');
?>