<?php
print_r($_POST);

$errors = [];

 $email = $_POST['email'];
  if(strlen($email) < 2) {
      $errors['email'] = 'email должен быть больше 2 символов';
  } else {
      $str = '@';
      $pdo = strpos($email, $str);
  if($pdo === false) {
      $errors['email'] = 'email должен содержать @ символ в строке';
         }
  }

 $password = $_POST['password'];
  if(strlen($password) < 2) {
      $errors['password'] = 'Пароль должен содержать больше 2 символов';
  }

  if (empty($errors)) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "arsik", "0000");

      $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
      $statement->execute(['email' => $email]);
      $res = $statement->fetch(PDO::FETCH_ASSOC);
      print_r($res);
  }