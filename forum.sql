-- Adminer 4.8.1 MySQL 5.7.24 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `icon`, `name`, `description`) VALUES
(1,	'coffee-cup.png',	'Coffee & Bakery กาแฟ เบเกอรี่ ขนมหวาน',	'โพสต์เกี่ยวกับกาแฟ ขนมหวาน ร้านกาแฟ ร้านขนม'),
(2,	'clapperboard.png',	'Movie ภาพยนต์',	'รีวิวเกี่ยวกับภาพยนต์ที่ชื่นชอบ แนวสยองขวัญ รักโรแมนติก ตลก'),
(3,	'fast-food.png',	'Food & Drink อาหารและเครื่องดื่ม',	'โพสต์เกี่ยวกับอาหารและเครื่องดิ่ม');

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `comments` (`id`, `member_id`, `post_id`, `message`, `created_at`) VALUES
(1,	1,	1,	'demo test',	'2021-08-05 11:51:58'),
(2,	2,	1,	'testtest',	'2021-08-05 04:57:44'),
(3,	2,	1,	'hello world',	'2021-08-05 05:10:08');

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `member` (`id`, `icon`, `username`, `password`) VALUES
(1,	'tum',	'tum',	'1234'),
(2,	'laravel.jpg',	'demo',	'1111'),
(4,	NULL,	'postman',	'1111');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`id`, `category_id`, `member_id`, `title`, `content`, `created_at`) VALUES
(1,	1,	2,	'เรื่องราวอันน่าทึ่งของกาแฟที่คุณอาจไม่เคยรู้ โดย COFFEE PRESS',	'<p>ลองนึกภาพผู้คนนั่งปล่อยอารมณ์พักผ่อนยามบ่ายจากการทำงาน อยู่ในร้านกาแฟสุดชิคใจกลางทองหล่อ ดื่มคาปูชิโน่นุ่มๆ ด้วยความสบายใจ หรือจะเป็นพนักงานออฟฟิศที่สั่งกาแฟเข้มข้นหวานมันเนื่องจากร่างกายต้องการคาเฟอีนและน้ำตาลเพื่อปลุกสมองและร่างกายให้พร้อมทำงานในยามเช้า</p>',	'2021-08-04 10:23:36'),
(9,	2,	4,	'test',	'testtt',	'2021-08-04 21:00:48');

-- 2021-08-05 05:17:01
