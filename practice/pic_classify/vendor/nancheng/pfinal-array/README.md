# pfinal-array

![](https://img.shields.io/apm/l/vim-mode.svg)
[![](https://img.shields.io/badge/Downloads-4k-red.svg)](https://packagist.org/packages/nancheng/pfinal-array)


**Note:** ```PHP``` ```PHPArray``` ```Validator```

这是一个PHP数组操作中间件,对 PHP 数组的常用操作进行封装
目前包括以下方法：

- del_val()     删除数组中的某个值
- keyExists()   判断数组中是否有这个键
- get()         根据键名获取数组中的某个值,支持点语法
- pf_arr_sort() 数组冒泡排序
- tree()        二级数组树结构化(不递归)
- getTree()     多级数组结构化(不递归)
- pf_array_unique()   多维数组去重 
- array_depth()       检测数组的维度
- pf_encode()         数据格式转换
    支持 数组转 'json','xml','csv','serialize'
    
    
    
- pf_array_flatten()        将多维折叠数组变为一维
- pf_is_list()              判断PHP数组是否索引数组
- pf_array_rand_by_weight() 根据权重获取随机区间返回ID
- pf_rand_val()      随机获取数组中的元素
- pf_rand_weighted() 按权重 随机返回数组的值
- pf_array_shuffle() 随机打乱数组(支持多维数组)
- pf_array_insert()  在数组中的给定位置插入元素
- pf_array_diff_both()    返回两个数组中不同的元素
- pf_getCloud()      返回数组的标签云
- pf_array_group_by() 按指定的键对数组依次分组
- pf_array_null()    把数组中的null转换成空字符串

## 安装

通过 Composer 安装：

    php composer.phar require nancheng/pfinal-array
---

## 使用

```php

    require './vendor/autoload.php';
    use pf\arr\PFarr;
    
    PFarr::pf_array_unique($arr);
    PFarr::pf_array_col
```

## 例子


*多维数组去重*

```php
    $arr = [1,54,'a',45,12,'c',1,1,12,[1,1,'a',['a','b','a']]];
    $arr = PFarr::pf_array_unique($arr);
    echo '<pre>';
    print_r($arr);
        
    
    // 结果
    Array
    (
        [0] => 1
        [1] => 54
        [2] => a
        [3] => 45
        [4] => 12
        [5] => c
        [9] => Array
            (
                [0] => 1
                [2] => a
                [3] => Array
                    (
                        [0] => a
                        [1] => b
                    )
    
            )
    
    )
```

*获取指定列的数据*

```php
$result = PFarr::pf_array_col($records, 'first_name', 'id');
    print_r($result);
```

*按指定的键对数组依次分组*

```php
$records = [
    [
        'city'  => '上海',
        'age'   => 18,
        'name'  => '马二'
    ],
    [
        'city'  => '上海',
        'age'   => 20,
        'name'  => '翠花'
    ]
];

//按照 city 分组 
$arr = PFarr::pf_array_group_by($records,'city');

//按照 city 分组 完成 之后 再按照  age 分组
   
$arr1 = PFarr::pf_array_group_by($records,'city','age');

```

### 其他

继续完善
