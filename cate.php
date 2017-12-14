<?php

use pf\arr\PFarr;
use Phpml\Classification\NaiveBayes;
error_reporting(1);
require './vendor/autoload.php';
$samples = [['my', 'dog', 'has', 'flea', 'problems', 'help', 'please'],
    ['maybe', 'not', 'take', 'him', 'to', 'dog', 'park', 'stupid'],
    ['my', 'dalmation', 'is', 'so', 'cute', 'I', 'love', 'him'],
    ['stop', 'posting', 'stupid', 'worthless', 'garbage'],
    ['mr', 'licks', 'ate', 'my', 'steak', 'how', 'to', 'stop', 'him'],
    ['quit', 'buying', 'worthless', 'dog', 'food', 'stupid']];

$labels = ['a','b','a','b','a','b'];
$nb = new NaiveBayes();
$nb->train($samples, $labels);
$data = $nb->predict([['food']]);
PFarr::dd($data);
