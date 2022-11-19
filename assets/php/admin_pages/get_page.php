<?php
require_once '../connection.php';

$page = $_POST['page'];

switch ($page) {
    case 'order':
        $query = "SELECT `order`.`order_id`,  `order`.`product_id`, `product`.`name`, `order`.`date`, `order`.`qnt`, `order`.`cost`, `order`.`status`, `order`.`decline_reason` FROM `order` INNER JOIN product ON `order`.product_id = product.product_id";

        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
        echo "
        <table>
        <tr>
        <th>
        ID заказа
        </th>
        <th>
        ID товара
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
        <th>
        Статус
        </th>
        <th>
        Причина отмены
        </th>
        </tr>
        ";
        //Getting items from database
        while ($row = mysqli_fetch_array($result)) { 
            $order_id = $row['order_id'];
            $product_id = $row['product_id']; 
            $name = $row['name'];
            $date = $row['date'];
            $qnt = $row['qnt'];
            $cost = $row['cost'];
            $status = $row['status'];
            $decline_reason = $row['decline_reason'];

            //Making item card
            echo "
                <tr data-id='$order_id'>
                <td class='id non-edit'>$order_id</td>
                <td class='id' data-section='product_id'>$product_id</td>
                <td class='non-edit' data-section='name'>$name</td>
                <td data-section='date' class='non-edit'>$date</td>
                <td data-section='qnt'>$qnt шт.</td>
                <td data-section='cost'>$cost р.</td>
                <td data-section='status'>$status</td>
                <td data-section='decline_reason'>$decline_reason</td>
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
                <tr data-id='$product_id'>
                <td class='id non-edit'>$product_id</td>
                <td class='id' data-section='category_id'>$category_id</td>
                <td data-section='name'>$product_name</td>
                <td class='category-name non-edit'>$category_name</td>
                <td class='unfolding' data-section='description'><label for='checkbox$product_id'></label><input type='checkbox' id='checkbox$product_id'><p>$description</p></td>
                <td data-section='year'>$year г.</td>
                <td class='one-row' data-section='price'>$price р.</td>
                <td class='image' data-section='img_url'><a href='assets/$img_url'><img src='assets/$img_url'></a></td>
                <td data-section='date_added'>$date_added</td>
                <td class='one-row' data-section='qnt'>$qnt шт.</td>
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
                <tr data-id='$category_id'>
                <td class='id non-edit'>$category_id</td>
                <td data-section='name'>$category_name</td>
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
