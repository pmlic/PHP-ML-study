<?php

use pf\arr\PFarr;
use Phpml\Classification\MLPClassifier;
use Phpml\NeuralNetwork\ActivationFunction\PReLU;
use Phpml\NeuralNetwork\ActivationFunction\Sigmoid;
use Phpml\NeuralNetwork\Layer;
use Phpml\NeuralNetwork\Node\Neuron;

require './vendor/autoload.php';

/*$network = new MLPClassifier(5, [2], ['a', 'b', 4]);
$network->partialTrain(
    [[1, 0, 0, 0, 0], [0, 1, 0, 0, 0]],
    ['a', 'b']
);

//PFarr::dd(['a', $network->predict([1, 0, 0, 0, 0])]);
PFarr::dd($network->predict([1, 0, 0, 0, 0]));



$network->partialTrain(
    [[0, 0, 1, 1, 0], [1, 1, 1, 1, 1], [0, 0, 0, 0, 0]],
    ['a', 'a', 4]
);
$this->assertEquals('a', $network->predict([0, 0, 1, 1, 0]));
$this->assertEquals('a', $network->predict([1, 1, 1, 1, 1]));
$this->assertEquals(4, $network->predict([0, 0, 0, 0, 0]));

*/
$layer1 = new Layer(2, Neuron::class, new PReLU);
PFarr::dd($layer1);
$layer2 = new Layer(2, Neuron::class, new Sigmoid);

//第一个参数 输入层的数量 第二个参数 带有隐藏层结构的数组，每个值代表每个层中的神经元数量

$mlp = new MLPClassifier(4, [$layer1, $layer2], ['a', 'b', 'c']);
$mlp->train(
    $samples = [[1, 0, 0, 0], [0, 1, 1, 0], [1, 1, 1, 1], [0, 0, 0, 0]],
    $targets = ['a', 'a', 'b', 'c']
);
PFarr::dd($mlp->predict([[1, 1, 1, 1], [0, 0, 0, 0]]));
