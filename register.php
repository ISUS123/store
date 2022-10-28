<?php
require_once('header.php');
?>

<content>
        <div class="container">
            <div class="auth-box">
                <p class="title">Регистрация нового клиента</p>
                <div class="form-wrapper">
                    <form action="assets/php/register_handler.php" method="post" id="form">
                        <div class="standard-form">
                            <div>
                                <label for="name">Имя: </label>
                                <input minlength="1" maxlength="32" required type="text" name="name" id="name" value="Ivan">
                            </div>
                            <div>
                                <label for="surname">Фамилия: </label>
                                <input minlength="1" maxlength="32" required type="text" name="surname" id="surname" value="Ivanov">
                            </div>
                            <div>
                                <label for="patronymic">Отчество: </label>
                                <input minlength="1" maxlength="32" type="text" name="patronymic" id="patronymic">
                            </div>
                            <div>
                                <label for="login">Логин: </label>
                                <input minlength="3" maxlength="16" required type="text" name="login" id="login" value="iva21">
                            </div>
                            <div>
                                <label for="email">Email: </label>
                                <input minlength="3" maxlength="64" required type="email" name="email" id="email" value="i_van@yandex.ru">
                            </div>
                            <div>
                                <label for="password">Пароль:</label>
                                <input minlength="6" maxlength="32" required type="password" name="password" id="password" value="123">
                            </div>
                            <div>
                                <label for="password_repeat">Повтор пароля:</label>
                                <input minlength="6" maxlength="32" required type="password" name="password_repeat" id="password_repeat" value="123">
                            </div>
                            <div class="buttons">
                                <p class="error-message">Пароли не совпадают</p>
                                <input type="submit" class="submit" value="Зарегистрироваться">
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

<script src="assets/js/register_check.js"></script>