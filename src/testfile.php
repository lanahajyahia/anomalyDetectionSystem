<?php include("server.php");
$table = 'Detected_Attacks';
function get_total_attacks($type = null)
{
    global $connection, $table;
    $sql = "SELECT * FROM $table WHERE type='$type'";
    $result = $connection->query($sql);
    /* determine number of rows result set */
    if (!empty($result) && $result->num_rows > 0) {
        return $result->num_rows;
    } else {
        return 0;
    }
}


?>
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["SQLI", "STORED", "REFLECTED"];
var yValues = [<?php echo get_total_attacks("sqli");?>, <?php echo get_total_attacks("xss stored");?>, <?php echo get_total_attacks("xss reflected");?>];
var barColors = [
  "#00aba9",
  "#2b5797",
  "#e8c3b9"
  
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Total amount of attacks"
    }
  }
});
</script>

</body>
</html>
