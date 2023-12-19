<?php
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if($requestUri === '/registrate') {
    if($requestMethod === 'GET') {
        require_once "./html/registrate.php";
    }  elseif ($requestMethod === 'POST') {
            require_once "./handler/registrate.php";
        }else {
            echo"<h1>404 Метод $requestMethod не поддерживается для сайта $requestUri</h1>";
        }
    } elseif ($requestUri === '/login') {
        if($requestMethod === 'GET') {
            require_once "./html/login.php";
        }  elseif ($requestMethod === 'POST') {
            require_once "./handler/login.php";
        }else {
            echo"<h1>404 Метод $requestMethod не поддерживается для сайта $requestUri</h1>";
        }
    } elseif ($requestUri === '/main') {
        if($requestMethod === 'GET') {
            require_once "./handler/main.php";
        }else {
            echo"<h1>404 Метод $requestMethod не поддерживается для сайта $requestUri</h1>";
        }
    }else {
        require_once "./html/not_found.php";
    }
