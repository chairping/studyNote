<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-6
 * Time: 下午11:55
 */

trait Hello {
    public function sayHelloWorld() {
        echo 'Hello' . $this->getWorld();
    }

    abstract public function getWorld();
}

class MyHelloWorld {
    private $world;
    use Hello;

    public function getWorld() {
        return $this->world;
    }

    public function setWorld($val) {
        $this->world = $val;
    }

}