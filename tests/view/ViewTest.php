<?php 
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/FakeEngine.php";

class ViewTest extends TestCase
{
    protected function setUp() 
    {
        # Hide terminal outputs
        // $this->setOutputCallback(function() {});
        
        $fakeEngine = new FakeEngine();
        $this->view = new View($fakeEngine);

        $this->view->assign(
            ['firstname' => 'Fellipe', 'lastname' => 'Pinheiro']
        );
    }

    protected function tearDown()
    {
        $this->view->clearAllAssign();
    }

    public function testInstance()
    {
        $this->assertInstanceOf( View::class, $this->view );
    }
    
    public function testTemplateVars()
    {
        $varsValues = $this->view->templateVars();
        $this->assertEquals(2, count($varsValues));
    }

    public function testAssignContext()
    {
        $this->view->assign(
            ['email' => 'pinheiro.llip@gmail.com']
        );

        $varsValues = $this->view->templateVars();
        
        $this->assertContains( 'Fellipe', $varsValues );
        $this->assertContains( 'Pinheiro', $varsValues );
        $this->assertContains( 'pinheiro.llip@gmail.com', $varsValues );
    }

    public function testClearAllAssings()
    {
        // Get the current size that must be 2: firstname and lastname
        $varsValues = $this->view->templateVars();
        $this->assertEquals(2, count($varsValues));
        
        // Clear the assings and get again.
        $this->view->clearAllAssign();
        $varsValues = $this->view->templateVars();
        
        $this->assertEquals(0, count($varsValues));
    }

    public function testFetchTemplateWithContextVars()
    {
        $this->view->assign(
            ['email' => 'pinheiro.llip@gmail.com']
        );
        $template = __DIR__ . "/fixtures/templateWithContext.html";
        
        $templateString = $this->view->fetch($template);

        $this->assertContains('<h1>Hello Fellipe Pinheiro</h1>', $templateString);
        $this->assertContains('<p>Your email is: pinheiro.llip@gmail.com</p>', $templateString);
    }

    public function testFetchTemplateWithoutContextVar()
    {
        $template = __DIR__ . "/fixtures/templateWithContext.html";
        
        $templateString = $this->view->fetch($template);

        $this->assertContains('<h1>Hello Fellipe Pinheiro</h1>', $templateString);
        // 'email' var was not assigned, must not appear.
        $this->assertContains('<p>Your email is: {$email}</p>', $templateString);
    }
}