<?php  // 对象当做数组访问, 能够使用count， 迭代器
class ObjectAsArray implements ArrayAccess, Countable, IteratorAggregate{
    private $container = [];
    public function offsetGet ($offset) {
        return $this->container[$offset];
    }
    public function offsetSet ($offset, $value) {
        $this->container[$offset] = $value;
    }
    public function offsetExists ($offset) {
        return isset($this->container[$offset]);
    }
    public function offsetUnset ($offset) {
        unset($this->container[$offset]);
    }
    // 获取元素的个数
    public function count() {
        return count($this->container);
    }
    public function getIterator() {
        return new ArrayIterator($this->container);
    }
}
$obj = new ObjectAsArray();
//  对象当做数组操作
$obj['foo'] = 'bar'; //sets foo to bar
var_dump($obj['foo']); //prints 'bar'
var_dump(isset($obj['foo'])); //true
unset($obj['foo']); //unsets foo
var_dump(isset($obj['foo'])); //false

count($obj);

foreach ($obj as $val) {
    // do something
}
