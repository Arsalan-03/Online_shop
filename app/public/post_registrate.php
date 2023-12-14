<?php

print_r($_POST);



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


//// if($email === $email) {
//     $errors['email'][] = "Пользователь с такой почтой уже существует";
// }

 $password = $_POST['psw'];
 $password_repeat = $_POST['psw-repeat'];

 if(strlen($password) < 2) {
     $errors['password'] = 'Пароль должен быть больше 2 символов';
 } elseif($password !== $password_repeat) {
         $errors['password'] = 'Пароли не совпадают';
 }

print_r($errors);



 if(empty($errors)) {
     $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "arsik", "0000");

     $statement = $pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
     $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

     $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
     $statement->execute(['email' => $email]);
     $result = $statement->fetch(PDO::FETCH_ASSOC);
     print_r($result);
 }
require_once('get_registrate.php');
?>

