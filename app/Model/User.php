<?php

namespace Model;


class User extends Model
{

    public function getOneByEmail(string $email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);
        $result = $statement->fetch();

        return$result;
    }

    public function create(string $name, string $email, string $password)
    {
        $statement = $this->pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }
}