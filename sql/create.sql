-- -----------------------------------------------------
-- Create Database `secrestfull`
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `secrestfull`;
CREATE SCHEMA IF NOT EXISTS `secrestfull` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;

-- -----------------------------------------------------
-- Create Administrator user `sec`
-- -----------------------------------------------------
DROP USER IF EXISTS 'sec'@'%';
CREATE USER 'sec'@'%' IDENTIFIED BY 'restfull';
GRANT ALL PRIVILEGES ON secrestfull . * TO 'sec'@'%';
SHOW GRANTS FOR 'sec'@'%';


USE `secrestfull` ;

-- -----------------------------------------------------
-- Table `secrestfull`.`supported`
-- used for avaible operating system
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secrestfull`.`supported` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `operating_system` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- Add first supported operating system
INSERT INTO `secrestfull`.`supported` (`id`, `operating_system`) VALUES ('1', 'Ubuntu 20.04 LTS');



