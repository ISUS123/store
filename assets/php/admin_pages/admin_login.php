<?php
session_start();

require_once('../connection.php');

if(isset($_POST["login"]) && isset($_POST["password"])) {

};

$admin_login = 'admin'; //Admin login and password
$admin_password = 'admin11';

$login = $_POST['login'];
$password = $_POST['password'];

if ($login != $admin_login) {
    die('1'); //Wrong login
}

if (isset($_SESSION["session_adminname"])) {
    require_once 'admin_panel.php';
    exit(); //Already logged in, getting admin page
}

if ($login == $admin_login && $password == $admin_password) {
    $_SESSION['session_adminname'] = $login;
    require_once 'admin_panel.php'; //Login successful, getting admin page
} else {
    die('2'); //Wrong password
}

mysqli_close($link);
?>
