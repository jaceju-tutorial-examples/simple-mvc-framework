<?php

class IndexController extends Controller
{

    /**
     * @var array
     */
    private $_todos = null;

    public function __construct()
    {
        $this->_todos = new Todo();
    }

    protected function index()
    {
        $view = new View_Html();
        $view->assign('todos', $this->_todos->fetchAll());
        $view->render('index.tpl.php');
    }

    protected function add()
    {
        if ($this->_request->isPost()) {
            $task = $_POST['task'];
            $this->_todos->add($task);
            $this->_redirect('./');
        }
    }

    protected function done()
    {
        if ($this->_request->isPost()) {
            $id = $_POST['id'];
            $this->_todos->done($id);
            $this->_redirect('./');
        }
    }
}