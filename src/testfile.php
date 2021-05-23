<?php include("server.php");
$table = 'Detected_Attacks';
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
    // $row_cnt = $result->num_rows;
    // if ($row_cnt != 0) {
    //     return $row_cnt;
    // } else {
    //     return 0;
    // }
}


?>
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<body>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    <p> red - xss reflected , green - sqli , blue - xss stored </p> 

    <script>
        var xValues = ['Jan & Feb', 'Mar & Apr', 'May & Jun', 'Jul & Aug', 'Sep & Oct', 'Nov & Dec'];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [<?php echo get_attacks("01","02", "xss reflected"); ?>, <?php echo get_attacks("03","04", "xss reflected"); ?>, <?php echo get_attacks("05","06", "xss reflected"); ?>, <?php echo get_attacks("07","08", "xss reflected"); ?>, <?php echo get_attacks("09","10", "xss reflected"); ?>, <?php echo get_attacks("11","12", "xss reflected"); ?>],
                    borderColor: "red",
                    fill: false
                }, {
                    data: [<?php echo get_attacks("01","02", "sqli"); ?>, <?php echo get_attacks("03","04", "sqli"); ?>, <?php echo get_attacks("05","06", "sqli"); ?>, <?php echo get_attacks("07","08", "sqli"); ?>, <?php echo get_attacks("09","10", "sqli"); ?>, <?php echo get_attacks("11","12", "sqli"); ?>],
                    borderColor: "green",
                    fill: false
                }, {
                    data: [<?php echo get_attacks("01","02", "xss stored"); ?>, <?php echo get_attacks("03","04", "xss stored"); ?>, <?php echo get_attacks("05","06", "xss stored"); ?>, <?php echo get_attacks("07","08", "xss stored"); ?>, <?php echo get_attacks("09","10", "xss stored"); ?>, <?php echo get_attacks("11","12", "xss stored"); ?>],
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