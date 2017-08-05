CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `statistical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `begin` datetime DEFAULT NOW(),
  `end` datetime NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime DEFAULT NOW(),
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `opportunities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opportunitie_id` int(11) NOT NULL,
  `type_contact_id` int(11) NOT NULL,
  `date` datetime DEFAULT NOW(),
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `type_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

TRUNCATE TABLE `type_contact`;

INSERT INTO `type_contact` (`id`, `name`) VALUES (1, 'post');
INSERT INTO `type_contact` (`id`, `name`) VALUES (2, 'email');
INSERT INTO `type_contact` (`id`, `name`) VALUES (3, 'phone');
INSERT INTO `type_contact` (`id`, `name`) VALUES (4, 'phone_relaunch');
INSERT INTO `type_contact` (`id`, `name`) VALUES (5, 'interview');