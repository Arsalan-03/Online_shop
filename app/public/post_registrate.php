<?php

print_r($_POST);



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

//// if($email === $email) {
//     $errors['email'][] = "Пользователь с такой почтой уже существует";
// }

 $password = $_POST['psw'];
 $password_repeat = $_POST['psw-repeat'];

 if(strlen($password) < 2) {
     $errors['password'][] = 'Пароль должен быть больше 2 символов';
 }

 if($password !== $password_repeat) {
     $errors['password'][] = 'Пароли не совпадают';
 }



 if(empty($errors)) {
     $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "arsik", "0000");

     $statement = $pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
     $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

     $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
     $statement->execute(['email' => $email]);
     $result = $statement->fetch(PDO::FETCH_ASSOC);
     print_r($result);
 } else {
     foreach($errors as $key) {
         foreach($key as $message) {
             echo $message . "<br>";
         }
     }
 }
?>

<form action="post_registrate.php" method="POST">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="name"><b>Name</b></label>
        <label style="color: red"><?php echo $errors['name']; ?></label>

        <input type="text" placeholder="Enter Name" name="name" id="name" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="psw"><b> </b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b
            ></label><input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
        <hr

        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.<
            /p><button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>

<style>
    * {box-sizing: border-box}

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity:1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
</style>

//print_r($pdo);

//$statement = $pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
//$statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);


#Выводит всех пользователей в таблице users
