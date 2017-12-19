<?php

use Phpml\Classification\MLPClassifier;
use Phpml\Classification\SVC;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Dataset\Demo\IrisDataset;
use Phpml\Metric\Accuracy;
use Phpml\NeuralNetwork\ActivationFunction\Sigmoid;
use Phpml\SupportVectorMachine\Kernel;

require_once 'vendor/autoload.php';
$dataset = new IrisDataset();
$split = new StratifiedRandomSplit($dataset, 0.3, 123);
$mlp = new MLPClassifier(4, [2], ['setosa', 'versicolor', 'virginica'], $iterations = 10000, $activationFunction = new Sigmoid(), $learningRate = 1.0);
$castTrainSamples = cast($split->getTrainSamples());
$mlp->train(
    $samples = $castTrainSamples,
    $targets = $split->getTrainLabels()
);
$castTestSamples = cast($split->getTestSamples());
$predicted = $mlp->predict($castTestSamples);
var_dump(Accuracy::score($split->getTestLabels(), $predicted));
function cast($data) {
    foreach ($data as $k => $v) {
        foreach ($v as $k2 => $s) {
            $float = (float) $s;
            $data[$k][$k2] = $float;
        }
    }
    return $data;
}