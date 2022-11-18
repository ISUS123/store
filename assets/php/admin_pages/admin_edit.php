<?php
session_start();

require_once('../connection.php');

$id = $_POST["id"];

$current_page = $_POST["current_page"];

if(isset($_POST["delete"])) {
    $query = "DELETE FROM `$current_page` WHERE {$current_page}_id = $id";

    $result = mysqli_query($link, $query);

    exit();
};

if(isset($_POST["add"])) {
    switch($current_page) {
        case "product":
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $year = $_POST['year'];
            $price = $_POST['price'];
            $img_url = $_POST['img_url'];
            $qnt = $_POST['qnt'];

            $query = "INSERT INTO `$current_page` VALUES(NULL, $category_id, '$name', '$description', '$year', '$price', '$img_url', CURDATE(), '$qnt')";
            
            $result = mysqli_query($link, $query);

            exit();
        break;
        case "category":
            $name = $_POST['name'];

            $query = "INSERT INTO `$current_page` VALUES(NULL, '$name')";

            $result = mysqli_query($link, $query);
            
            exit();
        break;
    }
    
}

$to_edit = $_POST["to_edit"];

$new_content = $_POST["new_content"];

$query = "UPDATE `$current_page` SET `$to_edit` = '$new_content' WHERE {$current_page}_id = $id ";

$result = mysqli_query($link, $query);

mysqli_close($link);
?>