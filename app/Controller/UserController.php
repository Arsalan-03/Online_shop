<?php

namespace Controller;

use Model\User;

class UserController
{
    private User $modelUser;
    public function __construct()
    {
        $this->modelUser = new User();
    }

    public function getRegistrate(): void
    {
        require_once "./../View/registrate.php";
    }

    public function registrate(): void
    {
        $errors = $this->regValidate($_POST);
        if (empty($errors)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['psw'];

            $password = password_hash($password, PASSWORD_DEFAULT);

            $this->modelUser->create($name, $email, $password);

            header("Location: /login");
        } else {
            require_once('./../View/registrate.php');
        }
    }

    private function regValidate(array $data): array
    {
        $errors = [];

        $name = $data['name'];
        if (strlen($name) < 2) {
            $errors['name'] = 'Имя должен быть больше 2 символов';
        }

        $email = $data['email'];
        if (strlen($email) < 2) {
            $errors['email'] = 'email должен быть больше 2 символов';
        } else {
            $str = "@";
            $pos = strpos($email, $str);

            if ($pos === false) {
                $errors['email'] = "email должен содержать символ @ в строке";
            } else {
                if (!empty($this->modelUser->getOneByEmail($email))) {
                    $errors['email'] = "Пользователь с таким email уже существует";
                }
            }
        }

        $password = $data['psw'];
        $password_repeat = $data['psw-repeat'];

        if (strlen($password) < 2) {
            $errors['password'] = 'Пароль должен быть больше 2 символов';
        } else {
            if ($password !== $password_repeat) {
                $errors['password'] = 'Пароли не совпадают';
            }
        }
        return $errors;
    }

    public function getLogin(): void
    {
        require_once "./../View/login.php";
    }

    public function login()
    {
        $errors = [];

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (strlen($email) < 2) {
            $errors['email'] = "email должен быть больше 2 символов";
        }
        if (empty($errors)) {
            $result = $this->modelUser->getOneByEmail($email);

            if (empty($result)) {
                $errors['email'] = 'Пользователя не существует';
            } else {
                if (password_verify($password, $result['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $result['id'];
                    header("Location: /main");
                } else {
                    $errors['password'] = 'Неверный пароль или логин';
                }
            }
            return $errors;
        }
        require_once "./../View/login.php";
    }

    public function loqout(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header("Location: /login");
    }
}