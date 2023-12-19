<?php
//print_r($_POST);
$errors = [];

$email = $_POST['email'];
  if(strlen($email) < 2) {
      $errors['email'] = "email должен быть больше 2 символов";
  }

$password = $_POST['password'];
  if(strlen($password) < 2) {
      $errors['password'] = "пароль должен быть больше 2 символов";
  }
$password= password_hash($password, PASSWORD_DEFAULT);

//print_r($errors);

if(empty($errors)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "arsik", "0000");

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $statement->execute(['email' => $email]);
    $result = $statement->fetch();

        if(empty($result)) {
        $errors['email'] = 'Пользователя не существует';
    } else {
        if (password_verify($password, $result['password'])) {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            header("Location: /main");
        }else{
            $errors['password'] = 'Неверный пароль или логин';
            }
        }
    }
require_once "./html/login.php";
?>

