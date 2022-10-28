<?php
session_start();

require_once 'connection.php';

$login = $_SESSION["session_username"];

//Getting customer id from customer login
$query_id = mysqli_query($link, "SELECT customer_id FROM customer WHERE login='$login'");
$result1 = mysqli_fetch_array($query_id);
$customer_id = $result1[0];

if(empty($_POST['type'])) {
    die("2");
}

$type = $_POST['type']; //Type determines which button is pressed

if($type == 1) {
    $qnt = $_POST['qnt'];
    $product_id = $_POST['product_id'];
    $query = "UPDATE cart SET qnt = $qnt WHERE customer_id = $customer_id AND product_id = $product_id";
    $result = mysqli_query($link, $query);

    $query_product = mysqli_query($link, "SELECT `price` FROM product WHERE product_id = $product_id");
    $result_product = mysqli_fetch_array($query_product);
    $product_price = $result_product[0];
    $cost = $product_price * $qnt;
    exit("1=".$cost);
}

if($type == 2) {
    $cart_id = $_POST['cart_id'];
    $query = "DELETE FROM cart WHERE cart_id = $cart_id";
    $result = mysqli_query($link, $query);
    exit();
}

if($type == 3) {
    $cart_id = $_POST['cart_id'];
    $query_cart = "SELECT * FROM cart WHERE cart_id = $cart_id";
    $result_cart = mysqli_query($link, $query_cart);

    while($row_cart = mysqli_fetch_array($result_cart)) {
        $product_id = $row_cart['product_id'];
        $customer_id = $row_cart['customer_id'];
        $product_id = $row_cart['product_id'];
        $qnt = $row_cart['qnt'];
    };

    $query_product = mysqli_query($link, "SELECT `price` FROM product WHERE product_id = $product_id");
    $result_product = mysqli_fetch_array($query_product);
    $product_price = $result_product[0];
    $cost = $product_price * $qnt;

    $query_order = "INSERT INTO `order` VALUES(NULL, $product_id, $customer_id, $cost, $qnt, curdate())";
    $result_order = mysqli_query($link, $query_order);

    if($result_order) {
        $query_delete = "DELETE FROM cart WHERE cart_id = $cart_id";
        $result_delete = mysqli_query($link, $query_delete);
        exit();
    }
}

mysqli_close($link);
?>