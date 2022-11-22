<?php
session_start();
require_once 'header.php';
require_once 'assets/php/connection.php';

if (empty($_SESSION["session_username"])) {
    echo "<div class='error-wrapper' style='display: flex;'>
            <div class='error' style='cursor: default'>
                <p>Необходима авторизация</p>
                <a class='button enter' href='login.php' style='display: block'>Войти</a>
            </div>
          </div>";
    die();
}

?>

<content class="align-top">
    <div class='cart-page'>
        <div class='container'>
            <div class="cart-menu">
                <form action="#">
                    <button class='items-in-cart' name='page' value="cart">Корзина</button>
                    <button class="orders" name='page' value="orders">Заказы</button>
                </form>
            </div>   
            <div class="cart-content">
                
            </div> 
            <div class="password-wrapper">
                <div class="password-check">
                    <form action="#">
                        <label for="pass">Для оформления заказа введите пароль от аккаунта: </label>
                        <div>
                            <input type="password" name="pass" id="pass">
                            <input class="button" type="submit" value="Подтвердить">
                            <input class="button" type="reset" value="Отмена">
                        </div>
                    </form>
                    <p class='error-message'></p>
                </div>
            </div>
    
        </div>
    </div>
</content>  

<?php
require_once 'footer.php';
?>

<script src="assets/js/cart_handler.js"></script>