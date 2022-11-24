<?php
session_start();

require_once 'connection.php';

if(empty($_SESSION["session_username"])) {
    die('1');
}

$login = $_SESSION["session_username"];

//Getting customer id from customer login
$query_id = mysqli_query($link, "SELECT customer_id FROM customer WHERE login='$login'");
$result1 = mysqli_fetch_array($query_id);
$customer_id = $result1[0];

if(isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
} else {
    die('2');
}

//Getting item in the cart
$item_in_cart = mysqli_query($link, "SELECT * FROM cart WHERE 
customer_id = $customer_id AND product_id = $product_id");
$result_item = mysqli_fetch_array($item_in_cart);
$cart_id = $result_item[0];
$qnt = $result_item[3];

//Getting available qnt of item
$query_qnt = mysqli_query($link, "SELECT qnt FROM product WHERE product_id = $product_id");
$result_qnt = mysqli_fetch_array($query_qnt);
$qnt_available = $result_qnt[0];

if(mysqli_num_rows($item_in_cart) < 1) {

//If this item is not in the cart 
$query_insert = "INSERT INTO cart VALUES(NULL, $customer_id, $product_id, 1)";
$result = mysqli_query($link, $query_insert) or die("Ошибка отправки запроса " . mysqli_error($link));
    if($result) {
        echo "3";
    }

} else {

//If this item already in the cart
if($qnt < $qnt_available) { //If qnt adding in the cart < qnt available
    $query_insert = "UPDATE cart SET qnt = $qnt+1 WHERE cart_id = $cart_id";
    $result = mysqli_query($link, $query_insert) or die("Ошибка отправки запроса " . mysqli_error($link));
        if($result) {
            $qnt = $qnt+1;
            echo "4=".$qnt;
        }
} else {
    echo "5";
}

}

mysqli_close($link);
?>