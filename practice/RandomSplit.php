<?php

use pf\arr\PFarr;
use Phpml\CrossValidation\RandomSplit;
use Phpml\Dataset\ArrayDataset;
use Phpml\Dataset\CsvDataset;

require './vendor/autoload.php';
$dataset = new CsvDataset('./data/languages.csv', 1); //导入学习数据
$randomSplit = new RandomSplit($dataset, 0.2);

PFarr::dd($randomSplit->getTrainSamples());
PFarr::dd($randomSplit->getTestSamples());