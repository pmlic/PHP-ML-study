<?php


use pf\arr\PFarr;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Dataset\ArrayDataset;
use Phpml\Dataset\Demo\WineDataset;
use Phpml\Metric\Accuracy;
use Phpml\Regression\SVR;
use Phpml\SupportVectorMachine\Kernel;

require './vendor/autoload.php';

$dataset = new WineDataset();
$split = new StratifiedRandomSplit($dataset, 0.3);

//随机取得训练数据
echo '<pre>';
//print_r($split->getTrainSamples()); //训练的数据
//print_r($split->getTrainLabels()); //训练的标记

//随机取得测试数据
echo '<pre>';
//print_r($split->getTestSamples()); //测试的数据
//print_r($split->getTestLabels()); //测试的标记

$regression = new SVR(Kernel::RBF, 3, 0.1, 10);
$regression->train($split->getTrainSamples(), $split->getTrainLabels());
$predicted = $regression->predict($split->getTestSamples());

foreach ($predicted as &$target) {
    $target = round($target, 0);
}
echo 'Accuracy: ' . Accuracy::score($split->getTestLabels(), $predicted);