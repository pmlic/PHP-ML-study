<?php

require './vendor/autoload.php';

use pf\arr\PFarr;
use Phpml\Preprocessing\Imputer;
use Phpml\Preprocessing\Imputer\Strategy\MeanStrategy;

$data = [
    [1, null, 3, 4],
    [4, 3, 2, 1],
    [null, 6, 7, 8],
    [8, 7, null, 5],
];

$imputer = new Imputer(null, new MeanStrategy(), Imputer::AXIS_COLUMN,$data);
$imputer->transform($data);

PFarr::dd($data);