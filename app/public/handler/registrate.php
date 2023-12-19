<?php

//print_r($_POST);



$errors = [];

$name = $_POST['name'];
 if(strlen($name) < 2) {
    $errors['name'] = 'Имя должен быть больше 2 символов';
 }

$email = $_POST['email'];
 if(strlen($email) < 2) {
     $errors['email'] = 'email должен быть больше 2 символов';
 } else {
     $str = "@";
     $pos = strpos($email, $str);

     if($pos === false) {
         $errors['email'] = "email должен содержать символ @ в строке";
     }
 }

 $password = $_POST['psw'];
 $password_repeat = $_POST['psw-repeat'];

 if(strlen($password) < 2) {
     $errors['password'] = 'Пароль должен быть больше 2 символов';
 } else {
     if($password !== $password_repeat) {
         $errors['password'] = 'Пароли не совпадают';
     }
 }
$password = password_hash($password, PASSWORD_DEFAULT);



 if(empty($errors)) {
     $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "arsik", "0000");

     $statement = $pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
     $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

     header("Location: /login");
 }
require_once('./html/registrate.php');
?>

