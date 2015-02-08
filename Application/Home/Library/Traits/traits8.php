<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-6
 * Time: 下午11:59
 */

trait Counter {
    public function inc() {
        static $c = 0;
        $c = $c + 1;
        echo "$c\n";
    }
}

class C1 {
    use Counter;
}

class C2 {
    use Counter;
}

$o = new C1(); $o->inc();
$p = new C2(); $o->inc(); $o->inc();


trait sayWhere {
    public function whereAmI() {
        echo __CLASS__;
    }
}

class Hello {
    use sayWHere;
}

class World {
    use sayWHere;
}

$a = new Hello;
$a->whereAmI(); //Hello

$b = new World;
$b->whereAmI(); //World

trait TestTrait {
    public function testMethod() {
        echo "Class: " . __CLASS__ . PHP_EOL;
        echo "Trait: " . __TRAIT__ . PHP_EOL;
    }
}

class BaseClass {
    use TestTrait;
}

class TestClass extends BaseClass {

}

$t = new TestClass();
$t->testMethod();

//Class: BaseClass
//Trait: TestTrait


trait TestTrait2 {
    public function testMethod() {
        echo "Class: " . __CLASS__ . PHP_EOL;
        echo "Trait: " . __TRAIT__ . PHP_EOL;
    }
}

class BaseClass2 {
    use TestTrait;
}

class TestClass2 extends BaseClass {

}

$t = new TestClass2();
$t->testMethod();

//Class: BaseClass
//Trait: TestTrait

trait Call_Helper{

    public function __call($name, $args){
        return count($args);
    }
}

class Foo{
    use Call_Helper;
}

$foo = new Foo();
echo $foo->go(1,2,3,4); // echoes 4

