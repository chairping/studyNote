<?php
// 约定 必须有数据输出
interface RendererInterface {
    public function renderData();
}
// 装饰类
abstract class Decorator implements RendererInterface {
    protected $wrapped;
    public function __construct(RendererInterface $wrappable) {
        $this->wrapped = $wrappable;
    }
}

class RenderInJson extends Decorator {
    public function renderData() {
        $output = $this->wrapped->renderData();
        return json_encode($output);
    }
}

class RenderInXml extends Decorator {
    public function renderData() {
        $output = $this->wrapped->renderData();
        $doc = new \DOMDocument();
        foreach ($output as $key => $val) {
            $doc->appendChild($doc->createElement($key, $val));
        }
        return $doc->saveXML();
    }
}

class Webservice implements RendererInterface{
    protected $data;
    public function __construct($data){
        $this->data = $data;
    }

    public function renderData(){
        return $this->data;
    }
}
//////////////// test ///////////////////////
class DecoratorTest extends \PHPUnit_Framework_TestCase
{
    protected $service;
    protected function setUp() {
        $this->service = new Decorator\Webservice(array('foo' => 'bar'));
    }
    public function testJsonDecorator()
    {
        // Wrap service with a JSON decorator for renderers
        $service = new Decorator\RenderInJson($this->service);
        // Our Renderer will now output JSON instead of an array
        $this->assertEquals('{"foo":"bar"}', $service->renderData());
    }

    public function testXmlDecorator()
    {
        // Wrap service with a XML decorator for renderers
        $service = new Decorator\RenderInXml($this->service);
        // Our Renderer will now output XML instead of an array
        $xml = '<?xml version="1.0"?><foo>bar</foo>';
        $this->assertXmlStringEqualsXmlString($xml, $service->renderData());
    }

    /**
     * The first key-point of this pattern :
     */
    public function testDecoratorMustImplementsRenderer()
    {
        $className = 'DesignPatterns\Structural\Decorator\Decorator';
        $interfaceName = 'DesignPatterns\Structural\Decorator\RendererInterface';
        $this->assertTrue(is_subclass_of($className, $interfaceName));
    }

    /**
     * Second key-point of this pattern : the decorator is type-hinted
     *
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testDecoratorTypeHinted()
    {
        if (version_compare(PHP_VERSION, '7', '>=')) {
            throw new \PHPUnit_Framework_Error('Skip test for PHP 7', 0, __FILE__, __LINE__);
        }

        $this->getMockForAbstractClass('DesignPatterns\Structural\Decorator\Decorator', array(new \stdClass()));
    }

    /**
     * Second key-point of this pattern : the decorator is type-hinted
     *
     * @requires PHP 7
     * @expectedException TypeError
     */
    public function testDecoratorTypeHintedForPhp7()
    {
        $this->getMockForAbstractClass('DesignPatterns\Structural\Decorator\Decorator', array(new \stdClass()));
    }

    /**
     * The decorator implements and wraps the same interface
     */
    public function testDecoratorOnlyAcceptRenderer()
    {
        $mock = $this->getMock('DesignPatterns\Structural\Decorator\RendererInterface');
        $dec = $this->getMockForAbstractClass('DesignPatterns\Structural\Decorator\Decorator', array($mock));
        $this->assertNotNull($dec);
    }
}
