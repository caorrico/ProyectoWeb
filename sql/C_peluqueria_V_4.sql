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
  `idrol` INT NOT NULL AUTO_INCREMENT,
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
-- Table `peluqueria_p`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `nombre_categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`producto` (
  `idproducto` INT NOT NULL AUTO_INCREMENT,
  `nombre_producto` VARCHAR(45) NOT NULL,
  `detaller_producto` VARCHAR(45) NULL,
  `precio` FLOAT NULL,
  `categoria_idcategoria` INT NOT NULL,
  PRIMARY KEY (`idproducto`, `categoria_idcategoria`),
  INDEX `fk_producto_categoria1_idx` (`categoria_idcategoria` ASC) ,
  CONSTRAINT `fk_producto_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `peluqueria_p`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
-- Table `peluqueria_p`.`inventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`inventario` (
  `idinventario` INT NOT NULL AUTO_INCREMENT,
  `cantidad` INT NOT NULL,
  `precio` FLOAT NOT NULL,
  `producto_idproducto` INT NOT NULL,
  `persona_idpersona` INT NOT NULL,
  PRIMARY KEY (`idinventario`, `producto_idproducto`, `persona_idpersona`),
  INDEX `fk_inventario_producto1_idx` (`producto_idproducto` ASC) ,
  INDEX `fk_inventario_persona1_idx` (`persona_idpersona` ASC) ,
  CONSTRAINT `fk_inventario_producto1`
    FOREIGN KEY (`producto_idproducto`)
    REFERENCES `peluqueria_p`.`producto` (`idproducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventario_persona1`
    FOREIGN KEY (`persona_idpersona`)
    REFERENCES `peluqueria_p`.`persona` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`empresa` (
  `idempresa` INT NOT NULL AUTO_INCREMENT,
  `nombre_empresa` VARCHAR(45) NOT NULL,
  `direccion_empresa` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idempresa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`sucursal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`sucursal` (
  `idsucursal` INT NOT NULL AUTO_INCREMENT,
  `nombre_sucursar` VARCHAR(45) NOT NULL,
  `direccion_sucursal` VARCHAR(45) NOT NULL,
  `empresa_idempresa` INT NOT NULL,
  PRIMARY KEY (`idsucursal`, `empresa_idempresa`),
  INDEX `fk_sucursal_empresa1_idx` (`empresa_idempresa` ASC) ,
  CONSTRAINT `fk_sucursal_empresa1`
    FOREIGN KEY (`empresa_idempresa`)
    REFERENCES `peluqueria_p`.`empresa` (`idempresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`venta` (
  `idfactura` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `codigo_factura` VARCHAR(45) NOT NULL,
  `precio` VARCHAR(45) NOT NULL,
  `servicio_idservicio` INT NOT NULL,
  `persona_idpersona` INT NOT NULL,
  `sucursal_idsucursal` INT NOT NULL,
  PRIMARY KEY (`idfactura`, `servicio_idservicio`, `persona_idpersona`, `sucursal_idsucursal`),
  INDEX `fk_venta_servicio1_idx` (`servicio_idservicio` ASC) ,
  INDEX `fk_venta_persona1_idx` (`persona_idpersona` ASC) ,
  INDEX `fk_venta_sucursal1_idx` (`sucursal_idsucursal` ASC) ,
  CONSTRAINT `fk_venta_servicio1`
    FOREIGN KEY (`servicio_idservicio`)
    REFERENCES `peluqueria_p`.`servicio` (`idservicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_persona1`
    FOREIGN KEY (`persona_idpersona`)
    REFERENCES `peluqueria_p`.`persona` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_sucursal1`
    FOREIGN KEY (`sucursal_idsucursal`)
    REFERENCES `peluqueria_p`.`sucursal` (`idsucursal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`permisos` (
  `idpermisos` INT NOT NULL AUTO_INCREMENT,
  `permiso_acceso` VARCHAR(45) NULL,
  `rol_idrol` INT NOT NULL,
  PRIMARY KEY (`idpermisos`, `rol_idrol`),
  INDEX `fk_permisos_rol1_idx` (`rol_idrol` ASC) ,
  CONSTRAINT `fk_permisos_rol1`
    FOREIGN KEY (`rol_idrol`)
    REFERENCES `peluqueria_p`.`rol` (`idrol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `peluqueria_p`.`Servicio_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `peluqueria_p`.`Servicio_producto` (
  `idServicio_producto` INT NOT NULL AUTO_INCREMENT,
  `servicio_idservicio` INT NOT NULL,
  `producto_idproducto` INT NOT NULL,
  PRIMARY KEY (`idServicio_producto`, `servicio_idservicio`, `producto_idproducto`),
  INDEX `fk_Servicio_producto_servicio1_idx` (`servicio_idservicio` ASC) ,
  INDEX `fk_Servicio_producto_producto1_idx` (`producto_idproducto` ASC),
  CONSTRAINT `fk_Servicio_producto_servicio1`
    FOREIGN KEY (`servicio_idservicio`)
    REFERENCES `peluqueria_p`.`servicio` (`idservicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servicio_producto_producto1`
    FOREIGN KEY (`producto_idproducto`)
    REFERENCES `peluqueria_p`.`producto` (`idproducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
