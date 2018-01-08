<?php


use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Dataset\ArrayDataset;

require './vendor/autoload.php';

$dataset = new ArrayDataset(
    $samples = [[1], [2], [3], [4], [5], [6], [7], [8],[9],[10]],
    $targets = ['a', 'a', 'a', 'a', 'b', 'b', 'b', 'b','c','c']
);

$split = new StratifiedRandomSplit($dataset, 0.3);


//随机取得训练数据
echo '<pre>';
print_r($split->getTrainSamples()); //训练的数据
print_r($split->getTrainLabels()); //训练的标记

//随机取得测试数据
echo '<pre>';
print_r($split->getTestSamples()); //测试的数据
print_r($split->getTestLabels()); //测试的标记