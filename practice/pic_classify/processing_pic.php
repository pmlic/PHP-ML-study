<?php

/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2018/7/20
 * Time: 10:33
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
require __DIR__ . '/vendor/autoload.php';

use Spatie\Image\Image;
use Spatie\Image\Manipulations;

/**
 * 二值化图片类,处理训练数据
 * Class Processing_pic
 */
class Processing_pic
{
    protected $file_path;
    protected $image_classification;
    protected $image_binary;
    protected $image_color_histogram;

    public function __construct($path)
    {
        $this->file_path = $path;
        $this->_getImageData();
    }

    private function _getImageData()
    {
        if (!file_exists($this->file_path)) {
            throw new \Exception('The file directory does not exist');
        }
        //获取目录中的文件
        $file_list = $this->_getdir($this->file_path);
        //对图片进行大小标准化处理
        try {
            $this->_set_img($file_list);

        } catch (\Exception $e) {
            return $e->getMessage();
            //throw new \Exception($e->getMessage());
        }


    }

    private function _getdir($dir)
    {
        static $arr = array();
        if (is_dir($dir)) {
            $hadle = @opendir($dir);
            while ($file = readdir($hadle)) {
                if (!in_array($file, array('.', '..'))) {
                    $dirr = $dir . '/' . $file;
                    array_push($arr, $dirr);
                    if (is_dir($dirr)) {
                        $this->image_classification[] = $file;
                        $this->_getdir($dirr);
                    }
                }
            }
        }
        return $arr;
    }

    private function _set_img($file_list)
    {
        if (!count($file_list) > 0) {
            throw new \Exception('没有训练数据');
        }
        foreach ($file_list as $k => $item) {
            $file_name = basename($item);
            if (strstr($file_name, '.')) {
                Image::load($item)->width(100)->height(100)->save();
            }
        }
    }
}

new Processing_pic('./testImages');
