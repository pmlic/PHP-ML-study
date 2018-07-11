<?php
use pf\arr\PFarr;
use Phpml\Classification\SVC;
use Phpml\Dataset\ArrayDataset;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\SupportVectorMachine\Kernel;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\Tokenization\WordTokenizer;

require_once 'vendor/autoload.php';

$samples = [
    'engine',
    'engine1',
    'engine2',
    'engine3',
    '테스트',
    '中文',
    '中国人',
    '中人',
    '中',
];
$labels = ['英文', '英文','英文','英文','韩语', '中文','中文','中文','中文'];

/**
 * 新建一个向量机 分词器
 */
$vectorizer = new TokenCountVectorizer(new WordTokenizer());
$vectorizer->fit($samples);
$vectorizer->transform($samples);

$transformer = new TfIdfTransformer($samples);
$transformer->fit($samples);
$transformer->transform($samples);

$dataset = new ArrayDataset($samples, $labels);
$classifier = new SVC(Kernel::RBF, 10000);
$classifier->train($samples,$labels);


$testData = ['中'];

$vectorizer->fit($testData);
$vectorizer->transform($testData);

PFarr::dd($classifier->predict($testData));