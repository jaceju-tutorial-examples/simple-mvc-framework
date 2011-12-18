<?php

class View_Html extends View
{

    /**
     * @return string
     */
    public function fetch()
    {
        $args = func_get_args();
        $templateFilename = $args[0];

        $html = '';
        ob_start();
        include APP_PATH . '/views/' . $templateFilename;
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    /**
     * @return void
     */
    public function render()
    {
        $args = func_get_args();
        $templateFilename = $args[0];
        echo $this->fetch($templateFilename);
    }

}
