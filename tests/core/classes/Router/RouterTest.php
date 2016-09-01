<?php 
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    protected function setUp() 
    {
        $this->router = new Router('/site/index/fellipe');

        $this->route = $this->router->getRoute();
    }

    public function testInstance()
    {
        $this->assertInstanceOf( Router::class, $this->router );
    }

    public function testRouteControllerInstances()
    {
        $controller = new $this->route["controller"]();
        
        $this->assertInstanceOf( SiteController::class, $controller );
    }
    
    public function testRouteMethod()
    {
        $method = $this->route["method"];

        $this->assertEquals('index', $method);
    }

    public function testRouteParamValue()
    {
        $value = $this->route["value"];

        $this->assertEquals('fellipe', $value);
    }
}