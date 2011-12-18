<?php

class IndexController extends Controller
{

    /**
     * @var array
     */
    private $_todo = null;

    public function __construct(Todo $todo)
    {
        $this->_todo = $todo;
    }

    protected function index()
    {
        $view = new View_Html();
        $view->assign('todos', $this->_todo->fetchAll());
        $view->render('index.phtml');
    }

    protected function add()
    {
        if ($this->_request->isPost()) {
            $task = $_POST['task'];
            $this->_todo->add($task);
            $this->_redirect('./');
        }
    }

    protected function done()
    {
        if ($this->_request->isPost()) {
            $id = $_POST['id'];
            $this->_todo->done($id);
            $this->_redirect('./');
        }
    }
}