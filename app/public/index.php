<?php

//if (empty($errors)) {
//    $statement = $pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
//    $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);
//
//    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
//    $statement->execute(['email' => $email]);
//    $result = $statement->fetch(PDO::FETCH_ASSOC);
//    print_r($result);
//} else {
//    foreach($errors as $key) {
//        foreach($key as $message) {
//            echo $message . "<br>";
//        }
//    }
//}
//try {
//    $pdo = new PDO("pgsql:host=db;port=5432;dbname=room_bd;", "arsik", "0000");
//
////    print_r($pdo);
//} catch (PDOException $throwable) {
//    echo $throwable->getMessage();
//}
//echo "Hello, worllllld!";
////phpinfo();
//
