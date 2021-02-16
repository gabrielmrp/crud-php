DROP DATABASE  `phpcrud`;
CREATE DATABASE `phpcrud`;
USE `phpcrud`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB; 
INSERT INTO `users` (`name`, `email`, `password`) VALUES
  ("User", "user@user.com", "secret"),
  ("User 2", "user2@user.com", "12345678"),
  ("John Doe", "user3@user.com", "654321"),
  ("User 4d", "user4@user.com", "qwe123"); 