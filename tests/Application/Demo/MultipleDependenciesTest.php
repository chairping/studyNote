<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-5
 * Time: 下午10:52
 */

class MultipleDependenciesTest extends PHPUnit_Framework_TestCase {

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
     * 多重依赖 参数传递按依赖的顺序
     * @depends testProducerFirst
     * @depends testProducerSecond
     */
    public function testConsumer()
    {
        $this->assertEquals(
            array('first', 'second'),
            func_get_args()
        );
    }
}