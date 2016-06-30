<?php
use \Core\Controller\Controller;


class Profile extends Controller {
	
	public function Index($name = ''){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');
		
		$this->view('profile/index');

	}

	public function Login(){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');
		$this->meta_title('dTitle de la page profil');
		$name ="Nom utilisateur";

		$this->view('profile/login', compact('name'));

	}

	public function Register($name = ''){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');
		
		$this->view('profile/register');

		// Définition du layout à utiliser
		// $this->layout('test');
	}


	public function Confirm($name = ''){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');
		

		
		$this->view('profile/confirm');
	}


	public function Account(){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');
		$this->meta_title('dTitle de ladsd page profil');
		
		// $this->updateSessionUser($user);

		// var_dump($vars);

		
		$this->view('profile/account', compact('name'));
	}


	public function Logout($name = ''){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');
		$this->view('profile/logout');
	}


	public function Password_remember($name = ''){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');

		$this->view('profile/password_remember');
	}


	public function Password_reset($name = ''){
		
		// Définition du modèle à utiliser
		$model = $this->model('Profile_model');

		$this->view('profile/password_reset');
	}

	
}
?>