<?php

class Router
{
	private $router;
	private $url;

	function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->router = require_once($routesPath);
		return $this->router;
	}

	public function run()
	{
		if(empty($_GET['url'])) $_GET['url'] = '/';

		if (!empty($_GET['url']))
		{
			$this->url = trim($_GET['url'], "/");

			foreach ($this->router as $key => $value)
			{
				// Совпдение роутов
				if ($key == $this->url)
				{
					$segment = explode("/", $value);

					$controllerName = ucfirst(array_shift($segment))."Controller";

					$actionName = "action".ucfirst(array_shift($segment));

					$controllerFile = "controllers/" . $controllerName . ".php";

					if (file_exists($controllerFile))
					{
						require_once($controllerFile);
					}

					$controllerobject = new $controllerName;
					$controllerobject->$actionName();
				}
			}
		}
	}
}