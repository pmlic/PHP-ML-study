<?php

use pf\arr\PFarr;
use Phpml\Clustering\KMeans;

require './vendor/autoload.php';

$samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];

$kmeans = new KMeans(2,KMeans::INIT_RANDOM);
PFarr::dd($kmeans->cluster($samples));