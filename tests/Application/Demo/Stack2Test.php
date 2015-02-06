<?php

class Stack2Test extends PHPUnit_Framework_TestCase {

    protected $stack;
    /**
     * 测试类的每个测试方法都会运行一次 setUp() 与 tearDown() 模板方法
     * (同时,每个测试方法都是在一个全新的测试类实例上运行的)
     */
    protected function setUp()
    {
        $this->stack = array();
        var_dump('test');
    }

    public function testEmpty()
    {
        $this->assertTrue(empty($this->stack));
    }

    public function testPush()
    {
        array_push($this->stack, 'foo');
        $this->assertEquals('foo', $this->stack[count($this->stack)-1]);
        $this->assertFalse(empty($this->stack));
    }

    public function testPop()
    {
        array_push($this->stack, 'foo');
        $this->assertEquals('foo', array_pop($this->stack));
        $this->assertTrue(empty($this->stack));
    }
}