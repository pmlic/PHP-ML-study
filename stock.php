<?php

use pf\arr\PFarr;
use Phpml\Regression\LeastSquares;
use Phpml\Regression\SVR;
use Phpml\SupportVectorMachine\Kernel;

require_once './vendor/autoload.php';
/*
我们现在对一支股票进行预测
张氏股从2010年开始
2010年单股价123.5$
2011年单股价124.5$
2012年单股价134.5$
2013年单股价144$
2014年单股价144.7$
2015年单股价154.5$
2016年单股价184.5$
我们根据每年的股价涨势计算出
2010年 涨1.1%
2011年 涨1.2%
2012年 涨2.1%
2013年 涨3.1%
2014年 涨3.3%
2015年 涨4.1%
2016年 涨5.1%
*/
/*将上面的数据放入$samples数组里
*/
$samples = [[2010], [2011], [2012], [2013], [2014], [2015],[2016]];
/*
在labels中存入每年的股价涨势
*/
$labels = [1.1, 1.2, 2.1, 3.1, 3.3, 4.1,5.1];
/*
逼近线性模型进行预测
*/
$regression = new LeastSquares();

//$regression = new SVR(Kernel::LINEAR);
$regression = new SVR(Kernel::LINEAR);
/* 对其进行训练   */
$regression->train($samples, $labels);
/*
如果我们想知道2017年张氏股的涨势是什么样的，我们用最小二乘法逼近线性模型来进行预测
*/
PFarr::dd($regression->predict([2017]));