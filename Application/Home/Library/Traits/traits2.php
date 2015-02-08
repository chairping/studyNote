<?php

/**
 * 另外一个优先顺序
 */

trait HelloWorld {
    public function sayHello() {
        echo 'Hello World!';
    }
}

class TheWorldIdsNotEnough {
    use HelloWorld;

    public function sayHello() { // 优先值调用 本类的方法
        echo 'Hello Universe!';
    }
}

$o = new TheWorldIdsNotEnough();
$o->sayHello(); // output: Hello Universe!