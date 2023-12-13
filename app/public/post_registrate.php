<?php

print_r($_POST);

$name = $_POST['name'];
 if(strlen($name) < 1) {
    echo 'Имя должен быть больше 2 символов';
}

$email = $_POST['email'];
 if(strlen($email) < 1) {
     echo 'email должен быть больше 2 символов';
 }
 $str = "@";
 $pos = strpos($email, $str);

 if($pos !== true) {
     echo "email должен содержать символ @ в строке";
 }

 $password = $_POST['psw'];
 $password_repeat = $_POST['psw-repeat'];

 if(strlen($password) < 1) {
     echo 'Пароль должен быть больше 2 символов';
 }

 if($password !== $password_repeat) {
     echo 'Пароли не совпадают';
 }

$pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "arsik", "0000");

//print_r($pdo);

$statement = $pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
$statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);


#Выводит всех пользователей в таблице users
$statement = $pdo->prepare('SELECT * FROM users WHERE name = :name');
$statement->execute(['name' => $name]);
$result = $statement->fetch();
print_r($result);