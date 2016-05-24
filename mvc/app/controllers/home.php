<?php
/**
* 
*/
class Home extends Controller {
	
	public function index($name = '', $qqchose =''){

		// Définition du modèle à utiliser
		$user_var = $this->model('User');	
		
		// On set la variable
		$user_var->name = $name;
		$user_var->qqchose = $qqchose; 

		// Définition de la vue à utiliser
		$this->view('home/index', ['name' => $user_var->name,'qqchose' => $user_var->qqchose ]);
		// Note : pas de lien avec l'url mais avec l'architecture des fichier
	}
}
?>