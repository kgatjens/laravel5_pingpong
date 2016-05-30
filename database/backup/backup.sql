# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.160.46 (MySQL 5.5.47-0ubuntu0.14.04.1)
# Database: db_hepc
# Generation Time: 2016-05-03 21:59:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
	(1,'Healthy Recipes','','/images/tips/category/default/icon1.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(2,'Liver Friendly Foods','','/images/tips/category/default/icon2.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(3,'Shopping List','','/images/tips/category/default/icon3.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(4,'Getting Started With Excercise','','/images/tips/category/default/icon4.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(5,'Easy Exercises','','/images/tips/category/default/icon5.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(6,'Benefits of Exercises','','/images/tips/category/default/icon6.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(7,'What to Expect Week by Week','','/images/tips/category/default/icon7.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(8,'Staying Safe','','/images/tips/category/default/icon8.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(9,'Dealing with Life Events','','/images/tips/category/default/icon9.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(10,'Managing Stress','','/images/tips/category/default/icon10.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(11,'Treatment Tips','','/images/tips/category/default/icon11.png','2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(12,'keeping Your Liver Healthy','','/images/tips/category/default/icon12.png','2016-05-03 21:21:01','2016-05-03 21:21:01');

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
	(1,'Awesome!',1,'2016-05-03 21:21:01','2016-05-03 21:21:01');

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
	(1,'31f0f81b-5da1-49d0-9223-e87b2533c885','2016-05-03 21:58:03','2016-05-03 21:58:03');

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
  `media_path` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `access` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



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
	(1,'','admin@hepc.com','$2y$10$in.yc3l6CdMLMLQeCfnfAumBWjL6yfQWKcJM6Jwg6JIKQC6cqX33K',NULL,'2016-05-03 21:21:01','2016-05-03 21:21:01'),
	(2,'','editor@hepc.com','$2y$10$F8IUFa3z29y8hAIo1bAeP.wUbz1lg2biRbDPpjzjrPQcdW6so79Yy',NULL,'2016-05-03 21:21:01','2016-05-03 21:21:01');

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
