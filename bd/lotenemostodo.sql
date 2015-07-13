-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2015 a las 01:55:34
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema loTenemosTodo
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `loTenemosTodo` ;

-- -----------------------------------------------------
-- Schema loTenemosTodo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `loTenemosTodo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `loTenemosTodo` ;

-- -----------------------------------------------------
-- Table `loTenemosTodo`.`perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `loTenemosTodo`.`perfil` ;

CREATE TABLE IF NOT EXISTS `loTenemosTodo`.`perfil` (
  `id_perfil` INT NOT NULL AUTO_INCREMENT,
  `descripcion_perfil` VARCHAR(45) NULL,
  PRIMARY KEY (`id_perfil`))
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descripcion_perfil`) VALUES
(1, 'Administrador'),
(2, 'Consulta'),
(3, 'Trabajador');


-- -----------------------------------------------------
-- Table `loTenemosTodo`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `loTenemosTodo`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `loTenemosTodo`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `login_usuario` VARCHAR(30) NULL,
  `pass_usuario` VARCHAR(30) NULL,
  `nombre_usuario` VARCHAR(30) NULL,
  `apellido_usuario` VARCHAR(30) NULL,
  `correo_usuario` VARCHAR(45) NULL,
  `edad_usuario` INT NOT NULL,
  `codigo_perfil` INT NOT NULL,
  `fechaNacimiento_usuario` DATE NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuarios_perfil1_idx` (`codigo_perfil` ASC),
  CONSTRAINT `fk_usuarios_perfil1`
    FOREIGN KEY (`codigo_perfil`)
    REFERENCES `loTenemosTodo`.`perfil` (`id_perfil`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `login_usuario`, `pass_usuario`, `nombre_usuario`, `apellido_usuario`, `correo_usuario`, `edad_usuario`, `codigo_perfil`, `fechaNacimiento_usuario`) VALUES
(1, 'crismeneses', '123456', 'Cristian', 'Meneses', 'correo@mail.com', 24, 1, '1991-03-27');



-- -----------------------------------------------------
-- Table `loTenemosTodo`.`orden_compras`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `loTenemosTodo`.`orden_compras` ;

CREATE TABLE IF NOT EXISTS `loTenemosTodo`.`orden_compras` (
  `ID_OC` INT NOT NULL AUTO_INCREMENT,
  `FECHA_EMISION` DATE NULL,
  `TOTAL_OC` DECIMAL(10,0) NULL,
  `ESTADO` VARCHAR(30) NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`ID_OC`, `id_usuario`),
  INDEX `fk_orden_compras_usuarios_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_orden_compras_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `loTenemosTodo`.`usuarios` (`id_usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `loTenemosTodo`.`tipo_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `loTenemosTodo`.`tipo_producto` ;

CREATE TABLE IF NOT EXISTS `loTenemosTodo`.`tipo_producto` (
  `id_tipoProducto` INT NOT NULL,
  `descripcion_tipo` VARCHAR(100) NULL,
  PRIMARY KEY (`id_tipoProducto`))
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipoProducto`, `descripcion_tipo`) VALUES
(1, 'Tecnológico'),
(2, 'Electrodomestico'),
(3, 'Vestuario'),
(4, 'Deporte');


-- -----------------------------------------------------
-- Table `loTenemosTodo`.`productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `loTenemosTodo`.`productos` ;

CREATE TABLE IF NOT EXISTS `loTenemosTodo`.`productos` (
  `ID_PRODUCTO` INT NOT NULL AUTO_INCREMENT,
  `DESCRIPCION` VARCHAR(150) NULL,
  `PRECIO` INT NULL,
  `UNIDAD` INT NULL,
  `id_tipo` INT NOT NULL,
  PRIMARY KEY (`ID_PRODUCTO`),
  INDEX `fk_productos_tipo_producto1_idx` (`id_tipo` ASC),
  CONSTRAINT `fk_productos_tipo_producto1`
    FOREIGN KEY (`id_tipo`)
    REFERENCES `loTenemosTodo`.`tipo_producto` (`id_tipoProducto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;
--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_PRODUCTO`, `DESCRIPCION`, `PRECIO`, `UNIDAD`, `id_tipo`) VALUES
(1, 'Television Sony 40"', 164990, 20, 1),
(2, 'DVD/BlueRay Samsung', 89990, 42, 1),
(3, 'Zapatillas Nike', 34990, 50, 3),
(4, 'Lavadora LG', 74990, 13, 2);


-- -----------------------------------------------------
-- Table `loTenemosTodo`.`detalle_oc`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `loTenemosTodo`.`detalle_oc` ;

CREATE TABLE IF NOT EXISTS `loTenemosTodo`.`detalle_oc` (
  `ID_OC` INT NOT NULL AUTO_INCREMENT,
  `ID_PRODUCTO` INT NOT NULL,
  `CANTIDAD` INT NULL,
  `SUB_TOTAL` INT NULL,
  PRIMARY KEY (`ID_OC`, `ID_PRODUCTO`),
  INDEX `fk_detalle_oc_productos1_idx` (`ID_PRODUCTO` ASC),
  CONSTRAINT `fk_detalle_oc_orden_compras1`
    FOREIGN KEY (`ID_OC`)
    REFERENCES `loTenemosTodo`.`orden_compras` (`ID_OC`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_detalle_oc_productos1`
    FOREIGN KEY (`ID_PRODUCTO`)
    REFERENCES `loTenemosTodo`.`productos` (`ID_PRODUCTO`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `loTenemosTodo` ;

-- -----------------------------------------------------
-- Placeholder table for view `loTenemosTodo`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `loTenemosTodo`.`view1` (`id` INT);

-- -----------------------------------------------------
-- View `loTenemosTodo`.`view1`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `loTenemosTodo`.`view1` ;
DROP TABLE IF EXISTS `loTenemosTodo`.`view1`;
USE `loTenemosTodo`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
