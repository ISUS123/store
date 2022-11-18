<?php
    require_once 'connection.php';

    //Login availability check
    $login = $_POST['login'];

    $login_query = "SELECT login FROM customer WHERE login = '$login'";
    
    $logindb = mysqli_query($link, $login_query) or die("Ошибка проверки логина" . mysqli_error($link));
    
    if(mysqli_num_rows($logindb)  > 0) {
        die('1'); //This login already taken
    }

    //Email availability check
    $email = $_POST['email'];

    $email_query = "SELECT email FROM customer WHERE email = '$email'";

    $emaildb = mysqli_query($link, $email_query) or die("Ошибка проверки Email". mysqli_error($link));

    if(mysqli_num_rows($emaildb) > 0) {
        die('2'); //This email already registered
    }

    //Empty fields check
    if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['password'])) {
        die();
    }
    
    //Getting the remaining variables
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = trim($_POST['password']);
    
    //Query formation
    $query = "INSERT INTO customer VALUES(NULL, '$name', '$surname', '$patronymic', '$login', '$email', '$password')";
    
    //Query sending
    $result = mysqli_query($link, $query) or die("Ошибка отправки запроса " . mysqli_error($link));
    if($result) {
        echo "3"; //Successfull
    }
    
    mysqli_close($link);
?>