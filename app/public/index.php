<?php

require_once './../Autoloader.php';
//вызываем метод с помощью названия класса!
Autoloader::registrate(dirname(__DIR__)); //dirname - Возвращает имя родительского каталога из указанного пути
$app = new App(); //Создаём объект класса АPP
$app->run();//Запускаем метод run