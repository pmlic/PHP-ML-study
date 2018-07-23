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

use pf\arr\PFarr;
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
        $this->_get_img_binaryzation();
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

    private function _getdir($dir, $pattern = "")
    {
        $arr = array();
        $dir_handle = opendir($dir);
        if ($dir_handle) {
            while (($file = readdir($dir_handle)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                $tmp = realpath($dir . '/' . $file);
                if (is_dir($tmp)) {
                    $retArr = $this->_getdir($tmp, $pattern);
                    if (!empty($retArr)) {
                        $arr[] = $retArr;
                    }
                } else {
                    if ($pattern === "" || preg_match($pattern, $tmp)) {
                        if (!in_array($dir, $arr)) {
                            $arr[] = $dir;
                        }
                        $arr[] = $tmp;
                    }
                }
            }
            closedir($dir_handle);
        }
        return PFarr::pf_array_flatten($arr);
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

    private function _get_img_binaryzation()
    {
        if (!file_exists($this->file_path)) {
            throw new \Exception('The file directory does not exist');
        }
        //获取目录中的文件
        $file_list = $this->_getdir($this->file_path);
        $img_info = [];
        foreach ($file_list as $k => $item) {
            $file_name = basename($item);
            if (!strstr($file_name, '.')) {
                $testDataDir = __DIR__ . '/testData/' . $file_name;
                if (!file_exists($testDataDir)) {
                    mkdir($testDataDir);
                }
            }
        }
        foreach ($file_list as $k => $item) {
            $file_name = basename($item);
            if (strstr($file_name, '.')) {
                $dir_path = __DIR__.'/testData/'.strrchr(dirname($item),DIRECTORY_SEPARATOR);
                $pretreatment = $this->_get_data_img($item);
                //TODO 提取特征
            }
        }
        exit;
    }

    private function _get_data_img($img_path)
    {
        if (!$ex = getimagesize($img_path)) {
            return false;
        }

        // 打开图片
        switch ($ex[2]) {
            case IMAGETYPE_JPEG:
            case IMAGETYPE_JPEG2000:
                if (!$im = imageCreateFromJpeg($img_path)) {
                    return false;
                }
                break;
            case IMAGETYPE_PNG:
                $im = imageCreateFromPng($img_path);
                break;
            case IMAGETYPE_GIF:
                $im = imageCreateFromGif($img_path);
                break;
            case IMAGETYPE_BMP:
                $im = imageCreateFromBmp($img_path);
                break;
            default :
                return false;
        }

        $gray = array_fill(0, $ex[1],
            array_fill(0, $ex[0], 0)
        );

        // 转为灰阶图像
        foreach ($gray as $y => &$row) {
            foreach ($row as $x => &$Y) {
                $rgb = imagecolorat($im, $x, $y);
                // 根据颜色求亮度
                $B = $rgb & 255;
                $G = ($rgb >> 8) & 255;
                $R = ($rgb >> 16) & 255;
                $Y = ($R * 19595 + $G * 38469 + $B * 7472) >> 16;
            }
        }
        unset($row, $Y);

        // 自动求域值
        $back = 127;
        do {
            $crux = $back;
            $s = $b = $l = $I = 0;
            foreach ($gray as $row) {
                foreach ($row as $Y) {
                    if ($Y < $crux) {
                        $s += $Y;
                        $l++;
                    } else {
                        $b += $Y;
                        $I++;
                    }
                }
            }
            $s = $l ? floor($s / $l) : 0;
            $b = $I ? floor($b / $I) : 0;
            $back = ($s + $b) >> 1;
        } while ($crux != $back);

        // 二值化
        $bin = $gray;
        foreach ($bin as &$row) {
            foreach ($row as &$Y) {
                $Y = $Y < $crux ? 0 : 1;
            }
        }

        return array(
            $gray,
            $bin,
        );
    }
}

new Processing_pic('./testImages');
