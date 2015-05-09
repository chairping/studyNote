<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-6
 * Time: 下午9:41
 */

class StubTest extends PHPUnit_Framework_TestCase {
    public function testStub() {
        // 为 SomeClass 类创建桩件
        $stub = $this->getMockBuilder('SomeClass')
                ->getMock();

        // 配置桩件
        $stub->method('doSomething')
                ->willReturn('foo');

        // 现在调用 $this->doSomething() 将返回'foo'
        $this->assertEquals('foo', $stub->doSomething());
    }
}