<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-6
 * Time: 上午12:08
 */

class TemplateMethodsTest  extends PHPUnit_Framework_TestCase  {
// 运行结果
//TemplateMethodsTest::setUpBeforeClass

//TemplateMethodsTest::setUp
//TemplateMethodsTest::assertPreConditions
//TemplateMethodsTest::testOne
//TemplateMethodsTest::assertPostConditions
//TemplateMethodsTest::tearDown

//.TemplateMethodsTest::setUp
//TemplateMethodsTest::assertPreConditions
//TemplateMethodsTest::testTwo
//TemplateMethodsTest::tearDown

//TemplateMethodsTest::onNotSuccessfulTest

//FTemplateMethodsTest::tearDownAfterClass




    //setUpBeforeClass() 与 tearDownAfterClass() 模板方法将分别在测试用
    //例类的第一个测试运行之前和测试用例类的最后一个测试运行之后调用
    public static function setUpBeforeClass()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }
    protected function setUp()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }
    protected function assertPreConditions()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }
    public function testOne()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->assertTrue(TRUE);
    }
    public function testTwo()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->assertTrue(FALSE);
    }
    protected function assertPostConditions()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }
    protected function tearDown()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }
    public static function tearDownAfterClass()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }
    protected function onNotSuccessfulTest(Exception $e)
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        throw $e;
    }
}