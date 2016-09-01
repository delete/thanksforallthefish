<?php 
use PHPUnit\Framework\TestCase;

class RouterRoutesTest extends TestCase
{

    public function testSiteIndexWithAndParam()
    {
        $this->routeTest('/site/index/fellipe', SiteController::class, 'index', 'fellipe');
        $this->routeTest('/site/index/fellipe/', SiteController::class, 'index', 'fellipe');
    }

    public function testSiteIndexWithoutAndParam()
    {
        $this->routeTest('/site/index', SiteController::class, 'index', '');
        $this->routeTest('/site/index/', SiteController::class, 'index', '');
    }

    public function testSiteIndexWithParamAndWithoutController()
    {
        $this->routeTest('/index/fellipe', SiteController::class, 'index', 'fellipe');
        $this->routeTest('/index/fellipe/', SiteController::class, 'index', 'fellipe');
    }

    public function testSiteIndexWithoutParamAndWithoutController()
    {
        $this->routeTest('/index', SiteController::class, 'index', '');
        $this->routeTest('/index/', SiteController::class, 'index', '');
    }

    public function testSiteIndexWithParamAndWithControllerWithIndexPhp()
    {
        $this->routeTest('index.php/site/index/fellipe', SiteController::class, 'index', 'fellipe');
        $this->routeTest('index.php/site/index/fellipe/', SiteController::class, 'index', 'fellipe');
    }

    public function testSiteIndexWithoutParamAndWithControllerWithIndexPhp()
    {
        $this->routeTest('index.php/site/index/', SiteController::class, 'index', '');
        $this->routeTest('index.php/site/index/', SiteController::class, 'index', '');
    }
    
    private function routeTest($route, $expectedControllerClass, $expectedmethod, $expectedvalue)
    {
        $this->router = new Router($route);
        $this->route = $this->router->getRoute();
        
        $controller = new $this->route["controller"]();
        $this->assertInstanceOf( $expectedControllerClass, $controller );
        
        $method = $this->route["method"];
        $this->assertEquals($expectedmethod, $method);
        
        $value = $this->route["value"];
        $this->assertEquals($expectedvalue, $value);
    }
}