<?php

namespace App\Components;

class Router
{
    private $uri;
	private $routes = [
        'task/create' => 'task/create',
        'task/([0-9]+)/edit' => 'task/edit/$1',
        'task/([0-9]+)/success' => 'task/success/$1',
        'login' => 'auth/login',
        'logout' => 'auth/logout',
	    '' => 'task/index',
    ];

	public function __construct()
	{
        if (!empty($_SERVER['PATH_INFO'])) {
		    $this->uri = trim($_SERVER['PATH_INFO'], '/');
		}
	}

	public function run()
	{

        // Проходим по роутам в цикле
		foreach ($this->routes as $uriPattern => $path) {

            // Проверяем, есть ли совпадения между роутами и uri
			if(preg_match("~$uriPattern~", $this->uri)) {
                
                // Получаем внутренний путь из внешнего согласно правилу
				$internalRoute = preg_replace("~$uriPattern~", $path, $this->uri);
                
				$parameters = explode('/', $internalRoute);

                // Создаем правильное название контроллера исходя из названия роута
                $controllerName = '\App\Controllers\\';
				$controllerName .= ucfirst(array_shift($parameters).'Controller');

                // Создаем правильное название метода
				$actionName = array_shift($parameters);


                // Создаем обьект контроллера, вызываем нужный метод и передаем ему параметры
				$controllerObject = new $controllerName;
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                // Прерываем цикл, если контроллер был найден и вернул что-то
				if ($result != null) {
					break;
				}
			}

		}
	}
}