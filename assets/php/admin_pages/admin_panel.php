<content>
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
                <div class="edit-menu">
                    <p class="title">Редактирование данных</p>
                    <form action="#">
                        <textarea name="edit-content" required></textarea>
                        <div class="edit-buttons">
                            <input type="reset" value="Отмена">
                            <input type="submit" value="Подтвердить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</content>

<script src="assets/js/admin_controls.js"></script>