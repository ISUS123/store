<?php
session_start();

require_once 'connection.php';

$login = $_SESSION["session_username"];

//Getting customer password from customer login
$query_id = mysqli_query($link, "SELECT `password` FROM customer WHERE login='$login'");
$result1 = mysqli_fetch_array($query_id);
$password = $result1[0];

if(isset($_POST['password_input'])) {
    $password_input = $_POST['password_input'];
}

if($password_input == $password) {
    exit("1");
} else {
    exit("2");
}

mysqli_close($link);
?>