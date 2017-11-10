<?php

use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\Demo\IrisDataset;
use Phpml\Math\Distance\Minkowski;

require_once 'vendor/autoload.php';
//官方提供的最受欢迎和广泛使用的虹膜测量和类名的数据集。
$dataset = new IrisDataset();

//var_dump($dataset->getSamples());
$samples = $dataset->getSamples();
$labels  = $dataset->getTargets();

$classifier = new KNearestNeighbors($k=4,new Minkowski($lambda=4));  //导入邻近算法
/*$classifier->train($samples, $labels);  // 进行训练*/


var_dump($classifier->predict([3, 2])); //预测
