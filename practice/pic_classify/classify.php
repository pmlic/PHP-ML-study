<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2018/7/20
 * Time: 14:39
 *
 *
 *                      _ooOoo_
 *                     o8888888o
 *                     88" . "88
 *                     (| ^_^ |)
 *                     O\  =  /O
 *                  ____/`---'\____
 *                .'  \\|     |//  `.
 *               /  \\|||  :  |||//  \
 *              /  _||||| -:- |||||-  \
 *              |   | \\\  -  /// |   |
 *              | \_|  ''\---/''  |   |
 *              \  .-\__  `-`  ___/-. /
 *            ___`. .'  /--.--\  `. . ___
 *          ."" '<  `.___\_<|>_/___.'  >'"".
 *        | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *        \  \ `-.   \_ __\ /__ _/   .-` /  /
 *  ========`-.____`-.___\_____/___.-`____.-'========
 *                       `=---='
 *  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 *           佛祖保佑       永无BUG     永不修改
 *
 */

require __DIR__ . '/../../vendor/autoload.php';
$dataset = fopen(__DIR__ . '\testData\test.txt', 'a+');
while (!feof($dataset)) {
    $res[] = fgets($dataset);
}

if (count($res) > 0) {
    $samples = [];
    foreach ($res as $val) {
        $sample = trim(strstr($val, " "), " ");
        $labels = trim(substr($val,0,stripos($val," "))," ");
        var_dump($labels);exit;
        if (!in_array($sample, $samples)) {
            $samples[] = $sample;
        }
    }
    foreach ($samples as $k => $sample) {
        $samples[$k] = explode(" ", trim($sample, " "));
    }
}
var_dump($samples);
exit();
print_r($res);
exit;