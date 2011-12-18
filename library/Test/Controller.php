<?php
require_once 'phpQuery.php';

class Test_Controller extends PHPUnit_Framework_TestCase
{
    /**
     * @var Controller
     */
    protected $_controller = null;

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
    public function setUp()
    {
        $this->_controller->setRequest($this->_request)
                            ->setResponse($this->_response);
    }

    /**
     * @param string $url
     */
    protected function _parseUrl($url)
    {
        $urlInfo = parse_url($url);
        if (isset($urlInfo['query'])) {
            parse_str($urlInfo['query'], $_GET);
        }
    }

    /**
     * @param string $url
     * @return Test_Controller
     */
    public function dispatch($url)
    {
        $this->_parseUrl($url);
        $this->_controller->dispatch();
        return $this;
    }

    /**
     * @param int $code
     * @return Test_Controller
     */
    public function assertResponseCode($code)
    {
        $this->assertEquals($code, $this->_response->getHttpResponseCode());
        return $this;
    }

    /**
     * @param string $action
     * @return Test_Controller
     */
    public function assertAction($action)
    {
        $this->assertEquals($action, $this->_request->getAction());
        return $this;
    }

    /**
     * @param type $url
     * @return Test_Controller
     */
    public function assertRedirectTo($url)
    {
        $redirectUrl = $this->_response->getHeader('Location');
        $this->assertEquals($url, $redirectUrl);
        $this->_request->reset();
        $this->_response->reset();
        $this->dispatch($url);
        return $this;
    }

    /**
     * @param string $selector
     * @return Test_Controller
     */
    public function assertQuery($selector)
    {
        $content = $this->_response->getContent();
        $pq = phpQuery::newDocument($content);
        $this->assertGreaterThanOrEqual(1, $pq->find($selector)->size());
        return $this;
    }

    /**
     * @param string $selector
     * @param string $content
     * @return Test_Controller
     */
    public function assertQueryContain($selector, $text)
    {
        $content = $this->_response->getContent();
        $pq = phpQuery::newDocument($content);
        $this->assertEquals($text, $pq->find($selector)->text());
        return $this;
    }
}