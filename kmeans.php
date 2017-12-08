<?php

use pf\arr\PFarr;
use Phpml\Clustering\KMeans;

require './vendor/autoload.php';
//注意 在要分组的数据中 如果是字符串则会出现错误的处理方式

$samples = [[1,5], [2, 20], [3,11], [4,5], [5,9], [6,19],[7,30],[8,9],[9,19]];
$kmeans = new KMeans(3,KMeans::INIT_RANDOM);
PFarr::dd($kmeans->cluster($samples));