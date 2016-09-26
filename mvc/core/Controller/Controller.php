<?php

namespace Core\Controller;

use \App\Models\User;
use \Core\Model\Model;



class Controller{

	private $db;
	// private $vars = [];
	public $layout = "default";
	private $data = array();
	private $meta_title="BookCase";
	private $meta_description="Description";
	private $meta_author="Gostka Design";

	//Appel du model
	// $dependance sert à passer des param au model comme la $db
	// Permet d'eviter de lier le code dans les classes
	// 
	
	public function model ($model, $dependance = []){
		
		require_once WEBAPP.'/models/' . $model . '.php';

		return new $model($dependance);

	}


	// Appel de la vue correspondante
	public function view($view, $data = [])	{
		
		// var_dump($data);
		// 
		// permet de separer les entrees du tableau en var toutes simples
		//
		//
		ob_start();
		extract($data);
		$meta_title = $this->meta_title;
		$meta_description = $this->meta_description;
		$meta_author = $this->meta_author;
		
		
		require_once WEBAPP.'/views/' . $view . '.php';
		$content_for_layout = ob_get_clean();


		if ( isset($this->layout) ) {
			// echo WEBAPP.'/views/layouts/' . $this->layout . '.php';
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

	public function meta_description($meta_description){

		if (isset($meta_description)){

			$this->meta_description = $meta_description;
			return $this->meta_description;

		}
		else {

			return $this->meta_description;

		}

	}

	public function meta_author($meta_author){

		if (isset($meta_author)){

			$this->meta_author = $meta_author;
			return $this->meta_author;

		}
		else {

			return $this->meta_author;

		}

	}

	

	// Pour merger toutes les données envoyé au layout pour laffichage
	// public function set($datas){

	// 	// on merge toutes les données qui sont envoyées
	// 	$this->vars = array_merge($this->vars,$datas);

	// }

}


?>