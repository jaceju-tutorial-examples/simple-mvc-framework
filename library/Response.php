<?php

class Response
{
    /**
     * @var array
     */
    protected $_headers = array(
        'Content-Type' => 'text/html; charset=utf-8',
    );

    /**
     * @param string $name
     * @param string $content
     */
    public function setHeader($name, $content)
    {
        $this->_headers[$name] = $content;
    }

    /**
     * @param type $name
     * @return type
     */
    public function getHeader($name)
    {
        return isset($this->_headers[$name])
             ? $this->_headers[$name]
             : null;
    }

    /**
     * @var int
     */
    protected $_httpResponseCode = 200;

    /**
     * @param int $code
     */
    public function setHttpResponseCode($code)
    {
        $this->_httpResponseCode = $code;
    }

    /**
     * @return int
     */
    public function getHttpResponseCode()
    {
        return $this->_httpResponseCode;
    }

    /**
     * @var string
     */
    protected $_content = '';

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param bool $return
     */
    public function output()
    {
        $this->sendHeaders();
        echo $this->_content;
    }

    /**
     * @return void
     */
    protected function sendHeaders()
    {

    }

    /**
     * @return void
     */
    public function reset()
    {
        $this->_headers = array(
            'Content-Type' => 'text/html; charset=utf-8',
        );
        $this->_content = null;
        $this->_httpResponseCode = 200;
    }
}
