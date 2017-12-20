<?php

use pf\arr\PFarr;
use Phpml\FeatureExtraction\TfIdfTransformer;

require_once 'vendor/autoload.php';

/**
 * 特征提取
 */
$samples = [
    [0 => 1, 1 => 1, 2 => 2, 3 => 1, 4 => 0, 5 => 0],
    [0 => 1, 1 => 1, 2 => 0, 3 => 0, 4 => 2, 5 => 3],
];


$transformer = new TfIdfTransformer($samples);
$transformer->transform($samples);
PFarr::dd($samples);
