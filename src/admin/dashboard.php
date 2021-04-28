<?php
session_start();
include('includes/header.php');
include('../server.php');

define("XSS_TABLE", "XSS_injections");
define("SQLI_TABLE", "SQL_injections");


function get_attack_number($table, $type = null)
{
    global $connection;
    $result = $connection->query("SELECT * FROM $table WHERE type='$type'");
    /* determine number of rows result set */
    $row_cnt = $result->num_rows;
    if ($row_cnt != 0) {
        return $row_cnt;
    } else {
        return 0;
    }
}
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include("../navbar.php"); ?>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="padding-top: 1em; padding-left: 0.5em;">Dashboard</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- SQLi -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        SQLi attacks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        echo get_attack_number(htmlspecialchars(SQLI_TABLE), htmlspecialchars("sqli"));
                                        ?>
                                    </div>

                                </div>

                                <div class="col-auto">

                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                        <a href="<?php echo htmlspecialchars('Logs\sqliLogs.php'); ?>" class="small-box-footer" style="align-self: center;">View All Logs </i></a>

                    </div>
                </div>

                <!-- XSS Reflected -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Reflected XSS attacks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        echo get_attack_number(htmlspecialchars(XSS_TABLE), htmlspecialchars("reflected"));
                                        ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo htmlspecialchars('Logs\reflectedLogs.php'); ?>" class="small-box-footer" style="align-self: center;">View All Logs </i></a>

                    </div>
                </div>

                <!-- Stored XSS -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Stored xss attacks
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?php
                                                echo get_attack_number(htmlspecialchars(XSS_TABLE), htmlspecialchars("stored"));
                                                ?></div>
                                        </div>
                                        <div class="col">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo htmlspecialchars('Logs\storedLogs.php'); ?>" class="small-box-footer" style="align-self: center;">View All Logs </i></a>

                    </div>
                </div>

                <!-- CSRF -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        CSRF attacks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo htmlspecialchars('Logs\csrfLogs.php'); ?>" class="small-box-footer" style="align-self: center;">View All Logs </i></a>

                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Overall Injections</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> XSS
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> SQLi
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> CSRF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php
    include('includes/scripts.php');
    include('includes/footer.php'); ?>