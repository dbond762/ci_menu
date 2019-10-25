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
  `parrent` INT(11) NULL ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `menu` ADD CONSTRAINT `menu_parrent` FOREIGN KEY (`parrent`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
