	<?php 
use PHPUnit\Framework\TestCase;

class SiteControllerTest extends TestCase
{
    protected function setUp() 
    {
        $this->site = new SiteController();
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

    // public function testeIfTemplateExists()
    // {
    //     $template = $this->site->temaplateDir . 'home.html';
    //     var_dump($this->site->view->currentFile());
    //     $this->assertTrue($this->site->view->templateExists('index.html'));
    // }
}