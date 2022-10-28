<?php
require_once 'header.php';
require_once 'assets/php/connection.php';
//pablo
?>

<content>
    <div class="about-page">
        <div class="container">
            <div class="quiz-wrapper">
                <div class="quiz">
                    <div class="hide">
                        <svg viewBox="0 0 50 50">
                            <path class="st1" d="M5,5c13.33,13.33,26.67,26.67,40,40" />
                            <path class="st1" d="M45,5C31.67,18.33,18.33,31.67,5,45" />
                        </svg>
                    </div>
                    <p>Тест о компании</p>
                    <form class="standard-form">
                        <!-- Form making by JS -->
                    </form>
                </div>
                <div class="quiz-result">
                    <p>Результаты теста</p>
                    <p class="result-text"></p>
                </div>
            </div>
            <div class="about">
                <img src="../assets/img/logo.png" alt="">
                <p class="title">Copy Star</p>
                <div>
                    <p>Компания CopyStar основана Иваном Ивановичем в 2004 году. Компания специализируется на производстве копировального оборудования. Главный офис находится в Москве.</p>
                </div>
                <a class="show-quiz">Пройти тест</a>
            </div>
    
            <div class="slider">
                <div class="slider-arrow left">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 140 460">
                        <polyline class="st0" points="10.95,10.16 120.95,230.16 10.95,450.16 " />
                    </svg>
                </div>
                <div class="slider-content">
                    <p>5 последних товаров</p>
                    <div class="slider-line">
    
                        <?php
                        //Getting data from database
                        $query = "SELECT `product_id`, `name`, `price`, `description`, `img_url` FROM product WHERE `qnt` > 0 ORDER BY date_added DESC LIMIT 5";
                        if ($result = mysqli_query($link, $query)) {
                            if (mysqli_num_rows($result) > 4) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $product_id = $row['product_id'];
                                    $name = $row['name'];
                                    $price = $row['price'];
                                    $description = $row['description'];
                                    $img_url = $row['img_url'];
    
                                    //Making item card
                                    echo "<div class='catalog-item'>
                            <div class='item-left'>
                                <span>$name</span>
                                <p>$description</p>
                                <a href='product.php?product_id=$product_id'>Страница товара</a>
                                <span>$price р.</span>
                            </div>
                            <div class='item-right'>
                                <img src='../assets/$img_url'>
                            </div>
                        </div>";
                                }
                            } else {
                                //If error, show message or hide slider
                                echo "<p>Недостаточно подходящих товаров для формирования списка</p>";
                            }
                        } else {
                            echo "<p>Не удалось получить данные, попробуйте обновить страницу</p>";
                        }
    
                        mysqli_close($link);
                        ?>
                    </div>
                </div>
                <div class="slider-arrow right">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 140 460">
                        <polyline class="st0" points="10.95,10.16 120.95,230.16 10.95,450.16 " />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <div class="background"></div>
</content>

<?php
require_once 'footer.php';
?>

<script src="assets/js/about_page.js"></script>
