-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 25 2014 г., 13:59
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
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `file` varchar(256) NOT NULL,
  `on_frontpage` int(1) NOT NULL,
  `index` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

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
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `caption` varchar(256) NOT NULL COMMENT 'Название, отображающееся в пунктах меню',
  `url` varchar(256) NOT NULL COMMENT 'Адрес страницы',
  `module` enum('frontpage','portfolio','price','support') NOT NULL COMMENT 'Шаблон страницы',
  `section` varchar(256) NOT NULL,
  `parent` int(2) NOT NULL COMMENT 'Родительский пункт',
  `side` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

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
(15, 'Текст', 'text', 'support', 'about,strategy,clients', 4, 'admin'),
(16, 'Добавить работу', '?add', 'portfolio', 'add', 2, 'admin'),
(17, 'Разделы', '?branches', 'portfolio', 'branches', 2, 'admin');

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
(1, 'РосТрансАвиа', 'РосТрансАвиа', 'РосТрансАвиа', 'preview-1.jpg', '', '', '', '', '2014-02-16 12:40:07', 5, 1),
(2, 'Форекс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-2.jpg', '', '', '', '', '2014-02-16 12:41:07', 6, 1),
(3, 'Canon', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-3.jpg', '', '', '', '', '2014-02-16 12:41:28', 7, 1),
(4, 'ЧеStars', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-4.jpg', '', '', '', '', '2014-02-16 12:41:50', 5, 1),
(5, 'ЧеStars', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-4.jpg', '', '', '', '', '2014-02-16 12:41:54', 6, 1),
(6, 'ЧеStars', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-4.jpg', '', '', '', '', '2014-02-16 12:41:56', 7, 1),
(7, 'ЧеStars', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'С Ильей Лагутенко, анонсирующий музыкальный конкурс', 'preview-4.jpg', '', '', '', '', '2014-02-16 12:41:57', 5, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

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
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `login` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `contacts` text NOT NULL,
  `files` text NOT NULL,
  `about` text NOT NULL,
  `strategy` text NOT NULL,
  `clients` text NOT NULL,
  `index` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `login`, `password`, `contacts`, `files`, `about`, `strategy`, `clients`, `index`) VALUES
(1, 'admin', '32535', 'a:5:{i:0;a:2:{s:7:"caption";s:5:"skype";s:5:"value";s:7:"wvihrev";}i:1;a:2:{s:7:"caption";s:3:"icq";s:5:"value";s:11:"355-133-868";}i:2;a:2:{s:7:"caption";s:3:"tel";s:5:"value";s:15:"+7931 337 48 37";}i:3;a:2:{s:7:"caption";s:4:"mail";s:5:"value";s:17:"wvihrev@gmail.com";}i:4;a:2:{s:7:"caption";s:0:"";s:5:"value";s:0:"";}}', 'a:5:{i:0;a:2:{s:4:"name";s:69:"Бриф на изготовление интернетбаннера";s:4:"file";s:17:"1393182006700.png";}i:1;a:2:{s:4:"name";s:88:"Бриф на изготовление полиграфической продукции";s:4:"file";s:17:"1393182020686.png";}i:2;a:2:{s:4:"name";s:68:"Бриф на изготовлние наружной рекламы";s:4:"file";s:17:"1393182035249.png";}i:3;a:2:{s:4:"name";s:53:"Бриф на изготовлние логотипа";s:4:"file";s:17:"1393182054186.png";}i:4;a:1:{s:4:"name";s:0:"";}}', '<p>Развивающаяся компания в сфере Интернет-рекламы, которая специализируется на создании флеш-баннеров. Главная цель - создание привлекательного и стильного рекламного продукта, отвечающего всем требованиям современной рекламной индустрии.</p>\r\n<p><strong>Интересные факты</strong><br />В современном мире, где многое зависит от финансов, для проведения рекламной кампании флеш баннер является одним из самых недорогих, но достаточно продуктивных способов раскрутки.</p>\r\n<p>Стоимость флеш баннера может варьироваться и вы всегда можете выбрать именно то, что нужно вам. Ну а мы, в свою очередь, с удовольствием возьмемся за исполнение ваших самых креативных идей и замыслов! Так как мы стремимся к качеству и совершенству каждого рекламного продукта, выпускаемого студией. Заказать флеш баннер</p>', '<p><strong>Цель</strong><br />Наша основная задача достижение максимального результата, никогда не останавливаться на достигнутом и постоянно совершенствоваться в сфере интернет рекламы и дизайна.</p>\r\n<p><strong>Методы</strong><br />Основой лучшей реализации рекламы является ясное донесение информации рекламного продукта. От креатива к реализации.</p>', '<p>Мы работаем вместе с этими брендами и выработали стратегию наряду с уникальным подходом. Мы процветаем и сотрудничаем с клиентами, которые хотят расширить границы и мыслить нестандартно.</p>', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `top-banner`
--

CREATE TABLE IF NOT EXISTS `top-banner` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `file` varchar(256) NOT NULL,
  `background` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `index` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `top-banner`
--

INSERT INTO `top-banner` (`id`, `file`, `background`, `url`, `index`) VALUES
(17, '1393095347257.jpg', '#000000', '/portfolio/polygraphy/?id=2 	', 2),
(15, '1393095283813.jpg', '#000000', '/portfolio/banners/?id=1', 1),
(18, '1393095364712.jpg', '#000000', '/portfolio/logo/?id=3', 3),
(19, '1393095386853.jpg', '#000000', '/portfolio/banners/?id=4', 4);
