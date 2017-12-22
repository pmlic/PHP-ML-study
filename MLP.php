<?php

use pf\arr\PFarr;
use Phpml\Classification\MLPClassifier;

require './vendor/autoload.php';

$network = new MLPClassifier(5, [3, 2], ['a', 'b', 4]);
$network->partialTrain(
    [[1, 0, 0, 0, 0], [0, 1, 0, 0, 0]],
    ['a', 'b']
);

//PFarr::dd(['a', $network->predict([1, 0, 0, 0, 0])]);
PFarr::dd($network->predict([1, 0, 0, 0, 0]));



$network->partialTrain(
    [[0, 0, 1, 1, 0], [1, 1, 1, 1, 1], [0, 0, 0, 0, 0]],
    ['a', 'a', 4]
);
$this->assertEquals('a', $network->predict([0, 0, 1, 1, 0]));
$this->assertEquals('a', $network->predict([1, 1, 1, 1, 1]));
$this->assertEquals(4, $network->predict([0, 0, 0, 0, 0]));