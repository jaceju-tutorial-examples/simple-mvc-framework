<?php

class Request_Http extends Request
{
    /**
     * @return bool
     */
    public function isPost()
    {
        return ('POST' === $_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return bool
     */
    public function isAjax()
    {
        return ('XMLHttpRequest' === $_SERVER['X_REQUESTED_WITH']);
    }
}
