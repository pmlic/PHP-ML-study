<?php

use Phpml\Association\Apriori;

require './vendor/autoload.php';

/**
 * 关联规则 Apriori
 */
$associator = new Apriori($support = 0.5, $confidence = 0.5);


$samples = [
    ['alpha', 'beta', 'epsilon'],
    ['alpha', 'beta', 'theta'],
    ['alpha', 'beta', 'epsilon'], 
    ['alpha', 'beta', 'theta']
];
$labels  = [];

$associator1 = new Apriori($support = 0.5, $confidence = 0.5);
//Train 训练只需提供训练样本和标签 (as array). 示例:
$associator1->train($samples, $labels);

//预测样本标签使用 predict 方法。
$arr = $associator1->predict(['alpha', 'beta', 'theta']);
//var_dump($arr);

//生成关联规则简单地使用 rules 方法。
$arr1 = $associator->getRules();
var_dump($arr1);

//生成k-length频繁项集简单地使用 apriori 方法。

var_dump($associator->apriori());
