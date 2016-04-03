<?php
/**
* 
*/
class Home extends Controller {
	
	public function index($name = ''){

		// Définition du modèle à utiliser
		$user = $this->model('User');	
		
		// On set la variable
		$user->name = $name; 

		// Définition de la vue à utiliser
		$this->view('home/index', ['name' => $user->name]);
		// Note : pas de lien avec l'url mais avec l'architecture des fichier
	}
}
?>