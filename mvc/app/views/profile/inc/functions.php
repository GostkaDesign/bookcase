<?php

function debug ($variable){
	if (!isset($variable)){
		echo "<pre> Aucune variable à débuguer n'est défini</pre>";
	}
	else{
		echo '<pre>' . print_r($variable, true) . '</pre>';
	}
	
}

function str_random($lenght){

	$alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0 , $lenght);
}

function is_connected(){

	if (!isset($_SESSION['auth'])) {
		
		// $_SESSION['fash']['danger'] = "Acces denied. You must be loged."

		//Redirection vers la page profile
      	header('location:../login/');

      	exit();

	}
}

?>