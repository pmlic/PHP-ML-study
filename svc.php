<?php

use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

require_once 'vendor/autoload.php';

$samples = [[1,2], [4,3], [2,4], [3,5], [4,6], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];
$classifier = new SVC(Kernel::LINEAR, $cost = 1000);
$train = $classifier->train($samples, $labels);
$pre_1 = $classifier->predict([3, 2]);
// return 'b'
$pre_2 = $classifier->predict([[3, 2], [1, 5]]);
// return ['b', 'a']
\pf\arr\PFarr::dd($pre_2);