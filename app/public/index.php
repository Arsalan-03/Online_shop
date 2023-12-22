<?php
require_once './../App.php';
$controllerAutoloader = function (string $className) // Анонимные функции
{
    //Controller\UserController - был таким
    // а теперь с помощью константы DIRECTORY_SEPARATOR, стал вот таким - Controller/UserController
    // '\\' - первый слэш экранирует, а второй означает, то что наш слэш обратный
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    //str_replace - Заменяет все вхождения строки поиска на строку замены

    $path = dirname(__DIR__) . '/' . $path . '.php';

    if (file_exists($path)) { // Проверяет, есть ли такой файл
        require_once $path;
        return true;
    }
    return false; //Если нет такого файла, то переходит на другой Autoloader
};


spl_autoload_register($controllerAutoloader); // Запускает Автолоадер

$app = new App(); //Создаём объект класса АPP
$app->run();//Запускаем метод run