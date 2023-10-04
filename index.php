<?php

session_start();

// session_regenerate_id();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)).'/gestion_incubateur');



$url = '';
if(isset($_GET['url']))
  $url = $_GET['url'];

require_once (ROOT . DS . 'config' . DS . 'config.php');
require_once (ROOT . DS . 'config' . DS . 'shared.php');



//CONTROLLER
setReporting();
$urlArray = callHook();
$controller = $urlArray[0];


require_once(ROOT . DS . 'php' . DS . $controller . '.php');
//VIEWS
require(ROOT . DS . 'views' . DS . 'meta.php'); 
require(ROOT . DS . 'php' . DS . 'header.php');
require(ROOT . DS . 'views' . DS . 'header.php');
require(ROOT . DS . 'php' . DS . 'menu.php');
require(ROOT . DS . 'views' . DS . 'menu.php');
require(ROOT . DS . 'views' . DS . $controller . DS . $view . '.php');
require(ROOT . DS . 'views' . DS . 'footer.php');
