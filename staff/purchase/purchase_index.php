<?php 

session_start();

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

<?php 
include('../header.php');
?>
<head>
    <title> Purchase </title>                      
</head>

<body>  

    <div class="card text-center">
        <h3> Purchase </h3>
    </div><br><br>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> New Purchase 
                </button>
            </div>
        </div><br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive" id="tblPurchase">
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
                    <h4 class="modal-title">New Purchase</h4>
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
                            <label for="txtName">Purchase Name</label>
                            <input type="text" class="form-control" name="txtName"  placeholder="Enter Purchase Name" required>
                        </div>

                        <div class="form-group">
                            <label for="txtDes">Description</label>
                            <textarea class="form-control" name="txtDes" rows="3" placeholder="Enter Description"></textarea>
                        </div>

                         <div class="form-group">
                            <label for="txtDate">Purchase Date</label>
                            <input type="date" class="form-control" name="txtDate" placeholder="Select Date">
                        </div>

                        <div class="form-group">
                            <label for="txtSupplierID">Supplier</label>
                            <select name="txtSupplierID" id="txtSupplierID" class="form-control" required>
                            <?php
                                $query="SELECT * FROM supplier";
                                $retrieve=mysqli_query($con,$query);
                                $count=mysqli_num_rows($retrieve);
                                for ($i=0; $i < $count; $i++){
                                    $array=mysqli_fetch_array($retrieve);
                                    $SupplierID=$array['SupplierID'];
                                    $SupplierName=$array['Supplier_Name'];
                                    echo "<option value='$SupplierID'>$SupplierName</option>";
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="txtResourceID">Resource</label>
                            <select name="txtResourceID" id="txtResourceID" class="form-control" required>
                            <?php
                                $query="SELECT * FROM resource";
                                $retrieve=mysqli_query($con,$query);
                                $count=mysqli_num_rows($retrieve);
                                for ($i=0; $i < $count; $i++){
                                    $array=mysqli_fetch_array($retrieve);
                                    $ResourceID=$array['ResourceID'];
                                    $ResourceName=$array['Resource_Name'];
                                    echo "<option value='$ResourceID'>$ResourceName</option>";
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="filePaymentVoucher">Payment Voucher</label>
                            <input type="file" name="filePaymentVoucher"/>
                        </div>

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
                    <h4 class="modal-title">Edit Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">

                    <form id="formEdit">

                        <input type="text" name="id" id="edit-form-id">

                        <div class="form-group">
                            <label for="txtName">Purchase Name</label>
                            <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Enter Purchase Name" required>
                        </div>

                        <div class="form-group">
                            <label for="txtDes">Description</label>
                            <textarea class="form-control" name="txtDes" rows="3" id="txtDes" placeholder="Enter Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="txtDate">Purchase Date</label>
                            <input type="date" class="form-control" name="txtDate" id="txtDate" placeholder="Select Date">
                        </div>

                        <div class="form-group">
                            <label for="txtSupplierID">Supplier</label>
                            <select name="txtSupplierID" id="txtSupplierID" class="form-control" required>

                            <?php
                                $query="SELECT * FROM supplier";
                                $retrieve=mysqli_query($con,$query);
                                $count=mysqli_num_rows($retrieve);
                                for ($i=0; $i < $count; $i++){
                                    $array=mysqli_fetch_array($retrieve);
                                    $SupplierID=$array['SupplierID'];
                                    $SupplierName=$array['Supplier_Name'];
                                    echo "<option value='$SupplierID'>$SupplierName</option>";
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="txtResourceID">Resource</label>
                            <select name="txtResourceID" id="txtResourceID" class="form-control" required>

                            <?php
                                $query="SELECT * FROM resource";
                                $retrieve=mysqli_query($con,$query);
                                $count=mysqli_num_rows($retrieve);
                                for ($i=0; $i < $count; $i++){
                                    $array=mysqli_fetch_array($retrieve);
                                    $ResourceID=$array['ResourceID'];
                                    $ResourceName=$array['Resource_Name'];
                                    echo "<option value='$ResourceID'>$ResourceName</option>";
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="filePaymentVoucher">Payment Voucher</label>
                            <input type="file" name="filePaymentVoucher" id="filePaymentVoucher"/>
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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {

            showAllPurchase();
            //View Record
            function showAllPurchase() 
            {
                $.ajax({
                    url: "purchase_action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        $("#tblPurchase").html(response);
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
                        url: "purchase_action.php",
                        type: "POST",
                        data: $("#formCreate").serialize() + "&action=insert",
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Created successfully!',
                            });
                            $("#addModal").modal('hide');

                            $("#formCreate")[0].reset();
                            showAllPurchase();
                            
                        }
                    });
                }
            });

            //Edit Record --> Binding Record
            $("body").on("click", ".editBtn", function(e) {
                e.preventDefault();
                var editId = $(this).attr('id');
                $.ajax({
                    url: "purchase_action.php",
                    type: "POST",
                    data: {
                        editId: editId
                    }, 
                    success: function(response) {
                        var data = JSON.parse(response);
                        $("#edit-form-id").val(data.PurchaseID);
                        $("#txtName").val(data.Purchase_Name);
                        $("#txtDes").val(data.Description);
                        $("#txtDate").val(data.Purchase_Date);
                        $('select[id="txtSupplierID"]').val(data.SupplierID);
                        $('select[id="txtResourceID"]').val(data.ResourceID);
                    }
                });
            });


            //Update Record
            $("#btnUpdate").click(function(e) {
                if ($("#formEdit")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "purchase_action.php",
                        type: "POST",
                        data: $("#formEdit").serialize() + "&action=update",
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated successfully!',
                            });
                            $("#editModal").modal('hide');
                            $("modal-backdrop fade hide");
                            $("#formEdit")[0].reset();
                            showAllPurchase();
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
                            url: "purchase_action.php",
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
                                showAllPurchase();
                            }
                        });
                    }
                })
            });
             // select

            
        });
    </script>
</body>



<?php
include('..\..\footer.php');
?>