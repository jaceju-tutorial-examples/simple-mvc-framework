<?php

class InterfaceTest extends PHPUnit_Extensions_SeleniumTestCase
{

    protected function setUp()
    {
        $this->_pdo = new PDO(
                        $GLOBALS['DB_DSN'],
                        $GLOBALS['DB_USER'],
                        $GLOBALS['DB_PASSWD']);
        $this->_pdo->query('TRUNCATE TABLE todo');

        Todo::setDb($this->_pdo);
        $this->_todo = new Todo();

        $this->setBrowser("*chrome");
        $this->setBrowserUrl("http://test.dev/");
    }

    public function testMyTestCase()
    {
        $this->open("/advanced_php_testing/mvc/");
        $this->type("id=new-todo", "Task 1");
        $this->keyPress("id=new-todo", "13");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("Task 1", $this->getText("//ul[@id='todo-list']/div[1]/div/div"));
        $this->type("id=new-todo", "Task 2");
        $this->keyPress("id=new-todo", "13");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("Task 2", $this->getText("//ul[@id='todo-list']/div[2]/div/div"));
    }
}