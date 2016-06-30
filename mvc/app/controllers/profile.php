<?php

// namespace App\Controllers;

// use \App\Core\Controller;
/**
* 
*/
class Profile extends Controller {
	
	public function Index($name = ''){
		
		// Définition du modèle à utiliser
		$mode = $this->model('Profile_model');

		// On set la variable
		// $vars->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/index', ['name' => $vars->name]);

	}

	public function Login($name = ''){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');
		$this->meta_title('dTitle de la page profil');

		// On set la variable
		// $vars->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/login', ['name' => $vars->name]);

	}

	public function Register($name = ''){
		
		// Définition du modèle à utiliser
		$mode = $this->model('Profile_model');
		
		// On set la variable
		// $vars->name = $name;
		var_dump($vars);

		// Définition de la vue à utiliser
		$this->view('profile/register', ['name' => $vars->name]);

		// Définition du layout à utiliser
		// $this->layout('test');
	}


	public function Confirm($name = ''){
		
		// Définition du modèle à utiliser
		$mode = $this->model('Profile_model');

		// On set la variable
		// $vars->name = $name;
		var_dump($vars);

		// Définition de la vue à utiliser
		$this->view('profile/confirm', ['name' => $vars->name]);
	}


	public function Account($name = ''){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');
		$this->meta_title('dTitle de la page profil');

		$name = $model->name;
		
		
		// $this->updateSessionUser($user);
		
		// On set la variable
		// $vars->name = $name;
		
		// var_dump($vars);

		// Définition de la vue à utiliser
		$this->view('profile/account', compact('name'));
	}


	public function Logout($name = ''){
		
		// Définition du modèle à utiliser
		$mode = $this->model('Profile_model');

		// On set la variable
		// $vars->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/logout', ['name' => $vars->name]);
	}


	public function Password_remember($name = ''){
		
		// Définition du modèle à utiliser
		$mode = $this->model('Profile_model');

		// On set la variable
		// $vars->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/password_remember', ['name' => $vars->name]);
	}


	public function Password_reset($name = ''){
		
		// Définition du modèle à utiliser
		$mode = $this->model('Profile_model');

		// On set la variable
		// $vars->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/password_reset', ['name' => $vars->name]);
	}

	
}
?>