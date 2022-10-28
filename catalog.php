<?php
require_once 'header.php';
require_once 'assets/php/connection.php';
?>

<content>
    <div class="catalog">
        <div class="container">
            <div class='catalog-menu'>
                <p>Сортировка</p>
                <form action='catalog.php' method='GET'>
                    <select name='sort_type'>
                        <option value='year'>по году производства</option>
                        <option value='name'>по наименованию</option>
                        <option value='price'>по цене</option>
                    </select>
                    <select name='sort_order'>
                        <option value="">по возрастанию</option>
                        <option value="desc">по убыванию</option>
                    </select>
                    <p>Категория</p>
                    <select name='item_category' size='4'>
                        <option value="all">Все категории</option>
                        <option value='laser'>Лазерные принтеры</option>
                        <option value='spray'>Струйные принтеры</option>
                        <option value='scaner'>Сканеры</option>
                        <option value='mfu'>МФУ</option>
                    </select>
                    <input type='submit' value='Применить' class='button'>
                </form>
            </div>
    
            <div class='catalog-items'>
                <?php
                //Sort & category values getting
                if (isset($_GET['sort_type'])) { //If isset, get value
                    $sort_type = $_GET['sort_type'];
                } else { //else set default value
                    $sort_type = 'year';
                };
    
                if (isset($_GET['sort_order'])) {
                    $sort_order = $_GET['sort_order'];
                };
    
                if (isset($_GET['item_category'])) {
                    $item_category = $_GET['item_category'];
                } else {
                    $item_category = 'all';
                };
    
                if ($item_category != 'all') {
                    $query_category = "AND category.name = '$item_category'";
                };
    
                //Making query with sort & category variables
                $query = "SELECT `product_id`, `product`.`name`, `description`, `year`, `price`, `img_url`, `date_added` FROM product JOIN category ON product.category_id = category.category_id
                WHERE `qnt` > 0 $query_category
                ORDER BY $sort_type $sort_order";
    
                if ($result = mysqli_query($link, $query)) {
                    //Getting items from database
                    while ($row = mysqli_fetch_array($result)) {
                        $product_id = $row['product_id'];
                        $name = $row['name'];
                        $description = $row['description'];
                        $year = $row['year'];
                        $price = $row['price'];
                        $img_url = $row['img_url'];
                        $date_added = $row['date_added'];
                        //Making item card
                        echo  "<div class='catalog-item'>
                                    <div class='item-content'>
                                        <div class='item-name'><span>$name</span><span>$year г.</span></div>
                                        <div class='item-picture'><img src='../assets/$img_url' alt='$name'></div>
                                        <div class='item-bottom'>
                                            <a href='product.php?product_id=$product_id' class='item-page'>Страница товара</a>
                                            <a class='to-cart' data-id='$product_id'>$price р.<div class='cart'></div></a>
                                        </div>
                                    </div>
                                </div>";
                    }
                } else {
                    echo "<div class='error'><p>Не удалось получить данные, попробуйте обновить страницу</p></div>";
                }
    
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
    <div class="error-wrapper">
    <div class="error">
        <p></p>
        <a class="button enter" href="login.php">Войти</a>
    </div>
</div>
</content>

<?php
require_once 'footer.php';
?>

<script src="assets/js/catalog_handler.js"></script>
<script src="assets/js/add_to_cart.js"></script>