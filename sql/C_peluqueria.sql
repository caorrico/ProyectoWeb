-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema peluqueria_p
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema peluqueria_p
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `peluqueria_p` DEFAULT CHARACTER SET utf8 ;
USE `peluqueria_p` ;

-- -----------------------------------------------------
-- Table `peluqueria_p`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`rol` (
  `idrol` INT NOT NULL DEFAULT 100,
  `nombre_rol` VARCHAR(45) NULL,
  PRIMARY KEY (`idrol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`persona` (
  `idpersona` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `cedula` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `contrasena` VARCHAR(45) NOT NULL,
  `activo` TINYINT NOT NULL,
  `rol_idrol` INT NOT NULL,
  PRIMARY KEY (`idpersona`, `rol_idrol`),
  INDEX `fk_persona_rol1_idx` (`rol_idrol` ASC) ,
  CONSTRAINT `fk_persona_rol1`
    FOREIGN KEY (`rol_idrol`)
    REFERENCES `peluqueria_p`.`rol` (`idrol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`producto` (
  `idproducto` INT NOT NULL DEFAULT 1000,
  `nombre_producto` VARCHAR(45) NOT NULL,
  `detaller_producto` VARCHAR(45) NULL,
  `precio` VARCHAR(45) NULL,
  PRIMARY KEY (`idproducto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`servicio` (
  `idservicio` INT NOT NULL AUTO_INCREMENT,
  `nombre_servicio` VARCHAR(45) NOT NULL,
  `descripcion_servicio` VARCHAR(45) NULL,
  PRIMARY KEY (`idservicio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`producto_has_servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`producto_has_servicio` (
  `producto_idproducto` INT NOT NULL,
  `servicio_idservicio` INT NOT NULL,
  PRIMARY KEY (`producto_idproducto`, `servicio_idservicio`),
  INDEX `fk_producto_has_servicio_servicio1_idx` (`servicio_idservicio` ASC) ,
  INDEX `fk_producto_has_servicio_producto1_idx` (`producto_idproducto` ASC) ,
  CONSTRAINT `fk_producto_has_servicio_producto1`
    FOREIGN KEY (`producto_idproducto`)
    REFERENCES `peluqueria_p`.`producto` (`idproducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_servicio_servicio1`
    FOREIGN KEY (`servicio_idservicio`)
    REFERENCES `peluqueria_p`.`servicio` (`idservicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`inventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`inventario` (
  `idinventario` INT NOT NULL DEFAULT 200,
  `cantidad` VARCHAR(45) NOT NULL,
  `precio` FLOAT NULL,
  `producto_idproducto` INT NOT NULL,
  PRIMARY KEY (`idinventario`, `producto_idproducto`),
  INDEX `fk_inventario_producto1_idx` (`producto_idproducto` ASC) ,
  CONSTRAINT `fk_inventario_producto1`
    FOREIGN KEY (`producto_idproducto`)
    REFERENCES `peluqueria_p`.`producto` (`idproducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`venta` (
  `idfactura` INT NOT NULL DEFAULT 2000,
  `fecha` DATE NOT NULL,
  `codigo_factura` VARCHAR(45) NOT NULL,
  `precio` VARCHAR(45) NOT NULL,
  `servicio_idservicio` INT NOT NULL,
  `persona_idpersona` INT NOT NULL,
  PRIMARY KEY (`idfactura`, `servicio_idservicio`, `persona_idpersona`),
  INDEX `fk_venta_servicio1_idx` (`servicio_idservicio` ASC) ,
  INDEX `fk_venta_persona1_idx` (`persona_idpersona` ASC) ,
  CONSTRAINT `fk_venta_servicio1`
    FOREIGN KEY (`servicio_idservicio`)
    REFERENCES `peluqueria_p`.`servicio` (`idservicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_persona1`
    FOREIGN KEY (`persona_idpersona`)
    REFERENCES `peluqueria_p`.`persona` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
