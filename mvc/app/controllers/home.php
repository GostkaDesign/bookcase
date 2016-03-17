<?php
/**
* 
*/
class Home  extends Controller
{
	
	public function index($name = '')
	{
		$user = $this->model('User');	// on defini le model
		$user->name = $name; // on le set

		// on cré la vu
		$this->view('home/index', ['name' => $user->name]); // pas de lien avec l'url mais avec l'architexture des fichier
	}
}
?>