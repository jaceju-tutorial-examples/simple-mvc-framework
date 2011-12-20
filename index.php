<?php
define('ROOT_PATH', __DIR__);
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

define('DB_DSN', 'mysql:dbname=development;host=127.0.0.1');
define('DB_USER', 'username');
define('DB_PASSWD', 'password');

$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWD);
Todo::setDb($pdo);

$controller = new IndexController(new Todo());
$controller->setRequest(new Request_Http())
        ->setResponse(new Response_Http())
        ->sendResponse(true)
        ->dispatch();