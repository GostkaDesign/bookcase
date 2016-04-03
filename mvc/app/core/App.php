<?php

class App
{
	
	protected $controller = 'home';

	protected $method = 'index';

	protected $params = [];

	function __construct()
	{
		
		$url = $this->parseUrl();
		// echo "TEST si le fichier existe'../app/controllers/'" . $url[0] . "'.php'<br>";
		if (file_exists('../app/controllers/' . $url[0] . '.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
			// echo 'le fichier existe<br>';
		}

		// echo 'DANS : APP/CORE/App.php<br>';
		// echo "require '../app/controllers/'" . $this->controller . "'.php'<hr>";
		require_once '../app/controllers/' . $this->controller . '.php';

		$this->controller = new $this->controller;

		if (isset($url[1]))
		{
			if (method_exists($this->controller, $url[1]))
			{
				// echo 'ok le fichier existe vraiment';
				$this->method = $url[1];
				unset($url[1]);
			}else {
				echo 'CETTE METHODE NEXISTE PAS';
			}
		}
		// var_dump($url);
		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	public function parseUrl()
	{
		if (isset($_GET['url'])) {
			// echo $_GET['url'];
			return $url = explode('/', filter_var ( rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}


?>