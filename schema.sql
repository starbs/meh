CREATE DATABASE IF NOT EXISTS `starbs-meh`;

CREATE TABLE IF NOT EXISTS `starbs-meh`.`urls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hash` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `full` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `urls_hash_unique` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
