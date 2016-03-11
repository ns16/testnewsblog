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
	(1, 'Математики проверили на прочность закон Ципфа', 'Испанские математики проверили на прочность закон Ципфа, согласно которому при попытке упорядочить все слова языка или текст по убыванию частоты их использования, то частота n-го слова в таком списке окажется приблизительно обратно пропорциональной его порядковому номеру n. О результатах исследования рассказывается в свежем выпуске журнала PLOS ONE.', '2016-02-23 13:19:38'),
	(2, 'Финансовые проблемы назвали причиной физической боли', 'Американские ученые выяснили, что люди с финансовыми проблемами испытывают гораздо больше физической боли чем те, кто относят себя к разряду обеспеченных. Кроме того, проблемы денежного характера негативно влияют на болевой порог и заставляют людей чаще употреблять обезболивающие. Об этом рассказывается в статье, опубликованной в журнале Psychological Science.', '2016-02-23 13:21:25'),
	(3, 'Huawei анонсировала свой первый планшет-трансформер', 'Китайская компания Huawei представила в рамках Mobile World Congress в Барселоне свой первый планшет-трансформер на Windows 10 — MateBook. Об этом сообщает The Verge.\r\nПри подключении к док-станции устройство можно использовать как ноутбук. Планшет получил дисплей в 12 дюймов с разрешением 2160 на 1440 точек. Толщина новинки схожа с iPhone 6 и составляет 6,9 миллиметра.', '2016-02-23 13:22:20'),
	(4, 'Ученые случайно открыли глаза', 'Британские и немецкие ученые открыли самые маленькие и, скорее всего, древнейшие глаза в природе — это бактерии, которые обладают фоточувствительностью и способны двигаться к источнику света. Об открытии сообщается в журнале eLife.', '2016-02-23 13:23:50'),
	(5, 'Кубик Рубика собрали за 0,8 секунды', 'Новый рекорд сборки кубика Рубика, поставленный в январе 2016 года, побили уже спустя несколько недель: разработанная американским экономистом компьютерная система сделала это всего за 0,887 секунды. О рекорде сообщает Gizmag.', '2016-02-23 13:24:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Таблица комментариев к статьям';

-- Дамп данных таблицы kohana-test.article_comments: ~10 rows (приблизительно)
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
	(12, 2, 2, 'image(array $file, $max_width = NULL, $max_height = NULL, $exact = FALSE) – проверяет, является ли загруженный файл изображением и, при необходимости, имеет ли правильный размер.', '2016-03-09 14:42:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='Таблица голосов к комментариям к статьям';

-- Дамп данных таблицы kohana-test.article_comment_votes: ~14 rows (приблизительно)
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
	(19, 6, 2, 1);
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

-- Дамп данных таблицы kohana-test.roles_users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `roles_users` DISABLE KEYS */;
INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей';

-- Дамп данных таблицы kohana-test.users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
	(1, 'dd@rambler.ru', 'Doomdragon', 'ced9203d6ff5b0bb79a7e7a8afeb6ad1b5c831741e6ef9043d2305fd6364f037', 64, 1457696015),
	(2, 'zull@gmail.com', 'Zull', 'd2cd672a1ec65d3b36e3a0e8a55cec3fa6190e90b8d22702319653b19e67a327', 24, 1457512118),
	(3, 'moogumi@yandex.ru', 'Moogumi', '6659243fe3a5249a0c03005953babb613a128c5fabb07fa76d2641880cf5c22a', 12, 1457024702),
	(4, 'coirin@mail.ru', 'Coirin', 'f6ffc762e08a81e8f522f3493fee7b07eb67b9514aed56e85efcb612a64190f6', 10, 1457089748),
	(5, 'ng@rambler.ru', 'Nilagelv', '2db0900446ef44f942375321dc12e71459c75c8448173ccdd070f73e3d04687c', 4, 1457074760),
	(6, 'ib@yandex.ru', 'Ironbinder', 'f9adc06779dbbee2f4981ea8227e0940cd828e3480ef280a430d778ecc3e2ca8', 2, 1457025092);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица kohana-test.users_articles
CREATE TABLE IF NOT EXISTS `users_articles` (
  `user_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор пользователя',
  `article_id` int(10) unsigned NOT NULL COMMENT 'Идентификатор статьи',
  KEY `FK_favorites_users` (`user_id`),
  KEY `FK_favorites_articles` (`article_id`),
  CONSTRAINT `FK_favorites_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_favorites_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица для связи пользователей и избранных статей';

-- Дамп данных таблицы kohana-test.users_articles: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `users_articles` DISABLE KEYS */;
INSERT INTO `users_articles` (`user_id`, `article_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(3, 3),
	(3, 5);
/*!40000 ALTER TABLE `users_articles` ENABLE KEYS */;


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

-- Дамп данных таблицы kohana-test.user_personal: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `user_personal` DISABLE KEYS */;
INSERT INTO `user_personal` (`user_id`, `name`, `birthdate`, `sex`, `city`, `activity`, `about_me`) VALUES
	(1, 'Роберт Муравьев', '1983-12-23', 1, 'Лонгвью', 'Инженер', 'Такая корпоративная культура приносит. Вами имидж неудачника долгое время. Себя по отношению к слову сказать, в например находили. Сторону всё равно будут сыпаться. Запомнят не интересует, будете вы можете выполнять все ваши. \n'),
	(2, 'Филипп Безруков', '1969-01-03', 1, 'Новосибирск', 'Менеджер по работе с клиентами', '');
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

-- Дамп данных таблицы kohana-test.user_social: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `user_social` DISABLE KEYS */;
INSERT INTO `user_social` (`user_id`, `profile_vk`, `profile_fb`, `profile_gp`, `profile_tw`, `profile_ok`) VALUES
	(1, 'http://vk.com/doomdragon', 'facebook.com/robert.muravev', '', '', '');
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
