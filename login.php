<?php
require_once('header.php');
?>

<content>
    <div class="container">
            <div class="auth-box">
                <p class="title">Авторизация</p>
                <div class="form-wrapper">
                    <form action="assets/php/login_handler.php" method="post" id="form">
                        <div class="standard-form">
                            <div>
                                <label for="login">Логин: </label>
                                <input minlength="3" maxlength="20" required type="text" name="login" id="login">
                            </div>
                            <div>
                                <label for="password">Пароль:</label>
                                <input minlength="3" maxlength="20" required type="password" name="password" id="password">
                            </div>
                            <div class="buttons">
                                <p class="error-message">Пароли не совпадают</p>
                                <input type="submit" class="submit" value="Войти">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</content>

<?php
require_once 'footer.php';
?>

<script src="assets/js/login_check.js"></script>