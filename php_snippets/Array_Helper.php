<?php
namespace Carbon;

class Array_Helper
{
    public static function assoc_unique($arr, $key)
    {
        $tmpArr = array();
        foreach($arr as $k => $v)
        {
            if (in_array($v[$key], $tmpArr))
            {
                unset($arr[$k]);
            }
            else
            {
                $tmpArr[] = $v[$key];
            }
        }
        sort($arr);
        return $arr;
    }

    public static function array_unique_fb($arr)
    {
        $temp = array();
        foreach ($arr as $v){
            $v = join(",",$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
            $temp[] = $v;
        }
        $temp = array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
        foreach ($temp as $k => $v){
            $temp[$k] = explode(",",$v);   //再将拆开的数组重新组装
        }
        return $temp;
    }
}
//
//$aa = array(
//    array('id' => 123, 'name' => '张三'),
//    array('id' => 123, 'name' => '李四'),
//    array('id' => 124, 'name' => '王五'),
//    array('id' => 125, 'name' => '赵六'),
//    array('id' => 126, 'name' => '赵六')
//);
//$key = 'id';
//assoc_unique(&$aa, $key);
//print_r($aa);
//Array ( [0] => Array ( [id] => 123 [name] => 张三 )
//        [1] => Array ( [id] => 124 [name] => 王五 )
//        [2] => Array ( [id] => 125 [name] => 赵六 )
//        [3] => Array ( [id] => 126 [name] => 赵六 )
//)

//$aa = array(
//    array('id' => 123, 'name' => '张三'),
//    array('id' => 123, 'name' => '李四'),
//    array('id' => 124, 'name' => '王五'),
//    array('id' => 123, 'name' => '李四'),
//    array('id' => 126, 'name' => '赵六')
//);
//$bb=array_unique_fb($aa);
//print_r($bb)
//Array ( [0] => Array ([0] => 123 [1] => 张三 )
//        [1] => Array ( [0] => 123 [1] => 李四 )
//        [2] => Array ( [0] => 124 [1] => 王五 )
//        [4] => Array ( [0] => 126 [1] => 赵六 )
//)
