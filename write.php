<?php
error_reporting(0);

use Phpml\Classification\Ensemble\RandomForest;
use Phpml\Dataset\CsvDataset;

require_once 'vendor/autoload.php';
/*require_once 'ArrayToCsv/ArrayToCsv.php';*/
$dataset = new CsvDataset('./data/for_php_train.csv',5,true); //读取学习数据
$testset = new CsvDataset('./data/for_php_test.csv',5,true);  // 读取要测试的数据

$sample = $dataset->getSamples();
$label = $dataset->getTargets();

$RandomForest = new RandomForest();
$RandomForest->train($sample,$label);
$RandomForest->train($dataset1->getSamples(),$label);

$result = $RandomForest->predict($testset->getSamples()); //预测结果
//var_dump($result);
$csv=[];
$csv[0]['PassengerId']='树苗ID';
$csv[0]['Survived']='活下来了';
//遍历预测结果
foreach ($result as $k=>$value){
    $csv[$k+1]['PassengerId']=$k+892;
    $csv[$k+1]['Survived']=$value;
}
var_dump($csv);exit;
$file = fopen('write.csv','a+b');
$data = $csv;
foreach ($data as $value){
    fputcsv($file,$value);
}
fclose( $file);