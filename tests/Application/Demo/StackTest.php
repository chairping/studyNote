<?php

class StackTest extends PHPUnit_Framework_TestCase {

    public function testEmpty() {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }
    /**
     * testPush 依赖testEmpty()返回的的数据 形参传递给testPush()
     * @depends testEmpty
     */
    public function testPush(array $stack) {
        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertNotEmpty($stack);

        return $stack;
    }

    /**
     * @depends testPush
     */
    public function testPop(array $stack) {
        $this->assertEquals('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }
}