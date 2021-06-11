DROP DATABASE IF EXISTS `indigitall`;
CREATE SCHEMA `indigitall` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE `indigitall`.`users` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(100) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `language` VARCHAR(45) NOT NULL,
  `latitude` FLOAT NOT NULL,
  `longitude` FLOAT NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE);

CREATE TABLE `indigitall`.`friends` (
  `id_friendship` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` INT UNSIGNED NOT NULL,
  `id_user_friend` INT UNSIGNED NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id_friendship`),
  INDEX `i_user_idx` (`id_user` ASC) VISIBLE,
  CONSTRAINT `i_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `indigitall`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `i_user_friend`
    FOREIGN KEY (`id_user`)
    REFERENCES `indigitall`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);