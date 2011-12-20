<?php

class IndexControllerTest extends Test_ControllerTestCase
{
    public function setUp()
    {
        $todo = $this->_setUpTodo();
        $this->_request = new Request();
        $this->_response = new Response();
        $this->_controller = new IndexController($todo);
        parent::setUp();
    }

    protected function _setUpTodo()
    {
        $todo = Phake::mock('Todo');
        Phake::when($todo)->fetchAll()->thenReturn(array(
            array(
                'id' => 1,
                'task' => 'Task 1',
                'done' => 'n',
            ),
        ));
        return $todo;
    }

    public function tearDown()
    {
        $this->_request->reset();
        $this->_response->reset();
    }

    public function testHome()
    {
        $this->dispatch('/');
        $this->assertAction('index')
                ->assertResponseCode(200)
                ->assertQuery('#todo-list');
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
                ->assertQueryContain(
                    '#todo-list>.todo>.display>.todo-text',
                    'Task 1'
                );
    }
}
