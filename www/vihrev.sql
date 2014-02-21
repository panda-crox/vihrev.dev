-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 21 2014 г., 07:48
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `vihrev`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `file` varchar(256) NOT NULL,
  `on_frontpage` int(1) NOT NULL,
  `index` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `name`, `file`, `on_frontpage`, `index`) VALUES
(1, 'AlarmMotors', 'client-1.png', 1, 1),
(2, 'intouch', 'client-1.png', 1, 2),
(3, 'Canon', 'client-3.png', 1, 3),
(4, 'TeleTrade', 'client-4.png', 1, 4),
(5, 'Роснефть', 'client-5.png', 1, 5),
(6, 'Роснефть', 'client-5.png', 1, 6),
(7, 'Роснефть', 'client-5.png', 1, 7),
(8, 'Роснефть', 'client-5.png', 1, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `navigation`
--

CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `caption` varchar(256) NOT NULL COMMENT 'Название, отображающееся в пунктах меню',
  `url` varchar(256) NOT NULL COMMENT 'Адрес страницы',
  `module` enum('frontpage','portfolio','price','support') NOT NULL COMMENT 'Шаблон страницы',
  `parent` int(2) NOT NULL COMMENT 'Родительский пункт',
  `side` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `navigation`
--

INSERT INTO `navigation` (`id`, `caption`, `url`, `module`, `parent`, `side`) VALUES
(1, 'Главная', '', 'frontpage', 0, 'admin'),
(2, 'Портфолио', 'portfolio', 'portfolio', 0, 'both'),
(3, 'Стоимость услуг', 'price', 'price', 0, 'both'),
(4, 'Обратная связь', 'support', 'support', 0, 'both'),
(5, 'Баннеры', 'banners', 'portfolio', 2, 'both'),
(6, 'Полиграфия', 'polygraphy', 'portfolio', 2, 'both'),
(7, 'Логотипы', 'logo', 'portfolio', 2, 'both'),
(9, 'Верхний баннер', 'top-banner', 'frontpage', 1, 'admin'),
(10, 'Клиенты', 'clients', 'frontpage', 1, 'admin'),
(11, 'Настройки сайта', 'settings', 'frontpage', 1, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `introtext` text NOT NULL,
  `text` text NOT NULL,
  `preview` varchar(256) NOT NULL,
  `flash` varchar(256) NOT NULL,
  `gif` varchar(256) NOT NULL,
  `jpg_png` text NOT NULL,
  `html` varchar(256) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` int(3) NOT NULL,
  `on_frontpage` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `name`, `introtext`, `text`, `preview`, `flash`, `gif`, `jpg_png`, `html`, `date`, `category`, `on_frontpage`) VALUES
(1, 'РосТрансАвиа', 'РосТрансАвиа', 'РосТрансАвиа', 'preview-1.jpg', '', '', '', '', '2014-02-16 08:40:07', 5, 1),
(2, 'Форекс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-2.jpg', '', '', '', '', '2014-02-16 08:41:07', 6, 1),
(3, 'Canon', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-3.jpg', '', '', '', '', '2014-02-16 08:41:28', 7, 1),
(4, 'ЧеStars', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-4.jpg', '', '', '', '', '2014-02-16 08:41:50', 5, 1),
(5, 'ЧеStars', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-4.jpg', '', '', '', '', '2014-02-16 08:41:54', 6, 1),
(6, 'ЧеStars', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-4.jpg', '', '', '', '', '2014-02-16 08:41:56', 7, 1),
(7, 'ЧеStars', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-4.jpg', '', '', '', '', '2014-02-16 08:41:57', 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `price-list`
--

CREATE TABLE IF NOT EXISTS `price-list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `price` varchar(256) NOT NULL,
  `category` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `price-list`
--

INSERT INTO `price-list` (`id`, `name`, `price`, `category`) VALUES
(1, 'флеш баннер (Economy)', '2500', 5),
(2, 'флеш баннер (Standart)', '5000', 5),
(3, 'флеш баннер (Original)', '7000', 5),
(4, 'Интерактивный флеш баннер', 'от 8000', 5),
(5, 'ресайз баннера (flash, gif, статика)', '1000', 5),
(6, 'статичные баннеры (gif, jpg, png)', '3500', 5),
(7, 'gif баннер', '3500', 5),
(8, 'gif баннер (100х100)', '1000', 5),
(9, 'Промо (флеш)', '10 000 - 12 000', 5),
(10, 'разработка концепции (идеи)', '2000', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `top-banner`
--

CREATE TABLE IF NOT EXISTS `top-banner` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `file` varchar(256) NOT NULL,
  `background` varchar(256) NOT NULL,
  `portfolio` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `top-banner`
--

INSERT INTO `top-banner` (`id`, `file`, `background`, `portfolio`) VALUES
(1, 'banner.jpg', '#000000', 1),
(2, 'banner.jpg', '#000000', 2),
(3, 'banner.jpg', '#000000', 3),
(4, 'banner.jpg', '#000000', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
