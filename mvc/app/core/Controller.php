<?php

class Controller
{
	//Appel du model
	public function model ($model)
	{
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}
	//Traitement

	// Appel de la vue correxpondante
	public function view($view, $data = [])
	{
		require_once '../app/views/' . $view . '.php';
	}
}


?>