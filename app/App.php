<?php

use \Controller\UserController;
use \Controller\MainController;
class App
{
    private array $routes = [ //Регистрация маршрута
        '/registrate' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getRegistrate',
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'registrate',
            ],
        ],
        '/login' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getLogin',
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'login',
            ],
        ],
        '/main' => [
            'GET' => [
                'class' => MainController::class,
                'method' => 'getProducts',
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'logout',
            ],
        ],
    ];

    public function run() //Маршрутизация
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        $obj = new UserController();

        if (isset($this->routes[$requestUri])) {
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $routMethods = $this->routes[$requestUri];

            if (isset($routMethods[$requestMethod])) {
                $handler = $routMethods[$requestMethod];

                $class = $handler['class'];
                $method = $handler['method'];

                $obj = new $class;
                $obj->$method($_POST);

            } else {
                echo "<h1>404 Метод $requestMethod не поддерживается для сайта $requestUri</h1>";
            }
        } else {
            require_once "./../View/not_found.php"; //если нет такого файла, выдаём ошибку
        }
    }
}
