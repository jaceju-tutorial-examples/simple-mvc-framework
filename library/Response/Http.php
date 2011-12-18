<?php

class Response_Http extends Response
{
    /**
     * @staticvar boolean $httpResponseCodeSent
     */
    public function sendHeaders()
    {
        static $httpResponseCodeSent = false;

        foreach ($this->_headers as $name => $content) {
            if (!$httpResponseCodeSent) {
                header("$name: $content", true, $this->_httpResponseCode);
                $httpResponseCodeSent = true;
            } else {
                header("$name: $content");
            }
        }
    }
}
