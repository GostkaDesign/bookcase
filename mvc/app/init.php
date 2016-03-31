<?php

require_once 'core/App.php';
require_once 'core/Controller.php';

spl_autoload_register('app_autoload');

function app_autoload($class){
	
	require_once "core/$class.php";
}

?>