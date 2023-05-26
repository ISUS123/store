-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 26 2023 г., 10:50
-- Версия сервера: 5.7.33
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `store`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL COMMENT 'ID корзины',
  `customer_id` int(11) NOT NULL COMMENT 'ID клиента',
  `product_id` int(11) NOT NULL COMMENT 'ID товара',
  `qnt` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Количество товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL COMMENT 'ID категории',
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'laser'),
(2, 'mfu'),
(3, 'scaner'),
(4, 'spray');

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL COMMENT 'ID клиента',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Имя',
  `surname` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Фамилия',
  `patronymic` text COLLATE utf8mb4_unicode_ci COMMENT 'Отчество',
  `login` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Логин',
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'E-mail',
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Пароль'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `order_id` int(10) NOT NULL COMMENT 'ID заказа',
  `product_id` int(11) NOT NULL COMMENT 'ID товара',
  `customer_id` int(11) NOT NULL COMMENT 'ID клиента',
  `cost` int(11) NOT NULL COMMENT 'Стоимость заказа',
  `qnt` int(11) NOT NULL COMMENT 'Количество товара',
  `date` date NOT NULL COMMENT 'Дата',
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Новый' COMMENT 'Статус',
  `decline_reason` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Причина отмены'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL COMMENT 'ID товара',
  `category_id` int(11) NOT NULL COMMENT 'ID категории',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название',
  `description` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT 'Нет описания' COMMENT 'Описание',
  `year` int(4) NOT NULL COMMENT 'Год выпуска',
  `price` int(11) NOT NULL COMMENT 'Цена',
  `img_url` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT 'img/media/default_image.jpg' COMMENT 'Ссылка на изображение',
  `date_added` date NOT NULL COMMENT 'Дата добавления',
  `qnt` int(11) NOT NULL DEFAULT '0' COMMENT 'Количество'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `name`, `description`, `year`, `price`, `img_url`, `date_added`, `qnt`) VALUES
(7, 2, 'МФУ Brother DCP-L2500DR', 'МФУ (принтер/сканер/копир), лазерная черно-белая печать, A4, двусторонняя печать, планшетный сканер, ЖК панель', 2008, 34290, 'mfu2.jpg', '2022-06-20', 6),
(8, 4, 'Принтер Epson L1800', 'принтер, струйная цветная печать, A3, печать фотографий', 2012, 8000, 'printer1.jpg', '2022-06-19', 4),
(9, 1, 'Принтер Canon PIXMA G1411', 'принтер, лазерная печать, A4, печать фотографий', 2014, 7500, 'printer2.jpg', '2022-06-17', 8),
(10, 3, 'Сканер Avision FB5000', 'планшетный сканер, формат A3, интерфейс USB 2.0, разрешение 600x600 dpi, датчик типа CIS', 2008, 5000, 'scaner1.jpg', '2022-06-14', 7),
(11, 3, 'Сканер Avision', 'Нет описания', 2016, 10000, 'scaner2.jpg', '2022-06-23', 5),
(29, 2, 'МФУ HP LaserJet Pro M227sdn (G3Q74A)', 'МФУ (принтер/сканер/копир), лазерная черно-белая печать, A4, двусторонняя печать, планшетный/протяжный сканер, ЖК панель, сетевой (Ethernet), AirPrint', 2005, 34500, 'mfu1.jpg', '2022-11-19', 12);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID корзины';

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID категории', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID клиента', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID заказа', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID товара', AUTO_INCREMENT=30;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
