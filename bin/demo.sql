CREATE DATABASE  IF NOT EXISTS `demo`;
USE `demo`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` binary(60) NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8_czech_ci NOT NULL DEFAULT 'user',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_uindex` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='tabulka pro uživatele';