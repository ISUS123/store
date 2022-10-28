<?php
session_start();

require_once('connection.php');

$login = $_POST['login'];

$query = mysqli_query($link,"SELECT * FROM customer WHERE login = '$login'");
    $data = mysqli_fetch_assoc($query);

if(empty($data)) {
    die('1');
}

if(isset($_SESSION["session_username"])){
    exit('3');
}


if(!empty($_POST['login']) && !empty($_POST['password'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $query = mysqli_query($link, "SELECT * FROM customer WHERE login = '$login'");
    $numrows = mysqli_num_rows($query);
    if($numrows!=0) 
    {
        while($row=mysqli_fetch_assoc($query)) {
            $dblogin=$row['login'];
            $dbpassword=$row['password'];
        }
        if($login == $dblogin && $password == $dbpassword) {
            $_SESSION['session_username'] = $login;
            echo "3";
        } else {
            echo "2";
        }
    }
}

mysqli_close($link);
?>