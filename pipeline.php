<?php
use Phpml\Classification\SVC;
use Phpml\Pipeline;
use Phpml\Preprocessing\Imputer;
use Phpml\Preprocessing\Normalizer;
use Phpml\Preprocessing\Imputer\Strategy\MostFrequentStrategy;

require './vendor/autoload.php';

$transformers = [
    new Imputer(null, new MostFrequentStrategy()),
    new Normalizer(),
];
$estimator = new SVC();

$samples = [
    [1, -1, 2],
    [2, 0, null],
    [null, 1, -1],
];

$targets = [
    4,
    1,
    4,
];

$pipeline = new Pipeline($transformers, $estimator);
$pipeline->train($samples, $targets);

$predicted = $pipeline->predict([[0, 0, 0]]);
var_dump($predicted);