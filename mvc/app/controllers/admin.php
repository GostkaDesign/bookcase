<?php
/**
* 
*/
class Admin extends Controller {
	
	public function Index($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Admin_model');

		// On set la variable
		$user->name = $name;

		// Définition de la vue à utiliser
		$this->view('admin/index', ['name' => $user->name]);

	}

	public function Users($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Admin_model');

		// On set la variable
		$user->name = $name;

		// Définition de la vue à utiliser
		$this->view('admin/users', ['name' => $user->name]);

	}

}

?>