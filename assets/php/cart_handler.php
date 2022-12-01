<?php
session_start();

require_once 'connection.php';

$login = $_SESSION["session_username"];

//Gets customer id from customer login
$query_id = mysqli_query($link, "SELECT customer_id FROM customer WHERE login='$login'");
$result1 = mysqli_fetch_array($query_id);
$customer_id = $result1[0];

//-------------------------
//Gets cart items or orders
//-------------------------

if (isset($_POST['page'])) {
    $page = $_POST['page'];
} else { //Default value
    $page = 'cart';
}

if (isset($_POST['is_changing_page'])) {
    $is_changing_page = $_POST['is_changing_page'];
} else {
    $is_changing_page = false;
}

if ($page == 'cart' && $is_changing_page) {
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
                        <p>Цена всего: </p> <span>$cost р.</span>
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
    } else {
        echo "Корзина пуста";
    }

} else if ($page == 'orders' && $is_changing_page) {
    $query = "SELECT `order`.`product_id`, `product`.`name`, `order`.`date`, `order`.`qnt`, `order`.`cost` FROM `order` INNER JOIN product ON `order`.product_id = product.product_id
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
                       <p>Количество: </p> <span>$qnt шт.</span>
                    </div>
                    <div class='cost'>
                        <p>Сумма заказа: </p> <span>$cost р.</span>
                    </div>
                    <div class='date'>
                        <p>Дата заказа: </p> <span>$date</span>
                    </div>
                </div>";
        }
    } else {
        echo "Нет заказов";
    }
}

//---------------
//Buttons Handler
//---------------

$type = $_POST['type']; //Type determines which button is pressed

if ($type == 1) { //Update item quantity
    $qnt = $_POST['qnt'];
    $product_id = $_POST['product_id'];
    $query = "UPDATE cart SET qnt = $qnt WHERE customer_id = $customer_id AND product_id = $product_id";
    $result = mysqli_query($link, $query);

    $query_product = mysqli_query($link, "SELECT `price` FROM product WHERE product_id = $product_id");
    $result_product = mysqli_fetch_array($query_product);
    $product_price = $result_product[0];
    $cost = $product_price * $qnt;
    exit("1=" . $cost);
}

if ($type == 2) { //Delete item from cart
    $cart_id = $_POST['cart_id'];
    $query = "DELETE FROM cart WHERE cart_id = $cart_id";
    $result = mysqli_query($link, $query);
    exit();
}

if ($type == 3) { //Proceed item from cart to order
    $cart_id = $_POST['cart_id'];
    $query_cart = "SELECT * FROM cart WHERE cart_id = $cart_id";
    $result_cart = mysqli_query($link, $query_cart);

    while ($row_cart = mysqli_fetch_array($result_cart)) {
        $product_id = $row_cart['product_id'];
        $customer_id = $row_cart['customer_id'];
        $product_id = $row_cart['product_id'];
        $qnt = $row_cart['qnt'];
    };

    $query_product = mysqli_query($link, "SELECT `price` FROM product WHERE product_id = $product_id");
    $result_product = mysqli_fetch_array($query_product);
    $product_price = $result_product[0];
    $cost = $product_price * $qnt;

    $query_order = "INSERT INTO `order` VALUES(NULL, $product_id, $customer_id, $cost, $qnt, curdate(), 'Новый', '')";
    $result_order = mysqli_query($link, $query_order);

    if ($result_order) {
        $query_delete = "DELETE FROM cart WHERE cart_id = $cart_id";
        $result_delete = mysqli_query($link, $query_delete);
        $query_update = "UPDATE product SET qnt = qnt - $qnt WHERE product_id = $product_id";
        $result_update = mysqli_query($link, $query_update);
        exit();
    }
}

if ($type == 4) { //Password check
    $password = $_POST['password'];
    $query_password = "SELECT `customer_id` FROM customer WHERE `password` = '$password'";
    $result_password = mysqli_query($link, $query_password);

    if(mysqli_num_rows($result_password) > 0) {
        exit("1");
    }

}

mysqli_close($link);
