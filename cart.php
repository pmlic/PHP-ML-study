<?php

use pf\arr\PFarr;
use Phpml\Classification\DecisionTree;

require './vendor/autoload.php';



$cart = new DecisionTree();
PFarr::dd($cart);