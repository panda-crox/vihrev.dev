-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 02 2014 г., 22:43
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `file` varchar(256) NOT NULL,
  `on_frontpage` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

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
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `navigation`
--

INSERT INTO `navigation` (`id`, `caption`, `url`, `module`, `section`, `parent`, `side`, `index`) VALUES
(1, 'Главная', '', 'frontpage', '', 0, '', 1),
(2, 'Портфолио', 'portfolio', 'portfolio', '', 0, '', 2),
(3, 'Стоимость услуг', 'price', 'price', '', 0, '', 3),
(4, 'Обратная связь', 'support', 'support', '', 0, '', 4),
(5, 'Баннеры', 'banners', 'portfolio', '', 2, '', 5),
(6, 'Полиграфия', 'polygraphy', 'portfolio', '', 2, '', 6),
(9, 'Верхний баннер', 'top-banner', 'frontpage', 'top-banner', 1, 'admin', 8),
(10, 'Клиенты', 'clients', 'frontpage', 'clients', 1, 'admin', 9),
(11, 'Настройки сайта', 'settings', 'frontpage', 'settings', 1, 'admin', 10),
(12, 'Сделай сам', 'do', 'frontpage', 'do', 0, 'client', 11),
(13, 'Файлы', 'files', 'support', 'files', 4, 'admin', 12),
(14, 'Контакты', 'contacts', 'support', 'contacts', 4, 'admin', 14),
(15, 'Текст', 'text', 'support', 'text', 4, 'admin', 17),
(28, 'Логотипы', 'logo', 'portfolio', '', 2, '', 5),
(32, 'Сервисы', 'services', 'frontpage', 'services', 1, 'admin', 18);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `name`, `introtext`, `text`, `preview`, `flash`, `gif`, `jpg_png`, `html`, `date`, `category`, `on_frontpage`, `index`) VALUES
(29, 'Форекс', 'Вводный текст', '<p><strong>Цели и задачи</strong></p>\r\n<p><em>Главная задача &ndash; показать конкурентные особенности проекторов canon:высокое качество изображения и стильный дизайн. А интерактивный баннер лучше всего позволяет доказать превосходство проектора canon по отношению к его конкурентам, стоит лишь навести стрелку курсора. </em></p>\r\n<p><em><strong>Идея и реализация: Владимир Вихрев</strong>.</em></p>', '1393754841280.jpg', '', '1393756110202.jpg', '', '', '2014-03-02 10:07:21', 5, 1, 3),
(27, 'Canon', 'Вводный текст', '', '1393754661671.jpg', '', '', '', '1393754661822', '2014-03-02 10:04:21', 5, 1, 1),
(28, 'Море', 'Вводный текст', '<p><span style="color: #ff0000;"><strong>Цели и задачи</strong></span></p>\r\n<p><em>Главная задача &ndash; показать конкурентные особенности проекторов canon:высокое качество изображения и стильный дизайн. А интерактивный баннер лучше всего позволяет доказать превосходство проектора canon по отношению к его конкурентам, стоит лишь навести стрелку курсора. </em></p>\r\n<p><em><strong>Идея и реализация: Владимир Вихрев</strong>.</em></p>', '1393754797570.jpg', '', '1393756096837.jpg', '', '', '2014-03-02 10:06:37', 5, 1, 2),
(30, 'ЧЕ СТАРС', 'Вводный текст', '<p><strong>Цели и задачи</strong></p>\r\n<p><em>Главная задача &ndash; показать конкурентные особенности проекторов canon:высокое качество изображения и стильный дизайн. А интерактивный баннер лучше всего позволяет доказать превосходство проектора canon по отношению к его конкурентам, стоит лишь навести стрелку курсора. </em></p>\r\n<p><em><strong>Идея и реализация: Владимир Вихрев</strong>.</em></p>', '1393754886477.jpg', '', '1393756120229.jpg', '', '', '2014-03-02 10:08:06', 28, 1, 4),
(31, 'Canon 2', 'Вводный текст', '', '1393754995988.jpg', '', '', '', '1393754996287', '2014-03-02 10:09:56', 28, 1, 5),
(32, 'ФОРЕКС 2', '', '<p><strong>Цели и задачи</strong></p>\r\n<p><em>Главная задача &ndash; показать конкурентные особенности проекторов canon:высокое качество изображения и стильный дизайн. А интерактивный баннер лучше всего позволяет доказать превосходство проектора canon по отношению к его конкурентам, стоит лишь навести стрелку курсора. </em></p>\r\n<p><em><strong>Идея и реализация: Владимир Вихрев</strong>.</em></p>', '1393755194145.jpg', '', '', '', '', '2014-03-02 10:13:14', 6, 1, 6),
(33, 'Море 2', '', '<p><strong>Цели и задачи</strong></p>\r\n<p><em>Главная задача &ndash; показать конкурентные особенности проекторов canon:высокое качество изображения и стильный дизайн. А интерактивный баннер лучше всего позволяет доказать превосходство проектора canon по отношению к его конкурентам, стоит лишь навести стрелку курсора. </em></p>\r\n<p><em><strong>Идея и реализация: Владимир Вихрев</strong>.</em></p>', '1393755278666.jpg', '', '1393756138353.jpg', '', '', '2014-03-02 10:14:38', 28, 1, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `price-list`
--

CREATE TABLE IF NOT EXISTS `price-list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `price` varchar(256) NOT NULL,
  `category` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `price-list`
--

INSERT INTO `price-list` (`id`, `name`, `price`, `category`, `index`) VALUES
(1, 'флеш баннер (Economy)', '2500', 5, 1),
(2, 'флеш баннер (Standart)', '5000', 5, 2),
(3, 'флеш баннер (Original)', '7000', 5, 3),
(4, 'Интерактивный флеш баннер', 'от 8000', 5, 4),
(5, 'ресайз баннера (flash, gif, статика)', '1000', 5, 5),
(6, 'статичные баннеры (gif, jpg, png)', '3500', 5, 6),
(7, 'gif баннер', '3500', 5, 7),
(8, 'gif баннер (100х100)', '1000', 5, 8),
(9, 'Промо (флеш)', '10 000 - 12 000', 5, 9),
(10, 'разработка концепции (идеи)', '2000', 5, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `category` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `file`, `text`, `category`, `index`) VALUES
(1, '1393772498743.png', 'СОЗДАНИЕ HTML5 БАННЕРОВ\r\nКреативные идеи на всех устройствах.\r\nИнтересные анимации, адаптивность.\r\nОтличный инструмент медийной рекламы!', 5, 1),
(2, '1393761150421.png', 'ЛОГОТИП И ФИРМЕННЫЙ СТИЛЬ\r\nСовременнные и стильные логотипы, точно отражающие последние тенденции времени.\r\nВас заметят и будут узнавать!', 28, 2),
(3, '1393761164170.png', 'ПОЛИГРАФИЯ\r\nБуклеты, визитки, билборды и многое другое, сделаем красиво и качественно в удобные для Вас сроки!', 6, 3);

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
(1, 'admin', '11111', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `support`
--

CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('files','contacts','text') NOT NULL,
  `name` varchar(256) NOT NULL,
  `value` text NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `support`
--

INSERT INTO `support` (`id`, `type`, `name`, `value`, `index`) VALUES
(2, 'files', 'Бриф на изготовление интернетбаннера', '1393516097897.png', 1),
(3, 'files', 'Бриф на изготовление полиграфической продукции', '1393516114927.png', 2),
(4, 'files', 'Бриф на изготовлние наружной рекламы', '1393516131141.png', 3),
(5, 'files', 'Бриф на изготовлние логотипа', '1393516147921.png', 4),
(6, 'contacts', 'skype', 'wvihrev', 5),
(8, 'contacts', 'icq', '355-133-868', 6),
(9, 'contacts', 'tel', '+7 931 337 48 37', 7),
(10, 'contacts', 'mail', 'wvihrev@gmail.com', 8),
(11, 'text', 'about', '<h3>О НАС</h3>\n<p>Развивающаяся компания в сфере Интернет-рекламы, которая специализируется на создании флеш-баннеров. Главная цель - создание привлекательного и стильного рекламного продукта, отвечающего всем требованиям современной рекламной индустрии.</p>\n<p><strong>Интересные факты</strong><br />В современном мире, где многое зависит от финансов, для проведения рекламной кампании флеш баннер является одним из самых недорогих, но достаточно продуктивных способов раскрутки.</p>\n<p>Стоимость флеш баннера может варьироваться и вы всегда можете выбрать именно то, что нужно вам. Ну а мы, в свою очередь, с удовольствием возьмемся за исполнение ваших самых креативных идей и замыслов! Так как мы стремимся к качеству и совершенству каждого рекламного продукта, выпускаемого студией. Заказать флеш баннер</p>', 9),
(12, 'text', 'strategy', '<h3>СТРАТЕГИЯ</h3>\r\n<p><strong>Цель</strong><br />Наша основная задача достижение максимального результата, никогда не останавливаться на достигнутом и постоянно совершенствоваться в сфере интернет рекламы и дизайна.</p>\r\n<p><strong>Методы</strong><br />Основой лучшей реализации рекламы является ясное донесение информации рекламного продукта. От креатива к реализации.</p>', 10),
(16, 'text', 'clients', '<h3>КЛИЕНТЫ И БРЕНДЫ</h3>\n<div class="facia">\n<div class="facia-inner">\n<p>Мы работаем вместе с этими брендами и выработали стратегию наряду с уникальным подходом. Мы процветаем и сотрудничаем с клиентами, которые хотят расширить границы и мыслить нестандартно.</p>\n</div>\n</div>', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `top-banner`
--

CREATE TABLE IF NOT EXISTS `top-banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(256) NOT NULL,
  `background` varchar(256) NOT NULL,
  `portfolio` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Дамп данных таблицы `top-banner`
--

INSERT INTO `top-banner` (`id`, `file`, `background`, `portfolio`, `index`) VALUES
(49, '1393744941340.jpg', '#000000', 27, 1),
(50, '1393747533640.swf', '#cccccc', 29, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
