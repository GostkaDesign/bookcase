<?php
use \Core\Controller\Controller;

class Home extends Controller {
	
	public function index($name = '', $qqchose =''){

		$model = $this->model('home_model');

		// Définition de la vue à utiliser
		$this->view('home/index');
		
	}
}
?>