<?php 
use PHPUnit\Framework\TestCase;

class RouterPartsTest extends TestCase
{

    public function testSiteIndexWithAndParam()
    {
        $this->partsTest('/site/index/fellipe', 'site', 'index', 'fellipe');
        $this->partsTest('/site/index/fellipe/', 'site', 'index', 'fellipe');
    }

    public function testSiteIndexWithoutAndParam()
    {
        $this->partsTest('/site/index', 'site', 'index', '');
        $this->partsTest('/site/index/', 'site', 'index', '');
    }

    public function testSiteIndexWithParamAndWithoutController()
    {
        $this->partsTest('/index/fellipe', 'index', 'fellipe', '');
        $this->partsTest('/index/fellipe/', 'index', 'fellipe', '');
    }

    public function testSiteIndexWithoutParamAndWithoutController()
    {
        $this->partsTest('/index', 'index', '', '');
        $this->partsTest('/index/', 'index', '', '');
    }

    public function testSiteIndexWithParamAndWithControllerWithIndexPhp()
    {
        $this->partsTest('index.php/site/index/fellipe', 'site', 'index', 'fellipe');
        $this->partsTest('index.php/site/index/fellipe/', 'site', 'index', 'fellipe');
    }

    public function testSiteIndexWithoutParamAndWithControllerWithIndexPhp()
    {
        $this->partsTest('index.php/site/index/', 'site', 'index', '');
        $this->partsTest('index.php/site/index/', 'site', 'index', '');
    }
    
    private function partsTest($route, $expectedController, $expectedMethod, $expectedParam)
    {
        $this->setOutputCallback(function() {});

        $this->router = new Router($route);
        $this->route = $this->router->getRoute();
        
        $controller = $this->route["controller"];
        $this->assertEquals( $expectedController, $controller );
        
        $method = $this->route["method"];
        $this->assertEquals($expectedMethod, $method);
        
        $param = $this->route["param"];
        $this->assertEquals($expectedParam, $param);
    }
}