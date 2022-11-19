<?php
session_start();

require_once('../connection.php');

$default_image = "img/media/default_image.jpg";

$default_description = "Нет описания";

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

            if(empty($_POST['description'])) {
                $description = $default_description;
            } else {
                $description = $_POST['description'];
            }

            $year = $_POST['year'];
            $price = $_POST['price'];

            if(empty($_POST['img_url'])) {
                $img_url = $default_image;
            } else {
                $img_url = $_POST['img_url'];
            }
            
            $qnt = $_POST['qnt'];

            $query = "INSERT INTO `$current_page` VALUES(NULL, $category_id, '$name', '$description', '$year', '$price', '$img_url', CURDATE(), '$qnt')";

            echo $query;
            
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