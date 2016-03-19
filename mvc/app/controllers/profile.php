<?php
/**
* 
*/
class Profile  extends Controller
{
	
	public function Index($name = '')
	{
		// echo $name;
		$user = $this->model('User');	// on defini le model
		$user->name = $name; // on le set
		// on cré la vu
		$this->view('profile/index', ['name' => $user->name]); // pas de lien avec l'url mais avec l'architexture des fichier

	}

	public function Login($name = '')
	{
		// echo "PAGE Login <br>";
		// echo $name;
		$user = $this->model('User');	// on defini le model
		$user->name = $name; // on le set
		// on cré la vu
		$this->view('profile/login', ['name' => $user->name]); // pas de lien avec l'url mais avec l'architexture des fichier

	}

	public function Register($name = '')
	{

		// echo "PAGE Register <br>";
		$user = $this->model('User');	// on defini le model
		$user->name = $name; // on le set
		var_dump($user);
		// on cré la vu
		$this->view('profile/register', ['name' => $user->name]); // pas de lien avec l'url mais avec l'architexture des fichier
	}


	public function Confirm($name = '')
	{

		// echo "PAGE Confirm <br>";
		$user = $this->model('User');	// on defini le model
		$user->name = $name; // on le set
		var_dump($user);
		// on cré la vu
		$this->view('profile/confirm', ['name' => $user->name]); // pas de lien avec l'url mais avec l'architexture des fichier
	}

	public function Account($name = '')
	{

		// echo "PAGE Account <br>";
		$user = $this->model('User');	// on defini le model
		$user->name = $name; // on le set
		var_dump($user);
		// on cré la vu
		$this->view('profile/account', ['name' => $user->name]); // pas de lien avec l'url mais avec l'architexture des fichier
	}

	public function Logout($name = '')
	{

		// echo "PAGE Logout <br>";
		$user = $this->model('User');	// on defini le model
		$user->name = $name; // on le set
		// var_dump($user);
		// on cré la vu
		$this->view('profile/logout', ['name' => $user->name]); // pas de lien avec l'url mais avec l'architexture des fichier
	}

	
}
?>