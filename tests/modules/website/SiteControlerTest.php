	<?php 
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../FakeView.php';

class SiteControllerTest extends TestCase
{
    protected function setUp() 
    {
        $fakeView = new FakeView();
        $this->site = new SiteController($fakeView);
    }

    protected function tearDown()
    {
        $this->site->view->clearAllAssign();
    }

    public function testInstance()
    {
        $this->assertInstanceOf( SiteController::class, $this->site );
    }

    public function testIndexParamValue(){
        $this->setOutputCallback(function() {});

        $this->site->index("fellipe");

        $vars = $this->site->view->templateVars();

        $this->assertContains("fellipe", $vars);
    }
}