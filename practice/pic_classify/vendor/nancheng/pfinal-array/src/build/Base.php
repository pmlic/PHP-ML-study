<?php

namespace pf\arr\build;

class Base
{
    use PFArrFormat;
    use PFArrToCsv;

    /**
     * 数组合并
     * @param $arr
     * @param $res
     * @return array
     */
    public function pf_merge($arr, $res)
    {
        $res = is_array($res) ? $res : [];
        foreach ($arr as $k => $v) {
            $res[$k] = isset($res[$k]) ? $res[$k] : $v;
            $res[$k] = is_array($res[$k]) ? $this->merge($v, $res[$k]) : $res[$k];
        }
        return $res;
    }

    /**
     * 移除数组中的某个值 获取新数组
     * @param array $data
     * @param array $values
     * @return array
     */
    public function del_val(array $data, array $values)
    {
        $news = [];
        foreach ($data as $key => $v) {
            if (!in_array($v, $values)) {
                $news[$key] = $v;
            }
        }
        return $news;
    }

    /**
     * 根据建明获取值
     * @param array $data
     * @param $key
     * @param null $value
     * @return array|mixed|null
     */
    public function get(array $data, $key, $value = null)
    {
        $exp = explode('.', $key);
        foreach ((array)$exp as $d) {
            if (isset($data[$d])) {
                $data = $data[$d];
            } else {
                return $value;
            }
        }
        return $data;
    }

    /**
     * 不区分大小写 检测数据数据键名
     * @param $key
     * @param $arr
     * @return bool
     */
    public function keyExists($key, $arr)
    {
        return array_key_exists(strtolower($key), $this->keyExists($arr));
    }

    /**
     * 根据下标过滤数据元素
     *
     * @param array $data 原数组数据
     * @param       $keys 参数的下标
     * @param int $type 1 存在在$keys时过滤  0 不在时过滤
     *
     * @return array
     */
    public function filterKeys(array $data, $keys, $type = 1)
    {
        $tmp = $data;
        foreach ($data as $k => $v) {
            if ($type == 1) {
                //存在时过滤
                if (in_array($k, $keys)) {
                    unset($tmp[$k]);
                }
            } else {
                //不在时过滤
                if (!in_array($k, $keys)) {
                    unset($tmp[$k]);
                }
            }
        }
        return $tmp;
    }

    /**
     * 数组排序
     * @param $arr
     * @return mixed
     */
    public function pf_arr_sort($arr)
    {
        $len = count($arr);
        for ($i = 1; $i < $len; $i++) {
            for ($k = 0; $k < $len - $i; $k++) {
                if ($arr[$k] > $arr[$k + 1]) {
                    $tmp = $arr[$k + 1];
                    $arr[$k + 1] = $arr[$k];
                    $arr[$k] = $tmp;
                }
            }
        }
        return $arr;
    }

    /**
     * 二级获取树形结构
     * @param $list
     * @param int $parent_id
     * @return array
     */
    public function tree($list,$parent_id=0) {
        $arr = [];
        $tree= [];
        foreach ($list as $value) {
            $arr[$value['parent_id']][]=$value;
        }

        foreach ($arr[$parent_id] as $key=>$val) {
            $tree[$key][] = $val;
            foreach ($arr[$val['id']] as $v) {
                $tree[$key]['son'][]=$v;
            }
        }
        return $tree;
    }

    /**
     * 多级获取树形结构
     * @param $list
     * @param int $parent_id
     * @return array
     */
    function getTree($list, $parent_id = 0) {
        $tree = [];
        if (!empty($list)) {
            //先修改为以id为下标的列表

            $newList = [];

            foreach ($list as $k => $v) {
                $newList[$v['id']] = $v;
            }
            //然后开始组装成特殊格式
            foreach ($newList as $value) {

                if ($parent_id == $value['parent_id']) {//先取出顶级
                    $tree[] = &$newList[$value['id']];
                } elseif (isset($newList[$value['parent_id']])) {
                    //再判定非顶级的pid是否存在，如果存在，则再pid所在的数组下面加入一个字段items，来将本身存进去
                    $newList[$value['parent_id']]['items'][] = &$newList[$value['id']];

                }
            }
        }    return $tree;
    }

    /**
     * 数组去重
     * @param $arr
     * @return array
     */
    public function pf_array_unique($arr) {
        $dime = $this->array_depth($arr);
        if($dime <= 1) {
            $data =array_unique($arr);
        } else {
            $temp=[];
            $new_data=[];
            foreach ($arr as $key=>$v) {
                if(is_array($v)) {
                    $new_data =$this->pf_array_unique($v);
                } else {
                    $temp[$key]=$v;
                }
            }
            $data=array_unique($temp);
            array_push($data,$new_data);
        }
        return $data;
    }


    /**
     * 检测数组的维度
     * @param $array
     * @return int
     */
    public function array_depth($array) {
        if(!is_array($array)) return 0;
        $max_depth = 1;
        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = $this->array_depth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }
        return $max_depth;
    }

    /**
     * 数组中指定的一列
     * @param $array
     * @param $columnKey
     * @param null $indexKey
     * @return array
     */
    public function pf_array_col($array, $columnKey, $indexKey = null)
    {
        $result = array();
        if(!empty($array)) {
            if (!function_exists('array_column')) {
                foreach ($array as $val) {
                    if (!is_array($val)) {
                        continue;
                    } elseif (is_null($indexKey) && array_key_exists($columnKey, $val)) {
                        $result[] = $val[$columnKey];
                    } elseif (array_key_exists($indexKey, $val)) {
                        if (is_null($columnKey)) {
                            $result[$val[$indexKey]] = $val;
                        } elseif (array_key_exists($columnKey, $val)) {
                            $result[$val[$indexKey]] = $val[$columnKey];
                        }
                    }
                }
            } else {
                $result = array_column($array, $columnKey, $indexKey);
            }
        }
        return $result;
    }

    /**
     * 对象转换成数组
     * @param $obj
     * @return array
     */
    public  function pf_obj_arr($obj)
    {
        $arr = is_object($obj) ? get_object_vars($obj) : $obj;
        if (is_array($arr)) {
            return array_map(array(
                __CLASS__,
                __FUNCTION__
            ), $arr);
        } else {
            return $arr;
        }
    }
	
	/**
	 * 将多维折叠数组变为一维
	 *
	 * @param array $values     多维数组
	 * @param bool $drop_empty  去掉为空的值
	 * @return array
	 */
	public function pf_array_flatten(array $values, $drop_empty = false)
	{
		$result = [];
		array_walk_recursive($values, function($value)
		use(&$result, $drop_empty) {
			if (!$drop_empty || !empty($value)) {
				$result[] = $value;
			}
		});
		return $result;
	}
	
	//判断PHP数组是否索引数组（列表/向量表）
	
	public function pf_is_list($arr)
	
	{
		if ( ! is_array($arr) ) {
			return false;
		}
		else if ( empty($arr) ) {
			return true;
		}
		else {
			$key_is_nums = array_map('is_numeric', array_keys($arr));
			return array_reduce($key_is_nums, 'and', true);
		}
	}
	
	/**
	 
	 * 根据权重获取随机区间返回ID
	 
	 * @param array $array 格式为  array(array('id'=>'','value'=>''),array('id'=>'','value'=>''))   //id为标识,value为权重
	 
	 * @return int|string
	 
	 */
	public function pf_array_rand_by_weight($array)
	{
		if (!empty($array)) {
			//区间最大值
			$sum = 0;
			//区间数组
			$interval = array();
			//制造区间
			foreach ($array as $value) {
				
				$interval[$value['id']]['min'] = $sum + 1;
				$interval[$value['id']]['max'] = $sum + $value['value'];
				$sum += $value['value'];
			}
			//在区间内随机一个数
			$result = rand(1, $sum);
			//获取结果属于哪个区间, 返回其ID
			
			foreach ($interval as $id=>$v) {
				
				while ($result >= $v['min'] && $result <= $v['max']) {
					return $id;
				}
			}
		}
		return 0;
	}
	
	/**
	 
	 * 二维数组验证一个值是否存在
	 
	 * @param $value
	 
	 * @param $array
	 
	 * @return bool
	 
	 */
	public function pf_deep_in_array($value, $array) {
		foreach($array as $item) {
			if(!is_array($item)) {
				if ($item == $value) {
					return true;
				} else {
					continue;
				}
			}
			
			if(in_array($value, $item)) {
				return true;
			} else if($this->pf_deep_in_array($value, $item)) {
				return true;
			}
		}
		return false;
	}


    /**
     * 随机返回 数组 的值
     * @param $array
     * @param int $len
     * @return array|bool|mixed
     */
	public function pf_rand_val($array,$len=1) {
	    if(!is_array($array)) {
	        return false;
        }
        $keys = array_rand($array, $len);
        if ($len === 1) {
            return $array[$keys];
        }
        return array_intersect_key($array, array_flip($keys));
    }


    /**
     * 按权重 随机返回数组的值
     * Example:$arr = [['dd',1],['ff',2],['cc',3],['ee',4]]; 出现 ee的次数相对于其他的次数要多一点
     * @param array $array
     * @return array|bool|mixed
     */
    public function pf_rand_weighted(array $array) {
        if(!is_array($array)) {
            return false;
        }

        $options = [];
        foreach ($array as $weight) {
            if(!is_array($weight)) {
                return false;
            }
            for ($i = 0; $i < $weight[1]; ++$i) {
                $options[] = $weight[0];
            }
        }
        return $this->pf_rand_val($options);
    }

    /**
     * 随机打乱数组
     * @param $array
     * @param bool $statue  true or  false
     * @return bool
     */
    public function pf_array_shuffle(&$array,$statue = false) {
        $keys = array_keys($array);
        shuffle($keys);
        $new = [];
        foreach($keys as $key) {
            if(is_array($array[$key] && $statue)) {
                $new[$key] = $this->pf_array_shuffle($array[$key],1);
            }
            $new[$key] = $array[$key];
        }
        $array = $new;
        return true;
    }

    /**
     * 在数组中的给定位置插入元素
     * @param $array
     * @param $insert
     * @param int $position
     * @return array
     */
    public function pf_array_insert($array, $insert, $position=0) {
        if(!is_array($insert)) {
            $insert = [$insert];
        }

        if($position==0) {
            $array = array_merge($insert, $array);
        } else {
            if($position >= (count($array)-1)) {
                $array = array_merge($array, $insert);
            } else {
                $head = array_slice($array, 0, $position);
                $tail = array_slice($array, $position);
                $array = array_merge($head, $insert, $tail);
            }
        }
        return $array;
    }

    /**
     * 返回两个数组中不同的元素
     * @param $array
     * @param $array1
     * @return array
     */
    public function pf_array_diff_both($array,$array1) {
        return array_merge(array_diff($array,$array1),array_diff($array1,$array));
    }

    /**
     * 获取指定数组的标签云
     * @param array $data
     * @param int $minFontSize
     * @param int $maxFontSize
     * @return string
     */
    public function pf_getCloud( $data = array(), $minFontSize = 12, $maxFontSize = 30 ) {
        $minimumCount = min( array_values( $data ) );
        $maximumCount = max( array_values( $data ) );
        $spread = $maximumCount - $minimumCount;
        $cloudTags = array();
        $spread == 0 && $spread = 1; // 假如等于0，则强制为1
        foreach ($data as $tag => $count) {
            $color = 'rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).')';
            $size = $minFontSize + ( $count - $minimumCount ) * ( $maxFontSize - $minFontSize ) / $spread;
            $cloudTags[] = '<a style="display:block;margin-left:10px;margin-top:'.rand(-5,5).'px;float:left;color:'.$color.';text-decoration:none;font-size: ' . floor( $size ) . 'px' . '" href="#" title="' . $tag  .'' . $count . '">'. htmlspecialchars( stripslashes( $tag ) ) . '</a>';
        }

        return join( "", $cloudTags );
    }

    /**
     * 按指定的键对数组依次分组
     * @param array $arr
     * @param $key
     * @return array|bool
     */
    public function pf_array_group_by(array $arr, $key)
    {
        if (!is_string($key) && !is_int($key)) {
            return false;
        }
        $is_function = !is_string($key) && is_callable($key);
        $grouped = [];
        foreach ($arr as $value) {
            $groupKey = null;
            if ($is_function) {
                $groupKey = $key($value);
            } else if (is_object($value)) {
                $groupKey = $value->{$key};
            } else {
                if(!isset($value[$key])) {
                    return false;
                }
                $groupKey = $value[$key];
            }
            $grouped[$groupKey][] = $value;
        }
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $groupKey => $value) {
                $params = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$groupKey] = call_user_func_array([$this,'pf_array_group_by'], $params);
            }
        }
        return $grouped;
    }

    /**
     * 把数组中的null 转换成 空字符串
     * @param $arr
     * @return array|string
     */
    public function pf_array_null($arr) {

        if ($arr !== null) {
            if (is_array($arr)) {
                if (!empty($arr)) {
                    foreach ($arr as $key => $value) {
                        if ($value === null) {
                            $arr[$key] = '';
                        } else {
                            $arr[$key] = $this->pf_array_null($value);		//递归再去执行
                        }
                    }
                }else{ $arr = ''; }
            } else {
                if ($arr === null) { $arr = ''; }
            }
        } else { $arr = ''; }
        return $arr;
    }

	/**
     * 结构化打印数组
     * @param $arr
     * @param int $type
     */
    public function dd($arr,$type=1) {
        echo '<pre>';
        if($type==1) {
            print_r($arr);
        } else {
            var_dump($arr);
        }
        echo '</pre>';
        exit;
    }

}