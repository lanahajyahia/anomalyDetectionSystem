<?php
session_start();
include('includes/header.php');
include('../server.php');
require_once("../exportData.php");

unset($_SESSION["captcha-show"]);

$table = "Detected_Attacks";
function get_attacks($month1, $month2, $type = null)
{
    global $connection, $table;
    $count_amount = 0;
    $sql = "SELECT date FROM $table WHERE type='$type'";
    $result = $connection->query($sql);
    /* determine number of rows result set */
    if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $month_str = $row['date'];
            if (substr($month_str, 5, 2) == $month1 || substr($month_str, 5, 2) == $month2) {
                // echo substr($month_str, 5, 2) ;
                $count_amount++;
            }
        }
    }
    return $count_amount;
}
function get_attack_number_today($type)
{
    global $connection, $table;
    $date = date("Y-m-d") . "";
    // echo $date;
    $sql = "SELECT * FROM $table WHERE type='$type' and date='$date'";
    $result = $connection->query($sql);
    /* determine number of rows result set */
    if (!empty($result) && $result->num_rows > 0) {
        return $result->num_rows;
    } else {
        return 0;
    }
}
if (isset($_GET['export'])) {
    exportAttack($table);
    exit();
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
                <a href="?export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate report for all attacks</a>
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
                                        echo get_attack_number_today(htmlspecialchars("sqli")) . " detected today";
                                        ?>
                                    </div>

                                </div>

                                <div class="col-auto">

                                    <i class="fas fa-exclamation-triangle" style='font-size:36px'></i>

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
                                        echo get_attack_number_today(htmlspecialchars("xss reflected")) . " detected today";
                                        ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class='fas fa-skull-crossbones' style='font-size:36px'></i>
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
                                                echo get_attack_number_today(htmlspecialchars("stored")) . " detected today";
                                                ?></div>
                                        </div>
                                        <div class="col">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class='fas fa-radiation-alt' style='font-size:36px'></i>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo htmlspecialchars('Logs\storedLogs.php'); ?>" class="small-box-footer" style="align-self: center;">View All Logs </i></a>

                    </div>
                </div>


            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4" style="align-items:center;">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

                        <!-- <body> -->
                            <canvas id="myChart" style="width:80%;max-width:800%"></canvas>
                            <p> red - xss reflected , green - sqli , blue - xss stored </p>

                            <script>
                                var xValues = ['Jan & Feb', 'Mar & Apr', 'May & Jun', 'Jul & Aug', 'Sep & Oct', 'Nov & Dec'];

                                new Chart("myChart", {
                                    type: "line",
                                    data: {
                                        labels: xValues,
                                        datasets: [{
                                            data: [<?php echo get_attacks("01", "02", "xss reflected"); ?>, <?php echo get_attacks("03", "04", "xss reflected"); ?>, <?php echo get_attacks("05", "06", "xss reflected"); ?>, <?php echo get_attacks("07", "08", "xss reflected"); ?>, <?php echo get_attacks("09", "10", "xss reflected"); ?>, <?php echo get_attacks("11", "12", "xss reflected"); ?>],
                                            borderColor: "red",
                                            fill: false
                                        }, {
                                            data: [<?php echo get_attacks("01", "02", "sqli"); ?>, <?php echo get_attacks("03", "04", "sqli"); ?>, <?php echo get_attacks("05", "06", "sqli"); ?>, <?php echo get_attacks("07", "08", "sqli"); ?>, <?php echo get_attacks("09", "10", "sqli"); ?>, <?php echo get_attacks("11", "12", "sqli"); ?>],
                                            borderColor: "green",
                                            fill: false
                                        }, {
                                            data: [<?php echo get_attacks("01", "02", "xss stored"); ?>, <?php echo get_attacks("03", "04", "xss stored"); ?>, <?php echo get_attacks("05", "06", "xss stored"); ?>, <?php echo get_attacks("07", "08", "xss stored"); ?>, <?php echo get_attacks("09", "10", "xss stored"); ?>, <?php echo get_attacks("11", "12", "xss stored"); ?>],
                                            borderColor: "blue",
                                            fill: false
                                        }]
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        }
                                    }
                                });
                            </script>
                    </div>

                    <!-- Card Body -->
                </div>
            </div>
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php
    include('includes/scripts.php');
    include('includes/footer.php'); ?>