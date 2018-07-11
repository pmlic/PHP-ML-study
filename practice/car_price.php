<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2017/11/30
 * Time: 9:55
 */

use pf\arr\PFarr;
use Phpml\Regression\LeastSquares;

require_once 'vendor/autoload.php';
//准备学习的数据
$samples = [[73676, 1996], [77006, 1998], [10565, 2000], [146088, 1995], [15000, 2001], [65940, 2000], [9300, 2000], [93739, 1996], [153260, 1994], [17764, 2002], [57000, 1998], [15000, 2000]];
$targets = [2000, 2750, 15500, 960, 4400, 8800, 7100, 2550, 1025, 5900, 4600, 4400]; //价格
$regression = new LeastSquares();
$regression->train($samples, $targets);
//预测60000公里的车 在2018年 的价格
$arr = $regression->predict([60000, 2018]);
PFarr::dd($arr);



