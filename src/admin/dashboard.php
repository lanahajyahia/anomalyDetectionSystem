<?php
session_start();
include('includes/header.php');
include('../server.php');

define("INJECTION_TABLE", "Detected_Attacks");


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
            <div class="row" style="justify-content: center;">
                <!-- SQLi -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        SQLi attacks</div>
                                    <div class="h6 mb-0 text-gray-800">
                                        <?php
                                        echo get_attack_number(htmlspecialchars(INJECTION_TABLE), htmlspecialchars("sqli")). " detected today";
                                        ?>
                                    </div>

                                </div>

                                <div class="col-auto">

                                    <i class="fas fa-broom fa-2x text-gray-300"></i>

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
                                    <div class="h6 mb-0  text-gray-800">
                                        <?php
                                        echo get_attack_number(htmlspecialchars(INJECTION_TABLE), htmlspecialchars("reflected")). " detected today";
                                        ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-car-crash fa-2x text-gray-300"></i>
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
                                            <div class="h6 mb-0 mr-3 text-gray-800">
                                                <?php
                                                echo get_attack_number(htmlspecialchars(INJECTION_TABLE), htmlspecialchars("stored")) . " detected today";
                                                ?></div>
                                        </div>
                                        <div class="col">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo htmlspecialchars('Logs\storedLogs.php'); ?>" class="small-box-footer" style="align-self: center;">View All Logs </i></a>

                    </div>
                </div>

                <!-- CSRF -->
                <div class="col-xl-3 col-md-6 mb-4" style="display:none">
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

            <div class="row" style="justify-content:center">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


                        <canvas id="myChart" style="width:80%;"></canvas>

                        <script>
                            var xValues = ["Reflected XSS", "Stored XSS", "SQLi"];
                            // var reflected = 
                            // console.log(reflected);
                            var yValues = [500, <?php echo get_attack_number(htmlspecialchars(INJECTION_TABLE), htmlspecialchars("stored")); ?>, <?php echo get_attack_number(htmlspecialchars(INJECTION_TABLE), htmlspecialchars("sqli")); ?>];
                            var barColors = ["red", "green", "blue"];

                            new Chart("myChart", {
                                type: "bar",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: barColors,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    },
                                    title: {
                                        display: true,
                                        text: "Overall Attacks Detected"
                                    }
                                }
                            });
                        </script>
                    </div>

                    <!-- Card Body -->



                </div>
            </div>






        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php
    include('includes/scripts.php');
    include('includes/footer.php'); ?>