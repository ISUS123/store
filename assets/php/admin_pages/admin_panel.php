    <div class='container'>
        <div class='admin-panel'>
            <ul class="admin-navbar">
                <p class='title'>Выбор раздела</p>
                <li><a href="#" class="navbar-item" data-id="product">Товары</a></li>
                <li><a href="#" class="navbar-item" data-id="category">Категории</a></li>
                <li><a href="#" class="navbar-item" data-id="order">Заказы</a></li>
                <li><a class="logout-button" href="assets/php/admin_pages/admin_logout.php">Выход</a></li>
            </ul>
            <div class="admin-content">

            </div>
            <div class="edit-wrapper">
                <div class="edit-menu menu">
                    <p class="title">Редактирование данных</p>
                    <form action="#">
                        <textarea name="edit-content" cols="30" rows="10" required></textarea>
                        <div class="edit-buttons">
                            <input type="reset" value="Отмена">
                            <input type="submit" value="Подтвердить">
                        </div>
                    </form>
                </div>
                <div class="delete-menu menu">
                    <p class="title">Удаление данных</p>
                    <form action="#">
                        <p>Вы действительно хотите удалить этот элемент?</p>
                        <div class="edit-buttons">
                            <input type="reset" value="Отмена">
                            <input type="submit" value="Подтвердить">
                        </div>
                    </form>
                </div>
                <div class="decline-menu menu">
                    <p class="title">Отмена заказа</p>
                    <label for='decline_reason'>Введите причину отмены заказа: </label>
                    <form action="#">
                        <textarea cols="30" rows="10" required id='decline_reason' name='decline_reason'></textarea>
                        <div class="edit-buttons">
                            <input type="reset" value="Отмена">
                            <input type="submit" value="Подтвердить">
                        </div>
                    </form>
                </div>
                <div class="add-menu menu">
                    <p class="title">Добавление элемента</p>
                    <form action="#" id='product'>
                        <div class="field">
                            <label for="category_id">ID категории:</label>
                            <input type="number" id='category_id' name='category_id' required min='1'>
                        </div>
                        <div class="field">
                            <label for="name">Название:</label>
                            <input type="text" id='name' name='name' required>
                        </div>
                        <div class="field">
                            <label for="description">Описание:</label>
                            <input type="text" id='description' name='description'>
                        </div>
                        <div class="field">
                            <label for="year">Год выпуска:</label>
                            <input type="number" id='year' name='year' required min='2000'>
                        </div>
                        <div class="field">
                            <label for="price">Цена:</label>
                            <input type="number" id='price' name='price' required min='0'>
                        </div>
                        <div class="field">
                            <label for="img_url">Ссылка на изображение:</label>
                            <input type="text" id='img_url' name='img_url'>
                        </div>
                        <div class="field">
                            <label for="qnt">Количество:</label>
                            <input type="number" id='qnt' name='qnt' required min='0'>
                        </div>
                        <div class="edit-buttons">
                            <input type="reset" value="Отмена">
                            <input type="submit" value="Подтвердить">
                        </div>
                    </form>

                    <form action="#" id='category'>
                        <div class="field">
                            <label for="category_name">Название категории:</label>
                            <input type="text" id='category_name' name='category_name' required>
                        </div>

                        <div class="edit-buttons">
                            <input type="reset" value="Отмена">
                            <input type="submit" value="Подтвердить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="assets/js/admin_controls.js"></script>