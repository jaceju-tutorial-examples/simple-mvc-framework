<?php

abstract class View
{

    /**
     * @var array
     */
    protected $_vars = array();

    /**
     * @param type $var
     * @param type $value
     */
    public function assign($var, $value = null)
    {
        if (is_array($var)) {
            foreach ($var as $name => $val) {
                if ($name != '') {
                    $this->_vars[$name] = $val;
                }
            }
        } else {
            if ($var != '') {
                $this->_vars[$var] = $value;
            }
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return isset($this->_vars[$name]) ? $this->_vars[$name] : NULL;
    }

    /**
     * @return string
     */
    public abstract function fetch();

    /**
     * @return void
     */
    public abstract function render();
}