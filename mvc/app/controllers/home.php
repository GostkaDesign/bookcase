<?php

class Home extends Controller {
	
	public function index($name = '', $qqchose =''){

		// Définition du modèle à utiliser
		//on peut appeler plusieur model !!!
		// ensuite on appelle les methodes du model
		// et on envoie a la vue
		$data = $this->model('home_model');
		// $data->layout = $this->layout('test_layout_home');
		$data->test = "petit test";
		
		// Définition de la vue à utiliser
		$this->view('home/index', $data);
		
	}
}
?>