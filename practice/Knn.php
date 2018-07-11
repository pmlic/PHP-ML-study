<?php

use pf\arr\PFarr;
use Phpml\Classification\KNearestNeighbors;

require './vendor/autoload.php';

$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new KNearestNeighbors();
$classifier->train($samples, $labels);
$data = $classifier->predict([3, 2]);

PFarr::dd($data);