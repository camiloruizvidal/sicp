﻿# SQL Manager 2011 for MySQL 5.1.0.2
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : sicp


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `sicp`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `sicp`;

#
# Structure for the `tbl_asegurador` table : 
#

CREATE TABLE `tbl_asegurador` (
  `id_asegurador` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_asegurador`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_categoria` table : 
#

CREATE TABLE `tbl_car_categoria` (
  `id_car_categoria` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `orden` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_car_categoria`)
)ENGINE=InnoDB
AUTO_INCREMENT=9 AVG_ROW_LENGTH=2048 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_registro` table : 
#

CREATE TABLE `tbl_car_registro` (
  `id_car_registro` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `value` TEXT COLLATE latin1_swedish_ci,
  `id_ficha` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_car_registro`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_tipo_dato` table : 
#

CREATE TABLE `tbl_car_tipo_dato` (
  `id_tipo_dato` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_dato`)
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=1638 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_variables` table : 
#

CREATE TABLE `tbl_car_variables` (
  `id_car_variables` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `id_car_tipo_dato` INTEGER(11) DEFAULT NULL,
  `list_values` TEXT COLLATE latin1_swedish_ci,
  PRIMARY KEY (`id_car_variables`)
)ENGINE=InnoDB
AUTO_INCREMENT=13 AVG_ROW_LENGTH=1365 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_variablexcategoria` table : 
#

CREATE TABLE `tbl_car_variablexcategoria` (
  `id_car_variablexcategoria` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_car_variables` INTEGER(11) DEFAULT NULL,
  `id_car_categoria` INTEGER(11) DEFAULT NULL,
  `orden` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_car_variablexcategoria`)
)ENGINE=InnoDB
AUTO_INCREMENT=13 AVG_ROW_LENGTH=1365 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_documento_tipo` table : 
#

CREATE TABLE `tbl_documento_tipo` (
  `id_documento_tipo` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `codigo` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_documento_tipo`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_estado_civil` table : 
#

CREATE TABLE `tbl_estado_civil` (
  `id_estado_civil` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_estado_civil`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_nivel_educativo` table : 
#

CREATE TABLE `tbl_nivel_educativo` (
  `id_nivel_educativo` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_nivel_educativo`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_persona` table : 
#

CREATE TABLE `tbl_persona` (
  `id_persona` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_documento_tipo` INTEGER(11) DEFAULT NULL,
  `id_tarjeta_familiar` INTEGER(11) DEFAULT NULL,
  `id_estado_civil` INTEGER(11) DEFAULT NULL,
  `id_asegurador` INTEGER(11) DEFAULT NULL COMMENT 'subsidiado, contributivo, desplazado, etc',
  `id_nivel_educativo` INTEGER(11) DEFAULT NULL,
  `nombre1` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `nombre2` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `apellido1` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `apellido2` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `documento` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `sexo` CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '1=masculino\r\n2=femenino',
  `fecha_nacimiento` DATE DEFAULT NULL,
  `es_cabeza_familia` CHAR(1) COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '0=no\r\n1=si',
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `tbl_persona_idx1` (`es_cabeza_familia`, `id_tarjeta_familiar`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `tbl_tarjeta_familiar` table : 
#

CREATE TABLE `tbl_tarjeta_familiar` (
  `id_tarjeta_familiar` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `fecha_apertura` DATETIME DEFAULT NULL,
  `codigo` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `sisben_ficha` INTEGER(11) DEFAULT NULL,
  `sisben_puntaje` DOUBLE(15,3) DEFAULT NULL,
  `sisben_nivel` INTEGER(11) DEFAULT NULL,
  `direccion` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `id_zona` INTEGER(11) DEFAULT NULL,
  `telefono` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_tarjeta_familiar`),
  UNIQUE KEY `codigo` (`codigo`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Data for the `tbl_car_categoria` table  (LIMIT -491,500)
#

INSERT INTO `tbl_car_categoria` (`id_car_categoria`, `descripcion`, `orden`) VALUES 
  (1,'Salud infantil',1),
  (2,'enfermedades no transmitibles',2),
  (3,'salud mental',3),
  (4,'salud sexual y reproductiva',4),
  (5,'nutricion',5),
  (6,'salud oral',6),
  (7,'riesgos familiares',7),
  (8,'riesgos de medio ambiente',8);
COMMIT;

#
# Data for the `tbl_car_tipo_dato` table  (LIMIT -489,500)
#

INSERT INTO `tbl_car_tipo_dato` (`id_tipo_dato`, `descripcion`) VALUES 
  (1,'Si/No'),
  (2,'Texto corto'),
  (3,'Texto Largo (Enriquecido)'),
  (4,'Lista de valores'),
  (5,'Entero'),
  (6,'Double'),
  (7,'Fecha'),
  (8,'Hora'),
  (9,'Si multiple'),
  (10,'Si otro');
COMMIT;

#
# Data for the `tbl_car_variables` table  (LIMIT -487,500)
#

INSERT INTO `tbl_car_variables` (`id_car_variables`, `descripcion`, `id_car_tipo_dato`, `list_values`) VALUES 
  (1,'con letrina pero alguien no la usa',1,NULL),
  (2,'mala higiene en preparacion de alimentos',1,NULL),
  (3,'areas endemicas de enfermedades de salud publica ',1,NULL),
  (4,'disposicion inadecuada de la basura',1,NULL),
  (5,'no siempre hierven el agua',1,NULL),
  (6,'usan plaguicidas',1,NULL),
  (7,'Perro sin vacunas',1,NULL),
  (8,'accidentes ofidicio',1,NULL),
  (9,'contacminacion del agua',1,NULL),
  (10,'mala disposicion de plaguicidas',1,NULL),
  (11,'convivencia inadecuada con animales',1,NULL),
  (12,'Plagas (Garrapatilla)',1,NULL);
COMMIT;

#
# Data for the `tbl_car_variablexcategoria` table  (LIMIT -487,500)
#

INSERT INTO `tbl_car_variablexcategoria` (`id_car_variablexcategoria`, `id_car_variables`, `id_car_categoria`, `orden`) VALUES 
  (1,1,8,1),
  (2,2,8,2),
  (3,3,8,3),
  (4,4,8,4),
  (5,5,8,5),
  (6,6,8,6),
  (7,7,8,7),
  (8,8,8,8),
  (9,9,8,9),
  (10,10,8,10),
  (11,11,8,11),
  (12,12,8,12);
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;