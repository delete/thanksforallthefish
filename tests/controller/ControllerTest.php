<?php 
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../view/FakeEngine.php";
require_once __DIR__ . "/fixtures/MySiteController.php";
/**
* 
*/
class ControllerTest extends PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        $fakeEngine = new FakeEngine();
        $view = new View($fakeEngine);
        $this->myController = new MySiteController($view);
    }
    public function testInstance()
    {
        $this->assertInstanceOf( MySiteController::class, $this->myController );
    }
    
    public function testTemplateDir()
    {
        $this->assertContains('controller/fixtures/', $this->myController->templateDir);
    }

    public function testIndexController()
    {
        $this->expectOutputString('<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <h1>Hello Fellipe</h1>
  <p>Your have: 50 dollars.</p>
</body>
</html>');
        
        $this->myController->index('50');
    }

    public function testCitiesApiController()
    {
        $this->expectOutputString('{"11":"Sao Paulo","21":"Rio de Janeiro","61":"Brasilia"}');

        $this->myController->citiesApi();
    }

    public function testIfTemplateDirExists()
    {
        $template = '/controller\/fixtures/';

        $expectedTemplate = $this->myController->view->getTemplateDir("website");

        $this->assertRegExp($template, $expectedTemplate);
    }
}