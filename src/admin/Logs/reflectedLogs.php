<?php 
require("../../core.php");
require("../../server.php"); 


if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = 'Users';
    $query = $connection->query("DELETE FROM `$table` WHERE id='$id'");
}
if (isset($_GET['delete-all'])) {
    $table = 'Users';
    $query = $connection->query("DELETE FROM `$table`");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reflected XSS</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 <style>
 ul {
    background-color: transparent !important;}
    .btn.btn-flat {
    border-radius: 19px;}
 </style>
</head>

<body id="page-top">
<?php include("../../navbar.php"); ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

     
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" style="padding:10px;">Reflected Cross Site Scripting Logs</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Reflected XSS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
										<tr>
								          <th><i class="fas fa-list-ol"></i> ID</th>
						                  <th><i class="fas fa-calendar"></i> Date</th>
										  <th><i class="fas fa-globe"></i> Time</th>
										  <th><i class="fas fa-desktop"></i> HTTP header</th>
										  <th><i class="fas fa-cog"></i> HTTP method</th>
										  <!-- <th><i class="fas fa-map"></i> injection</th> -->
						                  <th><i class="fas fa-bomb"></i> Description</th>
										  <!-- <th><i class="fas fa-cog"></i> Actions</th> -->
                                          <th><i class="fas fa-map"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = 'XSS_injections';
$sql   = $connection->query("SELECT id, date, time, http_url, http_method, description FROM `$table` WHERE type='reflected'");
while ($row = mysqli_fetch_assoc($sql)) {
    echo '
										<tr>
                                          <td>' . $row['id'] . '</td>
						                  <td>' . $row['date'] . '</td>
                                          <td>' . $row['time'] . '</td>
						                  <td>' . $row['http_url'] . '</td>
										  <td>' . $row['http_method'] . '</td>
                                          <td>' . $row['description'] . '</td>
                                          <td> 
                                          <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fas fa-edit"></i> Details</a> 
                                          <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-danger"><i class="fas fa-trash"></i> Delete</a>

                                          </td>
								
										</tr>
    ';
}
?> 
									</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                <a href="delete-all.php" class="btn btn-success pull-right btn-danger" title="Delete all logs"><i class="fas fa-trash"></i> Delete All</a>

                <a href="exportData.php" class="btn btn-success pull-right">Export to excel</a>
                </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Anomaly Detection 2020-2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<!-- 
     Logout Modal
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>