<?php

use Phpml\Classification\SVC;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Dataset\CsvDataset;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\SupportVectorMachine\Kernel;
use Phpml\Tokenization\WordTokenizer;

error_reporting(1);

require_once 'vendor/autoload.php';

$dataset = new CsvDataset('./data/languages.csv', 1); //导入学习数据
//WordTokenizer 分词器 TokenCountVectorizer 向量器
$vectorizer = new TokenCountVectorizer(new WordTokenizer());

$tfIdfTransformer = new TfIdfTransformer();


$testample=['我是中国人','this is engine'];

$samples = [];
foreach ($dataset->getSamples() as $sample) {
    $samples[] = $sample[0];
}
$vectorizer->fit($samples);
$vectorizer->transform($samples);
$tfIdfTransformer->fit($samples);
$tfIdfTransformer->transform($samples);

$randomSplit = new StratifiedRandomSplit($dataset, 0.1);


$classifier = new SVC(Kernel::RBF, 10000);
$classifier->train($randomSplit->getTrainSamples(), $randomSplit->getTrainLabels());
$testpredictedLabels = $classifier->predict($testample);

print_r($testpredictedLabels);// return  Array ( [0] => zh )
exit;