<?php

use pf\arr\PFarr;
use Phpml\Math\Distance\Euclidean;

require './vendor/autoload.php';

$a = [4, 6];
$b = [2, 5];

$euclidean = new Euclidean();
$data = $euclidean->distance($a, $b);
PFarr::dd($data);
// return 2.2360679774998