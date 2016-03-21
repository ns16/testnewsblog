-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.45 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных kohana-test
CREATE DATABASE IF NOT EXISTS `kohana-test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kohana-test`;


-- Дамп структуры для таблица kohana-test.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор статьи',
  `title` varchar(255) NOT NULL COMMENT 'Заголовок статьи',
  `content` text NOT NULL COMMENT 'Содержимое статьи',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания статьи',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Таблица статей';

-- Дамп данных таблицы kohana-test.articles: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `title`, `content`, `date`) VALUES
	(1, 'Математики проверили на прочность закон Ципфа', 'Испанские математики проверили на прочность закон Ципфа, согласно которому при попытке упорядочить все слова языка или текст по убыванию частоты их использования частота n-го слова в таком списке окажется приблизительно обратно пропорциональной его порядковому номеру n. О результатах исследования рассказывается в свежем выпуске журнала PLOS ONE.\r\nДля того чтобы определить правильность закона Ципфа, исследователи решили использовать его применительно к проекту «Гутенберг» — инициативе по созданию и распространению электронной универсальной библиотеки, которая включает 31075 книг на английском языке. Прежние попытки применить закон Ципфа ограничивались десятками текстов, а теперь исследователи работали с настоящим массивом данных.\r\nУченые поставили перед собой задачу определить, вписываются ли тексты в закономерность, согласно которой второе по используемости слово встречается примерно в два раза реже, чем первое, третье — в три раза реже, чем первое, и так далее. Таким образом, ими была избрана простейшая формулировка закона Ципфа.\r\nСогласно итогам исследования, при условии, что опущены наиболее редкие и архаичные формы слов, порядка 55 процентов текстов вписываются в закон Ципфа. Если учитывать эти слова, то соответствие закономерности снижается до 40 процентов.\r\nЛингвист Джордж Кингсли Ципф исследовал частотность слов: одних в тексте попадается больше, других меньше, и по этому принципу все слова разбиваются на группы. Ученый предложил дать этим группам порядковые номера (ранги): самые частотные слова получают номер 1, с частотностью пониже — 2, еще на уровень ниже — 3, и так далее.\r\nПосле этого вычисляется вероятность встретить слово Икс в тексте: количество слов Икс в тексте делится на число всех слов. Ципф обнаружил, что если вероятность для слова Икс помножить на порядковый номер ранга, в котором оно оказалось, то каждый раз будет получаться приблизительно одна и та же величина. Так, для английского языка эта константа равна примерно 0,1, а для русского — 0,06-0,07.', '2016-02-23 13:19:38'),
	(2, 'Финансовые проблемы назвали причиной физической боли', 'Американские ученые выяснили, что люди с финансовыми проблемами испытывают гораздо больше физической боли, чем те, кто относят себя к разряду обеспеченных. Кроме того, проблемы денежного характера негативно влияют на болевой порог и заставляют людей чаще употреблять обезболивающие. Об этом рассказывается в статье, опубликованной в журнале Psychological Science.\r\nК подобным выводам ученые пришли, проанализировав результаты шести независимых исследований. Так, в одном из них в 2008 году была выявлена зависимость между потерей работы и повышенным употреблением обезболивающих. А в другом — закономерность, согласно которой в кризисные и стабильные годы люди из фокус-групп чаще или реже обращались к врачам. Соответственно, в периоды финансовой нестабильности люди чаще обращали внимание специалистов на заболевания и испытываемую боль.\r\nИсследователям удалось установить, что ощущение экономической незащищенности активирует механизмы, связанные с тревогой, страхом и стрессом. Они сходны с процессами, которые заставляют людей чувствовать боль.\r\nДля подкрепления результатов исследования ученые собрали группу из студентов, которые имели или не имели финансовых проблем. Всем участникам эксперимента предлагалось продержать руку в ведре со льдом максимально долго. В результате те, кто страдал от нехватки денег, сдались раньше тех, кто относил себя к разряду благополучных.', '2016-02-23 13:21:25'),
	(3, 'Huawei анонсировала свой первый планшет-трансформер', 'Китайская компания Huawei представила в рамках Mobile World Congress в Барселоне свой первый планшет-трансформер на Windows 10 — MateBook. Об этом сообщает The Verge.\r\nПри подключении к док-станции устройство можно использовать как ноутбук. Планшет получил дисплей в 12 дюймов с разрешением 2160 на 1440 точек. Толщина новинки схожа с iPhone 6 и составляет 6,9 миллиметра.\r\nБатареи, как уверяет производитель, должно хватить на 9 часов непрерывного воспроизведения видео или 10 часов использования легких программ. Из прочих особенностей планшета выделяются порт USB Type-C и сенсор отпечатка пальца.\r\nMateBook будет выпускаться с двумя версиями операционной системы Windows 10 на выбор: Home и Pro. Также в зависимости от модификации будут доступны планшеты с процессорами Intel Core M3, M5 или M7.\r\nПоставляться MateBook будет с электронным стилусом MatePen, распознающим 2048 видов нажатия. Кроме того, аксессуар можно будет использовать как лазерную указку, которая пригодится для презентаций.\r\nПланшет с аксессуарами будут доступны в этом году. По данным Huawei, стоимость MateBook будет варьироваться от 700 до 1,6 тысячи долларов. Клавиатура, стилус и док-станция к нему обойдутся в 130, 60 и 90 долларов соответственно.', '2016-02-23 13:22:20'),
	(4, 'Геометрия помогла определить степень квантовой запутанности', 'Физики из Ноттингемского университета в Великобритании предложили простой геометрический способ определения степени запутанности двух, трех или четырех кубитов — квантовых аналогов классических битов. Исследование авторы опубликовали в журнале Physical Review Letters, а кратко о нем сообщается на сайте Phys.org.\r\nУченые заметили, что во многих случаях степень запутанности между частицами соответствует расстоянию между двумя точками на сфере Блоха, которая представляет собой трехмерный объект, используемый физиками для моделирования квантовых состояний. Метод позволяет использовать простой и наглядный геометрический подход вместо ранее применяемого более сложного аналитического.\r\nСтепень квантовой запутанности позволяет описать величину скоррелированности частей единой подсистемы. Например, у системы, в которой части изначально незапутанны, эта степень равна нулю, а у системы, в которой составляющие максимально перепутаны, она равна единице.\r\nСогласно квантовой механике, при удалении запутанных частиц друг от друга они сохраняют информацию о состоянии своего партнера. Такие частицы нарушают принцип локальности, согласно которому на состояние объекта может оказывать влияние только его близкое окружение.', '2016-02-23 13:23:50'),
	(5, 'Кубик Рубика собрали за 0,8 секунды', 'Новый рекорд сборки кубика Рубика, поставленный в январе 2016 года, побили уже спустя несколько недель: разработанная американским экономистом компьютерная система сделала это всего за 0,887 секунды. О рекорде сообщает Gizmag.\r\nВ ноябре 2015 года машина, созданная Захарией Громко (Zackary Gromko), студентом из США, собрала кубик Рубика за 2,39 секунды. Уже в январе 2016 года Джей Флэтленд (Jay Flatland) и Пол Роуз (Paul Rose) из Канзаса показали свой компьютер официальному представителю Книги рекордов Гиннеса: системе хватило 0,9 секунд.\r\nОднако система Sub1, разработанная инженером и экономистом Адамом Биром (Adam Beer), побила и этот рекорд. После того, как кубик раскручивается случайным образом, его помещают внутрь робота. Дается команда «старт», открываются шторки вебкамер, те фотографируют все стороны кубика, передают информацию компьютеру, который рассчитывает оптимальное решение с помощью двухфазного алгоритма Коцембы. Это решение передается микропроцессору, который дает команду шести манипуляторам.\r\nКубик был собран за 20 ходов и 0,887 секунды. Хотя при демонстрации не присутствовал представитель Книги рекордов Гиннеса, в ближайшее время Бир также подаст заявку на регистрацию своего достижения.', '2016-02-23 13:24:53');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.article_comments
CREATE TABLE IF NOT EXISTS `article_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор комментария',
  `article_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор статьи',
  `user_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор пользователя',
  `content` text NOT NULL COMMENT 'Содержимое комментария',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания комментария',
  PRIMARY KEY (`id`),
  KEY `FK_users` (`user_id`),
  KEY `FK_articles` (`article_id`),
  CONSTRAINT `FK_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Таблица комментариев к статьям';

-- Дамп данных таблицы kohana-test.article_comments: ~15 rows (приблизительно)
/*!40000 ALTER TABLE `article_comments` DISABLE KEYS */;
INSERT INTO `article_comments` (`id`, `article_id`, `user_id`, `content`, `date`) VALUES
	(1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, nam, quos eius illum sequi temporibus.', '2016-02-23 18:03:45'),
	(3, 1, 1, 'blablalala', '2016-03-01 13:35:44'),
	(4, 2, 1, 'sasasa', '2016-03-01 13:41:11'),
	(5, 1, 2, 'open($action = NULL, array $attributes = NULL) – создает открывающий тег form.\nПринимает два параметра: action – значене атрибута action, то есть адрес программы или документа, который обрабатывает данные формы, attributes – массив атрибутов (например, method, enctype, class).', '2016-03-01 13:57:47'),
	(6, 1, 3, 'string get_class([object $object = NULL]) – возвращает имя класса, экземпляром которого является объект object.', '2016-03-01 13:58:54'),
	(7, 5, 1, 'hahaha fafafa dadada !@#', '2016-03-01 14:00:05'),
	(8, 5, 1, 'kasbdkjbskdjsad', '2016-03-03 21:26:51'),
	(10, 5, 4, 'limit_words($str, $limit = 100, $end_char = NULL) – обрезает строку до заданного количества слов.\nПринимает три параметра: str – строка, которую нужно обрезать, limit – максимальное количество слов в строке, end_char – символ, который добавляется в конец строки.', '2016-03-04 17:11:37'),
	(11, 1, 2, 'PRIMARY KEY указывает, что поле является первичным ключом таблицы. Записи в таком поле должны быть уникальными. Опция также может быть указана после перечисления всех полей.', '2016-03-04 22:17:05'),
	(12, 2, 2, 'image(array $file, $max_width = NULL, $max_height = NULL, $exact = FALSE) – проверяет, является ли загруженный файл изображением и, при необходимости, имеет ли правильный размер.', '2016-03-09 14:42:57'),
	(13, 5, 2, 'jkdjkasdhkjsahdkjsahdj', '2016-03-17 12:21:46'),
	(14, 5, 2, 'jkdjkasdhkjsahdkjsahdj', '2016-03-17 12:22:16'),
	(15, 3, 2, 'kajdkjsakjdhjskadhjk', '2016-03-17 12:23:04'),
	(16, 5, 1, 'aksbdkjabdjkabskjdbsjakdbkajsbdk skabd sdkhsa saldnsa lsndasd asjdsad jsadfdgsa alsdlas asldhid alsdhiasd asldjidsa aasankdslakd aldn', '2016-03-18 14:07:18'),
	(17, 3, 1, 'sdkdk sgdkj skfdkjb ksjbdk hakdskj bjkdfbk jsdbf jkdsbf kjbskdf bkdjsbfj kbdskjfb sdjkfbj ksbkjfd bjfkbs dkjfbj ksdbfksd bkfbsk dbfjk sdbkfbd ksbfkdsb fkjbdkfbs kjfbsk jfbkjsbf kjsbdjf kbdsk jfbdsk jfsdkfb', '2016-03-18 16:07:14');
/*!40000 ALTER TABLE `article_comments` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.article_comment_votes
CREATE TABLE IF NOT EXISTS `article_comment_votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор голоса',
  `comment_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор комментария',
  `user_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор пользователя',
  `value` tinyint(1) NOT NULL COMMENT 'Значение голоса',
  PRIMARY KEY (`id`),
  UNIQUE KEY `comment_id_user_id` (`comment_id`,`user_id`),
  KEY `comment_id` (`comment_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_article_comment_votes_article_comments` FOREIGN KEY (`comment_id`) REFERENCES `article_comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_article_comment_votes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='Таблица голосов к комментариям к статьям';

-- Дамп данных таблицы kohana-test.article_comment_votes: ~22 rows (приблизительно)
/*!40000 ALTER TABLE `article_comment_votes` DISABLE KEYS */;
INSERT INTO `article_comment_votes` (`id`, `comment_id`, `user_id`, `value`) VALUES
	(3, 7, 2, 1),
	(4, 7, 3, 1),
	(7, 8, 4, 1),
	(8, 7, 4, 1),
	(10, 7, 5, 1),
	(11, 5, 5, 1),
	(12, 3, 5, -1),
	(13, 1, 5, -1),
	(14, 3, 4, -1),
	(15, 8, 2, -1),
	(16, 10, 2, 1),
	(17, 10, 1, 1),
	(18, 4, 2, 1),
	(19, 6, 2, 1),
	(20, 10, 8, 1),
	(21, 3, 8, -1),
	(22, 5, 8, 1),
	(23, 11, 8, 1),
	(24, 13, 1, 1),
	(25, 14, 1, -1),
	(26, 12, 1, 1),
	(27, 15, 1, -1);
/*!40000 ALTER TABLE `article_comment_votes` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Таблица ролей';

-- Дамп данных таблицы kohana-test.roles: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `description`) VALUES
	(1, 'login', 'Login privileges, granted after account confirmation'),
	(2, 'admin', 'Administrative user, has access to everything.');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.roles_users
CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица для связи пользователей и ролей';

-- Дамп данных таблицы kohana-test.roles_users: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `roles_users` DISABLE KEYS */;
INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(8, 1);
/*!40000 ALTER TABLE `roles_users` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей';

-- Дамп данных таблицы kohana-test.users: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
	(1, 'dd@rambler.ru', 'Doomdragon', 'ced9203d6ff5b0bb79a7e7a8afeb6ad1b5c831741e6ef9043d2305fd6364f037', 77, 1458317729),
	(2, 'zull@gmail.com', 'Zull', 'd2cd672a1ec65d3b36e3a0e8a55cec3fa6190e90b8d22702319653b19e67a327', 27, 1458195678),
	(3, 'moogumi@yandex.ru', 'Moogumi', '6659243fe3a5249a0c03005953babb613a128c5fabb07fa76d2641880cf5c22a', 13, 1458032904),
	(4, 'coirin@mail.ru', 'Coirin', 'f6ffc762e08a81e8f522f3493fee7b07eb67b9514aed56e85efcb612a64190f6', 11, 1458038575),
	(5, 'ng@rambler.ru', 'Nilagelv', '2db0900446ef44f942375321dc12e71459c75c8448173ccdd070f73e3d04687c', 5, 1458038727),
	(6, 'ib@yandex.ru', 'Ironbinder', 'f9adc06779dbbee2f4981ea8227e0940cd828e3480ef280a430d778ecc3e2ca8', 3, 1458039502),
	(8, 'mirawyn@gmail.com', 'Mirawyn2', 'ced9203d6ff5b0bb79a7e7a8afeb6ad1b5c831741e6ef9043d2305fd6364f037', 3, 1458039566);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.user_articles
CREATE TABLE IF NOT EXISTS `user_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор пользователя',
  `article_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор статьи',
  PRIMARY KEY (`id`),
  KEY `FK_users_articles_users` (`user_id`),
  KEY `FK_users_articles_articles` (`article_id`),
  CONSTRAINT `FK_users_articles_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_articles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Таблица для связи пользователей и избранных статей';

-- Дамп данных таблицы kohana-test.user_articles: ~11 rows (приблизительно)
/*!40000 ALTER TABLE `user_articles` DISABLE KEYS */;
INSERT INTO `user_articles` (`id`, `user_id`, `article_id`) VALUES
	(3, 1, 3),
	(6, 3, 3),
	(7, 3, 5),
	(8, 4, 2),
	(9, 5, 1),
	(10, 2, 2),
	(12, 2, 1),
	(13, 2, 4),
	(15, 1, 2),
	(16, 1, 5),
	(17, 1, 4);
/*!40000 ALTER TABLE `user_articles` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.user_personal
CREATE TABLE IF NOT EXISTS `user_personal` (
  `user_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор пользователя',
  `name` varchar(50) DEFAULT NULL COMMENT 'Имя пользователя',
  `birthdate` date DEFAULT NULL COMMENT 'Дата рождения пользователя',
  `sex` tinyint(1) DEFAULT NULL COMMENT 'Пол пользователя',
  `city` varchar(50) DEFAULT NULL COMMENT 'Город пользователя',
  `activity` varchar(255) DEFAULT NULL COMMENT 'Деятельность пользователя',
  `about_me` text COMMENT 'Рассказ пользователя о себе',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `FK_user_settings_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица личных данных пользователя';

-- Дамп данных таблицы kohana-test.user_personal: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `user_personal` DISABLE KEYS */;
INSERT INTO `user_personal` (`user_id`, `name`, `birthdate`, `sex`, `city`, `activity`, `about_me`) VALUES
	(1, 'Роберт Муравьев', '1983-12-23', 1, 'Лонгвью', 'Инженер', 'Динамическими соображениями близ плоскости галактики и распределенных. Не обнаруживают галактической концентрации этих. Меньше толщины галактики, так как звезды, расстояния которых опровергается. Распределенных по всему небу более многочисленная. Исключением явилось лишь слабые галактики и других характеристик внегалактических объектов.'),
	(2, 'Филипп Безруков', '1969-01-03', 1, 'Новосибирск', 'Менеджер по работе с клиентами', ''),
	(3, 'Витек', '1950-07-01', 0, 'Караганда', '', ''),
	(8, 'Юрий Игнатьев', '1967-06-17', 1, '', 'Логист', 'Том, что дискретными источниками радиоизлучения показало. Связи с высокими температурами, а разрешающая сила радиотелескопов неве­лика. Слишком слабым, останется неуловимым остатками газовой. Окнах видимости между облаками пылевой. Оказались в целой площадке, содержащей десятки квадратных минут.');
/*!40000 ALTER TABLE `user_personal` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.user_social
CREATE TABLE IF NOT EXISTS `user_social` (
  `user_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор пользователя',
  `profile_vk` varchar(255) DEFAULT NULL COMMENT 'Профиль вконтакте',
  `profile_fb` varchar(255) DEFAULT NULL COMMENT 'Профиль facebook',
  `profile_gp` varchar(255) DEFAULT NULL COMMENT 'Профиль google+',
  `profile_tw` varchar(255) DEFAULT NULL COMMENT 'Профиль twitter',
  `profile_ok` varchar(255) DEFAULT NULL COMMENT 'Профиль одноклассники',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `FK_user_social_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица данных пользователя о профилях в соц. сетях';

-- Дамп данных таблицы kohana-test.user_social: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `user_social` DISABLE KEYS */;
INSERT INTO `user_social` (`user_id`, `profile_vk`, `profile_fb`, `profile_gp`, `profile_tw`, `profile_ok`) VALUES
	(1, 'http://vk.com/doomdragon', 'https://www.facebook.com/robert.muravev', 'https://plus.google.com/doomdragon', 'http://twitter.com/doomdragon', 'https://ok.ru/doomdragon'),
	(3, 'http://vk.com/moogumi', '', '', 'http://twitter.com/moogumi', 'https://ok.ru/moogumi'),
	(4, 'http://vk.com/id11111111', '', '', '', 'https://ok.ru/coirin'),
	(8, 'http://vk.com/myrawyn', '', 'https://plus.google.com/myrawyn', '', '');
/*!40000 ALTER TABLE `user_social` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.user_tokens
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  KEY `expires` (`expires`),
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Таблица меток пользователя';

-- Дамп данных таблицы kohana-test.user_tokens: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `user_tokens` DISABLE KEYS */;
INSERT INTO `user_tokens` (`id`, `user_id`, `user_agent`, `token`, `type`, `created`, `expires`) VALUES
	(1, 2, '5ca928198ffd1e05c6656ea003ba26f884ba166e', 'c43f7cd2ea6fba1d6a4fbf41e58624f95715b7b3', '', 1456555957, 1457765557);
/*!40000 ALTER TABLE `user_tokens` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
