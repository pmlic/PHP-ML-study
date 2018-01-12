<?php
use Phpml\Classification\NaiveBayes;

require './vendor/autoload.php';


/*将上面的数据放入$samples数组里
*/
$samples = [[176, 70], [180, 80], [161, 45], [163, 47], [186, 86], [165, 49]];
/*
在labels中存入男女生类别标签（1、-1）
*/
$labels = ["男", "男", "女", "女", "男", "女"];   //注意 Nb算法 源码开启了 declare(strict_types=1);  变量类型严格检查  所以 必须传递字符串 如果是整型的话会报错
//$labels = ['1', '-1', '1', '-1', '1', '-1'];   //注意 Nb算法 源码开启了 declare(strict_types=1);  变量类型严格检查  所以 必须传递字符串 如果是整型的话会报错
$classifier = new NaiveBayes();
$classifier->train($samples, $labels);
print_r($classifier->predict([[172,40]]));
// return [-1, 1] 代表女生、男生
exit;