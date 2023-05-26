<?php
require_once 'header.php';
require_once 'assets/php/connection.php';
?>

<content>
    <div class="product">
        <div class="container">
                    <?php
                    if(isset($_GET["product_id"])) {
                        $product_id = $_GET["product_id"];
                    } else {
                        echo "<div class='error'><p>Не удалось найти данный товар</p></div>";
                        die();
                    }
                    $query = "SELECT `product_id`, `name`, `description`, `year`, `price`, `img_url`, `qnt` from product WHERE product_id = $product_id";
                    if($result = mysqli_query($link, $query)) {
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $name = $row['name'];
                            $description = $row['description'];
                            $year = $row['year'];
                            $price = $row['price'];
                            $img_url = $row['img_url'];
                            $qnt = $row['qnt'];
                            echo "
                            <div class='product-card'>
                                <img src='../assets/img/media/$img_url'>
                                    <div>
                                        <p>$name</p>
                                        <p>Год выпуска: $year</p>
                                    </div>
                                        <p class='description'>$description</p>
                                    <div>
                                        <p>$price р.</p>
                                        <p>В наличии: <font color='#1ca81c'>$qnt шт.</font></p>
                                        <a class='to-cart' data-id='$product_id'>Добавить в корзину</a>
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

<script src="assets/js/add_to_cart.js"></script>