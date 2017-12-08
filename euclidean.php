<?php
use Phpml\Math\Distance\Chebyshev;
use Phpml\Math\Distance\Euclidean;
use Phpml\Math\Distance\Manhattan;

require './vendor/autoload.php';
echo '<pre>';
/**
 * 欧几里德距离
 */
$a = [4, 6];
$b = [2, 5];

$euclidean = new Euclidean();
$data = $euclidean->distance($a, $b);
echo $data.'<br/>';
// return 2.2360679774998


/**
 * 曼哈顿距离
 */
$a1 = [4, 6];
$b1 = [2, 5];

$manhattan = new Manhattan();
$data_a = $manhattan->distance($a1, $b1);

echo $data_a.'<br>';

/**
 * 切夫雪比距离
 */

$a2 = [4, 6];
$b2 = [2, 5];

$chebyshev = new Chebyshev();
$data_b = $chebyshev->distance($a2, $b2);

echo $data_b.'<br>';
// return 2
