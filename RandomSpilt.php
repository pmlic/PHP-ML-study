<?php

use Phpml\CrossValidation\RandomSplit;
use Phpml\Dataset\ArrayDataset;

require './vendor/autoload.php';

$dataset = new ArrayDataset(
    $samples = [[1], [2], [3], [4], [5], [6], [7], [8],[9],[10]],
    $targets = ['a', 'a', 'a', 'a', 'b', 'b', 'b', 'b','c','c']
);
//第二个参数 是按照百分比 去分割的
//第三个参数 是播下一个更好的随机数发生器种子 是 mt_stand() 这个函数
$dataset_demp = new RandomSplit($dataset, 0.3, 1234);

//随机取得训练数据
echo '<pre>';
print_r($dataset_demp->getTrainSamples()); //训练的数据
print_r($dataset_demp->getTrainLabels()); //训练的标记

//随机取得测试数据
echo '<pre>';
print_r($dataset_demp->getTestSamples()); //测试的数据
print_r($dataset_demp->getTestLabels()); //测试的标记