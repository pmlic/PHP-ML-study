<?php

use pf\arr\PFarr;
use Phpml\Math\Matrix;

require_once 'vendor/autoload.php';
//将PHP数组打包为数学矩阵的类。
$matrix = new Matrix([
    [3, 3, 3],
    [4, 2, 1],
    [5, 6, 7],
]);
$flatArray = [1, 2, 3, 4];
$matrix = Matrix::fromFlatArray($flatArray);
PFarr::dd($matrix->toArray());