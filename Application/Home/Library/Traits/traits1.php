<?php

/**
 * 代码复用基础
 */
class Base {
    public function sayHello() {
        echo 'Hello';
    }
}

/**
 * 代码复用机制
 */
trait SayWorld {
    public function sayHello() {
        parent::sayHello(); // 先输出父类方法
        echo 'World!';    // 再输出自己本身的方法
    }
}

class MyHelloWorld extends Base {
    use SayWorld; // 使用traits复用 继承
}

$o = new MyHelloWorld();
$o->sayHello(); //output: Hello World!