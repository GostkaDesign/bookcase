<?php

class Autoloader{

	static function register(){
		
		spl_autoload_register( array(__CLASS__ , 'app_autoload' ));

	}


	static function app_autoload($class){
	// $class = str_replace('\\', '/', $class);
	echo " Classe a charger : <span class='label label-success'>".$class."</span><br>";
	// $class = str_replace('Bookcase\\mvc\\', '', $class);
	
	require_once "$class.php";
	}


}

?>