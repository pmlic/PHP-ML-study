<?php
//error_reporting(0);
use pf\arr\PFarr;
use Phpml\Classification\DecisionTree;
use Phpml\Dataset\ArrayDataset;
use Phpml\Metric\ClassificationReport;

require './vendor/autoload.php';

$database = new ArrayDataset([[1,1],[1, 1],[1, 0],[0, 1],[0, 0],[1, 0]],['y','y','n','n','n','n']);
$cart = new DecisionTree();
$cart->train($database->getSamples(),$database->getTargets());
$res = $cart->predict([[1,0],[0,3],[3,1]]);

$report = new ClassificationReport($database->getTargets(), $res);
PFarr::dd($report->getPrecision());