<?php

class Request
{
    /**
     * @var string
     */
    protected $_action = 'index';

    /**
     * @var type
     */
    protected $_headers = array(
        'REQUEST_METHOD' => 'GET',
    );

    /**
     * @return void
     */
    public function parseUrl()
    {
        $this->_action = isset($_GET['act'])
                       ? strtolower($_GET['act'])
                       : 'index';
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->setHeader('REQUEST_METHOD', strtoupper($method));
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function setHeader($name, $value)
    {
        $this->_headers[$name] = $value;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return ('POST' === $this->_headers['REQUEST_METHOD']);
    }

    /**
     * @return bool
     */
    public function isAjax()
    {
        return ('XMLHttpRequest' === $this->_headers['X_REQUESTED_WITH']);
    }

    /**
     * @return void
     */
    public function reset()
    {
        $_GET = array();
        $_POST = array();
        $_COOKIE = array();
        $this->_action = 'index';
        $this->_headers = array(
            'REQUEST_METHOD' => 'GET',
        );
    }
}