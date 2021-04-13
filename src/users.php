<?php
require("core.php");
include("navbar.php");
require("server.php");

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
<div class="content-wrapper"  style="margin-left: 0px !important;">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header" style="padding-bottom: 0px !important;">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-align-justify"></i> System Users</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <!-- <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li> -->
        		        <li class="breadcrumb-item active">Users</li>
        		      </ol>
        		    </div>
        		  </div>
    			</div>
            </div>

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">

                <div class="row">
				<div class="col-md-12">
                    
				    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Accounts</h3>
						</div>
						<div class="card-body">

                                    
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
								          <th><i class="fas"></i> ID</th>
						                  <th><i class="fas"></i>Name</th>
										  <th><i class="fas"></i> Email</th>
										  <th><i class="fas"></i> Username</th>
                                          <th><i class="fas"></i> Type</th>
										  <th><i class="fas"></i> Account Creation Time</th>
							
										</tr>
									</thead>
									<tbody>
<?php
$table = 'Users';
$sql   = $connection->query("SELECT id, firstname,lastname, email, username,user_type, reg_date FROM `$table`");
while ($row = mysqli_fetch_assoc($sql)) {
    echo '
										<tr>
                                          <td>' . $row['id'] . '</td>
						                  <td>' . $row['firstname'] . " " . $row['lastname'] . '</td>
                                          <td>' . $row['email'] . '</td>
						                  <td>' . $row['username'] . '</td>
										  <td>' . $row['user_type'] . '</td>
                                          <td>' . $row['reg_date'] . '</td>		
										  <td>
                                          <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                          <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-danger"><i class="fas fa-trash"></i> Delete</a>
										  </td>
						
										</tr>
    ';
}
?> 
									</tbody>
								    </table>

                        </div>
							 <div class="panel-heading">
                <a href="?delete-all" class="btn btn-success pull-right btn-danger" title="Delete all logs"><i class="fas fa-trash"></i> Delete All</a>

                <a href="exportData.php" class="btn btn-success pull-right">Export to excel</a>
                </div>
                     </div>
				
                </div>
				
				<div class="col-md-3">
				     <div class="card">
						<div class="card-header">
							<h3 class="card-title">Add User</h3>
						</div>
				        <div class="card-body">
						<form class="form-horizontal" action="" method="post">
                               <div class="form-group">
									 <label class="control-label">Username: </label>
									 <div class="col-sm-12">
								           <input type="text" name="username" class="form-control" required>
									 </div>
							   </div>
							   <div class="form-group">
									 <label class="control-label">Email: </label>
									 <div class="col-sm-12">
								           <input type="email" name="email" class="form-control" required>
									 </div>
							   </div>
                               <div class="form-group">
									<label class="control-label">Password: </label>
									 <div class="col-sm-12">
										   <input type="password" name="password" class="form-control" required>
								     </div>
								</div>
								<div class="form-group">
									<label class="control-label">Password 2: </label>
									 <div class="col-sm-12">
										   <input type="password2" name="password2" class="form-control" required>
								     </div>
								</div>
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-primary" name="add" type="submit">Add</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>

                
				</div>
                    
				</div>
				</div>
				<!--===================================================-->
				<!--End page content-->

			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
</div>
<?php
include("footer.php");
?>
<!-- <script>
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
        "order": [[ 0, "desc" ]],
		"language": {
			"paginate": {
			  "previous": '<i class="fas fa-angle-left"></i>',
			  "next": '<i class="fas fa-angle-right"></i>'
			}
		}
	} );
} );
</script>     -->
