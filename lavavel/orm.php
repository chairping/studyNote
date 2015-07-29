<?php

class City extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'city';
    public $timestamps = false;

}

$city = City::findOrNew(12);
//$city->isEmpty();
// 数据库存在id=12的数据
if ($model->exists === true)
{

}
elseif ($model->exists === false)
{

}

$model = City::all();
$model instanceof \Illuminate\Database\Eloquent\Collection && var_dump('true');
//model 的items属性保存数据 即array(City....) 数组对象

$model->isEmpty();      // 判断items 是否为空
$list = $model->all();  // 返回 items
$model->put('hahha', 'ahhahahahhaha'); // 相当于 $items['hahha', 'ahhahahahahah');
$data = $model->first();
$data = $model->last();
$data = $model->shift(); // return array_shift($this->items);
$model->push();  // array_unshift($this->items, $value);
$data = $model->pop(); // return array_pop($this->items);
$model->forget('hahha'); //unset($this->items[$key]);
$model->count();
$newObj = $model->reverse();

// 转化为单一的值 output: string 'initial 福州 厦门 莆田 三明 泉州 漳州 南平 龙岩 宁德' (length=70)
$reduce = $model->reduce(function($names, $row){
    return $names .' ' . $row->name;
}, 'initial');

// 筛选指定的值
$each = $model->each(function($row){
    if ($row->province_id == 12) {
        return $row;
    }
});

$map = $model->map(function($row, $id){
    return $id . '-' . $row->name;
});
var_dump($map->toArray());
//array (size=9)
//  0 => string '0-福州' (length=8)
//  1 => string '1-厦门' (length=8)
//  2 => string '2-莆田' (length=8)
//  3 => string '3-三明' (length=8)
//  4 => string '4-泉州' (length=8)
//  5 => string '5-漳州' (length=8)
//  6 => string '6-南平' (length=8)
//  7 => string '7-龙岩' (length=8)
//  8 => string '8-宁德' (length=8)

$filter = $model->filter(function($row){
    return ($row->id & 1);
});
var_dump(array_column($filter->toArray(), 'id'));
//array (size=5)
//  0 => int 1
//  1 => int 3
//  2 => int 5
//  3 => int 7
//  4 => int 9

$aa = $model->fetch('name');
//array (size=9)
//  0 => string '福州' (length=6)
//  1 => string '厦门' (length=6)
//  2 => string '莆田' (length=6)
//  3 => string '三明' (length=6)
//  4 => string '泉州' (length=6)
//  5 => string '漳州' (length=6)
//  6 => string '南平' (length=6)
//  7 => string '龙岩' (length=6)
//  8 => string '宁德' (length=6)

$data = $model->lists('name');
//array (size=9)
//  0 => string '福州' (length=6)
//  1 => string '厦门' (length=6)
//  2 => string '莆田' (length=6)
//  3 => string '三明' (length=6)
//  4 => string '泉州' (length=6)
//  5 => string '漳州' (length=6)
//  6 => string '南平' (length=6)
//  7 => string '龙岩' (length=6)
//  8 => string '宁德' (length=6)

$data = $model->lists('name', 'province_id');
//array (size=9)
//  0 => string '福州' (length=6)
//  1 => string '厦门' (length=6)
//  2 => string '莆田' (length=6)
//  3 => string '三明' (length=6)
//  4 => string '泉州' (length=6)
//  5 => string '漳州' (length=6)
//  6 => string '南平' (length=6)
//  7 => string '龙岩' (length=6)
//  8 => string '宁德' (length=6)

