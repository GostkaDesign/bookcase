<?php

namespace Core;


class App
{
	
	protected $controller = 'home';

	protected $method = 'index';

	protected $params = [];

	//$url[0] = le controller à appeler dans ../app/controllers/
	//$url[1] = la methode qui serra appeler par dans le controller

	function __construct()
	{
		// Dispatcher
		$url = $this->parseUrl();
		
		if (file_exists(WEBAPP.'/controllers/' . $url[0] . '.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
		}
		require_once WEBAPP.'/controllers/' . $this->controller . '.php';


		// Instanciation du controller
		$this->controller = new $this->controller;
		// Passer la db aux controllers
		$this->controller->db = AppDB::getDatabase();

		if (isset($url[1]))
		{
			if (method_exists($this->controller, $url[1]))
			{	
				$this->method = $url[1];
				unset($url[1]);
			}
		}
		
		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);

	}

	public function parseUrl()
	{
		if (isset($_GET['url'])) {

			return $url = explode('/', filter_var ( rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

		}
	}

}


?>