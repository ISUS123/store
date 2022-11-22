<?php
session_start();
require_once "header.php";
require_once "assets/php/connection.php";
?>

<?php
if(isset($_SESSION["session_adminname"])) {
    echo "<content class='align-top'>";
    require_once "assets/php/admin_pages/admin_panel.php";
    echo "</content>";
} else {
    echo "<content class='align-top'>
    <div class='container'>
        <div class='auth-box'>
            <p class='title'>Панель администратора</p>
            <div class='form-wrapper'>
                <form action='#' method='post' id='form'>
                    <div class='standard-form'>
                        <div>
                            <label for='login'>Логин: </label>
                            <input minlength='3' maxlength='20' required type='text' name='login' id='login'>
                        </div>
                        <div>
                            <label for='password'>Пароль:</label>
                            <input minlength='3' maxlength='20' required type='password' name='password' id='password'>
                        </div>
                        <div class='buttons'>
                            <p class='error-message'>Пароли не совпадают</p>
                            <input type='submit' class='submit' value='Войти'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</content>
<script src='assets/js/admin_check.js'></script>";
}
?>

<?php
require_once "footer.php";
?>