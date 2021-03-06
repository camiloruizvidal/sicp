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
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_categoria` table : 
#

CREATE TABLE `tbl_car_categoria` (
  `id_car_categoria` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `orden` INTEGER(11) DEFAULT NULL,
  `tipo` ENUM('persona','ficha') NOT NULL DEFAULT 'persona',
  PRIMARY KEY (`id_car_categoria`)
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=1820 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_programas` table : 
#

CREATE TABLE `tbl_car_programas` (
  `id_car_programas` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_car_programas`)
)ENGINE=InnoDB
AUTO_INCREMENT=16 AVG_ROW_LENGTH=1092 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_programas_actividades` table : 
#

CREATE TABLE `tbl_car_programas_actividades` (
  `id_car_programas_actividades` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_car_programa` INTEGER(11) DEFAULT NULL,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_car_programas_actividades`)
)ENGINE=InnoDB
AUTO_INCREMENT=71 AVG_ROW_LENGTH=244 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_programas_actividades_valores` table : 
#

CREATE TABLE `tbl_car_programas_actividades_valores` (
  `id_car_programas_actividades` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_car_programa` INTEGER(11) DEFAULT NULL,
  `rango_inicio` INTEGER(11) DEFAULT NULL,
  `rango_fin` INTEGER(11) DEFAULT NULL,
  `rango_tipo` ENUM('dias','mes','year') DEFAULT NULL,
  `dosis` INTEGER(11) DEFAULT NULL,
  `intervalo` INTEGER(11) DEFAULT NULL,
  `intervalo_tipo` ENUM('dias','semanas','meses','year') DEFAULT NULL,
  `sexo` ENUM('masculino','femenino','ambos') DEFAULT NULL,
  PRIMARY KEY (`id_car_programas_actividades`)
)ENGINE=InnoDB
AUTO_INCREMENT=10 AVG_ROW_LENGTH=2048 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_registro` table : 
#

CREATE TABLE `tbl_car_registro` (
  `id_car_registro` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `value` TEXT COLLATE latin1_swedish_ci,
  `id_persona` INTEGER(11) DEFAULT NULL,
  `id_tarjeta_familiar` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_car_registro`)
)ENGINE=InnoDB
AUTO_INCREMENT=6 AVG_ROW_LENGTH=4096 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_car_tipo_dato` table : 
#

CREATE TABLE `tbl_car_tipo_dato` (
  `id_car_tipo_dato` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_car_tipo_dato`)
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
AUTO_INCREMENT=99 AVG_ROW_LENGTH=186 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
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
AUTO_INCREMENT=98 AVG_ROW_LENGTH=188 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_codigos` table : 
#

CREATE TABLE `tbl_codigos` (
  `id_codigos` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `codigo_inicio` INTEGER(11) NOT NULL,
  `codigo_fin` INTEGER(11) NOT NULL,
  `codigo_next_value` INTEGER(11) DEFAULT 1,
  `id_usuario` INTEGER(11) NOT NULL,
  PRIMARY KEY (`id_codigos`),
  UNIQUE KEY `tbl_codigos_idx2` (`codigo_inicio`, `codigo_fin`),
  UNIQUE KEY `tbl_codigos_idx1` (`codigo_next_value`, `id_usuario`)
)ENGINE=InnoDB
AUTO_INCREMENT=2 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_config` table : 
#

CREATE TABLE `tbl_config` (
  `id_config` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `value` TEXT COLLATE latin1_swedish_ci,
  PRIMARY KEY (`id_config`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_departamentos` table : 
#

CREATE TABLE `tbl_departamentos` (
  `id_departamentos` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_departamentos`)
)ENGINE=InnoDB
AUTO_INCREMENT=33 AVG_ROW_LENGTH=512 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
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
AUTO_INCREMENT=2 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_encuestador` table : 
#

CREATE TABLE `tbl_encuestador` (
  `id_encuestador` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `apellidos` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `documento` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `id_documento` INTEGER(11) DEFAULT NULL,
  `correo` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `telefono` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_encuestador`)
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
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
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_municipios` table : 
#

CREATE TABLE `tbl_municipios` (
  `id_municipio` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_departamento` INTEGER(11) NOT NULL,
  `descripcion` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_municipio`)
)ENGINE=InnoDB
AUTO_INCREMENT=1103 AVG_ROW_LENGTH=74 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_nivel_educativo` table : 
#

CREATE TABLE `tbl_nivel_educativo` (
  `id_nivel_educativo` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_nivel_educativo`)
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_persona` table : 
#

CREATE TABLE `tbl_persona` (
  `id_persona` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_documento_tipo` INTEGER(11) DEFAULT NULL,
  `documento` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `nombre1` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `nombre2` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `apellido1` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `apellido2` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `id_tarjeta_familiar` INTEGER(11) NOT NULL,
  `id_estado_civil` INTEGER(11) DEFAULT NULL,
  `id_asegurador` INTEGER(11) DEFAULT NULL COMMENT 'subsidiado, contributivo, desplazado, etc',
  `id_nivel_educativo` INTEGER(11) DEFAULT NULL,
  `sexo` ENUM('Masculino') NOT NULL DEFAULT 'Masculino',
  `fecha_nacimiento` DATE DEFAULT NULL,
  `id_persona_familiaridad` INTEGER(11) NOT NULL COMMENT '0=no\r\n1=si',
  PRIMARY KEY (`id_persona`)
)ENGINE=InnoDB
AUTO_INCREMENT=19 AVG_ROW_LENGTH=2340 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `tbl_persona_familiaridad` table : 
#

CREATE TABLE `tbl_persona_familiaridad` (
  `id_persona_familiaridad` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `sexo` CHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL COMMENT 'm=masculino\r\nf=femenino\r\n0=neutro',
  PRIMARY KEY (`id_persona_familiaridad`)
)ENGINE=InnoDB
AUTO_INCREMENT=13 AVG_ROW_LENGTH=1365 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_tarjeta_familiar` table : 
#

CREATE TABLE `tbl_tarjeta_familiar` (
  `id_tarjeta_familiar` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `fecha_apertura` DATETIME DEFAULT NULL,
  `codigo` VARCHAR(20) COLLATE utf8_general_ci NOT NULL,
  `sisben_ficha` INTEGER(11) DEFAULT NULL,
  `sisben_puntaje` DOUBLE(15,3) DEFAULT NULL,
  `sisben_nivel` INTEGER(11) DEFAULT NULL,
  `direccion` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `id_zona` INTEGER(11) DEFAULT NULL,
  `telefono` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `id_municipio` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_tarjeta_familiar`),
  UNIQUE KEY `codigo` (`codigo`),
  UNIQUE KEY `codigo_2` (`codigo`)
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `tbl_usuario` table : 
#

CREATE TABLE `tbl_usuario` (
  `id_usuario` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `pass` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `id_perfil_tercero` INTEGER(11) NOT NULL,
  `id_perfil_tipo` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
)ENGINE=InnoDB
AUTO_INCREMENT=2 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_zona` table : 
#

CREATE TABLE `tbl_zona` (
  `id_zona` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_zona`)
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Data for the `tbl_asegurador` table  (LIMIT -497,500)
#

INSERT INTO `tbl_asegurador` (`id_asegurador`, `descripcion`) VALUES 
  (1,'as1'),
  (2,'as2');
COMMIT;

#
# Data for the `tbl_car_categoria` table  (LIMIT -489,500)
#

INSERT INTO `tbl_car_categoria` (`id_car_categoria`, `descripcion`, `orden`, `tipo`) VALUES 
  (1,'Salud infantil',2,'persona'),
  (2,'Enfermedades no transmisibles',3,'persona'),
  (3,'Salud mental',4,'persona'),
  (4,'Salud sexual y reproductiva',5,'persona'),
  (5,'Nutrición',6,'persona'),
  (6,'Salud oral',7,'persona'),
  (7,'Riesgos familiares',8,'persona'),
  (8,'Riesgos de medio ambiente',9,'persona'),
  (9,'Signos vitales',1,'persona'),
  (10,'Riesgos del ambiente',1,'ficha');
COMMIT;

#
# Data for the `tbl_car_programas` table  (LIMIT -484,500)
#

INSERT INTO `tbl_car_programas` (`id_car_programas`, `descripcion`) VALUES 
  (1,'VACUNACIÓN'),
  (2,'CRECIMIENTO Y DESARROLLO'),
  (3,'ALTERACIONES DEL DESARROLLO DEL JOVEN'),
  (4,'PLANIFICACIÓN FAMILIAR A HOMBRES Y MUJERES'),
  (5,'ALTERACIONES AL EMBARAZO'),
  (6,'ATENCION DEL PARTO'),
  (7,'RECIEN NACIDO'),
  (8,'ALTERACIONES DEL ADULTO'),
  (9,'CÁNCER DE CUELLO UTERINO (CITOLOGIAS)'),
  (10,'AGUDEZA  VISUAL'),
  (11,'SALUD ORAL'),
  (12,'CONTROL DE PLACA'),
  (13,'FLUOR'),
  (14,'SELLANTES'),
  (15,'DETRARTAJE');
COMMIT;

#
# Data for the `tbl_car_programas_actividades` table  (LIMIT -429,500)
#

INSERT INTO `tbl_car_programas_actividades` (`id_car_programas_actividades`, `id_car_programa`, `descripcion`) VALUES 
  (1,1,'Vacunación con BCG, HB, VOP'),
  (2,1,'Vacunación con VOP'),
  (3,1,'Vacunación con Pentavalente (DPT, HIB, HB)'),
  (4,1,'Vacunación con DPT'),
  (5,1,'Vacunación con Toxoide diftérico (Td)'),
  (6,1,'Embarazada'),
  (7,1,'Triple viral y fiebre amarilla'),
  (8,1,'Triple viral'),
  (9,2,'Identificación temprana e inscripción'),
  (10,2,'Consulta por Médico General'),
  (11,2,'Consulta de control o seguimiento Menor de 1 año'),
  (12,2,'Consulta de control o seguimiento 1 año'),
  (13,2,'Consulta de control o seguimiento 2 años'),
  (14,2,'Consulta de control o seguimiento De 3 años en adelante'),
  (15,3,'Consulta médico Gnal 1ra vez (inicial, media, tardía, adulto joven)'),
  (16,3,'Hemoglobina'),
  (17,3,'Colesterol HDL'),
  (18,3,'VDRL'),
  (19,3,'VIH/SIDA'),
  (20,3,'Citología'),
  (21,4,'Consulta 1ra vez'),
  (22,4,'Consulta de control o seguimiento según método'),
  (23,4,'Naturales'),
  (24,4,'Amenorrea por lactancia'),
  (25,4,'Hormonales'),
  (26,4,'DIU intervalo'),
  (27,4,'DIU post-parto'),
  (28,4,'DIU post-aborto'),
  (29,4,'E.Q.M Vasectomía (**)'),
  (30,4,'E.Q.M Oclusión tubaria bilateral'),
  (31,5,'Consulta 1vez x médico'),
  (32,5,'Consulta x Odontólogia'),
  (33,5,'Hemograma compl..'),
  (34,5,'Hemoclasificación'),
  (35,5,'VDRL'),
  (36,5,'Uroanálisis compl..'),
  (37,5,'Glicemia pre'),
  (38,5,'Curva Tolerancia Glucosa'),
  (39,5,'Frotis vaginal'),
  (40,5,'Ecografía Obstétrica'),
  (41,5,'Vacunación Td'),
  (42,5,'Suministro de Sulf. Ferroso Acido fólico'),
  (43,5,'Consulta control o seguimiento'),
  (44,6,'Serología VDRL'),
  (45,6,'Hemoclasificación'),
  (46,6,'Atención de parto espontáneo'),
  (47,6,'Consulta del puerperio'),
  (48,8,'Consulta médico Gnal 1ra vez (inicial, media, tardía, adulto joven)'),
  (49,8,'Glicemia pre'),
  (50,8,'Colesterol HDL'),
  (51,8,'Colesterol LDL'),
  (52,8,'Colesterol total'),
  (53,8,'Uruanálisis'),
  (54,8,'Creatinina (*)'),
  (55,8,'Triglicéridos (*)'),
  (56,9,'Citología Cervico-uterina'),
  (57,9,'Normal/satisfactoria'),
  (58,9,'Cambios benignos'),
  (59,9,'Anormal'),
  (60,10,'Toma de agudeza visual'),
  (61,10,'Examen oftalmológico'),
  (62,11,'Control y remoción de placa bacteriana'),
  (63,11,'Aplicación de flúor gel tópico'),
  (64,11,'Aplicado de sellantes en autocurado'),
  (65,11,'Aplicado de sellantes en fotocurado'),
  (66,11,'Detartraje supragingival'),
  (67,12,'control'),
  (68,13,'Aplicacion'),
  (69,14,'Aplicacion'),
  (70,15,'Aplicacion');
COMMIT;

#
# Data for the `tbl_car_programas_actividades_valores` table  (LIMIT -490,500)
#

INSERT INTO `tbl_car_programas_actividades_valores` (`id_car_programas_actividades`, `id_car_programa`, `rango_inicio`, `rango_fin`, `rango_tipo`, `dosis`, `intervalo`, `intervalo_tipo`, `sexo`) VALUES 
  (1,1,0,0,'dias',1,1,'dias','ambos'),
  (2,2,2,2,'mes',5,4,'semanas','ambos'),
  (3,2,4,4,'mes',5,4,'semanas','ambos'),
  (4,2,6,6,'mes',5,4,'semanas','ambos'),
  (5,2,18,18,'mes',5,4,'semanas','ambos'),
  (6,2,5,5,'year',5,4,'semanas','ambos'),
  (7,3,2,2,'mes',4,1,'meses','ambos'),
  (8,3,4,4,'mes',4,1,'meses','ambos'),
  (9,3,6,6,'mes',4,1,'meses','ambos');
COMMIT;

#
# Data for the `tbl_car_registro` table  (LIMIT -494,500)
#

INSERT INTO `tbl_car_registro` (`id_car_registro`, `value`, `id_persona`, `id_tarjeta_familiar`) VALUES 
  (1,'[\n    {\n        \"id\": \"89\",\n        \"value\": \"2\",\n        \"id_tipo_data\": \"4\"\n    },\n    {\n        \"id\": \"90\",\n        \"value\": \"2\",\n        \"id_tipo_data\": \"4\"\n    },\n    {\n        \"id\": \"91\",\n        \"value\": \"[\\n    {\\n        \\\"data 1\\\": {\\n            \\\"option 1\\\": \\\"1\\\",\\n            \\\"option 2\\\": \\\"NO\\\"\\n        }\\n    },\\n    {\\n        \\\"data 2\\\": {\\n            \\\"option 1\\\": \\\"11\\\",\\n            \\\"option 2\\\": \\\"11\\\"\\n        }\\n    },\\n    {\\n        \\\"data 3\\\": {\\n            \\\"option 1\\\": \\\"\\\",\\n            \\\"option 2\\\": \\\"\\\"\\n        }\\n    },\\n    {\\n        \\\"data 4\\\": {\\n            \\\"option 1\\\": \\\"\\\",\\n            \\\"option 2\\\": \\\"\\\"\\n        }\\n    }\\n]\",\n        \"id_tipo_data\": \"9\"\n    },\n    {\n        \"id\": \"92\",\n        \"value\": \"no\",\n        \"id_tipo_data\": \"1\"\n    },\n    {\n        \"id\": \"93\",\n        \"value\": \"no\",\n        \"id_tipo_data\": \"1\"\n    },\n    {\n        \"id\": \"94\",\n        \"value\": \"no\",\n        \"id_tipo_data\": \"1\"\n    },\n    {\n        \"id\": \"95\",\n        \"value\": \"no\",\n        \"id_tipo_data\": \"1\"\n    },\n    {\n        \"id\": \"96\",\n        \"value\": \"no\",\n        \"id_tipo_data\": \"1\"\n    },\n    {\n        \"id\": \"97\",\n        \"value\": \"no\",\n        \"id_tipo_data\": \"1\"\n    },\n    {\n        \"id\": \"98\",\n        \"value\": \"no\",\n        \"id_tipo_data\": \"1\"\n    }\n]',NULL,1),
  (2,'[{\"id\":\"14\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"15\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"16\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"17\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"18\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"19\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"20\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"21\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"22\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"23\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"24\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"25\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"26\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"27\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"28\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"29\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"30\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"31\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"32\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"33\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"34\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"35\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"36\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"37\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"38\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"39\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"40\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"41\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"42\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"43\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"44\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"45\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"46\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"47\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"48\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"49\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"50\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"51\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"52\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"53\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"54\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"55\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"56\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"57\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"58\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"59\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"60\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"61\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"62\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"63\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"64\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"65\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"66\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"67\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"68\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"69\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"70\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"71\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"72\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"73\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"74\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"75\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"76\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"77\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"78\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"79\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"80\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"88\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"82\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"83\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"84\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"85\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"86\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"87\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"81\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"1\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"12\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"11\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"10\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"9\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"8\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"7\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"6\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"5\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"4\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"3\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"2\",\"value\":\"no\",\"id_tipo_data\":\"1\"}]',1,NULL),
  (3,'[{\"id\":\"14\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"15\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"16\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"17\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"18\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"19\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"20\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"21\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"22\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"23\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"24\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"25\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"26\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"27\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"28\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"29\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"30\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"31\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"32\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"33\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"34\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"35\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"36\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"37\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"38\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"39\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"40\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"41\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"42\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"43\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"44\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"45\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"46\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"47\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"48\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"49\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"50\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"51\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"52\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"53\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"54\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"55\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"56\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"57\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"58\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"59\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"60\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"61\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"62\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"63\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"64\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"65\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"66\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"67\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"68\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"69\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"70\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"71\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"72\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"73\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"74\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"75\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"76\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"77\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"78\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"79\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"80\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"88\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"82\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"83\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"84\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"85\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"86\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"87\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"81\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"1\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"12\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"11\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"10\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"9\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"8\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"7\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"6\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"5\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"4\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"3\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"2\",\"value\":\"no\",\"id_tipo_data\":\"1\"}]',0,NULL),
  (4,'[{\"id\":\"14\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"15\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"16\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"17\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"18\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"19\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"20\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"21\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"22\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"23\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"24\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"25\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"26\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"27\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"28\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"29\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"30\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"31\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"32\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"33\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"34\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"35\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"36\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"37\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"38\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"39\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"40\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"41\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"42\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"43\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"44\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"45\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"46\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"47\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"48\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"49\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"50\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"51\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"52\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"53\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"54\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"55\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"56\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"57\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"58\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"59\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"60\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"61\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"62\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"63\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"64\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"65\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"66\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"67\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"68\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"69\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"70\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"71\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"72\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"73\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"74\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"75\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"76\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"77\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"78\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"79\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"80\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"88\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"82\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"83\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"84\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"85\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"86\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"87\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"81\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"1\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"12\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"11\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"10\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"9\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"8\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"7\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"6\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"5\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"4\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"3\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"2\",\"value\":\"no\",\"id_tipo_data\":\"1\"}]',17,NULL),
  (5,'[{\"id\":\"14\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"15\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"16\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"17\",\"value\":\"\",\"id_tipo_data\":\"5\"},{\"id\":\"18\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"19\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"20\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"21\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"22\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"23\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"24\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"25\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"26\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"27\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"28\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"29\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"30\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"31\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"32\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"33\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"34\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"35\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"36\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"37\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"38\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"39\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"40\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"41\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"42\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"43\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"44\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"45\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"46\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"47\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"48\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"49\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"50\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"51\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"52\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"53\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"54\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"55\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"56\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"57\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"58\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"59\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"60\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"61\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"62\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"63\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"64\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"65\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"66\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"67\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"68\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"69\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"70\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"71\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"72\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"73\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"74\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"75\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"76\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"77\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"78\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"79\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"80\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"88\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"82\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"83\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"84\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"85\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"86\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"87\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"81\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"1\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"12\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"11\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"10\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"9\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"8\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"7\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"6\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"5\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"4\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"3\",\"value\":\"no\",\"id_tipo_data\":\"1\"},{\"id\":\"2\",\"value\":\"no\",\"id_tipo_data\":\"1\"}]',18,NULL);
COMMIT;

#
# Data for the `tbl_car_tipo_dato` table  (LIMIT -489,500)
#

INSERT INTO `tbl_car_tipo_dato` (`id_car_tipo_dato`, `descripcion`) VALUES 
  (1,'Si/No'),
  (2,'Texto corto'),
  (3,'Texto Largo (Enriquecido)'),
  (4,'Lista de valores'),
  (5,'Entero'),
  (6,'Double'),
  (7,'Fecha'),
  (8,'Hora'),
  (9,'Si multiple'),
  (10,'Si/No otro');
COMMIT;

#
# Data for the `tbl_car_variables` table  (LIMIT -401,500)
#

INSERT INTO `tbl_car_variables` (`id_car_variables`, `descripcion`, `id_car_tipo_dato`, `list_values`) VALUES 
  (1,'Con letrina pero alguien no la usa',1,NULL),
  (2,'Mala higiene en preparación de alimentos',1,NULL),
  (3,'Áreas endémicas de enfermedades de salud publica',1,NULL),
  (4,'Disposición inadecuada de la basura',1,NULL),
  (5,'No siempre hierve el agua',1,NULL),
  (6,'Usan plaguicidas',1,NULL),
  (7,'Perro sin vacunas',1,NULL),
  (8,'Accidentes ofídico',1,NULL),
  (9,'Contaminación del agua',1,NULL),
  (10,'Mala disposición de plaguicidas',1,NULL),
  (11,'Convivencia inadecuada con animales',1,NULL),
  (12,'Plagas (Garra patilla)',1,NULL),
  (13,'Tiene perros',1,NULL),
  (14,'Tensión arterial sistólica',5,NULL),
  (15,'Tensión arterial diastólica',5,NULL),
  (16,'Frecuencia cardias',5,NULL),
  (17,'Frecuencia respiratoria',5,NULL),
  (18,'Muertes en menores de 1 año',1,NULL),
  (19,'Desnutrición',1,NULL),
  (20,'Animalia congénita',1,NULL),
  (21,'Discapacidad',1,NULL),
  (22,'Embarazo producto de abuso',1,NULL),
  (23,'Recién nacido menor de 28 días',1,NULL),
  (24,'Recién nacido parto domiciliario',1,NULL),
  (25,'Vacunas incompletas',1,NULL),
  (26,'Niños sin C y D',1,NULL),
  (27,'Niño sin evaluación odontológica',1,NULL),
  (28,'Niño menor a 5 años sin estructura AIEPI',1,NULL),
  (29,'Problemas visuales y auditivos',1,NULL),
  (30,'Caries',1,NULL),
  (31,'Deserción escolar',1,NULL),
  (32,'Violación',1,NULL),
  (33,'Violencia sexual',1,NULL),
  (34,'Maltrato infantil',1,NULL),
  (35,'Abandono',1,NULL),
  (36,'HTA',1,NULL),
  (37,'Diabetes',1,NULL),
  (38,'Escasa adherencia tratamiento medico',1,NULL),
  (39,'Compilación de órganos blancos',1,NULL),
  (40,'TBE',1,NULL),
  (41,'Sin marca BCG en el hombro',1,NULL),
  (42,'Enfermedades de la piel',1,NULL),
  (43,'Síntomas respiratorios',1,NULL),
  (44,'Hombre mayor de 50 años con evaluación de próstata',1,NULL),
  (45,'Sin evaluación nutricional',1,NULL),
  (46,'Mujer mayor de 45 años sin perfil epódica',1,NULL),
  (47,'No adscrito al programa adulto mayor',1,NULL),
  (48,'Discapacidad psicomotora',1,NULL),
  (49,'Abandono',1,NULL),
  (50,'Enfermedad mental y trastorno represivo y retardo',1,NULL),
  (51,'Retardo psicosocial',1,NULL),
  (52,'Síntomas de suicidio',1,NULL),
  (53,'Problemas de conducta',1,NULL),
  (54,'Víctima de violencia',1,NULL),
  (55,'Embarazo',1,NULL),
  (56,'Gestante sin PGN',1,NULL),
  (57,'Gestante sin suplemento acido folio y hierro',1,NULL),
  (58,'Gestante sin Psicoprofilaxis',1,NULL),
  (59,'Embarazo producto de abuso sexual',1,NULL),
  (60,'Enfermedad de transmisión sexual',1,NULL),
  (61,'Conducta sexual de riesgo',1,NULL),
  (62,'Sin citología',1,NULL),
  (63,'Desnutrición',1,NULL),
  (64,'Discapacidad psicomotora',1,NULL),
  (65,'Enfermedades gastrointestinales',1,NULL),
  (66,'Enfermedades de la cavidad oral',1,NULL),
  (67,'Tratamientos odontológicos sin terminar',1,NULL),
  (68,'Pacientes desdentados',1,NULL),
  (69,'Sin evaluación odontológica',1,NULL),
  (70,'No higiene oral',1,NULL),
  (71,'Mala higiene o señales de mal cuidado',1,NULL),
  (72,'Rechazo a intercambio educacional',1,NULL),
  (73,'Familia desintegrada o sin red de apoyo',1,NULL),
  (74,'Rechazo a la vacunación',1,NULL),
  (75,'Alcoholismo y otra adicción',1,NULL),
  (76,'Sospecha de violencia o abuso',1,NULL),
  (77,'Violencia o abuso pedofilia no quiere ayuda',1,NULL),
  (78,'Violencia o abuso que la familia quiera',1,NULL),
  (79,'Antecedentes familiares de patologías crónicas',1,NULL),
  (80,'Familia desinteresada por la salud',1,NULL),
  (81,'Escasa adherencia a las actividades de la promoción y prevención',1,NULL),
  (82,'Incesto',1,NULL),
  (83,'Familia en situación de desplazamiento',1,NULL),
  (84,'Conflicto armado',1,NULL),
  (85,'Analfabetismo',1,NULL),
  (86,'No reconocimiento de síntomas de peligro (Diarrea, ira, embarazo)',1,NULL),
  (87,'Cepillos dentales inadecuados',1,NULL),
  (88,'Tienen cepillos dentales pero no los usan',1,NULL),
  (89,'De donde se toma el agua',4,'[ { \"id\": \"1\", \"value\": \"Pozo\" }, { \"id\": \"2\", \"value\": \"Rio\" }, { \"id\": \"2\", \"value\": \"Acueducto\" } ]'),
  (90,'La basura es',4,'[ { \"id\": \"1\", \"value\": \"Quemada\" }, { \"id\": \"2\", \"value\": \"Pozo\" } ]'),
  (91,'Tiene animales',9,'{\"option\":[{\"id\":\"1\",\"name\":\"\\u00bfCuantos?\"},{\"id\":\"2\",\"name\":\"\\u00bfvacunados?\"}],\"data\":[{\"id\":\"1\",\"name\":\"Gatos\"},{\"id\":\"2\",\"name\":\"Perros\"},{\"id\":\"3\",\"name\":\"Equinos\"},{\"id\":\"4\",\"name\":\"Otros\"}]}'),
  (92,'Iluminación adecuada',1,NULL),
  (93,'Ventilación adecuada',1,NULL),
  (94,'Roedores',1,NULL),
  (95,'Reservorios de agua',1,NULL),
  (96,'Anjeos puertas y ventanas',1,NULL),
  (97,'Uso de toldillos',1,NULL),
  (98,'Material predominante en piso, techo, paredes',1,NULL);
COMMIT;

#
# Data for the `tbl_car_variablexcategoria` table  (LIMIT -402,500)
#

INSERT INTO `tbl_car_variablexcategoria` (`id_car_variablexcategoria`, `id_car_variables`, `id_car_categoria`, `orden`) VALUES 
  (1,1,8,1),
  (2,2,8,12),
  (3,3,8,11),
  (4,4,8,10),
  (5,5,8,9),
  (6,6,8,8),
  (7,7,8,7),
  (8,8,8,6),
  (9,9,8,5),
  (10,10,8,4),
  (11,11,8,3),
  (12,12,8,2),
  (13,14,9,1),
  (14,15,9,2),
  (15,16,9,3),
  (16,17,9,4),
  (17,18,1,1),
  (18,19,1,2),
  (19,20,1,3),
  (20,21,1,4),
  (21,22,1,5),
  (22,23,1,6),
  (23,24,1,7),
  (24,25,1,8),
  (25,26,1,9),
  (26,27,1,10),
  (27,28,1,11),
  (28,29,1,12),
  (29,30,1,13),
  (30,31,1,14),
  (31,32,1,15),
  (32,33,1,16),
  (33,34,1,17),
  (34,35,1,18),
  (35,36,2,1),
  (36,37,2,2),
  (37,38,2,3),
  (38,39,2,4),
  (39,40,2,5),
  (40,41,2,6),
  (41,42,2,7),
  (42,43,2,8),
  (43,44,2,9),
  (44,45,2,10),
  (45,46,2,11),
  (46,47,2,12),
  (47,48,2,13),
  (48,49,2,14),
  (49,50,3,1),
  (50,51,3,2),
  (51,52,3,3),
  (52,53,3,4),
  (53,54,3,5),
  (54,55,4,1),
  (55,56,4,2),
  (56,57,4,3),
  (57,58,4,4),
  (58,59,4,5),
  (59,60,4,6),
  (60,61,4,7),
  (61,62,4,8),
  (62,63,5,1),
  (63,64,5,2),
  (64,65,5,3),
  (65,66,6,1),
  (66,67,6,2),
  (67,68,6,3),
  (68,69,6,4),
  (69,70,6,5),
  (70,71,7,1),
  (71,72,7,2),
  (72,73,7,3),
  (73,74,7,4),
  (74,75,7,5),
  (75,76,7,6),
  (76,77,7,7),
  (77,78,7,8),
  (78,79,7,9),
  (79,80,7,10),
  (80,81,7,18),
  (81,82,7,12),
  (82,83,7,13),
  (83,84,7,14),
  (84,85,7,15),
  (85,86,7,16),
  (86,87,7,17),
  (87,88,7,11),
  (88,89,10,1),
  (89,90,10,2),
  (90,91,10,3),
  (91,92,10,4),
  (92,93,10,5),
  (93,94,10,6),
  (94,95,10,7),
  (95,96,10,8),
  (96,97,10,9),
  (97,98,10,10);
COMMIT;

#
# Data for the `tbl_codigos` table  (LIMIT -498,500)
#

INSERT INTO `tbl_codigos` (`id_codigos`, `codigo_inicio`, `codigo_fin`, `codigo_next_value`, `id_usuario`) VALUES 
  (1,1,1000,83,1);
COMMIT;

#
# Data for the `tbl_departamentos` table  (LIMIT -467,500)
#

INSERT INTO `tbl_departamentos` (`id_departamentos`, `descripcion`) VALUES 
  (1,'Amazonas'),
  (2,'Antioquia'),
  (3,'Arauca'),
  (4,'Atlántico'),
  (5,'Bolívar'),
  (6,'Boyacá'),
  (7,'Caldas'),
  (8,'Caquetá'),
  (9,'Casanare'),
  (10,'Cauca'),
  (11,'Cesar'),
  (12,'Chocó'),
  (13,'Córdoba'),
  (14,'Cundinamarca'),
  (15,'Guainía'),
  (16,'Guaviare'),
  (17,'Huila'),
  (18,'Guajira'),
  (19,'Madgalena'),
  (20,'Meta'),
  (21,'Nariño'),
  (22,'Norte de Santander'),
  (23,'Putumayo'),
  (24,'Quindío'),
  (25,'Risaralda'),
  (26,'San Andrés'),
  (27,'Santander'),
  (28,'Sucre'),
  (29,'Tolima'),
  (30,'Valle del Cauca'),
  (31,'Vaupés'),
  (32,'Vichada');
COMMIT;

#
# Data for the `tbl_documento_tipo` table  (LIMIT -498,500)
#

INSERT INTO `tbl_documento_tipo` (`id_documento_tipo`, `descripcion`, `codigo`) VALUES 
  (1,'Cédula','CC');
COMMIT;

#
# Data for the `tbl_encuestador` table  (LIMIT -498,500)
#

INSERT INTO `tbl_encuestador` (`id_encuestador`, `nombres`, `apellidos`, `documento`, `id_documento`, `correo`, `telefono`) VALUES 
  (1,'Camilo Ernesto','Ruiz Vidal','1061716139',1,'camiloruizvidal@gmail.com','3186234042');
COMMIT;

#
# Data for the `tbl_estado_civil` table  (LIMIT -497,500)
#

INSERT INTO `tbl_estado_civil` (`id_estado_civil`, `descripcion`) VALUES 
  (1,'Soltero'),
  (2,'Casado');
COMMIT;

#
# Data for the `tbl_municipios` table  (LIMIT 1,500)
#

INSERT INTO `tbl_municipios` (`id_municipio`, `id_departamento`, `descripcion`) VALUES 
  (1,1,'Leticia'),
  (2,1,'Puerto Nariño'),
  (3,2,'Abejorral'),
  (4,2,'Abriaquí'),
  (5,2,'Alejandria'),
  (6,2,'Amagá'),
  (7,2,'Amalfi'),
  (8,2,'Andes'),
  (9,2,'Angelópolis'),
  (10,2,'Angostura'),
  (11,2,'Anorí'),
  (12,2,'Anzá'),
  (13,2,'Apartadó'),
  (14,2,'Arboletes'),
  (15,2,'Argelia'),
  (16,2,'Armenia'),
  (17,2,'Barbosa'),
  (18,2,'Bello'),
  (19,2,'Belmira'),
  (20,2,'Betania'),
  (21,2,'Betulia'),
  (22,2,'Bolívar'),
  (23,2,'Briceño'),
  (24,2,'Burítica'),
  (25,2,'Caicedo'),
  (26,2,'Caldas'),
  (27,2,'Campamento'),
  (28,2,'Caracolí'),
  (29,2,'Caramanta'),
  (30,2,'Carepa'),
  (31,2,'Carmen de Viboral'),
  (32,2,'Carolina'),
  (33,2,'Caucasia'),
  (34,2,'Cañasgordas'),
  (35,2,'Chigorodó'),
  (36,2,'Cisneros'),
  (37,2,'Cocorná'),
  (38,2,'Concepción'),
  (39,2,'Concordia'),
  (40,2,'Copacabana'),
  (41,2,'Cáceres'),
  (42,2,'Dabeiba'),
  (43,2,'Don Matías'),
  (44,2,'Ebéjico'),
  (45,2,'El Bagre'),
  (46,2,'Entrerríos'),
  (47,2,'Envigado'),
  (48,2,'Fredonia'),
  (49,2,'Frontino'),
  (50,2,'Giraldo'),
  (51,2,'Girardota'),
  (52,2,'Granada'),
  (53,2,'Guadalupe'),
  (54,2,'Guarne'),
  (55,2,'Guatapé'),
  (56,2,'Gómez Plata'),
  (57,2,'Heliconia'),
  (58,2,'Hispania'),
  (59,2,'Itagüí'),
  (60,2,'Ituango'),
  (61,2,'Jardín'),
  (62,2,'Jericó'),
  (63,2,'La Ceja'),
  (64,2,'La Estrella'),
  (65,2,'La Pintada'),
  (66,2,'La Unión'),
  (67,2,'Liborina'),
  (68,2,'Maceo'),
  (69,2,'Marinilla'),
  (70,2,'Medellín'),
  (71,2,'Montebello'),
  (72,2,'Murindó'),
  (73,2,'Mutatá'),
  (74,2,'Nariño'),
  (75,2,'Nechí'),
  (76,2,'Necoclí'),
  (77,2,'Olaya'),
  (78,2,'Peque'),
  (79,2,'Peñol'),
  (80,2,'Pueblorrico'),
  (81,2,'Puerto Berrío'),
  (82,2,'Puerto Nare'),
  (83,2,'Puerto Triunfo'),
  (84,2,'Remedios'),
  (85,2,'Retiro'),
  (86,2,'Ríonegro'),
  (87,2,'Sabanalarga'),
  (88,2,'Sabaneta'),
  (89,2,'Salgar'),
  (90,2,'San Andrés de Cuerquía'),
  (91,2,'San Carlos'),
  (92,2,'San Francisco'),
  (93,2,'San Jerónimo'),
  (94,2,'San José de Montaña'),
  (95,2,'San Juan de Urabá'),
  (96,2,'San Luís'),
  (97,2,'San Pedro'),
  (98,2,'San Pedro de Urabá'),
  (99,2,'San Rafael'),
  (100,2,'San Roque'),
  (101,2,'San Vicente'),
  (102,2,'Santa Bárbara'),
  (103,2,'Santa Fé de Antioquia'),
  (104,2,'Santa Rosa de Osos'),
  (105,2,'Santo Domingo'),
  (106,2,'Santuario'),
  (107,2,'Segovia'),
  (108,2,'Sonsón'),
  (109,2,'Sopetrán'),
  (110,2,'Tarazá'),
  (111,2,'Tarso'),
  (112,2,'Titiribí'),
  (113,2,'Toledo'),
  (114,2,'Turbo'),
  (115,2,'Támesis'),
  (116,2,'Uramita'),
  (117,2,'Urrao'),
  (118,2,'Valdivia'),
  (119,2,'Valparaiso'),
  (120,2,'Vegachí'),
  (121,2,'Venecia'),
  (122,2,'Vigía del Fuerte'),
  (123,2,'Yalí'),
  (124,2,'Yarumal'),
  (125,2,'Yolombó'),
  (126,2,'Yondó (Casabe)'),
  (127,2,'Zaragoza'),
  (128,3,'Arauca'),
  (129,3,'Arauquita'),
  (130,3,'Cravo Norte'),
  (131,3,'Fortúl'),
  (132,3,'Puerto Rondón'),
  (133,3,'Saravena'),
  (134,3,'Tame'),
  (135,4,'Baranoa'),
  (136,4,'Barranquilla'),
  (137,4,'Campo de la Cruz'),
  (138,4,'Candelaria'),
  (139,4,'Galapa'),
  (140,4,'Juan de Acosta'),
  (141,4,'Luruaco'),
  (142,4,'Malambo'),
  (143,4,'Manatí'),
  (144,4,'Palmar de Varela'),
  (145,4,'Piojo'),
  (146,4,'Polonuevo'),
  (147,4,'Ponedera'),
  (148,4,'Puerto Colombia'),
  (149,4,'Repelón'),
  (150,4,'Sabanagrande'),
  (151,4,'Sabanalarga'),
  (152,4,'Santa Lucía'),
  (153,4,'Santo Tomás'),
  (154,4,'Soledad'),
  (155,4,'Suan'),
  (156,4,'Tubará'),
  (157,4,'Usiacuri'),
  (158,5,'Achí'),
  (159,5,'Altos del Rosario'),
  (160,5,'Arenal'),
  (161,5,'Arjona'),
  (162,5,'Arroyohondo'),
  (163,5,'Barranco de Loba'),
  (164,5,'Calamar'),
  (165,5,'Cantagallo'),
  (166,5,'Cartagena'),
  (167,5,'Cicuco'),
  (168,5,'Clemencia'),
  (169,5,'Córdoba'),
  (170,5,'El Carmen de Bolívar'),
  (171,5,'El Guamo'),
  (172,5,'El Peñon'),
  (173,5,'Hatillo de Loba'),
  (174,5,'Magangué'),
  (175,5,'Mahates'),
  (176,5,'Margarita'),
  (177,5,'María la Baja'),
  (178,5,'Mompós'),
  (179,5,'Montecristo'),
  (180,5,'Morales'),
  (181,5,'Norosí'),
  (182,5,'Pinillos'),
  (183,5,'Regidor'),
  (184,5,'Río Viejo'),
  (185,5,'San Cristobal'),
  (186,5,'San Estanislao'),
  (187,5,'San Fernando'),
  (188,5,'San Jacinto'),
  (189,5,'San Jacinto del Cauca'),
  (190,5,'San Juan de Nepomuceno'),
  (191,5,'San Martín de Loba'),
  (192,5,'San Pablo'),
  (193,5,'Santa Catalina'),
  (194,5,'Santa Rosa '),
  (195,5,'Santa Rosa del Sur'),
  (196,5,'Simití'),
  (197,5,'Soplaviento'),
  (198,5,'Talaigua Nuevo'),
  (199,5,'Tiquisio (Puerto Rico)'),
  (200,5,'Turbaco'),
  (201,5,'Turbaná'),
  (202,5,'Villanueva'),
  (203,5,'Zambrano'),
  (204,6,'Almeida'),
  (205,6,'Aquitania'),
  (206,6,'Arcabuco'),
  (207,6,'Belén'),
  (208,6,'Berbeo'),
  (209,6,'Beteitiva'),
  (210,6,'Boavita'),
  (211,6,'Boyacá'),
  (212,6,'Briceño'),
  (213,6,'Buenavista'),
  (214,6,'Busbanza'),
  (215,6,'Caldas'),
  (216,6,'Campohermoso'),
  (217,6,'Cerinza'),
  (218,6,'Chinavita'),
  (219,6,'Chiquinquirá'),
  (220,6,'Chiscas'),
  (221,6,'Chita'),
  (222,6,'Chitaraque'),
  (223,6,'Chivatá'),
  (224,6,'Chíquiza'),
  (225,6,'Chívor'),
  (226,6,'Ciénaga'),
  (227,6,'Coper'),
  (228,6,'Corrales'),
  (229,6,'Covarachía'),
  (230,6,'Cubará'),
  (231,6,'Cucaita'),
  (232,6,'Cuitiva'),
  (233,6,'Cómbita'),
  (234,6,'Duitama'),
  (235,6,'El Cocuy'),
  (236,6,'El Espino'),
  (237,6,'Firavitoba'),
  (238,6,'Floresta'),
  (239,6,'Gachantivá'),
  (240,6,'Garagoa'),
  (241,6,'Guacamayas'),
  (242,6,'Guateque'),
  (243,6,'Guayatá'),
  (244,6,'Guicán'),
  (245,6,'Gámeza'),
  (246,6,'Izá'),
  (247,6,'Jenesano'),
  (248,6,'Jericó'),
  (249,6,'La Capilla'),
  (250,6,'La Uvita'),
  (251,6,'La Victoria'),
  (252,6,'Labranzagrande'),
  (253,6,'Macanal'),
  (254,6,'Maripí'),
  (255,6,'Miraflores'),
  (256,6,'Mongua'),
  (257,6,'Monguí'),
  (258,6,'Moniquirá'),
  (259,6,'Motavita'),
  (260,6,'Muzo'),
  (261,6,'Nobsa'),
  (262,6,'Nuevo Colón'),
  (263,6,'Oicatá'),
  (264,6,'Otanche'),
  (265,6,'Pachavita'),
  (266,6,'Paipa'),
  (267,6,'Pajarito'),
  (268,6,'Panqueba'),
  (269,6,'Pauna'),
  (270,6,'Paya'),
  (271,6,'Paz de Río'),
  (272,6,'Pesca'),
  (273,6,'Pisva'),
  (274,6,'Puerto Boyacá'),
  (275,6,'Páez'),
  (276,6,'Quipama'),
  (277,6,'Ramiriquí'),
  (278,6,'Rondón'),
  (279,6,'Ráquira'),
  (280,6,'Saboyá'),
  (281,6,'Samacá'),
  (282,6,'San Eduardo'),
  (283,6,'San José de Pare'),
  (284,6,'San Luís de Gaceno'),
  (285,6,'San Mateo'),
  (286,6,'San Miguel de Sema'),
  (287,6,'San Pablo de Borbur'),
  (288,6,'Santa María'),
  (289,6,'Santa Rosa de Viterbo'),
  (290,6,'Santa Sofía'),
  (291,6,'Santana'),
  (292,6,'Sativanorte'),
  (293,6,'Sativasur'),
  (294,6,'Siachoque'),
  (295,6,'Soatá'),
  (296,6,'Socha'),
  (297,6,'Socotá'),
  (298,6,'Sogamoso'),
  (299,6,'Somondoco'),
  (300,6,'Sora'),
  (301,6,'Soracá'),
  (302,6,'Sotaquirá'),
  (303,6,'Susacón'),
  (304,6,'Sutamarchán'),
  (305,6,'Sutatenza'),
  (306,6,'Sáchica'),
  (307,6,'Tasco'),
  (308,6,'Tenza'),
  (309,6,'Tibaná'),
  (310,6,'Tibasosa'),
  (311,6,'Tinjacá'),
  (312,6,'Tipacoque'),
  (313,6,'Toca'),
  (314,6,'Toguí'),
  (315,6,'Topagá'),
  (316,6,'Tota'),
  (317,6,'Tunja'),
  (318,6,'Tunungua'),
  (319,6,'Turmequé'),
  (320,6,'Tuta'),
  (321,6,'Tutasá'),
  (322,6,'Ventaquemada'),
  (323,6,'Villa de Leiva'),
  (324,6,'Viracachá'),
  (325,6,'Zetaquirá'),
  (326,6,'Úmbita'),
  (327,7,'Aguadas'),
  (328,7,'Anserma'),
  (329,7,'Aranzazu'),
  (330,7,'Belalcázar'),
  (331,7,'Chinchiná'),
  (332,7,'Filadelfia'),
  (333,7,'La Dorada'),
  (334,7,'La Merced'),
  (335,7,'La Victoria'),
  (336,7,'Manizales'),
  (337,7,'Manzanares'),
  (338,7,'Marmato'),
  (339,7,'Marquetalia'),
  (340,7,'Marulanda'),
  (341,7,'Neira'),
  (342,7,'Norcasia'),
  (343,7,'Palestina'),
  (344,7,'Pensilvania'),
  (345,7,'Pácora'),
  (346,7,'Risaralda'),
  (347,7,'Río Sucio'),
  (348,7,'Salamina'),
  (349,7,'Samaná'),
  (350,7,'San José'),
  (351,7,'Supía'),
  (352,7,'Villamaría'),
  (353,7,'Viterbo'),
  (354,8,'Albania'),
  (355,8,'Belén de los Andaquíes'),
  (356,8,'Cartagena del Chairá'),
  (357,8,'Curillo'),
  (358,8,'El Doncello'),
  (359,8,'El Paujil'),
  (360,8,'Florencia'),
  (361,8,'La Montañita'),
  (362,8,'Milán'),
  (363,8,'Morelia'),
  (364,8,'Puerto Rico'),
  (365,8,'San José del Fragua'),
  (366,8,'San Vicente del Caguán'),
  (367,8,'Solano'),
  (368,8,'Solita'),
  (369,8,'Valparaiso'),
  (370,9,'Aguazul'),
  (371,9,'Chámeza'),
  (372,9,'Hato Corozal'),
  (373,9,'La Salina'),
  (374,9,'Maní'),
  (375,9,'Monterrey'),
  (376,9,'Nunchía'),
  (377,9,'Orocué'),
  (378,9,'Paz de Ariporo'),
  (379,9,'Pore'),
  (380,9,'Recetor'),
  (381,9,'Sabanalarga'),
  (382,9,'San Luís de Palenque'),
  (383,9,'Sácama'),
  (384,9,'Tauramena'),
  (385,9,'Trinidad'),
  (386,9,'Támara'),
  (387,9,'Villanueva'),
  (388,9,'Yopal'),
  (389,10,'Almaguer'),
  (390,10,'Argelia'),
  (391,10,'Balboa'),
  (392,10,'Bolívar'),
  (393,10,'Buenos Aires'),
  (394,10,'Cajibío'),
  (395,10,'Caldono'),
  (396,10,'Caloto'),
  (397,10,'Corinto'),
  (398,10,'El Tambo'),
  (399,10,'Florencia'),
  (400,10,'Guachené'),
  (401,10,'Guapí'),
  (402,10,'Inzá'),
  (403,10,'Jambaló'),
  (404,10,'La Sierra'),
  (405,10,'La Vega'),
  (406,10,'López (Micay)'),
  (407,10,'Mercaderes'),
  (408,10,'Miranda'),
  (409,10,'Morales'),
  (410,10,'Padilla'),
  (411,10,'Patía (El Bordo)'),
  (412,10,'Piamonte'),
  (413,10,'Piendamó'),
  (414,10,'Popayán'),
  (415,10,'Puerto Tejada'),
  (416,10,'Puracé (Coconuco)'),
  (417,10,'Páez (Belalcazar)'),
  (418,10,'Rosas'),
  (419,10,'San Sebastián'),
  (420,10,'Santa Rosa'),
  (421,10,'Santander de Quilichao'),
  (422,10,'Silvia'),
  (423,10,'Sotara (Paispamba)'),
  (424,10,'Sucre'),
  (425,10,'Suárez'),
  (426,10,'Timbiquí'),
  (427,10,'Timbío'),
  (428,10,'Toribío'),
  (429,10,'Totoró'),
  (430,10,'Villa Rica'),
  (431,11,'Aguachica'),
  (432,11,'Agustín Codazzi'),
  (433,11,'Astrea'),
  (434,11,'Becerríl'),
  (435,11,'Bosconia'),
  (436,11,'Chimichagua'),
  (437,11,'Chiriguaná'),
  (438,11,'Curumaní'),
  (439,11,'El Copey'),
  (440,11,'El Paso'),
  (441,11,'Gamarra'),
  (442,11,'Gonzalez'),
  (443,11,'La Gloria'),
  (444,11,'La Jagua de Ibirico'),
  (445,11,'La Paz (Robles)'),
  (446,11,'Manaure Balcón del Cesar'),
  (447,11,'Pailitas'),
  (448,11,'Pelaya'),
  (449,11,'Pueblo Bello'),
  (450,11,'Río de oro'),
  (451,11,'San Alberto'),
  (452,11,'San Diego'),
  (453,11,'San Martín'),
  (454,11,'Tamalameque'),
  (455,11,'Valledupar'),
  (456,12,'Acandí'),
  (457,12,'Alto Baudó (Pie de Pato)'),
  (458,12,'Atrato (Yuto)'),
  (459,12,'Bagadó'),
  (460,12,'Bahía Solano (Mútis)'),
  (461,12,'Bajo Baudó (Pizarro)'),
  (462,12,'Belén de Bajirá'),
  (463,12,'Bojayá (Bellavista)'),
  (464,12,'Cantón de San Pablo'),
  (465,12,'Carmen del Darién (CURBARADÓ)'),
  (466,12,'Condoto'),
  (467,12,'Cértegui'),
  (468,12,'El Carmen de Atrato'),
  (469,12,'Istmina'),
  (470,12,'Juradó'),
  (471,12,'Lloró'),
  (472,12,'Medio Atrato'),
  (473,12,'Medio Baudó'),
  (474,12,'Medio San Juan (ANDAGOYA)'),
  (475,12,'Novita'),
  (476,12,'Nuquí'),
  (477,12,'Quibdó'),
  (478,12,'Río Iró'),
  (479,12,'Río Quito'),
  (480,12,'Ríosucio'),
  (481,12,'San José del Palmar'),
  (482,12,'Santa Genoveva de Docorodó'),
  (483,12,'Sipí'),
  (484,12,'Tadó'),
  (485,12,'Unguía'),
  (486,12,'Unión Panamericana (ÁNIMAS)'),
  (487,13,'Ayapel'),
  (488,13,'Buenavista'),
  (489,13,'Canalete'),
  (490,13,'Cereté'),
  (491,13,'Chimá'),
  (492,13,'Chinú'),
  (493,13,'Ciénaga de Oro'),
  (494,13,'Cotorra'),
  (495,13,'La Apartada y La Frontera'),
  (496,13,'Lorica'),
  (497,13,'Los Córdobas'),
  (498,13,'Momil'),
  (499,13,'Montelíbano'),
  (500,13,'Monteria');
COMMIT;

#
# Data for the `tbl_municipios` table  (LIMIT 501,500)
#

INSERT INTO `tbl_municipios` (`id_municipio`, `id_departamento`, `descripcion`) VALUES 
  (501,13,'Moñitos'),
  (502,13,'Planeta Rica'),
  (503,13,'Pueblo Nuevo'),
  (504,13,'Puerto Escondido'),
  (505,13,'Puerto Libertador'),
  (506,13,'Purísima'),
  (507,13,'Sahagún'),
  (508,13,'San Andrés Sotavento'),
  (509,13,'San Antero'),
  (510,13,'San Bernardo del Viento'),
  (511,13,'San Carlos'),
  (512,13,'San José de Uré'),
  (513,13,'San Pelayo'),
  (514,13,'Tierralta'),
  (515,13,'Tuchín'),
  (516,13,'Valencia'),
  (517,14,'Agua de Dios'),
  (518,14,'Albán'),
  (519,14,'Anapoima'),
  (520,14,'Anolaima'),
  (521,14,'Apulo'),
  (522,14,'Arbeláez'),
  (523,14,'Beltrán'),
  (524,14,'Bituima'),
  (525,14,'Bogotá D.C.'),
  (526,14,'Bojacá'),
  (527,14,'Cabrera'),
  (528,14,'Cachipay'),
  (529,14,'Cajicá'),
  (530,14,'Caparrapí'),
  (531,14,'Carmen de Carupa'),
  (532,14,'Chaguaní'),
  (533,14,'Chipaque'),
  (534,14,'Choachí'),
  (535,14,'Chocontá'),
  (536,14,'Chía'),
  (537,14,'Cogua'),
  (538,14,'Cota'),
  (539,14,'Cucunubá'),
  (540,14,'Cáqueza'),
  (541,14,'El Colegio'),
  (542,14,'El Peñón'),
  (543,14,'El Rosal'),
  (544,14,'Facatativá'),
  (545,14,'Fosca'),
  (546,14,'Funza'),
  (547,14,'Fusagasugá'),
  (548,14,'Fómeque'),
  (549,14,'Fúquene'),
  (550,14,'Gachalá'),
  (551,14,'Gachancipá'),
  (552,14,'Gachetá'),
  (553,14,'Gama'),
  (554,14,'Girardot'),
  (555,14,'Granada'),
  (556,14,'Guachetá'),
  (557,14,'Guaduas'),
  (558,14,'Guasca'),
  (559,14,'Guataquí'),
  (560,14,'Guatavita'),
  (561,14,'Guayabal de Siquima'),
  (562,14,'Guayabetal'),
  (563,14,'Gutiérrez'),
  (564,14,'Jerusalén'),
  (565,14,'Junín'),
  (566,14,'La Calera'),
  (567,14,'La Mesa'),
  (568,14,'La Palma'),
  (569,14,'La Peña'),
  (570,14,'La Vega'),
  (571,14,'Lenguazaque'),
  (572,14,'Machetá'),
  (573,14,'Madrid'),
  (574,14,'Manta'),
  (575,14,'Medina'),
  (576,14,'Mosquera'),
  (577,14,'Nariño'),
  (578,14,'Nemocón'),
  (579,14,'Nilo'),
  (580,14,'Nimaima'),
  (581,14,'Nocaima'),
  (582,14,'Pacho'),
  (583,14,'Paime'),
  (584,14,'Pandi'),
  (585,14,'Paratebueno'),
  (586,14,'Pasca'),
  (587,14,'Puerto Salgar'),
  (588,14,'Pulí'),
  (589,14,'Quebradanegra'),
  (590,14,'Quetame'),
  (591,14,'Quipile'),
  (592,14,'Ricaurte'),
  (593,14,'San Antonio de Tequendama'),
  (594,14,'San Bernardo'),
  (595,14,'San Cayetano'),
  (596,14,'San Francisco'),
  (597,14,'San Juan de Río Seco'),
  (598,14,'Sasaima'),
  (599,14,'Sesquilé'),
  (600,14,'Sibaté'),
  (601,14,'Silvania'),
  (602,14,'Simijaca'),
  (603,14,'Soacha'),
  (604,14,'Sopó'),
  (605,14,'Subachoque'),
  (606,14,'Suesca'),
  (607,14,'Supatá'),
  (608,14,'Susa'),
  (609,14,'Sutatausa'),
  (610,14,'Tabio'),
  (611,14,'Tausa'),
  (612,14,'Tena'),
  (613,14,'Tenjo'),
  (614,14,'Tibacuy'),
  (615,14,'Tibirita'),
  (616,14,'Tocaima'),
  (617,14,'Tocancipá'),
  (618,14,'Topaipí'),
  (619,14,'Ubalá'),
  (620,14,'Ubaque'),
  (621,14,'Ubaté'),
  (622,14,'Une'),
  (623,14,'Venecia (Ospina Pérez)'),
  (624,14,'Vergara'),
  (625,14,'Viani'),
  (626,14,'Villagómez'),
  (627,14,'Villapinzón'),
  (628,14,'Villeta'),
  (629,14,'Viotá'),
  (630,14,'Yacopí'),
  (631,14,'Zipacón'),
  (632,14,'Zipaquirá'),
  (633,14,'Útica'),
  (634,15,'Inírida'),
  (635,16,'Calamar'),
  (636,16,'El Retorno'),
  (637,16,'Miraflores'),
  (638,16,'San José del Guaviare'),
  (639,17,'Acevedo'),
  (640,17,'Agrado'),
  (641,17,'Aipe'),
  (642,17,'Algeciras'),
  (643,17,'Altamira'),
  (644,17,'Baraya'),
  (645,17,'Campoalegre'),
  (646,17,'Colombia'),
  (647,17,'Elías'),
  (648,17,'Garzón'),
  (649,17,'Gigante'),
  (650,17,'Guadalupe'),
  (651,17,'Hobo'),
  (652,17,'Isnos'),
  (653,17,'La Argentina'),
  (654,17,'La Plata'),
  (655,17,'Neiva'),
  (656,17,'Nátaga'),
  (657,17,'Oporapa'),
  (658,17,'Paicol'),
  (659,17,'Palermo'),
  (660,17,'Palestina'),
  (661,17,'Pital'),
  (662,17,'Pitalito'),
  (663,17,'Rivera'),
  (664,17,'Saladoblanco'),
  (665,17,'San Agustín'),
  (666,17,'Santa María'),
  (667,17,'Suaza'),
  (668,17,'Tarqui'),
  (669,17,'Tello'),
  (670,17,'Teruel'),
  (671,17,'Tesalia'),
  (672,17,'Timaná'),
  (673,17,'Villavieja'),
  (674,17,'Yaguará'),
  (675,17,'Íquira'),
  (676,18,'Albania'),
  (677,18,'Barrancas'),
  (678,18,'Dibulla'),
  (679,18,'Distracción'),
  (680,18,'El Molino'),
  (681,18,'Fonseca'),
  (682,18,'Hatonuevo'),
  (683,18,'La Jagua del Pilar'),
  (684,18,'Maicao'),
  (685,18,'Manaure'),
  (686,18,'Riohacha'),
  (687,18,'San Juan del Cesar'),
  (688,18,'Uribia'),
  (689,18,'Urumita'),
  (690,18,'Villanueva'),
  (691,19,'Algarrobo'),
  (692,19,'Aracataca'),
  (693,19,'Ariguaní (El Difícil)'),
  (694,19,'Cerro San Antonio'),
  (695,19,'Chivolo'),
  (696,19,'Ciénaga'),
  (697,19,'Concordia'),
  (698,19,'El Banco'),
  (699,19,'El Piñon'),
  (700,19,'El Retén'),
  (701,19,'Fundación'),
  (702,19,'Guamal'),
  (703,19,'Nueva Granada'),
  (704,19,'Pedraza'),
  (705,19,'Pijiño'),
  (706,19,'Pivijay'),
  (707,19,'Plato'),
  (708,19,'Puebloviejo'),
  (709,19,'Remolino'),
  (710,19,'Sabanas de San Angel (SAN ANGEL)'),
  (711,19,'Salamina'),
  (712,19,'San Sebastián de Buenavista'),
  (713,19,'San Zenón'),
  (714,19,'Santa Ana'),
  (715,19,'Santa Bárbara de Pinto'),
  (716,19,'Santa Marta'),
  (717,19,'Sitionuevo'),
  (718,19,'Tenerife'),
  (719,19,'Zapayán (PUNTA DE PIEDRAS)'),
  (720,19,'Zona Bananera (PRADO - SEVILLA)'),
  (721,20,'Acacías'),
  (722,20,'Barranca de Upía'),
  (723,20,'Cabuyaro'),
  (724,20,'Castilla la Nueva'),
  (725,20,'Cubarral'),
  (726,20,'Cumaral'),
  (727,20,'El Calvario'),
  (728,20,'El Castillo'),
  (729,20,'El Dorado'),
  (730,20,'Fuente de Oro'),
  (731,20,'Granada'),
  (732,20,'Guamal'),
  (733,20,'La Macarena'),
  (734,20,'Lejanías'),
  (735,20,'Mapiripan'),
  (736,20,'Mesetas'),
  (737,20,'Puerto Concordia'),
  (738,20,'Puerto Gaitán'),
  (739,20,'Puerto Lleras'),
  (740,20,'Puerto López'),
  (741,20,'Puerto Rico'),
  (742,20,'Restrepo'),
  (743,20,'San Carlos de Guaroa'),
  (744,20,'San Juan de Arama'),
  (745,20,'San Juanito'),
  (746,20,'San Martín'),
  (747,20,'Uribe'),
  (748,20,'Villavicencio'),
  (749,20,'Vista Hermosa'),
  (750,21,'Albán (San José)'),
  (751,21,'Aldana'),
  (752,21,'Ancuya'),
  (753,21,'Arboleda (Berruecos)'),
  (754,21,'Barbacoas'),
  (755,21,'Belén'),
  (756,21,'Buesaco'),
  (757,21,'Chachaguí'),
  (758,21,'Colón (Génova)'),
  (759,21,'Consaca'),
  (760,21,'Contadero'),
  (761,21,'Cuaspud (Carlosama)'),
  (762,21,'Cumbal'),
  (763,21,'Cumbitara'),
  (764,21,'Córdoba'),
  (765,21,'El Charco'),
  (766,21,'El Peñol'),
  (767,21,'El Rosario'),
  (768,21,'El Tablón de Gómez'),
  (769,21,'El Tambo'),
  (770,21,'Francisco Pizarro'),
  (771,21,'Funes'),
  (772,21,'Guachavés'),
  (773,21,'Guachucal'),
  (774,21,'Guaitarilla'),
  (775,21,'Gualmatán'),
  (776,21,'Iles'),
  (777,21,'Imúes'),
  (778,21,'Ipiales'),
  (779,21,'La Cruz'),
  (780,21,'La Florida'),
  (781,21,'La Llanada'),
  (782,21,'La Tola'),
  (783,21,'La Unión'),
  (784,21,'Leiva'),
  (785,21,'Linares'),
  (786,21,'Magüi (Payán)'),
  (787,21,'Mallama (Piedrancha)'),
  (788,21,'Mosquera'),
  (789,21,'Nariño'),
  (790,21,'Olaya Herrera'),
  (791,21,'Ospina'),
  (792,21,'Policarpa'),
  (793,21,'Potosí'),
  (794,21,'Providencia'),
  (795,21,'Puerres'),
  (796,21,'Pupiales'),
  (797,21,'Ricaurte'),
  (798,21,'Roberto Payán (San José)'),
  (799,21,'Samaniego'),
  (800,21,'San Bernardo'),
  (801,21,'San Juan de Pasto'),
  (802,21,'San Lorenzo'),
  (803,21,'San Pablo'),
  (804,21,'San Pedro de Cartago'),
  (805,21,'Sandoná'),
  (806,21,'Santa Bárbara (Iscuandé)'),
  (807,21,'Sapuyes'),
  (808,21,'Sotomayor (Los Andes)'),
  (809,21,'Taminango'),
  (810,21,'Tangua'),
  (811,21,'Tumaco'),
  (812,21,'Túquerres'),
  (813,21,'Yacuanquer'),
  (814,22,'Arboledas'),
  (815,22,'Bochalema'),
  (816,22,'Bucarasica'),
  (817,22,'Chinácota'),
  (818,22,'Chitagá'),
  (819,22,'Convención'),
  (820,22,'Cucutilla'),
  (821,22,'Cáchira'),
  (822,22,'Cácota'),
  (823,22,'Cúcuta'),
  (824,22,'Durania'),
  (825,22,'El Carmen'),
  (826,22,'El Tarra'),
  (827,22,'El Zulia'),
  (828,22,'Gramalote'),
  (829,22,'Hacarí'),
  (830,22,'Herrán'),
  (831,22,'La Esperanza'),
  (832,22,'La Playa'),
  (833,22,'Labateca'),
  (834,22,'Los Patios'),
  (835,22,'Lourdes'),
  (836,22,'Mutiscua'),
  (837,22,'Ocaña'),
  (838,22,'Pamplona'),
  (839,22,'Pamplonita'),
  (840,22,'Puerto Santander'),
  (841,22,'Ragonvalia'),
  (842,22,'Salazar'),
  (843,22,'San Calixto'),
  (844,22,'San Cayetano'),
  (845,22,'Santiago'),
  (846,22,'Sardinata'),
  (847,22,'Silos'),
  (848,22,'Teorama'),
  (849,22,'Tibú'),
  (850,22,'Toledo'),
  (851,22,'Villa Caro'),
  (852,22,'Villa del Rosario'),
  (853,22,'Ábrego'),
  (854,23,'Colón'),
  (855,23,'Mocoa'),
  (856,23,'Orito'),
  (857,23,'Puerto Asís'),
  (858,23,'Puerto Caicedo'),
  (859,23,'Puerto Guzmán'),
  (860,23,'Puerto Leguízamo'),
  (861,23,'San Francisco'),
  (862,23,'San Miguel'),
  (863,23,'Santiago'),
  (864,23,'Sibundoy'),
  (865,23,'Valle del Guamuez'),
  (866,23,'Villagarzón'),
  (867,24,'Armenia'),
  (868,24,'Buenavista'),
  (869,24,'Calarcá'),
  (870,24,'Circasia'),
  (871,24,'Cordobá'),
  (872,24,'Filandia'),
  (873,24,'Génova'),
  (874,24,'La Tebaida'),
  (875,24,'Montenegro'),
  (876,24,'Pijao'),
  (877,24,'Quimbaya'),
  (878,24,'Salento'),
  (879,25,'Apía'),
  (880,25,'Balboa'),
  (881,25,'Belén de Umbría'),
  (882,25,'Dos Quebradas'),
  (883,25,'Guática'),
  (884,25,'La Celia'),
  (885,25,'La Virginia'),
  (886,25,'Marsella'),
  (887,25,'Mistrató'),
  (888,25,'Pereira'),
  (889,25,'Pueblo Rico'),
  (890,25,'Quinchía'),
  (891,25,'Santa Rosa de Cabal'),
  (892,25,'Santuario'),
  (893,26,'Providencia'),
  (894,27,'Aguada'),
  (895,27,'Albania'),
  (896,27,'Aratoca'),
  (897,27,'Barbosa'),
  (898,27,'Barichara'),
  (899,27,'Barrancabermeja'),
  (900,27,'Betulia'),
  (901,27,'Bolívar'),
  (902,27,'Bucaramanga'),
  (903,27,'Cabrera'),
  (904,27,'California'),
  (905,27,'Capitanejo'),
  (906,27,'Carcasí'),
  (907,27,'Cepita'),
  (908,27,'Cerrito'),
  (909,27,'Charalá'),
  (910,27,'Charta'),
  (911,27,'Chima'),
  (912,27,'Chipatá'),
  (913,27,'Cimitarra'),
  (914,27,'Concepción'),
  (915,27,'Confines'),
  (916,27,'Contratación'),
  (917,27,'Coromoro'),
  (918,27,'Curití'),
  (919,27,'El Carmen'),
  (920,27,'El Guacamayo'),
  (921,27,'El Peñon'),
  (922,27,'El Playón'),
  (923,27,'Encino'),
  (924,27,'Enciso'),
  (925,27,'Floridablanca'),
  (926,27,'Florián'),
  (927,27,'Galán'),
  (928,27,'Girón'),
  (929,27,'Guaca'),
  (930,27,'Guadalupe'),
  (931,27,'Guapota'),
  (932,27,'Guavatá'),
  (933,27,'Guepsa'),
  (934,27,'Gámbita'),
  (935,27,'Hato'),
  (936,27,'Jesús María'),
  (937,27,'Jordán'),
  (938,27,'La Belleza'),
  (939,27,'La Paz'),
  (940,27,'Landázuri'),
  (941,27,'Lebrija'),
  (942,27,'Los Santos'),
  (943,27,'Macaravita'),
  (944,27,'Matanza'),
  (945,27,'Mogotes'),
  (946,27,'Molagavita'),
  (947,27,'Málaga'),
  (948,27,'Ocamonte'),
  (949,27,'Oiba'),
  (950,27,'Onzaga'),
  (951,27,'Palmar'),
  (952,27,'Palmas del Socorro'),
  (953,27,'Pie de Cuesta'),
  (954,27,'Pinchote'),
  (955,27,'Puente Nacional'),
  (956,27,'Puerto Parra'),
  (957,27,'Puerto Wilches'),
  (958,27,'Páramo'),
  (959,27,'Rio Negro'),
  (960,27,'Sabana de Torres'),
  (961,27,'San Andrés'),
  (962,27,'San Benito'),
  (963,27,'San Gíl'),
  (964,27,'San Joaquín'),
  (965,27,'San José de Miranda'),
  (966,27,'San Miguel'),
  (967,27,'San Vicente del Chucurí'),
  (968,27,'Santa Bárbara'),
  (969,27,'Santa Helena del Opón'),
  (970,27,'Simacota'),
  (971,27,'Socorro'),
  (972,27,'Suaita'),
  (973,27,'Sucre'),
  (974,27,'Suratá'),
  (975,27,'Tona'),
  (976,27,'Valle de San José'),
  (977,27,'Vetas'),
  (978,27,'Villanueva'),
  (979,27,'Vélez'),
  (980,27,'Zapatoca'),
  (981,28,'Buenavista'),
  (982,28,'Caimito'),
  (983,28,'Chalán'),
  (984,28,'Colosó (Ricaurte)'),
  (985,28,'Corozal'),
  (986,28,'Coveñas'),
  (987,28,'El Roble'),
  (988,28,'Galeras (Nueva Granada)'),
  (989,28,'Guaranda'),
  (990,28,'La Unión'),
  (991,28,'Los Palmitos'),
  (992,28,'Majagual'),
  (993,28,'Morroa'),
  (994,28,'Ovejas'),
  (995,28,'Palmito'),
  (996,28,'Sampués'),
  (997,28,'San Benito Abad'),
  (998,28,'San Juan de Betulia'),
  (999,28,'San Marcos'),
  (1000,28,'San Onofre');
COMMIT;

#
# Data for the `tbl_municipios` table  (LIMIT 603,500)
#

INSERT INTO `tbl_municipios` (`id_municipio`, `id_departamento`, `descripcion`) VALUES 
  (1001,28,'San Pedro'),
  (1002,28,'Sincelejo'),
  (1003,28,'Sincé'),
  (1004,28,'Sucre'),
  (1005,28,'Tolú'),
  (1006,28,'Tolú Viejo'),
  (1007,29,'Alpujarra'),
  (1008,29,'Alvarado'),
  (1009,29,'Ambalema'),
  (1010,29,'Anzoátegui'),
  (1011,29,'Armero (Guayabal)'),
  (1012,29,'Ataco'),
  (1013,29,'Cajamarca'),
  (1014,29,'Carmen de Apicalá'),
  (1015,29,'Casabianca'),
  (1016,29,'Chaparral'),
  (1017,29,'Coello'),
  (1018,29,'Coyaima'),
  (1019,29,'Cunday'),
  (1020,29,'Dolores'),
  (1021,29,'Espinal'),
  (1022,29,'Falan'),
  (1023,29,'Flandes'),
  (1024,29,'Fresno'),
  (1025,29,'Guamo'),
  (1026,29,'Herveo'),
  (1027,29,'Honda'),
  (1028,29,'Ibagué'),
  (1029,29,'Icononzo'),
  (1030,29,'Lérida'),
  (1031,29,'Líbano'),
  (1032,29,'Mariquita'),
  (1033,29,'Melgar'),
  (1034,29,'Murillo'),
  (1035,29,'Natagaima'),
  (1036,29,'Ortega'),
  (1037,29,'Palocabildo'),
  (1038,29,'Piedras'),
  (1039,29,'Planadas'),
  (1040,29,'Prado'),
  (1041,29,'Purificación'),
  (1042,29,'Rioblanco'),
  (1043,29,'Roncesvalles'),
  (1044,29,'Rovira'),
  (1045,29,'Saldaña'),
  (1046,29,'San Antonio'),
  (1047,29,'San Luis'),
  (1048,29,'Santa Isabel'),
  (1049,29,'Suárez'),
  (1050,29,'Valle de San Juan'),
  (1051,29,'Venadillo'),
  (1052,29,'Villahermosa'),
  (1053,29,'Villarrica'),
  (1054,30,'Alcalá'),
  (1055,30,'Andalucía'),
  (1056,30,'Ansermanuevo'),
  (1057,30,'Argelia'),
  (1058,30,'Bolívar'),
  (1059,30,'Buenaventura'),
  (1060,30,'Buga'),
  (1061,30,'Bugalagrande'),
  (1062,30,'Caicedonia'),
  (1063,30,'Calima (Darién)'),
  (1064,30,'Calí'),
  (1065,30,'Candelaria'),
  (1066,30,'Cartago'),
  (1067,30,'Dagua'),
  (1068,30,'El Cairo'),
  (1069,30,'El Cerrito'),
  (1070,30,'El Dovio'),
  (1071,30,'El Águila'),
  (1072,30,'Florida'),
  (1073,30,'Ginebra'),
  (1074,30,'Guacarí'),
  (1075,30,'Jamundí'),
  (1076,30,'La Cumbre'),
  (1077,30,'La Unión'),
  (1078,30,'La Victoria'),
  (1079,30,'Obando'),
  (1080,30,'Palmira'),
  (1081,30,'Pradera'),
  (1082,30,'Restrepo'),
  (1083,30,'Riofrío'),
  (1084,30,'Roldanillo'),
  (1085,30,'San Pedro'),
  (1086,30,'Sevilla'),
  (1087,30,'Toro'),
  (1088,30,'Trujillo'),
  (1089,30,'Tulúa'),
  (1090,30,'Ulloa'),
  (1091,30,'Versalles'),
  (1092,30,'Vijes'),
  (1093,30,'Yotoco'),
  (1094,30,'Yumbo'),
  (1095,30,'Zarzal'),
  (1096,31,'Carurú'),
  (1097,31,'Mitú'),
  (1098,31,'Taraira'),
  (1099,32,'Cumaribo'),
  (1100,32,'La Primavera'),
  (1101,32,'Puerto Carreño'),
  (1102,32,'Santa Rosalía');
COMMIT;

#
# Data for the `tbl_nivel_educativo` table  (LIMIT -497,500)
#

INSERT INTO `tbl_nivel_educativo` (`id_nivel_educativo`, `descripcion`) VALUES 
  (1,'Primaria'),
  (2,'Secundaia');
COMMIT;

#
# Data for the `tbl_persona` table  (LIMIT -492,500)
#

INSERT INTO `tbl_persona` (`id_persona`, `id_documento_tipo`, `documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `id_tarjeta_familiar`, `id_estado_civil`, `id_asegurador`, `id_nivel_educativo`, `sexo`, `fecha_nacimiento`, `id_persona_familiaridad`) VALUES 
  (1,1,'1','niño','1','apellido','2',1,1,1,1,'Masculino','2017-08-28',1),
  (13,1,'2','2','2','2','2',1,1,2,2,'','2017-08-02',1),
  (14,1,'121','1212','1212','1212','1212',1,1,1,1,'Masculino','2017-08-02',1),
  (15,1,'3123123','1212233','12124324','121242342','1212342342',1,1,1,1,'Masculino','2017-08-03',10),
  (16,1,'milo','1212233','12124324','121242342','1212342342',1,1,1,1,'Masculino','2017-08-03',10),
  (17,1,'12','12','112','112','1212',1,2,1,1,'Masculino','2017-08-27',1),
  (18,1,'1071263','12','112','112','1212',1,2,1,1,'Masculino','2000-04-11',1);
COMMIT;

#
# Data for the `tbl_persona_familiaridad` table  (LIMIT -487,500)
#

INSERT INTO `tbl_persona_familiaridad` (`id_persona_familiaridad`, `descripcion`, `sexo`) VALUES 
  (1,' Es cabeza de familia','0'),
  (2,'Padre','m'),
  (3,'Madre','f'),
  (4,'Hijo','m'),
  (5,'Hermano','m'),
  (6,'Hermana','f'),
  (7,'Tio','m'),
  (8,'Tia','f'),
  (9,'Abuelo','m'),
  (10,'Abuela','f'),
  (11,'Sobrino','m'),
  (12,'Sobrina','f');
COMMIT;

#
# Data for the `tbl_tarjeta_familiar` table  (LIMIT -498,500)
#

INSERT INTO `tbl_tarjeta_familiar` (`id_tarjeta_familiar`, `fecha_apertura`, `codigo`, `sisben_ficha`, `sisben_puntaje`, `sisben_nivel`, `direccion`, `id_zona`, `telefono`, `id_municipio`) VALUES 
  (1,'2017-08-28 04:09:42','82',1,1.000,1,'1',1,'1',NULL);
COMMIT;

#
# Data for the `tbl_usuario` table  (LIMIT -498,500)
#

INSERT INTO `tbl_usuario` (`id_usuario`, `login`, `pass`, `id_perfil_tercero`, `id_perfil_tipo`) VALUES 
  (1,'1','c4ca4238a0b923820dcc509a6f75849b',1,1);
COMMIT;

#
# Data for the `tbl_zona` table  (LIMIT -497,500)
#

INSERT INTO `tbl_zona` (`id_zona`, `descripcion`) VALUES 
  (1,'Zona 1'),
  (2,'Zona 2');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;