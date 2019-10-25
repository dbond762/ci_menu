CREATE TABLE `ci_menu`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(100) NOT NULL ,
  `is_admin` BOOLEAN NOT NULL DEFAULT FALSE ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `ci_menu`.`user` ADD UNIQUE `unique_user_name` (`name`);

CREATE TABLE `ci_menu`.`menu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(50) NOT NULL ,
  `link` VARCHAR(100) NOT NULL ,
  `order` INT(3) NOT NULL ,
  `is_draft` BOOLEAN NOT NULL DEFAULT FALSE ,
  `parrent` INT(11) DEFAULT NULL ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `menu` ADD CONSTRAINT `menu_parrent` FOREIGN KEY (`parrent`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `menu` (`id`, `label`, `order`, `is_draft`, `link`, `parrent`) VALUES
(1, 'Start', 0, 0, '#', NULL),
(2, 'Eventskalender 2019', 1, 0, '#', NULL),
(3, 'Kongress 2020 in Berlin', 2, 0, '#', 2),
(4, 'Präsentation des Kongresses von Österreich 2019', 3, 0, '#', 2),
(5, 'Kongress 2019 in München', 4, 0, '#', 2),
(6, 'Andere Aktivitäten', 5, 0, '#', 2),
(7, 'Congress Awards', 6, 0, '#', NULL),
(14, 'Congress Awards', 7, 0, '#', 7),
(15, 'IT Awards', 8, 0, '#', 7),
(16, 'Unsere Partner', 9, 0, '#', NULL),
(17, 'Registrierung', 10, 0, '#', NULL),
(18, 'ÜBER UNS', 11, 0, '#', NULL),
(19, 'Kongreß 2017', 12, 0, '#', 18),
(20, 'Unser Team', 13, 0, '#', 18),
(21, 'Nachrichten', 14, 0, '#', NULL),
(22, 'Kontakte', 15, 0, '#', NULL);