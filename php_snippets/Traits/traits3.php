<?php
/**
 * 多个trait的用法
 */

trait Hello {
    public  function sayHello() {
        echo 'Hello';
    }
}

trait World {
    public function sayWorld() {
        echo 'World';
    }
}

class MyHelloWorld {
    use Hello, World;

    public function sayExcelamationMark() {
        echo '!';
    }
}

$o = new MyHelloWorld();
$o->sayHello();
$o->sayWorld();
$o->sayExcelamationMark();
// output: Hello World!