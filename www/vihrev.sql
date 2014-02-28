-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 28 2014 г., 14:14
-- Версия сервера: 5.1.44
-- Версия PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `file` varchar(256) NOT NULL,
  `on_frontpage` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `name`, `file`, `on_frontpage`, `index`) VALUES
(16, 'РОСНЕФТЬ', '1393144800750.png', 1, 3),
(15, 'TeleTrade', '1393144782370.png', 1, 5),
(14, 'Canon', '1393144767808.png', 1, 4),
(12, 'alarmmotors', '1393144731142.png', 1, 1),
(13, 'INTOUCH', '1393144753272.png', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `navigation`
--

CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(256) NOT NULL COMMENT 'Название, отображающееся в пунктах меню',
  `url` varchar(256) NOT NULL COMMENT 'Адрес страницы',
  `module` enum('frontpage','portfolio','price','support') NOT NULL COMMENT 'Шаблон страницы',
  `section` varchar(256) NOT NULL,
  `parent` int(11) NOT NULL COMMENT 'Родительский пункт',
  `side` enum('','client','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `navigation`
--

INSERT INTO `navigation` (`id`, `caption`, `url`, `module`, `section`, `parent`, `side`) VALUES
(1, 'Главная', '', 'frontpage', '', 0, ''),
(2, 'Портфолио', 'portfolio', 'portfolio', '', 0, ''),
(3, 'Стоимость услуг', 'price', 'price', '', 0, ''),
(4, 'Обратная связь', 'support', 'support', '', 0, ''),
(5, 'Баннеры', 'banners', 'portfolio', '', 2, ''),
(6, 'Полиграфия', 'polygraphy', 'portfolio', '', 2, ''),
(7, 'Логотипы', 'logo', 'portfolio', '', 2, ''),
(9, 'Верхний баннер', 'top-banner', 'frontpage', 'top-banner', 1, 'admin'),
(10, 'Клиенты', 'clients', 'frontpage', 'clients', 1, 'admin'),
(11, 'Настройки сайта', 'settings', 'frontpage', 'settings', 1, 'admin'),
(12, 'Сделай сам', 'do', 'frontpage', 'do', 0, 'client'),
(13, 'Файлы', 'files', 'support', 'files', 4, 'admin'),
(14, 'Контакты', 'contacts', 'support', 'contacts', 4, 'admin'),
(15, 'Текст', 'text', 'support', 'text', 4, 'admin');

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
  `category` int(11) NOT NULL,
  `on_frontpage` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `name`, `introtext`, `text`, `preview`, `flash`, `gif`, `jpg_png`, `html`, `date`, `category`, `on_frontpage`, `index`) VALUES
(16, 'Canon', 'Вводный текст', '<p>Описание</p>', '1393566961183.jpg', '', '', '', '1393566961877', '2014-02-28 09:56:01', 6, 1, 2),
(15, 'Canon', 'Вводный текст', '<p>Описание</p>', '1393566928661.jpg', '', '', '', '1393566928463', '2014-02-28 09:55:28', 5, 1, 1),
(17, 'Canon', 'Вводный текст', '<p>Описание</p>', '1393566999188.jpg', '', '', '', '1393566999339', '2014-02-28 09:56:39', 7, 1, 3),
(18, 'Canon', 'Вводный текст', '<p>Описание</p>', '1393567024217.jpg', '', '', '', '1393567024832', '2014-02-28 09:57:04', 5, 1, 4),
(19, 'Canon', 'Вводный текст', '<p>Описание</p>', '1393567061845.jpg', '', '', '', '1393567062296', '2014-02-28 09:57:42', 6, 1, 5),
(20, 'Canon', 'Вводный текст', '<p>Описание</p>', '1393567118158.jpg', '', '', '', '1393567118376', '2014-02-28 09:58:38', 5, 1, 6),
(21, 'Canon', 'Вводный текст', '<p>Описание</p>', '1393567138139.jpg', '', '', '', '1393567138516', '2014-02-28 09:58:58', 5, 1, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `price-list`
--

CREATE TABLE IF NOT EXISTS `price-list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `price` varchar(256) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

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
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `login`, `password`, `index`) VALUES
(1, 'admin', '32535', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `support`
--

CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('files','contacts','text') NOT NULL,
  `name` varchar(256) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `support`
--

INSERT INTO `support` (`id`, `type`, `name`, `value`) VALUES
(2, 'files', 'Бриф на изготовление интернетбаннера', '1393516097897.png'),
(3, 'files', 'Бриф на изготовление полиграфической продукции', '1393516114927.png'),
(4, 'files', 'Бриф на изготовлние наружной рекламы', '1393516131141.png'),
(5, 'files', 'Бриф на изготовлние логотипа', '1393516147921.png'),
(6, 'contacts', 'skype', 'wvihrev'),
(8, 'contacts', 'icq', '355-133-868'),
(9, 'contacts', 'tel', '+7 931 337 48 37'),
(10, 'contacts', 'mail', 'wvihrev@gmail.com'),
(11, 'text', 'about', '<h3>О НАС</h3>\n<p>Развивающаяся компания в сфере Интернет-рекламы, которая специализируется на создании флеш-баннеров. Главная цель - создание привлекательного и стильного рекламного продукта, отвечающего всем требованиям современной рекламной индустрии.</p>\n<p><strong>Интересные факты</strong><br />В современном мире, где многое зависит от финансов, для проведения рекламной кампании флеш баннер является одним из самых недорогих, но достаточно продуктивных способов раскрутки.</p>\n<p>Стоимость флеш баннера может варьироваться и вы всегда можете выбрать именно то, что нужно вам. Ну а мы, в свою очередь, с удовольствием возьмемся за исполнение ваших самых креативных идей и замыслов! Так как мы стремимся к качеству и совершенству каждого рекламного продукта, выпускаемого студией. Заказать флеш баннер</p>'),
(12, 'text', 'strategy', '<h3>СТРАТЕГИЯ</h3>\r\n<p><strong>Цель</strong><br />Наша основная задача достижение максимального результата, никогда не останавливаться на достигнутом и постоянно совершенствоваться в сфере интернет рекламы и дизайна.</p>\r\n<p><strong>Методы</strong><br />Основой лучшей реализации рекламы является ясное донесение информации рекламного продукта. От креатива к реализации.</p>'),
(16, 'text', 'clients', '<h3>КЛИЕНТЫ И БРЕНДЫ</h3>\n<div class="facia">\n<div class="facia-inner">\n<p>Мы работаем вместе с этими брендами и выработали стратегию наряду с уникальным подходом. Мы процветаем и сотрудничаем с клиентами, которые хотят расширить границы и мыслить нестандартно.</p>\n</div>\n</div>');

-- --------------------------------------------------------

--
-- Структура таблицы `top-banner`
--

CREATE TABLE IF NOT EXISTS `top-banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(256) NOT NULL,
  `background` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Дамп данных таблицы `top-banner`
--

INSERT INTO `top-banner` (`id`, `file`, `background`, `url`, `index`) VALUES
(17, '1393095347257.jpg', '#000000', '/portfolio/polygraphy/?id=2 	', 2),
(15, '1393095283813.jpg', '#000000', '/portfolio/banners/?id=1', 1),
(18, '1393095364712.jpg', '#000000', '/portfolio/logo/?id=3', 3),
(19, '1393095386853.jpg', '#000000', '/portfolio/banners/?id=4', 4);
