<?php

function debug ($variable){
	if (!isset($variable)){

		echo "<pre> Aucune variable à débuguer n'est défini</pre>";

	}
	else{
		echo '<pre>' . print_r($variable, true) . '</pre>';
	}
	
}

?>