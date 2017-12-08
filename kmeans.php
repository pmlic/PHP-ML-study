<?php

use pf\arr\PFarr;
use Phpml\Clustering\KMeans;

require './vendor/autoload.php';
//注意 在要分组的数据中 如果是字符串则会出现错误的处理方式
/**
 *  KMeans  算法 第二个参数
 *
 * 传递 1 或者 KMeans::INIT_RANDOM
 *
 * random方法
 *
 *      随机初始化方法选择完全随机的中心。它获得空间边界，以避免将集群中心与样本数据相距太远。
 *
 * 传递2  或者 KMeans::INIT_KMEANS_PLUS_PLUS  (默认传递的是2)
 *
 * K-means ++方法
 *
 *      K-means ++方法以智能方式选择k-均值聚类的初始聚类中心，以加速收敛。它使用DASV播种方法包括为群集找到良好的初始质心。
 *
 **/

$samples = [[1,5], [2, 20], [3,11], [4,5], [5,9], [6,19],[7,30],[8,9],[9,19]];
$kmeans = new KMeans(3,1);
PFarr::dd($kmeans->cluster($samples));