<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-5
 * Time: 下午11:25
 */

class DependencyAndDataProviderComboTest extends PHPUnit_Framework_TestCase {

    public function provider()
    {
        return array(array('provider1'), array('provider2'));
    }
    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }
    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }
    /**
     * 数据供给器的参数将先于来自所依赖的测试的的参数
     * 相当于
     * foreach( $this->additionProvider() as list($a)) {
     *      $this->testAdd($a, $this->testProducerFirst(), $this->testProducerSecond());
     * }
     * @depends testProducerFirst
     * @depends testProducerSecond
     * @dataProvider provider
     */
    public function testConsumer()
    {
        $this->assertEquals(
            array('provider1', 'first', 'second'),
            func_get_args()
        );
    }
}