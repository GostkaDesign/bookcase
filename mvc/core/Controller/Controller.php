<?php

namespace Core\Controller;


class Controller{

	// private $vars = [];
	public $layout = "default";
	private $data = array();
	private $meta_title="BookCase";

	//Appel du model
	// $dependance sert à passer des param au model comme la $db
	// Permet d'eviter de lier le code dans les classes
	// 
	
	public function model ($model, $dependance = null){
		require_once WEBAPP.'/models/' . $model . '.php';
		return new $model($dependance);

	}


	// Appel de la vue correspondante
	public function view($view, $data = [])	{
		
		// var_dump($data);
		// 
		// permet de separer les entrees du tableau en var toutes simples
		//
		$data['meta_title'] = $this->meta_title;
		ob_start();
		extract($data);
		require_once WEBAPP.'/views/' . $view . '.php';
		$content_for_layout = ob_get_clean();


		if ( isset($this->layout) ) {
			require_once WEBAPP.'/views/layouts/' . $this->layout . '.php';

		}

	}

	// Appel du layout
	public function layout($layout){

		$this->layout = $layout;
		return $this->layout;

	}

	public function meta_title($meta_title){

		if (isset($meta_title)){

			$this->meta_title = $meta_title;
			return $this->meta_title;

		}
		else {

			return $this->meta_title;

		}

	}

	

	// Pour merger toutes les données envoyé au layout pour laffichage
	// public function set($datas){

	// 	// on merge toutes les données qui sont envoyées
	// 	$this->vars = array_merge($this->vars,$datas);

	// }

}


?>