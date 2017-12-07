<?php

use pf\arr\PFarr;
use Phpml\Classification\NaiveBayes;

require './vendor/autoload.php';

$nbs = new NaiveBayes();
/*将上面的数据放入$samples数组里
*/
$samples = [[176, 70], [180, 80], [161, 45], [163, 47], [186, 86], [165, 49]];
/*
在labels中存入男女生类别标签（1、-1）
*/
$labels = [1,-1];
$nbs->train($samples, $labels);
/*  预测       */
PFarr::dd($nbs->predict([190, 85]));