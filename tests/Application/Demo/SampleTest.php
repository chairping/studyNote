<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-6
 * Time: 上午12:17
 */

class SampleTest extends PHPUnit_Framework_TestCase {

    public function testSomething()
    {
        // 可选:如果愿意,在这里随便测试点什么。
        $this->assertTrue(TRUE, '这应该已经是能正常工作的。' );
        // 在这里停止,并将此测试标记为不完整。
        $this->markTestIncomplete(
            '此测试目前尚未实现。'
        );
    }

    protected function setUp()
    {
        if (!extension_loaded('mysqli')) {
            $this->markTestSkipped(
                'MySQLi 扩展不可用。'
            );
        }
    }

    /**
    * @requires PHP 5.3
    */
    public function testConnection()
    {
// 测试要求有 mysqli 扩展,并且要求 PHP >= 5.3
    }
}