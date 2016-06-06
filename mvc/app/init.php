<?php

use \Bookcase\App;
spl_autoload_register('app_autoload');

function app_autoload($class){
	$class = str_replace('Bookcase\\', '', $class);
	// $class = str_replace('\\', '/', $class)
	// var_dump($class);
	require_once "core/$class.php";
}

// $config = new Config();

// var_dump($config);

// plus neccessaire puisqu'on utilise l'autoload
// require_once 'core/App.php';
// require_once 'core/Controller.php';

?>