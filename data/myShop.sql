-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 23 2017 г., 23:53
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `myShop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `id_basket` int(10) NOT NULL,
  `id_product` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '1',
  `price` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `delivery` varchar(100) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`, `created_at`) VALUES
(1, 'Acer', 'Acer_category', 1, '2017-12-10 00:00:00'),
(2, 'SAMSUNG', 'SAMSUNG_category', 1, '2017-12-06 00:00:00'),
(3, 'HP', 'HP_category', 1, '2017-12-18 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `img_products`
--

CREATE TABLE `img_products` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `small` varchar(255) NOT NULL,
  `big` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `img_products`
--

INSERT INTO `img_products` (`id`, `id_product`, `small`, `big`, `status`) VALUES
(1, 1, '/assets/images/products/1_noutbook_ideapad_R12_small158469.jpg', '/assets/images/products/1_noutbook_ideapad_R12_big158469.jpg', 1),
(2, 2, '/assets/images/products/2_noutbook_lenovo_R12_small158469.jpg', '/assets/images/products/2_noutbook_lenovo_R12_big158469.jpg', 1),
(4, 3, '/assets/images/products/3_noutbook_hp_R111_small5846922.jpg', '/assets/images/products/3_noutbook_hp_R111_big5846922.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `id_category`, `name`, `description`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ноутбук Acer IdeaPad 110-15IBR (80T700С2RK)', 'Устройство справится с любыми профессиональными, бытовыми и учебными задачами, включая просмотр качественного видео и работу с офисными приложениями. Оно снабжено современным процессором Intel и оперативной памятью с большим объёмом.', 18990, 1, '2017-12-12 00:00:00', '2017-12-18 20:04:02'),
(2, 2, 'Ноутбук SAMSUNG 110-15IBR ', 'Устройство справится с любыми профессиональными, бытовыми и учебными задачами, включая просмотр качественного видео и работу с офисными приложениями. Оно снабжено современным процессором Intel и оперативной памятью с большим объёмом.', 25600, 1, '2017-12-11 00:00:00', '2017-12-18 20:03:53'),
(3, 3, 'Ноутбук HP', 'HP мощный ноутбук', 12500, 1, '2017-12-14 00:00:00', '2017-12-18 20:27:20');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `sid` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `status`, `created_at`) VALUES
(55, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2017-12-17 23:53:02');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `img_products`
--
ALTER TABLE `img_products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=980;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `img_products`
--
ALTER TABLE `img_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
