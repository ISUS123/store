<?php

require_once 'connection.php';

//Sort & category values getting
if (isset($_POST['sort_type'])) { //If isset, get value
    $sort_type = $_POST['sort_type'];
} else { //else set default value
    $sort_type = 'year';
};

if (isset($_POST['sort_order'])) {
    $sort_order = $_POST['sort_order'];
} else {
    $sort_order = '';
};

if (isset($_POST['item_category'])) {
    $item_category = $_POST['item_category'];
} else { 
    $item_category = 'all';
};

if ($item_category != 'all' && $item_category != "") {
    $query_category = "AND category.name = '$item_category'";
};

//Making query with sort & category variables
$query = "SELECT `product_id`, `product`.`name`, `description`, `year`, `price`, `img_url`, `date_added` FROM product JOIN category ON product.category_id = category.category_id
                WHERE `qnt` > 0 $query_category
                ORDER BY $sort_type $sort_order";

if ($result = mysqli_query($link, $query)) {
    //Getting items from database
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $name = $row['name'];
        $description = $row['description'];
        $year = $row['year'];
        $price = $row['price'];
        $img_url = $row['img_url'];
        $date_added = $row['date_added'];
        //Making item card
        echo  "<div class='catalog-item'>
                                    <div class='item-content'>
                                        <div class='item-name'><span>$name</span><span>$year г.</span></div>
                                        <div class='item-picture'><img src='../assets/$img_url' alt='$name'></div>
                                        <div class='item-bottom'>
                                            <a href='product.php?product_id=$product_id' class='item-page'>Страница товара</a>
                                            <a class='to-cart' data-id='$product_id'>$price р.<div class='cart'></div></a>
                                        </div>
                                    </div>
                                </div>";
    }
} else {
    echo "1";
}

mysqli_close($link);
?>
