<?php
require_once "header.php";
require_once "assets/php/connection.php";
?>

<content class="align-top">
    <div class="catalog">
        <div class="container">
            <div class="catalog-menu">
                <p>Сортировка</p>
                <form action="assets/php/catalog_handler.php">
                    <select name="sort_type">
                        <option value="year">по году производства</option>
                        <option value="name">по наименованию</option>
                        <option value="price">по цене</option>
                    </select>
                    <select name="sort_order">
                        <option value="">по возрастанию</option>
                        <option value="desc">по убыванию</option>
                    </select>
                    <p>Категория</p>
                    <select name="item_category" size="4">
                        <option value="all" selected>Все категории</option>
                        <option value="laser">Лазерные принтеры</option>
                        <option value="spray">Струйные принтеры</option>
                        <option value="scaner">Сканеры</option>
                        <option value="mfu">МФУ</option>
                    </select>
                    <input type="submit" value="Применить" class="button">
                </form>
            </div>
    
            <div class="catalog-items">
                
            </div>
        </div>
    </div>
    <div class="error-wrapper">
    <div class="error">
        <p></p>
        <a class="button enter" href="login">Войти</a>
    </div>
</div>
</content>

<?php
require_once "footer.php";
?>

<script src="assets/js/catalog_handler.js"></script>