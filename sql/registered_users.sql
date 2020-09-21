CREATE TABLE IF NOT EXISTS `registered_users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `registered_at` DATETIME NOT NULL,
  `last_login_at` DATETIME NOT NULL,
  PRIMARY KEY (`user_id`)
);