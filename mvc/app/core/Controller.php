<?php

class Controller
{

	// private $vars = [];
	public $layout = "default";

	//Appel du model
	public function model ($model)
	{

		// echo 'DANS : APP/CORE/Controller.php<br>';
		// echo "require '../app/models/'" . $model . "'.php'<br>";
		require_once '../app/models/' . $model . '.php';
		// echo "return $model()<hr>";
		return new $model();

	}


	// Appel de la vue correspondante
	public function view($view, $data = [])
	{

		// echo 'DANS : APP/CORE/Controller.php<br>';
		// echo "require '../app/views/'" . $view . "'.php'<hr>";
		// 
		ob_start();
		require_once '../app/views/' . $view . '.php';
		$content_for_layout = ob_get_clean();
		if ($this->layout == false) {
			echo $content_for_layout;
		}else{
			echo $this->layout;
			require_once '../app/views/layouts/' . $this->layout . '.php';

		}

	}

	// Appel du layout
	public function layout($layout)
	{

		// require_once '../app/views/layout/' . $layout . '.php';
		echo "<br>layout a utiliser : " . $layout;
		$this->layout = $layout;

	}

	

	// Pour merger toutes les données envoyé au layout pour laffichage
	// public function set($datas){

	// 	// on merge toutes les données qui sont envoyées
	// 	$this->vars = array_merge($this->vars,$datas);

	// }

}


?>