<?php

class Controller
{

	//private $vars = [];


	//Appel du model
	public function model ($model)
	{

		// echo 'DANS : APP/CORE/Controller.php<br>';
		// echo "require '../app/models/'" . $model . "'.php'<br>";
		require_once '../app/models/' . $model . '.php';
		// echo "return $model()<hr>";
		return new $model();

	}


	// Appel de la vue correspondante
	public function view($view, $data = [])
	{

		// echo 'DANS : APP/CORE/Controller.php<br>';
		// echo "require '../app/views/'" . $view . "'.php'<hr>";
		require_once '../app/views/' . $view . '.php';

	}

	// Appel du layout
	// A FAIRE
	public function layout($layout)
	{

		// require_once '../app/views/layout/' . $layout . '.php';
		echo "layout a utiliser" . $layout;

	}

	// Pour merger toutes les données envoyé au layout pour laffichage
	// public function set($datas){

	// 	// on merge toutes les données qui sont envoyées
	// 	$this->vars = array_merge($this->vars,$datas);

	// }

}


?>