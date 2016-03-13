<?php

class App
{
	
	protected $controller = 'home';

	protected $method = 'index';

	protected $params = [];

	function __construct()
	{
		// echo "App.php  : ";
		$this->parseUrl();
	}

	public function parseUrl()
	{
		if (isset($_GET['url'])) {
			echo $_GET['url'];
		}
	}
}


?>