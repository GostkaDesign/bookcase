<?php

class Controller
{
	//Appel du model
	public function model ($model)
	{
		// echo 'DANS : APP/CORE/Controller.php<br>';
		// echo "require '../app/models/'" . $model . "'.php'<br>";
		require_once '../app/models/' . $model . '.php';
		// echo "return $model()<hr>";
		return new $model();
	}
	//Traitement

	// Appel de la vue correxpondante
	public function view($view, $data = [])
	{
		// echo 'DANS : APP/CORE/Controller.php<br>';
		// echo "require '../app/views/'" . $view . "'.php'<hr>";
		require_once '../app/views/' . $view . '.php';
	}
}


?>