<?php

class TodoTest extends PHPUnit_Framework_TestCase
{
    private $_pdo = null;

    private $_todo = null;

    public function setUp()
    {
        $this->_pdo = new PDO(
                $GLOBALS['DB_DSN'],
                $GLOBALS['DB_USER'],
                $GLOBALS['DB_PASSWD']);
        $this->_pdo->query('TRUNCATE TABLE todo');

        Todo::setDb($this->_pdo);
        $this->_todo = new Todo();
    }

    public function tearDown()
    {
        $this->_pdo->query('TRUNCATE TABLE todo');
    }

    public function testAdd()
    {
        $this->assertEquals(1, $this->_todo->add('Task 1'));
        $this->assertEquals(2, $this->_todo->add('Task 2'));
    }

    public function testFetchAll()
    {
        $this->_todo->add('Task 1', 'm');
        $this->_todo->add('Task 2', 'f');

        $result = $this->_todo->fetchAll();
        $this->assertEquals(2, count($result));

        $this->assertContains('Task 1', $result[0]);
        $this->assertContains('Task 2', $result[1]);
    }

    public function testDone()
    {
        $this->_todo->add('Task 1');
        $this->_todo->add('Task 2');

        $this->assertEquals(1, $this->_todo->done(1));
        $this->assertEquals(1, $this->_todo->done(2));
        $this->assertEquals(0, $this->_todo->done(3));
    }
}