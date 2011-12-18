<?php
define('ROOT_PATH', realpath(dirname(__DIR__)));
define('APP_PATH', ROOT_PATH . '/application');
define('LIB_PATH', ROOT_PATH . '/library');

set_include_path(implode(PATH_SEPARATOR, array(
    LIB_PATH,
    APP_PATH . '/controllers',
    APP_PATH . '/models',
    get_include_path(),
)));

function autoload($className)
{
    $className = str_replace('_', '/', $className);
    require_once "$className.php";
}

spl_autoload_register('autoload');
