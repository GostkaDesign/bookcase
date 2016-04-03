<?php
/**
* 
*/
class Profile extends Controller {
	
	public function Index($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Profile_model');

		// On set la variable
		$user->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/index', ['name' => $user->name]);

	}

	public function Login($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Profile_model');

		// On set la variable
		$user->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/login', ['name' => $user->name]);

	}

	public function Register($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Profile_model');
		
		// On set la variable
		$user->name = $name;
		var_dump($user);

		// Définition de la vue à utiliser
		$this->view('profile/register', ['name' => $user->name]);

		// Définition du layout à utiliser
		// $this->layout('test');
	}


	public function Confirm($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Profile_model');

		// On set la variable
		$user->name = $name;
		var_dump($user);

		// Définition de la vue à utiliser
		$this->view('profile/confirm', ['name' => $user->name]);
	}


	public function Account($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Profile_model');

		// On set la variable
		$user->name = $name;
		var_dump($user);

		// Définition de la vue à utiliser
		$this->view('profile/account', ['name' => $user->name]);
	}


	public function Logout($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Profile_model');

		// On set la variable
		$user->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/logout', ['name' => $user->name]);
	}


	public function Password_remember($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Profile_model');

		// On set la variable
		$user->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/password_remember', ['name' => $user->name]);
	}


	public function Password_reset($name = ''){
		
		// Définition du modèle à utiliser
		$user = $this->model('Profile_model');

		// On set la variable
		$user->name = $name;

		// Définition de la vue à utiliser
		$this->view('profile/password_reset', ['name' => $user->name]);
	}

	
}
?>