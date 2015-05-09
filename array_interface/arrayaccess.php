<?php

class ObjectAsArray implements ArrayAccess {

    private $container = [];

    public function offsetGet ($offset)
    {
        return $this->container[$offset];
    }

    public function offsetSet ($offset, $value)
    {
        $this->container[$offset] = $value;
    }

    public function offsetExists ($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset ($offset)
    {
        unset($this->container[$offset]);
    }
}

$obj = new ObjectAsArray();

$obj['foo'] = 'bar'; //sets foo to bar

var_dump($obj['foo']); //prints 'bar'

var_dump(isset($obj['foo'])); //true

unset($obj['foo']); //unsets foo

var_dump(isset($obj['foo'])); //false