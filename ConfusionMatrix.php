<?php

use Phpml\Metric\ConfusionMatrix;

require './vendor/autoload.php';

$res = new ConfusionMatrix();

print_r($res->compute([4,2,3,'c','e'],['4', '5', '6', '11', '15', '16', '17', '20', '22', '24', '28', '30', '32', '33','34', '35', '36', '37', '38', '40', '41', '45', '49', '50', '63', '72']));exit;