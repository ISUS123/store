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

<content>
    <div class='cart-page'>
        <div class='container'>
            <div class="cart-menu">
                <form action="cart.php" method="GET">
                    <button class='items-in-cart' name='page' value="cart">Корзина</button>
                    <button class="orders" name='page' value="orders">Заказы</button>
                </form>
            </div>
    
            <?php
    
            $login = $_SESSION["session_username"];
    
            //Getting customer id from customer login
            $query_id = mysqli_query($link, "SELECT customer_id FROM customer WHERE login='$login'");
            $result1 = mysqli_fetch_array($query_id);
            $customer_id = $result1[0];
    
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 'cart';
            }
    
            if ($page == 'cart') {
                $query = "SELECT * FROM product INNER JOIN cart ON product.product_id = cart.product_id
     WHERE customer_id = $customer_id";
                $result = mysqli_query($link, $query);
    
                if (mysqli_num_rows($result) > 0) {
                    //Getting items from database
                    while ($row = mysqli_fetch_array($result)) {
                        $product_id = $row['product_id'];
                        $cart_id = $row['cart_id'];
                        $name = $row['name'];
                        $description = $row['description'];
                        $year = $row['year'];
                        $price = $row['price'];
                        $img_url = $row['img_url'];
                        $date_added = $row['date_added'];
                        $qnt = $row['qnt'];
                        $availableQnt = $row[8]; //Quantity of items in stock
    
                        $cost = $price * $qnt;
                        //Making item card
                        echo "
                <div class='cart-item' data-id='$cart_id'>
                    <div class='item-info'>
                        <p class='name'>$name</p>
                    </div>
                    <div class='qnt'>
                        <label for='$product_id'>Количество: </label>
                        <input type='number' name='qnt' data-name='qnt' data-id='$product_id' min='1' max='$availableQnt' value='$qnt'>
                    </div>
                    <div class='cost'>
                        <p>Цена всего: $cost р.</p>
                    </div>
                    <div class='hide' data-name='hide' data-id='$cart_id'>
                        <svg viewBox='0 0 50 50'>
                            <path class='st1' d='M5,5c13.33,13.33,26.67,26.67,40,40' />
                            <path class='st1' d='M45,5C31.67,18.33,18.33,31.67,5,45' />
                        </svg>
                    </div>
                    <div class='accept'>
                        <input type='button' name='accept' data-id='$cart_id' data-name='accept' value='Оформить заказ'>
                    </div>
                </div>";
                    }
                    echo "</div>
            </div>";
                } else {
                    echo "Корзина пуста";
                }
            } else if ($page == 'orders') {
                $query = "SELECT * FROM `order` INNER JOIN product ON order.product_id = product.product_id
     WHERE customer_id = $customer_id";
                $result = mysqli_query($link, $query);
    
                if (mysqli_num_rows($result) > 0) {
                    //Getting items from database
                    while ($row = mysqli_fetch_array($result)) {
                        $product_id = $row['product_id'];
                        $name = $row['name'];
                        $date = $row['date'];
                        $qnt = $row['qnt'];
                        $cost = $row['cost'];
    
                        //Making item card
                        echo "
                <div class='cart-item'>
                    <div class='item-info'>
                        <p class='name'>$name</p>
                    </div>
                    <div class='qnt'>
                       <p>Количество: $qnt</p>
                    </div>
                    <div class='cost'>
                        <p>Цена всего: $cost р.</p>
                    </div>
                    <div class='date'>
                        <p>Дата заказа: $date</p>
                    </div>
                </div>";
                    }
                    echo "</div>
            </div>";
                } else {
                    echo "Нет заказов";
                }
            }
            ?>
    
            <div class="password-wrapper">
                <div class="password-check">
                    <form action="cart.php" method="post">
                        <label for="pass">Для оформления заказа введите пароль от аккаунта: </label>
                        <div>
                            <input type="password" name="pass" id="pass">
                            <input type="submit" value="Подтвердить">
                            <input type="reset" value="Отмена">
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