<?php
class ArrayReloaded implements Iterator{

    /**
     * 一个本身php数组类
     */
    private $array = [];

    private $valid = FALSE;

    public function __construct($array) {
        $this->array = $array;
    }

    public function rewind(){
        return current($this->array);
    }

    public function current() {
        return current($this->array);
    }

    public function key() {
        return key($this->array);
    }

    public function next() {
        $this->valid = (FALSE !== next($this->array));
    }
}

$colors = new ArrayReloaded(['red', 'green', 'blue']);

foreach($colors as $color ) {
    echo $color . "<br />";
}

$colors->rewind();

// Loop while valid
while ( $colors->valid() ) {

    echo $colors->key().": ".$colors->current()."
";
    $colors->next();

}