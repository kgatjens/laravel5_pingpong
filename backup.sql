# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.43-0ubuntu0.14.04.1)
# Database: db_hepc
# Generation Time: 2016-05-30 23:30:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `access`;

CREATE TABLE `access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `access` WRITE;
/*!40000 ALTER TABLE `access` DISABLE KEYS */;

INSERT INTO `access` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'like','like',NULL,'2016-05-25 15:02:34','0000-00-00 00:00:00'),
	(2,'comment','comment',NULL,'2016-05-25 15:02:36','0000-00-00 00:00:00'),
	(3,'favorite','favorite',NULL,'2016-05-25 15:02:45','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `access` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table categories_tips
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories_tips`;

CREATE TABLE `categories_tips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `icon_path` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_tips_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `categories_tips` WRITE;
/*!40000 ALTER TABLE `categories_tips` DISABLE KEYS */;

INSERT INTO `categories_tips` (`id`, `title`, `description`, `icon_path`, `created_at`, `updated_at`)
VALUES
	(1,'Healthy<br>Recipes','','/images/tips/category/default/icon1.png','2016-05-03 21:21:01','2016-05-28 19:48:57'),
	(2,'Liver Friendly<br>Foods','','/images/tips/category/default/icon2.png','2016-05-03 21:21:01','2016-05-29 04:11:43'),
	(3,'Shopping<br>List','','/images/tips/category/default/icon3.png','2016-05-03 21:21:01','2016-05-29 04:12:07'),
	(4,'Getting Started<br>With Excercise','','/images/tips/category/default/icon4.png','2016-05-03 21:21:01','2016-05-29 04:12:22'),
	(5,'Easy<br>Exercises','','/images/tips/category/default/icon5.png','2016-05-03 21:21:01','2016-05-29 04:12:35'),
	(6,'Benefits of<br>Exercises','','/images/tips/category/default/icon6.png','2016-05-03 21:21:01','2016-05-29 04:12:58'),
	(7,'What to Expect<br>Week by Week','','/images/tips/category/default/icon7.png','2016-05-03 21:21:01','2016-05-29 04:13:15'),
	(8,'Staying<br>Safe','','/images/tips/category/default/icon8.png','2016-05-03 21:21:01','2016-05-29 04:13:43'),
	(9,'Dealing with<br>Life Events','','/images/tips/category/default/icon9.png','2016-05-03 21:21:01','2016-05-29 04:14:07'),
	(10,'Managing<br>Stress','','/images/tips/category/default/icon10.png','2016-05-03 21:21:01','2016-05-29 04:14:23'),
	(11,'Treatment<br>Tips','','/images/tips/category/default/icon11.png','2016-05-03 21:21:01','2016-05-29 04:14:41'),
	(12,'keeping Your<br>Liver Healthy','','/images/tips/category/default/icon12.png','2016-05-03 21:21:01','2016-05-29 04:15:09');

/*!40000 ALTER TABLE `categories_tips` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table challenges
# ------------------------------------------------------------

DROP TABLE IF EXISTS `challenges`;

CREATE TABLE `challenges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `challenges_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `challenges` WRITE;
/*!40000 ALTER TABLE `challenges` DISABLE KEYS */;

INSERT INTO `challenges` (`id`, `title`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Challenge #1','Drink at least 8 glasses of water a day!','2016-05-03 21:21:01','2016-05-03 21:21:01');

/*!40000 ALTER TABLE `challenges` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table challenges_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `challenges_comments`;

CREATE TABLE `challenges_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `challenge_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned NOT NULL,
  `anonymous_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `onesignal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `challenges_comments_id_unique` (`id`),
  KEY `fk_challenge_comments_challenge_idx` (`challenge_id`),
  KEY `fk_challenge_comments_comment_idx` (`comment_id`),
  KEY `fk_challenge_comment_anonymous_id_idx` (`anonymous_id`),
  CONSTRAINT `fk_challenge_comments_comment` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_challenge_comments_challenge` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table challenges_likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `challenges_likes`;

CREATE TABLE `challenges_likes` (
  `challenge_id` int(10) unsigned NOT NULL,
  `anonymous_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `onesignal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `fk_challenge_likes_challenge_idx` (`challenge_id`),
  KEY `fk_challenge_anonymous_id_idx` (`anonymous_id`),
  CONSTRAINT `fk_challenge_likes_challenge` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `comments_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `name`, `order`, `created_at`, `updated_at`)
VALUES
	(1,'Awesome!',1,'2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(2,'Good Job!',2,'2016-05-24 00:25:08','2016-05-24 00:26:16'),
	(3,'Excellent!',3,'2016-05-25 19:33:19','2016-05-25 19:33:19'),
	(4,'Niiice!',4,'2016-05-25 19:33:42','2016-05-25 19:33:42'),
	(5,'Very impressive!',5,'2016-05-25 19:33:59','2016-05-25 19:33:59');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table devices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `devices`;

CREATE TABLE `devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `onesignal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;

INSERT INTO `devices` (`id`, `onesignal_id`, `created_at`, `updated_at`)
VALUES
	(1,'31f0f81b-5da1-49d0-9223-e87b2533c885','2016-05-03 21:58:03','2016-05-03 21:58:03'),
	(3,'bdf0f786-e1bc-4e64-b4cf-fee428ab21a8','2016-05-26 16:29:33','2016-05-26 21:58:31'),
	(4,'1df0f786-e1bc-4e64-b4cf-fee428ab21a8','2016-05-26 20:52:51','2016-05-28 18:32:47'),
	(5,'2df0f786-e1bc-4e64-b4cf-fee428ab21a8','2016-05-26 20:53:08','2016-05-26 20:53:08'),
	(6,'a4fea647-2d8c-4d4e-b7ea-80e945dfeaaf','2016-05-30 02:38:13','2016-05-30 02:38:13'),
	(7,'e4a24f94-df59-44b8-972a-a2127d6df151','2016-05-30 15:49:25','2016-05-30 15:49:25'),
	(8,'f376e02d-e42a-403d-ad34-5281c615d460','2016-05-30 16:27:12','2016-05-30 16:27:12'),
	(9,'4f3718c0-1a30-4e7e-a320-9e11056d1579','2016-05-30 16:38:06','2016-05-30 19:44:18'),
	(10,'2ed333c2-cdeb-43ca-9598-ad7462839f38','2016-05-30 17:48:33','2016-05-30 17:48:33'),
	(11,'4972ae05-fa22-46ea-89be-16bb598ad23b','2016-05-30 17:50:32','2016-05-30 17:50:32'),
	(12,'9521bf7a-1769-419f-8b0a-24ff3b4cfc43','2016-05-30 19:44:18','2016-05-30 19:44:18'),
	(13,'fd619305-ee67-4774-a76f-87eca02b1ec6','2016-05-30 19:44:21','2016-05-30 19:44:21'),
	(14,'0a01edb5-185e-4fc7-a2cf-8d2a1e5f3f06','2016-05-30 21:06:05','2016-05-30 21:06:05'),
	(15,'67e9cfba-b5ec-44ed-b861-07d070d186ac','2016-05-30 22:18:43','2016-05-30 22:18:43'),
	(16,'9ccda1f1-63f7-4b4b-a82e-c78ecb913989','2016-05-30 22:25:02','2016-05-30 22:25:02'),
	(17,'2b084486-64a0-41cf-8127-f98f80a557e7','2016-05-30 23:14:17','2016-05-30 23:14:17'),
	(18,'7ae74e71-8ac7-42dd-aa21-8c6c4d523546','2016-05-30 23:21:24','2016-05-30 23:21:24');

/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table feeds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feeds`;

CREATE TABLE `feeds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `challenge_id` int(10) unsigned NOT NULL,
  `onesignal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `feeds_id_unique` (`id`),
  KEY `fk_feeds_challenge_idx` (`challenge_id`),
  CONSTRAINT `fk_feeds_challenge` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `feeds` WRITE;
/*!40000 ALTER TABLE `feeds` DISABLE KEYS */;

INSERT INTO `feeds` (`id`, `challenge_id`, `onesignal_id`, `created_at`, `updated_at`)
VALUES
	(1,1,'31f0f81b-5da1-49d0-9223-e87b2533c885','2016-05-03 21:57:05','2016-05-03 21:57:05');

/*!40000 ALTER TABLE `feeds` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table feeds_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feeds_comments`;

CREATE TABLE `feeds_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `feed_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned NOT NULL,
  `anonymous_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `onesignal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `feeds_comments_id_unique` (`id`),
  KEY `fk_feed_comments_feed_idx` (`feed_id`),
  KEY `fk_feed_comments_comment_idx` (`comment_id`),
  KEY `fk_feed_comment_anonymous_id_idx` (`anonymous_id`),
  CONSTRAINT `fk_feed_comments_comment` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_feed_comments_feed` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `feeds_comments` WRITE;
/*!40000 ALTER TABLE `feeds_comments` DISABLE KEYS */;

INSERT INTO `feeds_comments` (`id`, `feed_id`, `comment_id`, `anonymous_id`, `onesignal_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'1231232','31f0f81b-5da1-49d0-9223-e87b2533c885','2016-05-26 16:27:13','2016-05-26 16:27:13');

/*!40000 ALTER TABLE `feeds_comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table feeds_likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feeds_likes`;

CREATE TABLE `feeds_likes` (
  `feed_id` int(10) unsigned NOT NULL,
  `anonymous_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `onesignal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `fk_feed_likes_feed_idx` (`feed_id`),
  KEY `fk_feed_anonymous_id_idx` (`anonymous_id`),
  CONSTRAINT `fk_feed_likes_feed` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `feeds_likes` WRITE;
/*!40000 ALTER TABLE `feeds_likes` DISABLE KEYS */;

INSERT INTO `feeds_likes` (`feed_id`, `anonymous_id`, `onesignal_id`, `created_at`, `updated_at`)
VALUES
	(1,'12323213','31f0f81b-5da1-49d0-9223-e87b2533c885','2016-05-26 15:10:14','2016-05-26 15:10:14');

/*!40000 ALTER TABLE `feeds_likes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_07_05_111905_create_visitors_table',1),
	('2014_07_05_144447_create_articles_table',1),
	('2014_07_05_152557_create_options_table',1),
	('2014_07_07_005653_create_categories_table',1),
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1),
	('2014_11_02_051938_create_roles_table',1),
	('2014_11_02_052125_create_permissions_table',1),
	('2014_11_02_052410_create_role_user_table',1),
	('2014_11_02_092851_create_permission_role_table',1),
	('2016_04_08_184155_create_challenges_table',1),
	('2016_04_08_184211_create_comments_table',1),
	('2016_04_08_184236_create_challenge_comments_table',1),
	('2016_04_08_194638_create_feeds_table',1),
	('2016_04_08_194645_create_feeds_comments_table',1),
	('2016_04_08_194723_create_push_type_table',1),
	('2016_04_08_194733_create_device_table',1),
	('2016_04_08_194745_create_push_notification_table',1),
	('2016_04_13_213919_create_categories_tips_table',1),
	('2016_04_13_220231_create_tips_table',1),
	('2016_04_22_162716_create_feeds_likes_table',1),
	('2016_04_22_162743_create_challenges_likes_table',1),
	('2016_04_26_203449_create_posts_table',1),
	('2016_04_26_203856_create_posts_likes_table',1),
	('2016_04_26_204935_create_posts_comments_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `options_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`)
VALUES
	(1,4,1,'2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(2,3,1,'2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(3,2,1,'2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(4,1,1,'2016-05-03 21:21:01','2016-05-03 21:21:01');

/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Manage Users','manage_users','Manage Users','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(2,'Manage Settings','manage_settings','Manage Settings','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(3,'Manage Roles','manage_roles','Manage Roles','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(4,'Manage Permissions','manage_permissions','Manage Permissions','2016-05-03 21:21:01','2016-05-03 21:21:01');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `media_path` varchar(1024) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `access` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` char(10) COLLATE utf8_unicode_ci DEFAULT 'recipe',
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `title`, `subtitle`, `link`, `description`, `media_path`, `access`, `created_at`, `updated_at`, `type`)
VALUES
	(14,'Broccoli, Mushroom & Beef               Stir-Fry','From EatingWell:  January/February 2016','https://healthyeating.nhlbi.nih.gov/recipedetail.aspx?cId=9&rId=152#','<p>This healthy beef and broccoli stir-fry recipe has a Korean-inspired gochujang sauce. Because stir-fries cook up quickly, have all the ingredients prepped and next to the stove before you turn on the heat. Serve over brown rice or rice noodles.</p>\r\n\r\n<h3><br />\r\nINGREDIENTS</h3>\r\n\r\n<p><strong>SAUCE</strong></p>\r\n\r\n<p>1/4 cup gochujang (Korean hot pepper paste)</p>\r\n\r\n<p>2 tablespoons lemon juice</p>\r\n\r\n<p>1 tablespoon grated fresh ginger</p>\r\n\r\n<p>1 tablespoon soy sauce</p>\r\n\r\n<p>1 tablespoon dry sherry</p>\r\n\r\n<p>1 tablespoon toasted sesame oil</p>\r\n\r\n<p>2 teaspoons sugar</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>STIR-FRY</strong></p>\r\n\r\n<p>3 tablespoons peanut oil or canola oil, divided</p>\r\n\r\n<p>1 pound flank steak, trimmed</p>\r\n\r\n<p>4 cups 1-inch broccoli florets</p>\r\n\r\n<p>1 bunch scallions, trimmed and cut into 1-inch pieces</p>\r\n\r\n<p>3 cloves garlic, minced</p>\r\n\r\n<p>4 cups sliced mushrooms</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>PREPARATION</h3>\r\n\r\n<p><strong>To prepare sauce: </strong>Combine gochujang, lemon juice, ginger, soy sauce, sherry, sesame oil and sugar in a small bowl. Place near the stove.</p>\r\n\r\n<p><strong>To prepare stir-fry:</strong> Heat a 14-inch flat-bottom carbon-steel wok over high heat. (You&rsquo;ll know it&rsquo;s hot enough when a bead of water vaporizes within 1 to 2 seconds of contact.) Add 1 tablespoon oil and swirl to coat. Add steak and stir-fry until just cooked, 2 to 4 minutes. Transfer to a large plate.</p>\r\n\r\n<p>Swirl in another 1 tablespoon oil; add broccoli and scallions. Stir-fry for 2 minutes.</p>\r\n\r\n<p>Swirl in the remaining 1 tablespoon oil; add garlic and mushrooms. Stir-fry until the vegetables are tender, 2 to 4 minutes more.</p>\r\n\r\n<p>Return the steak to the wok. Add the reserved sauce and cook, gently stirring, until well coated and hot, 1 to 2 minutes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<pre>\r\n&nbsp;</pre>\r\n','/images/posts/post_qjdpKEUeFg.jpg',0,'2016-05-30 20:39:13','2016-05-30 22:48:31','recipe'),
	(15,'Lamb Burgers Topped with Mâche Salad','From Eating Well March 2010','','<h2>Ingredients</h2>\r\n\r\n<p>4 teaspoons extra-virgin olive oil</p>\r\n\r\n<p>3/4 teaspoon lemon zest, preferably Meyer lemon (see Shopping Tip), divided</p>\r\n\r\n<p>2 tablespoons lemon juice, preferably Meyer lemon</p>\r\n\r\n<p>1 teaspoon honey, preferably orange-blossom honey</p>\r\n\r\n<p>1/2 teaspoon Dijon mustard</p>\r\n\r\n<p>1/2 teaspoon poppy seeds</p>\r\n\r\n<p>3/4 teaspoon salt, divided</p>\r\n\r\n<p>Freshly ground pepper to taste</p>\r\n\r\n<p>1/4 cup unseasoned dry breadcrumbs, preferably whole-wheat</p>\r\n\r\n<p>2 tablespoons chopped fresh chives</p>\r\n\r\n<p>1 clove garlic, minced</p>\r\n\r\n<p>1 pound lean ground lamb, preferably from the leg (see Note)</p>\r\n\r\n<p>4 sandwich buns, preferably whole-wheat</p>\r\n\r\n<p>4 cups m&acirc;che (lamb&rsquo;s lettuce) or coarsely chopped butterhead lettuce</p>\r\n\r\n<p>1/2 cup fresh mint leaves</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Preparation</h2>\r\n\r\n<p>Whisk oil, 1/4 teaspoon lemon zest, lemon juice, honey, mustard, poppy seeds, 1/2 teaspoon salt and pepper to taste in a large bowl. Set aside.</p>\r\n\r\n<p>Combine breadcrumbs, chives, garlic, the remaining 1/2 teaspoon lemon zest, the remaining 1/4 teaspoon salt and 1/2 teaspoon pepper in a medium bowl. Add lamb and gently knead until combined. Form into 4 patties.</p>\r\n\r\n<p>Coat a large nonstick skillet with cooking spray and heat over medium heat. Add the patties; cook until there is just a hint of pink in the center, 3 to 5 minutes per side. Transfer to a plate; tent with foil to keep warm.</p>\r\n\r\n<p>Meanwhile, warm or toast buns, if desired. Add m&acirc;che (or lettuce) and mint to the bowl with the dressing; toss to coat. Place the lamb burgers on the buns and top with salad greens (a generous 3/4 cup each).</p>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>Tips &amp; Notes</h3>\r\n\r\n<p><strong>Make Ahead Tip</strong>: Refrigerate the dressing (Step 1) for up to 1 day. Cover and refrigerate the lamb mixture (Step 2) for up to 4 hours.</p>\r\n\r\n<p><strong>Tip:</strong>&nbsp;It can be difficult to find lean ground lamb, but it&rsquo;s easy to grind your own. Choose a lean cut, such as leg or loin, trim any excess fat and cut into 3/4-inch pieces. Pulse in a food processor until uniformly ground, being careful not to overprocess. Or ask your butcher to grind a lean cut for you.</p>\r\n\r\n<p><strong>Shopping Tip:</strong>&nbsp;Look for Meyer lemons in late winter and early spring in well-stocked supermarkets and specialty grocers. Regular lemon works well as a substitute in this recipe.</p>\r\n','/images/posts/post_SIhJoS22Tp.jpg',0,'2016-05-30 22:54:33','2016-05-30 22:54:33','recipe'),
	(16,'Tuna, Artichoke & Basil Stuffed Potatoes','','http://www.eatingwell.com/','<p>These baked potatoes topped with canned tuna, artichoke hearts, provolone cheese and basil may seem unconventional, but the flavor combination is awesome. Serve with a mixed green salad.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Ingredients</h3>\r\n\r\n<p>4 medium russet potatoes, scrubbed</p>\r\n\r\n<p>2 5- to 6-ounce cans chunk light tuna (see Note), drained</p>\r\n\r\n<p>3/4 cup nonfat plain Greek yogurt</p>\r\n\r\n<p>1/2 cup plus 2 tablespoons chopped fresh basil, divided</p>\r\n\r\n<p>1 6-ounce jar marinated artichoke hearts, drained and chopped (about 1/2 cup)</p>\r\n\r\n<p>2 scallions, chopped</p>\r\n\r\n<p>1 tablespoon capers, rinsed (optional)</p>\r\n\r\n<p>1/4 teaspoon salt</p>\r\n\r\n<p>1/2 teaspoon freshly ground pepper</p>\r\n\r\n<p>3/4 cup shredded provolone cheese</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Preparation</h3>\r\n\r\n<p>Pierce potatoes all over with a fork. Microwave on Medium, turning once or twice, until soft, about 20 minutes. (Or use the &ldquo;potato setting&rdquo; on your microwave and cook according to manufacturer&rsquo;s directions.)</p>\r\n\r\n<p>Meanwhile, combine tuna, yogurt, 1/2 cup basil, artichoke hearts, scallions, capers (if using), salt and pepper in a large bowl.</p>\r\n\r\n<p>When the potatoes are cool enough to handle, carefully cut off the top third. Scoop out the insides and add to the bowl with the tuna. Place the potato shells in a microwave-safe dish. Mash the potato and tuna mixture together with a fork or potato masher.</p>\r\n\r\n<p>Evenly divide the tuna mixture among the potato shells. (They will be very well stuffed.) Top with cheese. Microwave on High until the filling is hot and the cheese is melted, 2 to 4 minutes. To serve, top each potato with a little tomato and some of the remaining 2 tablespoons basil.</p>\r\n','/images/posts/post_tr2T2GiSq3.jpg',0,'2016-05-30 23:12:37','2016-05-30 23:15:37','recipe');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_access`;

CREATE TABLE `posts_access` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `access_id` int(10) unsigned NOT NULL,
  `status` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `posts_access_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posts_access` WRITE;
/*!40000 ALTER TABLE `posts_access` DISABLE KEYS */;

INSERT INTO `posts_access` (`id`, `post_id`, `access_id`, `status`, `created_at`, `updated_at`)
VALUES
	(25,14,1,'1','2016-05-30 15:39:13','0000-00-00 00:00:00'),
	(26,14,2,'1','2016-05-30 15:39:13','0000-00-00 00:00:00'),
	(27,14,3,'1','2016-05-30 15:39:13','0000-00-00 00:00:00'),
	(28,15,1,'1','2016-05-30 17:54:33','0000-00-00 00:00:00'),
	(29,15,2,'0','2016-05-30 17:54:33','0000-00-00 00:00:00'),
	(30,15,3,'0','2016-05-30 17:54:33','0000-00-00 00:00:00'),
	(31,16,1,'0','2016-05-30 18:15:38','2016-05-30 23:15:38'),
	(32,16,2,'1','2016-05-30 18:12:37','0000-00-00 00:00:00'),
	(33,16,3,'0','2016-05-30 18:15:38','2016-05-30 23:15:38');

/*!40000 ALTER TABLE `posts_access` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_comments`;

CREATE TABLE `posts_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned NOT NULL,
  `anonymous_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `onesignal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_comments_id_unique` (`id`),
  KEY `fk_post_comments_post_idx` (`post_id`),
  KEY `fk_post_comments_comment_idx` (`comment_id`),
  KEY `fk_post_comment_anonymous_id_idx` (`anonymous_id`),
  CONSTRAINT `fk_post_comments_comment` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_comments_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posts_comments` WRITE;
/*!40000 ALTER TABLE `posts_comments` DISABLE KEYS */;

INSERT INTO `posts_comments` (`id`, `post_id`, `comment_id`, `anonymous_id`, `onesignal_id`, `created_at`, `updated_at`)
VALUES
	(38,14,1,'','31f0f81b-5da1-49d0-9223-e87b2533c885','2016-05-30 23:33:59','2016-05-30 23:33:59');

/*!40000 ALTER TABLE `posts_comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts_likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_likes`;

CREATE TABLE `posts_likes` (
  `post_id` int(10) unsigned NOT NULL,
  `anonymous_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `onesignal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `fk_post_likes_post_idx` (`post_id`),
  KEY `fk_post_anonymous_id_idx` (`anonymous_id`),
  CONSTRAINT `fk_post_likes_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table push_notification_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `push_notification_types`;

CREATE TABLE `push_notification_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `push_notification_types_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `push_notification_types` WRITE;
/*!40000 ALTER TABLE `push_notification_types` DISABLE KEYS */;

INSERT INTO `push_notification_types` (`id`, `name`, `title`, `slug`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Like feed','Like feed','like-feed','Like an anonymous feed.','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(2,'Comment feed','Comment feed','comment-feed','Make a comment on anonymous feed.','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(3,'Like post','Like post','like-post','Like a post.','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(4,'Comment post','Comment post','comment-post','Make a comment on post.','2016-05-03 21:21:01','2016-05-03 21:21:01');

/*!40000 ALTER TABLE `push_notification_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table push_notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `push_notifications`;

CREATE TABLE `push_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `device_id` int(10) unsigned NOT NULL,
  `push_notification_type_id` int(10) unsigned NOT NULL,
  `pushable_id` int(10) unsigned NOT NULL,
  `pushable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sent` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `push_notifications_id_unique` (`id`),
  KEY `push_notifications_device_id_foreign` (`device_id`),
  KEY `push_notifications_push_notification_type_id_foreign` (`push_notification_type_id`),
  CONSTRAINT `push_notifications_push_notification_type_id_foreign` FOREIGN KEY (`push_notification_type_id`) REFERENCES `push_notification_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `push_notifications_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `push_notifications` WRITE;
/*!40000 ALTER TABLE `push_notifications` DISABLE KEYS */;

INSERT INTO `push_notifications` (`id`, `device_id`, `push_notification_type_id`, `pushable_id`, `pushable_type`, `title`, `message`, `sent`, `created_at`, `updated_at`)
VALUES
	(1,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-25 21:29:40','2016-05-25 21:29:41'),
	(2,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-25 21:29:58','2016-05-25 21:29:58'),
	(3,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-25 21:30:02','2016-05-25 21:30:02'),
	(4,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-25 21:30:04','2016-05-25 21:30:04'),
	(5,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-25 21:30:10','2016-05-25 21:30:11'),
	(6,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-25 21:30:26','2016-05-25 21:30:26'),
	(7,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-25 21:41:43','2016-05-25 21:41:43'),
	(8,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-25 21:42:25','2016-05-25 21:42:25'),
	(9,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-26 14:58:14','2016-05-26 14:58:15'),
	(10,1,1,0,'','like-feed','Someone likes your feed.',1,'2016-05-26 15:10:14','2016-05-26 15:10:14'),
	(11,1,2,0,'','comment-feed','Someone comment your feed.',1,'2016-05-26 16:27:11','2016-05-26 16:27:13');

/*!40000 ALTER TABLE `push_notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(2,2,2,'2016-05-03 21:21:01','2016-05-03 21:21:01');

/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Administrator','admin',NULL,'2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(2,'Editor','editor',NULL,'2016-05-03 21:21:01','2016-05-03 21:21:01');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tips
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tips`;

CREATE TABLE `tips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `media_path` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `access` tinyint(4) NOT NULL,
  `categories_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tips_id_unique` (`id`),
  KEY `fk_tips_category_idx` (`categories_id`),
  CONSTRAINT `fk_tips_category` FOREIGN KEY (`categories_id`) REFERENCES `categories_tips` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tips` WRITE;
/*!40000 ALTER TABLE `tips` DISABLE KEYS */;

INSERT INTO `tips` (`id`, `title`, `subtitle`, `link`, `description`, `media_path`, `access`, `categories_id`, `created_at`, `updated_at`)
VALUES
	(1,'Test Tips 1','','','<p>Des.</p>\r\n','/images/tips/tip_mYEsck3pxX.png',0,1,'2016-05-25 16:20:54','2016-05-30 15:27:55'),
	(2,'Test Tips 2','','','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit vestibulum neque, at eleifend nunc molestie eget. Pellentesque gravida magna vitae dolor consectetur consequat.</p>\r\n','',0,1,'2016-05-27 21:04:39','2016-05-27 21:04:39'),
	(3,'Test Tips 3','','','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit vestibulum neque, at eleifend nunc molestie eget. Pellentesque gravida magna vitae dolor consectetur consequat.</p>\r\n','',0,3,'2016-05-27 21:04:55','2016-05-27 21:04:55'),
	(4,'Test Tips 4','','','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit vestibulum neque, at eleifend nunc molestie eget. Pellentesque gravida magna vitae dolor consectetur consequat.</p>\r\n','/images/tips/tip_4VrGFWYhmc.png',0,1,'2016-05-27 21:06:24','2016-05-30 17:59:07');

/*!40000 ALTER TABLE `tips` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'','admin@hepc.com','$2y$10$in.yc3l6CdMLMLQeCfnfAumBWjL6yfQWKcJM6Jwg6JIKQC6cqX33K','EMePgYOXfY4kSUcKmahNz4gmGXubSIa5SLRqCUlkmpxv09aDBKvWdt9Ew8AU','2016-05-03 21:21:01','2016-05-23 17:39:25'),
	(2,'','editor@hepc.com','$2y$10$F8IUFa3z29y8hAIo1bAeP.wUbz1lg2biRbDPpjzjrPQcdW6so79Yy','gt6dEUcDD2zAnBU2N8GapyN355kp3v1Pnudbo9KXnImUw8xGKxmze7vWNlQM','2016-05-03 21:21:01','2016-05-23 17:39:47');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table visitors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `visitors`;

CREATE TABLE `visitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
