<?php

use pf\arr\PFarr;
use Phpml\Association\Apriori;

require './vendor/autoload.php';

//如 Apriori.md 中 所讲  我们
/**
鸟、鸟笼、鸟食、猫粮、猫砂
鱼食、鸟、鸟笼
猫粮、狗粮、宠物玩具
鸟、鸟笼、鸟食
猫粮、猫砂、宠物玩具
 **/
//顾客的清单
$samples=[
    ['鸟类','鸟笼','鸟食','猫粮','猫砂'],
    ['鱼食','鸟','鸟笼'],
    ['猫粮','狗粮','宠物玩具'],
    ['鸟','鸟笼','鸟食'],
    ['鸟','鸟笼'],
    ['猫粮','猫砂','宠物玩具'],
];
$labels  = [];
/**
 * $support 支持度
 * confidence 自信度
 */
$associator = new Apriori($support = 0.1,$confidence = 0.5);
/* 对其进行训练   */
$associator->train($samples, $labels);
/**
 * 假如顾客 购买了辣条 推荐用户的商品有
 */
PFarr::dd($associator->predict(['猫粮']));