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
// 生成测试样本
$samples = [];
for ($i = 0; $i < 1000; $i++) {
    $samples[] = [
        [rand(1, 9999) . mt_rand(100, 100000)]
    ];
}
$labels=[];
//PFarr::dd($samples);
$regression = new SVR(Kernel::LINEAR);
//Train 训练只需提供训练样本和标签 (as array). 示例:
$regression->train($samples, $labels);
//找一下  100,500这个点
PFarr::dd($regression->predict([100,500]));