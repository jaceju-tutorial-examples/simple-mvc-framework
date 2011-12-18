<?php

abstract class Controller
{
    /**
     * @var Request
     */
    protected $_request = null;

    /**
     * @var Response
     */
    protected $_response = null;

    /**
     * @return void
     */
    protected abstract function index();

    /**
     * @param Request $request
     * @return Controller
     */
    public function setRequest(Request $request)
    {
        $this->_request = $request;
        return $this;
    }

    /**
     * @param Response $response
     * @return Controller
     */
    public function setResponse(Response $response)
    {
        $this->_response = $response;
        return $this;
    }

    /**
     * @var bool
     */
    protected $_sendResponse = false;

    /**
     * @param bool $sendResponse
     * @return Controller
     */
    public function sendResponse($sendResponse)
    {
        $this->_sendResponse = (bool) $sendResponse;
        return $this;
    }

    /**
     * @return void
     */
    public final function dispatch()
    {
        ob_start();
        $this->_request->parseUrl();
        $action = $this->_request->getAction();
        if (method_exists($this, $action)) {
            $this->$action();
            $this->_response->setContent(ob_get_clean());
        } else {
            $this->_response->setHttpResponseCode(404);
        }

        if ($this->_sendResponse) {
            $this->_response->output();
        }
    }

    /**
     * @param string $url
     */
    protected function _redirect($url)
    {
        $this->_response->setHeader('Location', $url);
    }
}