<?php

print_r($_POST);

$pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "arsik", "0000");

$errors = [];

$name = $_POST['name'];
 if(strlen($name) < 2) {
    $errors['name'][] = 'Имя должен быть больше 2 символов';
}

$email = $_POST['email'];
 if(strlen($email) < 2) {
     $errors['email'][] = 'email должен быть больше 2 символов';
 }
 $str = "@";
 $pos = strpos($email, $str);

 if($pos === false) {
     $errors['email'][] = "email должен содержать символ @ в строке";
 }

 $password = $_POST['psw'];
 $password_repeat = $_POST['psw-repeat'];

 if(strlen($password) < 2) {
     $errors['password'][] = 'Пароль должен быть больше 2 символов';
 }

 if($password !== $password_repeat) {
     $errors['password'][] = 'Пароли не совпадают';
 }

 if (empty($errors)) {
     $statement = $pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
     $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);
 } else {
     foreach($errors as $key) {
         foreach($key as $message) {
             echo $message . "<br>";
         }
     }
 }


//print_r($pdo);

//$statement = $pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
//$statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);


#Выводит всех пользователей в таблице users
//$statement = $pdo->prepare('SELECT * FROM users WHERE name = :name');
//$statement->execute(['name' => $name]);
//$result = $statement->fetch();
//print_r($result);