<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-5
 * Time: 下午11:39
 */

class ExceptionTest extends PHPUnit_Framework_TestCase {

    /**
     * 自动捕获 InvalidArgumentException 抛出的异常
     * @expectedException InvalidArgumentException
     * 断言错误信息为 Right Message
     * @expectedExceptionMessage Right Message
     */
    public function testExceptionHasRightMessage()
    {
        throw new InvalidArgumentException('Some Message', 10);
    }
    /**
     * @expectedException InvalidArgumentException
     * 断言错误信息为 匹配该正则表达式
     * @expectedExceptionMessageRegExp /Right./
     */
    public function testExceptionMessageMatchesRegExp()
    {
        throw new InvalidArgumentException('Some Message', 10);
    }
    /**
     * @expectedException InvalidArgumentException
     * 断言错误码 为 20
     * @expectedExceptionCode 20
     */
    public function testExceptionHasRightCode()
    {
        throw new InvalidArgumentException('Some Message', 10);
    }


    //======================== 以下的代码效果跟上面的代码一样 =================//
    public function testException()
    {
        $this->setExpectedException('InvalidArgumentException');
    }
    public function testExceptionHasRightMessage2()
    {
        // 预期错误异常韦 InvalidArgumentException
        // 错误信息为 'Right Message'
        $this->setExpectedException(
            'InvalidArgumentException', 'Right Message'
        );
        throw new InvalidArgumentException('Some Message', 10);
    }
    public function testExceptionMessageMatchesRegExp2()
    {
        // 预期错误异常韦 InvalidArgumentException
        // 错误信息匹配 '/Right.*/'
        // 错误码 10
        $this->setExpectedException(
            'InvalidArgumentException', '/Right.*/', 10
        );
        throw new InvalidArgumentException('The Wrong Message', 10);
    }
    public function testExceptionHasRightCode2()
    {
        // 预期错误异常韦 InvalidArgumentException
        // 错误信息匹配 'Right Message'
        // 错误码 20
        $this->setExpectedException(
            'InvalidArgumentException', 'Right Message', 20
        );
        throw new InvalidArgumentException('The Right Message', 10);
    }

    //================= 另一种对异常进行测试的方法 ===============/
    public function testException2() {
        try {
            // ... 预期会引发异常的代码 ...
        }
        catch (InvalidArgumentException $expected) {
            return;
        }
        //的调用将会中止测试,并通告测试有问题
        $this->fail( '预期的异常未出现。' );
    }
}