<?php

class Home extends Controller {
	
	public function index($name = '', $qqchose =''){

		// Définition du modèle à utiliser
		//on peut appeler plusieur model !!!
		// ensuite on appelle les methodes du model
		// et on envoie a la vue
		$vars = $this->model('home_model');
		$vars = $this->layout('test_layout_home');
		
		// On set la variable
		// $vars->name = $name;
		// $vars->qqchose = $qqchose;
		// var_dump($vars);
		// Définition de la vue à utiliser
		$this->view('home/index', ['name' => $vars->name,'qqchose' => $vars->qqchose ]);
		// $this->view('home/index', $vars);
		// Note : pas de lien avec l'url mais avec l'architecture des fichier
	}
}
?>