<?php
require APP_PATH . '/controllers/IndexController.php';

class IndexControllerTest extends Test_Controller
{
    public function setUp()
    {
        $pdo = new PDO(
                $GLOBALS['DB_DSN'],
                $GLOBALS['DB_USER'],
                $GLOBALS['DB_PASSWD']);
        $pdo->query('TRUNCATE TABLE todo');

        Todo::setDb($pdo);

        $this->_request = new Request();
        $this->_response = new Response();
        $this->_controller = new IndexController();
        parent::setUp();
    }

    public function testHome()
    {
        $this->dispatch('/');
        $this->assertAction('index');
        $this->assertResponseCode(200);
    }

    public function testNotFound()
    {
        $this->dispatch('/?act=fake');
        $this->assertResponseCode(404);
    }

    public function testAdd()
    {
        $this->_request->setMethod('POST');
        $_POST['task'] = 'Task 1';
        $this->dispatch('/?act=add')
                ->assertAction('add')
                ->assertRedirectTo('./')
                ->assertResponseCode(200)
                ->assertQuery('#todo-list');
    }

    public function tearDown()
    {
        $this->_request->reset();
        $this->_response->reset();
    }
}
