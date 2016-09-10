<?php 
use PHPUnit\Framework\TestCase;
/**
* 
*/
class RouterExceptionsTest extends TestCase
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
    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Method not found!
     */
    public function testRightControllerAndWrongMethod()
    {
        $this->router = new Router('/site/wrong/');

        $this->router->routing();
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Method not found!
     */
    public function testRightControllerAndWrongMethodAndWithIndexPhp()
    {
        $this->router = new Router('/index.php/site/wrong');

        $this->router->routing();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Controller not found!
     */
    public function testWrongControllerAndRightMethod()
    {
        $this->router = new Router('/wrong/index/');

        $this->router->routing();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Controller not found!
     */
    public function testWithoutControllerAndWrongMethod()
    {
        $this->router = new Router('/wrong/');

        $this->router->routing();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Controller not found!
     */
    public function testWrongControllerAndWithoutMethodAndWithIndexPhp()
    {
        $this->router = new Router('/index.php/wrong/');

        $this->router->routing();
    }

}