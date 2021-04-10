<?php
require("../core.php");
include("../navbar.php");
require("../server.php");
// if (isset($_GET['delete-id'])) {
//     $id    = (int) $_GET["delete-id"];
//     $table = $prefix . 'logs';
//     $query = $mysqli->query("DELETE FROM `$table` WHERE id='$id'");
// }

// if (isset($_GET['delete-all'])) {
//     $table = $prefix . 'logs';
//     $query = $mysqli->query("DELETE FROM `$table` WHERE type='SQLi'");
// }
?>
<div class="content-wrapper"  style="margin-left: 0px !important;">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header" style="padding-bottom: 0px !important;">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-align-justify"></i> SQL Injection Logs</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <!-- <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li> -->
        		        <li class="breadcrumb-item active">SQL Injection Logs</li>
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
							<h3 class="card-title">Reports</h3>
						</div>
						<div class="card-body">
                                    
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
										</tr>
									</thead>
									<tbody>
<?php
$table = 'SQL_injections';
$sql   = $connection->query("SELECT id, date, time, http_url, http_method, description FROM `$table` WHERE type='sqli'");
while ($row = mysqli_fetch_assoc($sql)) {
    echo '
										<tr>
                                          <td>' . $row['id'] . '</td>
						                  <td>' . $row['date'] . '</td>
                                          <td>' . $row['time'] . '</td>
						                  <td>' . $row['http_url'] . '</td>
										  <td>' . $row['http_method'] . '</td>
                                          <td>' . $row['description'] . '</td>
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
                    
				</div>
				</div>
				<!--===================================================-->
				<!--End page content-->

			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
</div>
<script>
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
</script>    
<?php
include("../footer.php");
?>