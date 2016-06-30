<?php

class Autoloader{

	static function register(){
		
		spl_autoload_register( array(__CLASS__ , 'app_autoload' ));

	}


	static function app_autoload($class){
	// echo " Classe a charger : <span class='label label-success'>".$class."</span><br>";
	// $class = str_replace('Bookcase\\mvc\\', '', $class);
	$class = str_replace('\\', '/', $class);
	
	// require_once "core/$class.php";
	require_once "core/$class.php";

	// require_once __NAMESPACE__."/$class.php";
	}


}

?>