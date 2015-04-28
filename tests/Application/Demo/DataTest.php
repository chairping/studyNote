<?php
require 'CsvFileIterator.php';

class DataTest extends PHPUnit_Framework_TestCase {

    /**
     * 数据供给器
     * 相当于运行
     * foreach( $this->additionProvider() as list($a, $b, $expected)) {
     *      $this->testAdd($a, $b, $expected);
     * }
     * 等同于
     * foreach( $this->additionProvider() as $val) {
     *      $a = $val[0];
     *      $b = $val[1];
     *      $expected = $val[2];
     *      $this->testAdd($a, $b, $expected);
     * }
     * @dataProvider additionProvider
     */
    public function testAdd($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
    }
    public function additionProvider()
    {
        return array(
            array(0, 0, 0),
            array(0, 1, 1),
            array(1, 0, 1),
            array(1, 1, 3)
        );
    }

    /**
     * @dataProvider additionProvider2
     */
    public function testAdd2($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
    }

    public function additionProvider2() {

    }


}