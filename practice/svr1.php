<?php

use pf\arr\PFarr;
use Phpml\SupportVectorMachine\Kernel;

require './vendor/autoload.php';
$samples = array(
    array(-1, 1 => 0.43, 3 => 10, 9284 => 0.2),
    array(1, 1 => 1, 5 => 0.01, 94 => 0.11),
    array(1, 1 => 2, 5 => 0.01, 94 => 0.11),
    array(1, 1 => 0.22, 5 => 0.01, 94 => 0.11),
    array(1, 1 => 0.22, 5 => 0.01, 94 => 0.11),
    array(1, 1 => 0.22, 5 => 0.01, 94 => 0.11),
    array(1, 1 => 0.22, 5 => 0.01, 94 => 0.11),
);

$svm  = new \Phpml\Regression\SVR(Kernel::LINEAR);
$labels=["January","February","March","April","May","June","July"];
$svm->train($samples,[1, -1]);

$predict = [
  [65,59,90,81],
  [59,90,81,56,10,1,-10],
  [81,56],
  [55,40],
  [55,40],
  [65],
  [45,2,100,1,230],
];

$data = [];
foreach ($predict as $value) {
    $data[] = $svm->predict($value);
}

$labels = json_encode($labels);
$data = json_encode($data);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
</head>
<body>
<canvas id="myChart" width="800" height="400"></canvas>
<script>
    var data = {
        labels : <?php echo $labels;?>,
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                data : <?php echo $data;?>
            }
        ]
    }
    var ctx = document.getElementById("myChart").getContext("2d");
    var myNewChart = new Chart(ctx).Line(data);
</script>
</body>
</html>
