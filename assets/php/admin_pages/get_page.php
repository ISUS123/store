<?php
require_once '../connection.php';

$page = $_POST['page'];

switch ($page) {
    case 'order':
        $query = "SELECT `order`.`product_id`, `product`.`name`, `order`.`date`, `order`.`qnt`, `order`.`cost` FROM `order` INNER JOIN product ON `order`.product_id = product.product_id";

        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
        echo "
        <table>
        <tr>
        <th>
        ID
        </th>
        <th>
        Название товара
        </th>
        <th>
        Дата заказа
        </th>
        <th>
        Кол-во товара
        </th>
        <th>
        Сумма заказа
        </th>
        </tr>
        ";
        //Getting items from database
        while ($row = mysqli_fetch_array($result)) { 
            $product_id = $row['product_id']; 
            $name = $row['name'];
            $date = $row['date'];
            $qnt = $row['qnt'];
            $cost = $row['cost'];

            //Making item card
            echo "
                <tr>
                <td>$product_id</td>
                <td>$name</td>
                <td>$date</td>
                <td>$qnt шт.</td>
                <td>$cost р.</td>
                </tr>";
                
        }
        echo "</table>";
        exit();
    } else {
        echo "Нет заказов";
        exit();
    }
        break;
    case 'product':
        $query = "SELECT `product`.`product_id`, `product`.`category_id`, `product`.`name` AS 'product_name', `category`.`name` AS 'category_name' , `description`, `year`, price, img_url, date_added, qnt FROM product INNER JOIN category ON product.category_id = category.category_id";

        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
        
        echo "
        <table>
        <tr>
        <th>
        ID товара
        </th>
        <th>
        ID категории
        </th>
        <th>
        Название товара
        </th>
        <th>
        Название категории
        </th>
        <th>
        Описание
        </th>
        <th>
        Год выпуска
        </th>
        <th>
        Цена
        </th>
        <th>
        Изображение
        </th>
        <th>
        Дата добавления
        </th>
        <th>
        Кол-во
        </th>
        </tr>";
        //Getting items from database
        while ($row = mysqli_fetch_array($result)) { 
            $product_id = $row['product_id']; 
            $category_id = $row['category_id'];
            $product_name = $row['product_name'];
            $category_name = $row['category_name'];
            $description = $row['description'];
            $year = $row['year'];
            $price = $row['price'];
            $img_url = $row['img_url'];
            $date_added = $row['date_added'];
            $qnt = $row['qnt'];

            //Making item card
            echo "
                <tr>
                <td>$product_id</td>
                <td>$category_id</td>
                <td>$product_name</td>
                <td>$category_name</td>
                <td>$description</td>
                <td>$year г.</td>
                <td>$price р.</td>
                <td>$img_url</td>
                <td>$date_added</td>
                <td>$qnt шт.</td>
                </tr>";
        }
        echo "</table>";
        exit();
    } else {
        echo "Нет товаров";
        exit();
    }
        break;
    case 'category':
        $query = "SELECT `category_id`, `name` FROM category";

        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
        
        echo "
        <table>
        <tr>
        <th>
        ID категории
        </th>
        <th>
        Название категории
        </th>
        </tr>";
        //Getting items from database
        while ($row = mysqli_fetch_array($result)) { 
            $category_id = $row['category_id'];
            $category_name = $row['name'];

            //Making item card
            echo "
                <tr>
                <td>$category_id</td>
                <td>$category_name</td>
                </tr>";
        }
        echo "</table>";
        exit();
    } else {
        echo "Нет категорий
        ";
        exit();
    }
        break;
}

mysqli_close($link);
