<?php session_start() ?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copy Star</title>
    <link rel="stylesheet/less" type="text/css" href="assets/css/style.less" />
    <script src="assets/js/less@4.js"></script>
    <!-- <script src="assets/js/jquery-3.6.1.min.js"></script> -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="shortcut icon" href="../assets/img/favicon.png" sizes="512x512" type="image/x-icon">
</head>
<header>
    <div class="container">
        <div class="menus">
            <a href="about_company" class="menu-button button-about">О нас
                <img src="../assets/img/logo.png" alt="" class="company-logo">
            </a>
            <a href="catalog" class="menu-button">Каталог</a>
            <a href="location" class="menu-button">Где нас найти?</a>
            <a href="admin" class="menu-button">Админ-панель</a>
        </div>

        <?php
        //Changing header buttons if user authorized
        if (empty($_SESSION["session_username"])) {
            echo "<div class='auth-buttons'>
                <a href='login' class='menu-button button-login auth'>Вход</a>
                <a href='register' class='menu-button button-register auth'>Регистрация</a>
            </div>";
        } else {
            echo "<div class='auth-buttons'>
                <a href='cart' class='menu-button button-cart'>Корзина</a>
                <a href='assets/php/logout' class='menu-button button-login auth'>Выход</a>
            </div>";
        }
        ?>

    </div>
</header>