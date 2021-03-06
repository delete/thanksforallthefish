<?php 
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    protected function setUp() 
    {
        $GLOBALS["config"] = [
            "routes" => [
                "site" => "SiteController",
            ],
            "defaults" => [
                "controller" => "SiteController",
                "method" => "index"
            ]
        ];

        $this->setOutputCallback(function() {});
        $this->router = new Router('/site/index/fellipe');

        $this->route = $this->router->getRoute();
    }

    public function testInstance()
    {
        $this->assertInstanceOf( Router::class, $this->router );
    }

    public function testRouteControllerInstances()
    {
        $controller = $this->route["controller"];
        
        $this->assertEquals( 'site', $controller );
    }
    
    public function testRouteMethod()
    {
        $testRouteMethodd = $this->route["method"];

        $this->assertEquals('index', $testRouteMethodd);
    }

    public function testRouteParamValue()
    {
        $param = $this->route["param"];

        $this->assertEquals('fellipe', $param);
    }
}