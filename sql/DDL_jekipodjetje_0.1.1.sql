-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema secrestfull
-- -----------------------------------------------------
-- secrestfull database

-- -----------------------------------------------------
-- Schema secrestfull
--
-- secrestfull database
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `secrestfull` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `secrestfull` ;

-- -----------------------------------------------------
-- Table `secrestfull`.`supported`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secrestfull`.`supported` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `operating_system` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `secrestfull`.`oblike_podjetja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secrestfull`.`oblike_podjetja` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `oblika` VARCHAR(255) NOT NULL COMMENT 'Pravna oblika podjetja, torej, dno, doo, drustco, zadruga, itd',
  `kratica` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `secrestfull`.`obcina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secrestfull`.`obcina` (
  `id_koh_reg_nac` INT(3) NOT NULL,
  `id_koh_reg_euro` VARCHAR(10) NOT NULL,
  `koh_regija` VARCHAR(20) NOT NULL,
  `id_stat_reg_nac` INT(3) NOT NULL,
  `id_stat_reg_euro` VARCHAR(10) NOT NULL,
  `stat_reg` VARCHAR(25) NOT NULL,
  `id_obcina` INT(3) NOT NULL,
  `obcina` VARCHAR(255) NOT NULL COMMENT 'Kohezijske statisticne obcine po regijah po 2 standardih:\n- Standardna klasifikacija teritorialnih enot (SKTE) in \n- Skupna klasifikacija statističnih teritorialnih enot v Evropski uniji (NUTS).')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `secrestfull`.`drzava`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secrestfull`.`drzava` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(255) NULL,
  `kratica` VARCHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
