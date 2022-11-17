<?php
session_start();

require_once('../connection.php');

$id = $_POST["id"];

$to_edit = $_POST["to_edit"];

$new_content = $_POST["new_content"];

$current_page = $_POST["current_page"];

$query = "UPDATE `$current_page` SET `$to_edit` = '$new_content' WHERE {$current_page}_id = $id ";

// $result = mysqli_query($link, $query);

echo $query;

mysqli_close($link);
?>