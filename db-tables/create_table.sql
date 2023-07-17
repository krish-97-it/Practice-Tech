-- Table list
-- 1. wp_create_update_user_data
-- 2. wp_crud


CREATE TABLE `wp_create_update_user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(555) DEFAULT NULL,
  PRIMARY KEY (`phone`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin


CREATE TABLE `wp_crud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `address` varchar(555) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
