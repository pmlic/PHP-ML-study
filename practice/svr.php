<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2017/12/4
 * Time: 16:59
 */

use pf\arr\PFarr;
use Phpml\Regression\SVR;
use Phpml\SupportVectorMachine\Kernel;

require_once './vendor/autoload.php';
/*将上面的数据放入$samples数组里
*/
$samples = [[176, 70], [180, 80], [161, 45], [163, 47], [186, 86], [165, 49]];
/*
在labels中存入男女生类别标签（1、-1）
*/
$labels = [1, 1, -1, -1, 1, -1];
//PFarr::dd($samples);
$regression = new SVR(Kernel::LINEAR);
//Train 训练只需提供训练样本和标签 (as array). 示例:
$regression->train($samples, $labels);
//找一下  190, 85这个点
PFarr::dd($regression->predict([190, 85]));