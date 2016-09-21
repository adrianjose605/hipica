/*
Navicat MySQL Data Transfer

Source Server         : Roberto
Source Server Version : 50505
Source Host           : 200.90.40.106:100
Source Database       : hipica_roberto

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2015-07-14 16:09:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `par_subproductos`
-- ----------------------------
DROP TABLE IF EXISTS `par_subproductos`;
CREATE TABLE `par_subproductos` (
  `cod_subproducto` varchar(4) NOT NULL DEFAULT '',
  `nombre_subproducto` varchar(45) NOT NULL DEFAULT '',
  `cod_producto` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`cod_subproducto`,`cod_producto`),
  KEY `fk_par_subproductos` (`cod_producto`),
  CONSTRAINT `fk_par_subproductos` FOREIGN KEY (`cod_producto`) REFERENCES `par_productos_periodico` (`cod_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of par_subproductos
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_haras_acum_mensual`
-- ----------------------------
DROP TABLE IF EXISTS `tb_haras_acum_mensual`;
CREATE TABLE `tb_haras_acum_mensual` (
  `idharas` int(10) unsigned NOT NULL,
  `inicio_mes` date NOT NULL,
  `acumulado` decimal(10,4) DEFAULT '0.0000',
  PRIMARY KEY (`idharas`,`inicio_mes`),
  CONSTRAINT `fk_acumulado_haras_1` FOREIGN KEY (`idharas`) REFERENCES `tbharas` (`idharas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_haras_acum_mensual
-- ----------------------------

-- ----------------------------
-- Table structure for `tbcarrera`
-- ----------------------------
DROP TABLE IF EXISTS `tbcarrera`;
CREATE TABLE `tbcarrera` (
  `idcarrera` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpistadistancia` int(10) unsigned NOT NULL,
  `idclasico` int(10) unsigned DEFAULT NULL,
  `idestadopista` int(10) unsigned NOT NULL,
  `numero` int(10) unsigned NOT NULL,
  `fecha_carrera` datetime NOT NULL,
  `desv_standar` decimal(10,0) NOT NULL,
  `nro_llamado` int(10) unsigned NOT NULL,
  `numero_carrera_dia` int(10) unsigned NOT NULL,
  `reunion` int(10) unsigned NOT NULL,
  `serie_carrera` varchar(6) NOT NULL,
  `categoria` int(10) unsigned NOT NULL,
  `trofeo` varchar(200) NOT NULL,
  `integridad` char(1) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `idpremio` int(10) unsigned NOT NULL,
  `premiototal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idcarrera`),
  KEY `FK_tbcarrera_tbclasico` (`idclasico`),
  KEY `FK_tbcarrera_tbdistancia` (`idpistadistancia`),
  KEY `FK_tbcarrera_tbestadopista` (`idestadopista`),
  KEY `tbcarrera_ibfk_5` (`idpremio`),
  CONSTRAINT `tbcarrera_ibfk_1` FOREIGN KEY (`idclasico`) REFERENCES `tbclasico` (`idclasico`),
  CONSTRAINT `tbcarrera_ibfk_3` FOREIGN KEY (`idestadopista`) REFERENCES `tbestadopista` (`idestadopista`),
  CONSTRAINT `tbcarrera_ibfk_4` FOREIGN KEY (`idpistadistancia`) REFERENCES `tbpistadistancia` (`idpistadistancia`),
  CONSTRAINT `tbcarrera_ibfk_5` FOREIGN KEY (`idpremio`) REFERENCES `tbpremios` (`idpremios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbcarrera
-- ----------------------------

-- ----------------------------
-- Table structure for `tbcausaretiro`
-- ----------------------------
DROP TABLE IF EXISTS `tbcausaretiro`;
CREATE TABLE `tbcausaretiro` (
  `idcausaretiro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcausaretiro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbcausaretiro
-- ----------------------------

-- ----------------------------
-- Table structure for `tbclasico`
-- ----------------------------
DROP TABLE IF EXISTS `tbclasico`;
CREATE TABLE `tbclasico` (
  `idclasico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idhipodromo` int(10) unsigned NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `pond` int(10) unsigned NOT NULL,
  `grado` tinyint(3) unsigned NOT NULL,
  `fecha_registro` varchar(45) NOT NULL,
  PRIMARY KEY (`idclasico`),
  KEY `FK_tbclasico_tbpais` (`idhipodromo`) USING BTREE,
  CONSTRAINT `kd_tbclasico_1` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbclasico
-- ----------------------------

-- ----------------------------
-- Table structure for `tbcomentarios`
-- ----------------------------
DROP TABLE IF EXISTS `tbcomentarios`;
CREATE TABLE `tbcomentarios` (
  `idcomentarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `idtipocomentario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idcomentarios`),
  KEY `tbcomentario_ibfk_1` (`idtipocomentario`),
  CONSTRAINT `tbcomentario_ibfk_1` FOREIGN KEY (`idtipocomentario`) REFERENCES `tbtipocomentarios` (`idtipocomentario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbcomentarios
-- ----------------------------

-- ----------------------------
-- Table structure for `tbcondicion`
-- ----------------------------
DROP TABLE IF EXISTS `tbcondicion`;
CREATE TABLE `tbcondicion` (
  `idcondicion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idtipocondicion` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cond_abrev` varchar(3) NOT NULL,
  `cond_descrip` varchar(255) NOT NULL,
  `cond_pond` tinyint(10) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `idpais` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idcondicion`),
  KEY `FK_tbcondiciion_tbtipocondicion` (`idtipocondicion`),
  KEY `tbcondicion_ibfk_2` (`idpais`),
  CONSTRAINT `tbcondicion_ibfk_1` FOREIGN KEY (`idtipocondicion`) REFERENCES `tbtipocondicion` (`idtipocondicion`),
  CONSTRAINT `tbcondicion_ibfk_2` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbcondicion
-- ----------------------------
INSERT INTO `tbcondicion` VALUES ('8', '3', '2015-07-02 10:57:40', 'C', 'Caballos', '8', '1', '29');
INSERT INTO `tbcondicion` VALUES ('9', '4', '2015-07-10 10:35:02', 'NVa', 'nuevo', '2', '1', '29');
INSERT INTO `tbcondicion` VALUES ('10', '5', '2015-07-10 10:35:27', 'rf', 'dsadsads', '4', '1', '31');

-- ----------------------------
-- Table structure for `tbcondicioncarrera`
-- ----------------------------
DROP TABLE IF EXISTS `tbcondicioncarrera`;
CREATE TABLE `tbcondicioncarrera` (
  `idcondicioncarrera` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcarrera` int(10) unsigned NOT NULL,
  `idcondicion` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idcondicioncarrera`),
  KEY `FK_tbcondicioncarrera_tbcarrera` (`idcarrera`),
  KEY `FK_tbcondicioncarrera_tbcondicion` (`idcondicion`),
  CONSTRAINT `tbcondicioncarrera_ibfk_1` FOREIGN KEY (`idcarrera`) REFERENCES `tbcarrera` (`idcarrera`),
  CONSTRAINT `tbcondicioncarrera_ibfk_2` FOREIGN KEY (`idcondicion`) REFERENCES `tbcondicion` (`idcondicion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbcondicioncarrera
-- ----------------------------

-- ----------------------------
-- Table structure for `tbcuerpos`
-- ----------------------------
DROP TABLE IF EXISTS `tbcuerpos`;
CREATE TABLE `tbcuerpos` (
  `idcuerpos` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idcuerpos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbcuerpos
-- ----------------------------

-- ----------------------------
-- Table structure for `tbdiccionario`
-- ----------------------------
DROP TABLE IF EXISTS `tbdiccionario`;
CREATE TABLE `tbdiccionario` (
  `idtermino` int(10) unsigned NOT NULL,
  `ididioma` int(10) unsigned NOT NULL,
  `representacion` varchar(55) NOT NULL,
  PRIMARY KEY (`idtermino`,`ididioma`),
  KEY `tbdiccionario_fk_2` (`ididioma`),
  CONSTRAINT `tbdiccionario_fk_1` FOREIGN KEY (`idtermino`) REFERENCES `tbtermino` (`idtermino`),
  CONSTRAINT `tbdiccionario_fk_2` FOREIGN KEY (`ididioma`) REFERENCES `tbidioma` (`ididioma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbdiccionario
-- ----------------------------

-- ----------------------------
-- Table structure for `tbdistancia`
-- ----------------------------
DROP TABLE IF EXISTS `tbdistancia`;
CREATE TABLE `tbdistancia` (
  `iddistancia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `distancia` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iddistancia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbdistancia
-- ----------------------------
INSERT INTO `tbdistancia` VALUES ('4', '400', '2015-07-02 08:57:13', '1');
INSERT INTO `tbdistancia` VALUES ('5', '800', '2015-07-02 08:57:19', '1');
INSERT INTO `tbdistancia` VALUES ('6', '1200', '2015-07-02 08:57:44', '1');
INSERT INTO `tbdistancia` VALUES ('7', '1000', '2015-07-02 09:58:13', '1');

-- ----------------------------
-- Table structure for `tbdistanciamiento`
-- ----------------------------
DROP TABLE IF EXISTS `tbdistanciamiento`;
CREATE TABLE `tbdistanciamiento` (
  `iddistanciamiento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `abrev` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iddistanciamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbdistanciamiento
-- ----------------------------

-- ----------------------------
-- Table structure for `tbejemplar`
-- ----------------------------
DROP TABLE IF EXISTS `tbejemplar`;
CREATE TABLE `tbejemplar` (
  `idejemplar` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpais` int(10) unsigned NOT NULL,
  `idharas` int(10) unsigned NOT NULL,
  `idstud` int(10) unsigned NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nombre_abrev` varchar(12) CHARACTER SET latin1 NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `idejemplarpadre` int(10) unsigned DEFAULT NULL,
  `idejemplarmadre` int(10) unsigned DEFAULT NULL,
  `precio` decimal(12,2) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `castrado` tinyint(1) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idtipopelaje` int(10) unsigned NOT NULL,
  `idtipoorigen` int(10) unsigned NOT NULL,
  `comentario_inicial` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idejemplar`),
  KEY `FK_tbejemplar_tbpais` (`idpais`),
  KEY `FK_tbejemplar_tbharas` (`idharas`),
  KEY `FK_tbejemplar_tbstud` (`idstud`),
  KEY `FK_tbejemplar_tbejemplar_padre` (`idejemplarpadre`),
  KEY `FK_tbejemplar_tbejemplar_madre` (`idejemplarmadre`),
  KEY `FK_tbejemplar_tbtipopelaje` (`idtipopelaje`),
  KEY `tbejemplar_ibfk_8` (`idtipoorigen`),
  KEY `estatus` (`estatus`),
  CONSTRAINT `tbejemplar_ibfk_2` FOREIGN KEY (`idejemplarmadre`) REFERENCES `tbejemplar` (`idejemplar`),
  CONSTRAINT `tbejemplar_ibfk_3` FOREIGN KEY (`idejemplarpadre`) REFERENCES `tbejemplar` (`idejemplar`),
  CONSTRAINT `tbejemplar_ibfk_4` FOREIGN KEY (`idharas`) REFERENCES `tbharas` (`idharas`),
  CONSTRAINT `tbejemplar_ibfk_5` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`),
  CONSTRAINT `tbejemplar_ibfk_6` FOREIGN KEY (`idstud`) REFERENCES `tbstud` (`idstud`),
  CONSTRAINT `tbejemplar_ibfk_7` FOREIGN KEY (`idtipopelaje`) REFERENCES `tbtipopelaje` (`idtipopelaje`),
  CONSTRAINT `tbejemplar_ibfk_8` FOREIGN KEY (`idtipoorigen`) REFERENCES `tbtipoorigen` (`idtipoorigen`),
  CONSTRAINT `tbejemplar_ibfk_9` FOREIGN KEY (`estatus`) REFERENCES `tbejemplarstatus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbejemplar
-- ----------------------------
INSERT INTO `tbejemplar` VALUES ('1', '28', '4', '3', 'PADRE_SISTEMA', '2015-05-12', 'MDS', '1', null, null, '90000.00', '1', '1', '2015-07-01 16:13:40', '6', '4', null);
INSERT INTO `tbejemplar` VALUES ('2', '29', '4', '3', 'MADRE_SISTEMA', '2015-05-12', 'PDS', '0', null, null, '120000.00', '1', '1', '2015-07-01 16:13:40', '6', '4', null);
INSERT INTO `tbejemplar` VALUES ('5', '29', '4', '3', 'Canonero', '1969-01-08', 'can', '1', '1', '2', '1.00', '2', '1', '2015-07-02 11:20:07', '6', '5', '111');
INSERT INTO `tbejemplar` VALUES ('6', '28', '4', '3', 'Elrelampago', '2005-02-02', 'ELRMP', '1', '1', '2', '1.00', '1', '1', '2015-07-14 12:15:50', '6', '4', 'Muyrapido');
INSERT INTO `tbejemplar` VALUES ('7', '29', '7', '4', 'Benny Benasy', '2000-02-02', 'BB', '1', '1', '2', '1000.00', '1', '0', '2015-07-14 13:16:22', '7', '5', 'Muy Fuerte');

-- ----------------------------
-- Table structure for `tbejemplarstatus`
-- ----------------------------
DROP TABLE IF EXISTS `tbejemplarstatus`;
CREATE TABLE `tbejemplarstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbejemplarstatus
-- ----------------------------
INSERT INTO `tbejemplarstatus` VALUES ('0', 'Inactivo');
INSERT INTO `tbejemplarstatus` VALUES ('1', 'Activo');
INSERT INTO `tbejemplarstatus` VALUES ('2', 'En Cria');

-- ----------------------------
-- Table structure for `tbentrenador`
-- ----------------------------
DROP TABLE IF EXISTS `tbentrenador`;
CREATE TABLE `tbentrenador` (
  `identrenador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpersona` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`identrenador`),
  KEY `FK_tbentrenador_tbpersona` (`idpersona`),
  CONSTRAINT `tbentrenador_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbentrenador
-- ----------------------------

-- ----------------------------
-- Table structure for `tbestadopista`
-- ----------------------------
DROP TABLE IF EXISTS `tbestadopista`;
CREATE TABLE `tbestadopista` (
  `idestadopista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(3) NOT NULL,
  `pond` tinyint(1) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idestadopista`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbestadopista
-- ----------------------------
INSERT INTO `tbestadopista` VALUES ('3', 'Regular', 'REG', '5', '2015-07-02 08:58:45', '1');
INSERT INTO `tbestadopista` VALUES ('4', 'Optimo', 'OPT', '9', '2015-07-02 08:59:00', '1');

-- ----------------------------
-- Table structure for `tbgrupo`
-- ----------------------------
DROP TABLE IF EXISTS `tbgrupo`;
CREATE TABLE `tbgrupo` (
  `idgrupo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idgrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbgrupo
-- ----------------------------

-- ----------------------------
-- Table structure for `tbgrupopermiso`
-- ----------------------------
DROP TABLE IF EXISTS `tbgrupopermiso`;
CREATE TABLE `tbgrupopermiso` (
  `idgrupo` int(10) unsigned NOT NULL,
  `idpermiso` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idgrupo`,`idpermiso`),
  KEY `FK_tbgrupopermiso_tbpermiso` (`idpermiso`),
  CONSTRAINT `tbgrupopermiso_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `tbgrupo` (`idgrupo`),
  CONSTRAINT `tbgrupopermiso_ibfk_2` FOREIGN KEY (`idpermiso`) REFERENCES `tbpermiso` (`idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbgrupopermiso
-- ----------------------------

-- ----------------------------
-- Table structure for `tbharas`
-- ----------------------------
DROP TABLE IF EXISTS `tbharas`;
CREATE TABLE `tbharas` (
  `idharas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `idpais` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idharas`),
  KEY `tbharas_fk_1` (`idpais`),
  CONSTRAINT `tbharas_fk_1` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbharas
-- ----------------------------
INSERT INTO `tbharas` VALUES ('4', 'LaMarquesena', 'Haraedoguarico', '2015-07-02 09:00:30', '1', '28');
INSERT INTO `tbharas` VALUES ('5', 'LaFinca', 'Finca', '2015-07-02 09:01:01', '1', '28');
INSERT INTO `tbharas` VALUES ('6', 'Har', 'dasdsd', '2015-07-08 14:11:50', '1', '30');
INSERT INTO `tbharas` VALUES ('7', 'Har', 'sadasd', '2015-07-08 14:35:21', '1', '29');

-- ----------------------------
-- Table structure for `tbhipodromo`
-- ----------------------------
DROP TABLE IF EXISTS `tbhipodromo`;
CREATE TABLE `tbhipodromo` (
  `idhipodromo` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave Principal de la Tabla',
  `abreviatura` varchar(2) NOT NULL COMMENT 'Abreviatura del Hipodromo',
  `descripcion` varchar(45) NOT NULL COMMENT 'Descripción del Hipodromo',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se creo el registro',
  `idpais` int(10) unsigned NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idhipodromo`),
  KEY `FK_tbhipodromo_tbpais` (`idpais`),
  CONSTRAINT `tbhipodromo_ibfk_1` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena los Hipodromos';

-- ----------------------------
-- Records of tbhipodromo
-- ----------------------------
INSERT INTO `tbhipodromo` VALUES ('3', 'RI', 'LaRinconada', '2015-07-02 08:53:32', '28', '1');
INSERT INTO `tbhipodromo` VALUES ('4', 'SR', 'SantaRita', '2015-07-02 08:53:54', '28', '1');
INSERT INTO `tbhipodromo` VALUES ('5', 'V', 'Valencia', '2015-07-02 09:53:23', '28', '1');

-- ----------------------------
-- Table structure for `tbidioma`
-- ----------------------------
DROP TABLE IF EXISTS `tbidioma`;
CREATE TABLE `tbidioma` (
  `ididioma` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_idioma` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ididioma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbidioma
-- ----------------------------

-- ----------------------------
-- Table structure for `tbimplemento`
-- ----------------------------
DROP TABLE IF EXISTS `tbimplemento`;
CREATE TABLE `tbimplemento` (
  `idimplemento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idtipoimplemento` int(10) unsigned NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(3) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idimplemento`),
  KEY `FK_tbimplemento_tbtipoimplemento` (`idtipoimplemento`),
  CONSTRAINT `tbimplemento_ibfk_1` FOREIGN KEY (`idtipoimplemento`) REFERENCES `tbtipoimplemento` (`idtipoimplemento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbimplemento
-- ----------------------------
INSERT INTO `tbimplemento` VALUES ('4', '3', 'Gringolas', 'Gr', '2015-07-02 10:13:58', '1');

-- ----------------------------
-- Table structure for `tbjinete`
-- ----------------------------
DROP TABLE IF EXISTS `tbjinete`;
CREATE TABLE `tbjinete` (
  `idjinete` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpersona` int(10) unsigned NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `nivel` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`idjinete`) USING BTREE,
  KEY `FK_tbjinente_tbpersona` (`idpersona`),
  CONSTRAINT `tbjinete_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbjinete
-- ----------------------------

-- ----------------------------
-- Table structure for `tbjugada`
-- ----------------------------
DROP TABLE IF EXISTS `tbjugada`;
CREATE TABLE `tbjugada` (
  `idjugada` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` char(5) DEFAULT NULL,
  `por_defecto` tinyint(1) NOT NULL,
  `idtipojugada` int(10) unsigned NOT NULL,
  `multijugada` tinyint(1) NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `cantcarr` smallint(10) NOT NULL,
  `idhipodromo` int(10) unsigned NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `idjugadabase` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idjugada`),
  KEY `FK_tbjugada_tbtipojugada` (`idtipojugada`),
  KEY `tbjugada_ibfk_2` (`idhipodromo`),
  KEY `tbjugada_ibfk_3` (`idjugadabase`),
  CONSTRAINT `tbjugada_ibfk_1` FOREIGN KEY (`idtipojugada`) REFERENCES `tbtipojugada` (`idtipojugada`),
  CONSTRAINT `tbjugada_ibfk_2` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`),
  CONSTRAINT `tbjugada_ibfk_3` FOREIGN KEY (`idjugadabase`) REFERENCES `tbjugada` (`idjugada`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbjugada
-- ----------------------------
INSERT INTO `tbjugada` VALUES ('3', 'Ganador', 'G', '0', '3', '1', 'Primero', '1', '5', '1', null);
INSERT INTO `tbjugada` VALUES ('4', 'PoolDeCuatro', 'P4', '0', '4', '1', 'PDC', '4', '3', '1', null);
INSERT INTO `tbjugada` VALUES ('5', 'Prueba', 'PRU', '1', '4', '1', 'test', '5', '4', '1', null);
INSERT INTO `tbjugada` VALUES ('7', 'Pruebadse', 'PRUB', '1', '4', '1', 'test', '5', '4', '1', '4');
INSERT INTO `tbjugada` VALUES ('8', 'Nova', 'NOV', '1', '4', '1', 'adsa', '5', '4', '1', '5');
INSERT INTO `tbjugada` VALUES ('9', 'Carlos', 'XD', '1', '3', '1', 'Carlos estuvo aqui', '1', '3', '1', '4');

-- ----------------------------
-- Table structure for `tbjugadacarrera`
-- ----------------------------
DROP TABLE IF EXISTS `tbjugadacarrera`;
CREATE TABLE `tbjugadacarrera` (
  `idjugadacarrera` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idjugada` int(10) unsigned NOT NULL,
  `idcarrera` int(10) unsigned NOT NULL,
  `numero_jugada` int(10) unsigned NOT NULL,
  `dividendo` decimal(10,2) DEFAULT NULL,
  `acumulado` tinyint(4) DEFAULT NULL,
  `garantizado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idjugadacarrera`),
  KEY `FK_tbjugadacarrera_tbjugada` (`idjugada`),
  KEY `FK_tbjugadacarrera_tbcarrera` (`idcarrera`),
  CONSTRAINT `tbjugadacarrera_ibfk_1` FOREIGN KEY (`idcarrera`) REFERENCES `tbcarrera` (`idcarrera`),
  CONSTRAINT `tbjugadacarrera_ibfk_2` FOREIGN KEY (`idjugada`) REFERENCES `tbjugada` (`idjugada`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbjugadacarrera
-- ----------------------------

-- ----------------------------
-- Table structure for `tbpais`
-- ----------------------------
DROP TABLE IF EXISTS `tbpais`;
CREATE TABLE `tbpais` (
  `idpais` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave Principal de la Tabla',
  `abreviatura` varchar(3) CHARACTER SET latin1 NOT NULL COMMENT 'Abreviatura del Pais',
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL COMMENT 'Nombre del Pais',
  `fecha_registro` datetime NOT NULL COMMENT 'Fecha en la que se creo el registro',
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena los paises';

-- ----------------------------
-- Records of tbpais
-- ----------------------------
INSERT INTO `tbpais` VALUES ('28', 'VNZ', 'Venezuela', '2015-07-02 08:52:32', '1');
INSERT INTO `tbpais` VALUES ('29', 'ARG', 'Argentina', '2015-07-02 08:52:46', '1');
INSERT INTO `tbpais` VALUES ('30', 'COL', 'Colombia', '2015-07-02 09:42:56', '1');
INSERT INTO `tbpais` VALUES ('31', 'PER', 'Peru', '2015-07-02 13:39:18', '1');

-- ----------------------------
-- Table structure for `tbparcial`
-- ----------------------------
DROP TABLE IF EXISTS `tbparcial`;
CREATE TABLE `tbparcial` (
  `idparcial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `distancia` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idparcial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbparcial
-- ----------------------------

-- ----------------------------
-- Table structure for `tbparticipante_causaretiro_llegada`
-- ----------------------------
DROP TABLE IF EXISTS `tbparticipante_causaretiro_llegada`;
CREATE TABLE `tbparticipante_causaretiro_llegada` (
  `idparticipante_causaretiro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcausaretiro` int(10) unsigned NOT NULL,
  `comentario` varchar(255) CHARACTER SET latin1 NOT NULL,
  `idparticipante` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idparticipante_causaretiro`),
  KEY `FK_tbparticipante_causaretiro_tbcausaretiro` (`idcausaretiro`),
  KEY `tbparticipante_causaretiro_llegada_ibfk_2` (`idparticipante`),
  CONSTRAINT `tbparticipante_causaretiro_llegada_ibfk_1` FOREIGN KEY (`idcausaretiro`) REFERENCES `tbcausaretiro` (`idcausaretiro`),
  CONSTRAINT `tbparticipante_causaretiro_llegada_ibfk_2` FOREIGN KEY (`idparticipante`) REFERENCES `tbparticipante_llegada` (`idparticipante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbparticipante_causaretiro_llegada
-- ----------------------------

-- ----------------------------
-- Table structure for `tbparticipante_llamado`
-- ----------------------------
DROP TABLE IF EXISTS `tbparticipante_llamado`;
CREATE TABLE `tbparticipante_llamado` (
  `idparticipacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcarrera` int(10) unsigned NOT NULL,
  `idejemplar` int(10) unsigned NOT NULL,
  `identrenador` int(10) unsigned NOT NULL,
  `numero` varchar(2) NOT NULL,
  `llave` varchar(2) NOT NULL,
  `puesto_pista` varchar(2) NOT NULL,
  `valor_recal` decimal(10,0) NOT NULL,
  `idstud` int(10) unsigned NOT NULL,
  `idjinete` int(10) unsigned NOT NULL,
  `pesojinete` decimal(10,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`idparticipacion`),
  KEY `FK_tbparticipante_tbcarrera` (`idcarrera`),
  KEY `FK_tbparticipante_tbejemplar` (`idejemplar`),
  KEY `FK_tbparticipante_tbentrenador` (`identrenador`),
  KEY `tbparticipante_ibfk_7` (`idstud`),
  KEY `tbparticipante_llamado_ibfk_8` (`idjinete`),
  CONSTRAINT `tbparticipante_llamado_ibfk_2` FOREIGN KEY (`idcarrera`) REFERENCES `tbcarrera` (`idcarrera`),
  CONSTRAINT `tbparticipante_llamado_ibfk_4` FOREIGN KEY (`idejemplar`) REFERENCES `tbejemplar` (`idejemplar`),
  CONSTRAINT `tbparticipante_llamado_ibfk_5` FOREIGN KEY (`identrenador`) REFERENCES `tbentrenador` (`identrenador`),
  CONSTRAINT `tbparticipante_llamado_ibfk_7` FOREIGN KEY (`idstud`) REFERENCES `tbstud` (`idstud`),
  CONSTRAINT `tbparticipante_llamado_ibfk_8` FOREIGN KEY (`idjinete`) REFERENCES `tbjinete` (`idjinete`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbparticipante_llamado
-- ----------------------------

-- ----------------------------
-- Table structure for `tbparticipante_llegada`
-- ----------------------------
DROP TABLE IF EXISTS `tbparticipante_llegada`;
CREATE TABLE `tbparticipante_llegada` (
  `idparticipante` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcarrera` int(10) unsigned NOT NULL,
  `idejemplar` int(10) unsigned NOT NULL,
  `numero` varchar(2) NOT NULL,
  `peso_ejemplar` decimal(5,2) NOT NULL,
  `actuacion_400` smallint(10) unsigned DEFAULT NULL,
  `actuacion_800` smallint(10) unsigned DEFAULT NULL,
  `tiempo_ejemplar` decimal(3,2) DEFAULT NULL,
  `promedio_ponderado` decimal(3,2) DEFAULT NULL,
  `idtropiezo` int(10) unsigned DEFAULT NULL,
  `iddistanciamiento` int(10) unsigned DEFAULT NULL,
  `idcuerpo` int(10) unsigned DEFAULT NULL,
  `pesojinete` decimal(10,2) NOT NULL,
  `idjinete` int(10) unsigned DEFAULT NULL,
  `retiro` tinyint(1) unsigned DEFAULT NULL,
  `posicionllegada` smallint(10) unsigned NOT NULL,
  `dividendo` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idparticipante`),
  KEY `FK_tbparticipante_tbcarrera` (`idcarrera`),
  KEY `FK_tbparticipante_tbejemplar` (`idejemplar`),
  KEY `FK_tbparticipante_tbtropiezo` (`idtropiezo`),
  KEY `FK_tbparticipante_tbdistanciamiento` (`iddistanciamiento`),
  KEY `FK_tbparticipante_cuerpo` (`idcuerpo`),
  KEY `tbparticipante_llegada_ibfk_6` (`idjinete`),
  KEY `tbparticipante_llegada_ibfk_4` (`retiro`),
  CONSTRAINT `tbparticipante_llegada_ibfk_2` FOREIGN KEY (`idcarrera`) REFERENCES `tbcarrera` (`idcarrera`),
  CONSTRAINT `tbparticipante_llegada_ibfk_3` FOREIGN KEY (`idejemplar`) REFERENCES `tbejemplar` (`idejemplar`),
  CONSTRAINT `tbparticipante_llegada_ibfk_5` FOREIGN KEY (`idtropiezo`) REFERENCES `tbtropiezo` (`idtropiezo`),
  CONSTRAINT `tbparticipante_llegada_ibfk_6` FOREIGN KEY (`idjinete`) REFERENCES `tbjinete` (`idjinete`),
  CONSTRAINT `tbparticipante_llegada_ibfk_7` FOREIGN KEY (`idcuerpo`) REFERENCES `tbcuerpos` (`idcuerpos`),
  CONSTRAINT `tbparticipante_llegada_ibfk_8` FOREIGN KEY (`iddistanciamiento`) REFERENCES `tbdistanciamiento` (`iddistanciamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbparticipante_llegada
-- ----------------------------

-- ----------------------------
-- Table structure for `tbparticipante_parcial`
-- ----------------------------
DROP TABLE IF EXISTS `tbparticipante_parcial`;
CREATE TABLE `tbparticipante_parcial` (
  `idparticipanteparcial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idparticipante` int(10) unsigned NOT NULL,
  `idparcial` int(10) unsigned NOT NULL,
  `tiempo` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idparticipanteparcial`),
  KEY `FK_tbparticipante_parcial_participante` (`idparticipante`),
  KEY `FK_tbparticipante_parcial_parcial` (`idparcial`),
  CONSTRAINT `tbparticipante_parcial_ibfk_1` FOREIGN KEY (`idparcial`) REFERENCES `tbparcial` (`idparcial`),
  CONSTRAINT `tbparticipante_parcial_ibfk_2` FOREIGN KEY (`idparticipante`) REFERENCES `tbparticipante_llegada` (`idparticipante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbparticipante_parcial
-- ----------------------------

-- ----------------------------
-- Table structure for `tbpartimplementollamado`
-- ----------------------------
DROP TABLE IF EXISTS `tbpartimplementollamado`;
CREATE TABLE `tbpartimplementollamado` (
  `idpartllamadoimplemento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idimplemento` int(10) unsigned NOT NULL,
  `idparticipantellamado` int(10) unsigned NOT NULL,
  `ponderacion` smallint(10) unsigned NOT NULL,
  PRIMARY KEY (`idpartllamadoimplemento`),
  KEY `FK_tbimplemento_participante_tbparcipante` (`idparticipantellamado`),
  KEY `FK_tbimplemento_participante_tbimplemento` (`idimplemento`),
  CONSTRAINT `tbpartimplementollamado_ibfk_1` FOREIGN KEY (`idimplemento`) REFERENCES `tbimplemento` (`idimplemento`),
  CONSTRAINT `tbpartimplementollamado_ibfk_2` FOREIGN KEY (`idparticipantellamado`) REFERENCES `tbparticipante_llamado` (`idparticipacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbpartimplementollamado
-- ----------------------------

-- ----------------------------
-- Table structure for `tbpermiso`
-- ----------------------------
DROP TABLE IF EXISTS `tbpermiso`;
CREATE TABLE `tbpermiso` (
  `idpermiso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conjunto` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL,
  `privado` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbpermiso
-- ----------------------------

-- ----------------------------
-- Table structure for `tbpersona`
-- ----------------------------
DROP TABLE IF EXISTS `tbpersona`;
CREATE TABLE `tbpersona` (
  `idpersona` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `primer_apellido` varchar(45) NOT NULL,
  `segundo_apellido` varchar(45) NOT NULL,
  `primer_nombre` varchar(45) NOT NULL,
  `segundo_nombre` varchar(45) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `nombre_abrev` varchar(15) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `nacionalidad` char(1) NOT NULL,
  `rif` varchar(15) NOT NULL,
  `usuario` int(1) DEFAULT '0',
  `jinete` int(1) DEFAULT '0',
  `propietario` int(1) DEFAULT '0',
  `entrenador` int(1) DEFAULT '0',
  PRIMARY KEY (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbpersona
-- ----------------------------

-- ----------------------------
-- Table structure for `tbpista`
-- ----------------------------
DROP TABLE IF EXISTS `tbpista`;
CREATE TABLE `tbpista` (
  `idpista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `idtipopista` int(10) unsigned NOT NULL,
  `idhipodromo` int(10) unsigned NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpista`),
  KEY `tbpista_ibfk_1` (`idpista`) USING BTREE,
  KEY `tbpista_ibfk_2` (`idhipodromo`) USING BTREE,
  KEY `fk_tbpista_2` (`idtipopista`),
  CONSTRAINT `tbpista_ibfk_1
tbpista_ibfk_1
tbtipohipodromodistancia_ibfk_2` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`),
  CONSTRAINT `tbpista_ibfk_1` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`),
  CONSTRAINT `tbpista_ibfk_2` FOREIGN KEY (`idtipopista`) REFERENCES `tbtipopista` (`idtipopista`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbpista
-- ----------------------------
INSERT INTO `tbpista` VALUES ('4', 'PistaA', '9', '3', '1');
INSERT INTO `tbpista` VALUES ('5', 'PistaB', '10', '4', '1');
INSERT INTO `tbpista` VALUES ('6', 'PPrueba', '9', '5', '1');

-- ----------------------------
-- Table structure for `tbpistadistancia`
-- ----------------------------
DROP TABLE IF EXISTS `tbpistadistancia`;
CREATE TABLE `tbpistadistancia` (
  `idpistadistancia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpista` int(10) unsigned NOT NULL,
  `iddistancia` int(10) unsigned NOT NULL,
  `tiempo_minimo` decimal(3,2) DEFAULT NULL,
  `tiempo_maximo` decimal(3,2) DEFAULT NULL,
  `tiempo_promedio` decimal(3,2) DEFAULT NULL,
  `tiempo_record` decimal(3,2) DEFAULT NULL,
  `tiempo_base` decimal(3,2) DEFAULT NULL,
  `tiempo_tc` decimal(3,2) DEFAULT NULL,
  `idparticipante` int(10) unsigned DEFAULT NULL,
  `fecha_record` datetime DEFAULT NULL,
  `curvas` smallint(10) DEFAULT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpistadistancia`),
  KEY `fk_tbpistadistancia_1` (`idpista`),
  KEY `fk_tbpistadistancia_2` (`iddistancia`),
  CONSTRAINT `fk_tbpistadistancia_1` FOREIGN KEY (`idpista`) REFERENCES `tbpista` (`idpista`),
  CONSTRAINT `fk_tbpistadistancia_2` FOREIGN KEY (`iddistancia`) REFERENCES `tbdistancia` (`iddistancia`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbpistadistancia
-- ----------------------------
INSERT INTO `tbpistadistancia` VALUES ('1', '4', '6', null, null, null, null, null, null, null, null, null, '1');
INSERT INTO `tbpistadistancia` VALUES ('2', '4', '5', null, null, null, null, null, null, null, null, null, '1');
INSERT INTO `tbpistadistancia` VALUES ('3', '4', '4', null, null, null, null, null, null, null, null, null, '1');
INSERT INTO `tbpistadistancia` VALUES ('4', '5', '4', null, null, null, null, null, null, null, null, null, '1');
INSERT INTO `tbpistadistancia` VALUES ('5', '6', '6', null, null, null, null, null, null, null, null, null, '1');
INSERT INTO `tbpistadistancia` VALUES ('6', '4', '7', null, null, null, null, null, null, null, null, null, '1');

-- ----------------------------
-- Table structure for `tbpremios`
-- ----------------------------
DROP TABLE IF EXISTS `tbpremios`;
CREATE TABLE `tbpremios` (
  `idpremios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `porcentaje_1` int(11) NOT NULL,
  `porcentaje_2` int(11) DEFAULT '0',
  `porcentaje_3` int(11) DEFAULT '0',
  `porcentaje_4` int(11) DEFAULT '0' COMMENT '0',
  `porcentaje_5` int(11) DEFAULT '0',
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `idhipodromo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idpremios`) USING BTREE,
  KEY `tbpremio_fk_1` (`idhipodromo`),
  CONSTRAINT `tbpremio_fk_1` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbpremios
-- ----------------------------
INSERT INTO `tbpremios` VALUES ('5', 'Estandar', '50', '40', '10', '0', '0', '1', '3');
INSERT INTO `tbpremios` VALUES ('6', 'Completo', '50', '30', '10', '5', '5', '1', '4');
INSERT INTO `tbpremios` VALUES ('7', 'EdicioE', '50', '25', '25', '0', '0', '1', '3');
INSERT INTO `tbpremios` VALUES ('8', 'Nuevo', '50', '50', '0', '0', '0', '1', '4');

-- ----------------------------
-- Table structure for `tbpronostico`
-- ----------------------------
DROP TABLE IF EXISTS `tbpronostico`;
CREATE TABLE `tbpronostico` (
  `idpronostico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idrevista` int(10) unsigned NOT NULL,
  `idparticipante` int(10) unsigned NOT NULL,
  `idcomentarios` int(10) unsigned NOT NULL,
  `posicion` char(1) NOT NULL,
  `pronostico` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `linea` char(1) NOT NULL,
  PRIMARY KEY (`idpronostico`),
  KEY `FK_tbpronostico_tbrevista` (`idrevista`),
  KEY `FK_tbpronostico_tbparticipante` (`idparticipante`),
  KEY `FK_tbpronostico_tbcomentarios` (`idcomentarios`),
  CONSTRAINT `tbpronostico_ibfk_1` FOREIGN KEY (`idcomentarios`) REFERENCES `tbcomentarios` (`idcomentarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbpronostico_ibfk_2` FOREIGN KEY (`idparticipante`) REFERENCES `tbparticipante_llamado` (`idparticipacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbpronostico_ibfk_3` FOREIGN KEY (`idrevista`) REFERENCES `tbrevista` (`idrevista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbpronostico
-- ----------------------------

-- ----------------------------
-- Table structure for `tbpropietario`
-- ----------------------------
DROP TABLE IF EXISTS `tbpropietario`;
CREATE TABLE `tbpropietario` (
  `idpropietario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpersona` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`idpropietario`),
  KEY `FK_tbentrenador_tbpersona` (`idpersona`) USING BTREE,
  CONSTRAINT `tbpropietario_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbpropietario
-- ----------------------------

-- ----------------------------
-- Table structure for `tbpropietariostud`
-- ----------------------------
DROP TABLE IF EXISTS `tbpropietariostud`;
CREATE TABLE `tbpropietariostud` (
  `idstud` int(10) unsigned NOT NULL,
  `idpropietario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idstud`,`idpropietario`),
  KEY `tbstudprop_llamado_ibfk_2` (`idpropietario`),
  CONSTRAINT `tbstudprop_llamado_ibfk_1` FOREIGN KEY (`idstud`) REFERENCES `tbstud` (`idstud`),
  CONSTRAINT `tbstudprop_llamado_ibfk_2` FOREIGN KEY (`idpropietario`) REFERENCES `tbpropietario` (`idpropietario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbpropietariostud
-- ----------------------------

-- ----------------------------
-- Table structure for `tbrevista`
-- ----------------------------
DROP TABLE IF EXISTS `tbrevista`;
CREATE TABLE `tbrevista` (
  `idrevista` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave Principal de la Tabla',
  `codigo` varchar(5) NOT NULL COMMENT 'Código de la Revista',
  `descripcion` varchar(45) NOT NULL COMMENT 'Descripción de la Revista',
  `nivel` int(10) NOT NULL COMMENT 'Nivel de la Revista',
  `fecha_registro` datetime NOT NULL COMMENT 'Fecha en la que se creo el registro',
  `idpais` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idrevista`),
  KEY `fk_revista_1` (`idpais`),
  CONSTRAINT `fk_revista_1` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena los paises';

-- ----------------------------
-- Records of tbrevista
-- ----------------------------

-- ----------------------------
-- Table structure for `tbrevista_circulacion`
-- ----------------------------
DROP TABLE IF EXISTS `tbrevista_circulacion`;
CREATE TABLE `tbrevista_circulacion` (
  `idpais` int(10) unsigned DEFAULT NULL,
  `idrevista` int(10) unsigned DEFAULT NULL,
  KEY `fk_revista_circulacion` (`idpais`),
  KEY `fk_revista_circulacion_1` (`idrevista`),
  CONSTRAINT `fk_revista_circulacion` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`),
  CONSTRAINT `fk_revista_circulacion_1` FOREIGN KEY (`idrevista`) REFERENCES `tbrevista` (`idrevista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbrevista_circulacion
-- ----------------------------

-- ----------------------------
-- Table structure for `tbrevista_unidades`
-- ----------------------------
DROP TABLE IF EXISTS `tbrevista_unidades`;
CREATE TABLE `tbrevista_unidades` (
  `idrevista_unidades` int(10) unsigned NOT NULL,
  `idrevista` int(10) unsigned NOT NULL,
  `id_unidad` int(10) unsigned NOT NULL,
  KEY `tbrevista_unidades_ibfk_1` (`idrevista`),
  KEY `tbrevista_unidades_ibfk_2` (`id_unidad`),
  CONSTRAINT `tbrevista_unidades_ibfk_1` FOREIGN KEY (`idrevista`) REFERENCES `tbrevista` (`idrevista`),
  CONSTRAINT `tbrevista_unidades_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `tbunidades` (`idunidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbrevista_unidades
-- ----------------------------

-- ----------------------------
-- Table structure for `tbstud`
-- ----------------------------
DROP TABLE IF EXISTS `tbstud`;
CREATE TABLE `tbstud` (
  `idstud` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `colores` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `idpais` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idstud`),
  KEY `tbstud_fk_1` (`idpais`),
  CONSTRAINT `tbstud_fk_1` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbstud
-- ----------------------------
INSERT INTO `tbstud` VALUES ('3', 'StrudA', 'ROJO', '2015-07-02 09:09:21', '1', '30');
INSERT INTO `tbstud` VALUES ('4', 'Stud', 'VERDE', '2015-07-02 09:09:49', '1', '28');
INSERT INTO `tbstud` VALUES ('5', 'Nuevio', 'AZUL', '2015-07-08 16:55:08', '0', '30');

-- ----------------------------
-- Table structure for `tbtermino`
-- ----------------------------
DROP TABLE IF EXISTS `tbtermino`;
CREATE TABLE `tbtermino` (
  `idtermino` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref_termino` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`idtermino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbtermino
-- ----------------------------

-- ----------------------------
-- Table structure for `tbtipocomentarios`
-- ----------------------------
DROP TABLE IF EXISTS `tbtipocomentarios`;
CREATE TABLE `tbtipocomentarios` (
  `idtipocomentario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipocomentario` varchar(45) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipocomentario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbtipocomentarios
-- ----------------------------
INSERT INTO `tbtipocomentarios` VALUES ('4', 'Acotacion', '1');
INSERT INTO `tbtipocomentarios` VALUES ('5', 'Negativo', '0');
INSERT INTO `tbtipocomentarios` VALUES ('6', 'Bueno', '0');

-- ----------------------------
-- Table structure for `tbtipocondicion`
-- ----------------------------
DROP TABLE IF EXISTS `tbtipocondicion`;
CREATE TABLE `tbtipocondicion` (
  `idtipocondicion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipocond_pond` tinyint(10) NOT NULL,
  `tipocond_orden` tinyint(10) NOT NULL,
  `tipocond_multiple` tinyint(1) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipocondicion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbtipocondicion
-- ----------------------------
INSERT INTO `tbtipocondicion` VALUES ('3', 'Sexo', '2015-07-02 09:11:08', '2', '1', '0', '1');
INSERT INTO `tbtipocondicion` VALUES ('4', 'Edad', '2015-07-02 09:11:23', '3', '2', '1', '1');
INSERT INTO `tbtipocondicion` VALUES ('5', 'Serie', '2015-07-02 10:50:45', '0', '3', '1', '1');

-- ----------------------------
-- Table structure for `tbtipoimplemento`
-- ----------------------------
DROP TABLE IF EXISTS `tbtipoimplemento`;
CREATE TABLE `tbtipoimplemento` (
  `idtipoimplemento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(5) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipoimplemento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbtipoimplemento
-- ----------------------------
INSERT INTO `tbtipoimplemento` VALUES ('3', 'TipoA', 'TPA', '2015-07-02 09:06:10', '1');
INSERT INTO `tbtipoimplemento` VALUES ('4', 'TipoB', 'TPB', '2015-07-02 09:06:19', '1');
INSERT INTO `tbtipoimplemento` VALUES ('5', 'TipoC', 'TPC', '2015-07-02 09:06:30', '1');
INSERT INTO `tbtipoimplemento` VALUES ('6', 'Medicamentos', 'MD', '2015-07-02 10:10:29', '1');

-- ----------------------------
-- Table structure for `tbtipojugada`
-- ----------------------------
DROP TABLE IF EXISTS `tbtipojugada`;
CREATE TABLE `tbtipojugada` (
  `idtipojugada` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipojugada`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbtipojugada
-- ----------------------------
INSERT INTO `tbtipojugada` VALUES ('3', 'JugadaA', '2015-07-02 09:11:58', '1');
INSERT INTO `tbtipojugada` VALUES ('4', 'JugadaB', '2015-07-02 09:12:06', '1');

-- ----------------------------
-- Table structure for `tbtipoorigen`
-- ----------------------------
DROP TABLE IF EXISTS `tbtipoorigen`;
CREATE TABLE `tbtipoorigen` (
  `idtipoorigen` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `abreviatura` varchar(4) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipoorigen`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbtipoorigen
-- ----------------------------
INSERT INTO `tbtipoorigen` VALUES ('4', 'Nacional', '2015-07-02 09:02:58', 'NAC', '1');
INSERT INTO `tbtipoorigen` VALUES ('5', 'ImportadoV', '2015-07-02 09:03:10', 'IMP', '1');

-- ----------------------------
-- Table structure for `tbtipopelaje`
-- ----------------------------
DROP TABLE IF EXISTS `tbtipopelaje`;
CREATE TABLE `tbtipopelaje` (
  `idtipopelaje` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `fecharegistro` datetime NOT NULL,
  `abreviatura` char(1) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipopelaje`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbtipopelaje
-- ----------------------------
INSERT INTO `tbtipopelaje` VALUES ('6', 'Castano', '2015-07-02 09:07:01', 'C', '1');
INSERT INTO `tbtipopelaje` VALUES ('7', 'Alazan', '2015-07-02 09:07:27', 'A', '1');
INSERT INTO `tbtipopelaje` VALUES ('8', 'Zaino', '2015-07-02 11:09:13', 'Z', '1');
INSERT INTO `tbtipopelaje` VALUES ('9', 'Tordillo', '2015-07-02 11:09:25', 'T', '1');

-- ----------------------------
-- Table structure for `tbtipopista`
-- ----------------------------
DROP TABLE IF EXISTS `tbtipopista`;
CREATE TABLE `tbtipopista` (
  `idtipopista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipopista`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbtipopista
-- ----------------------------
INSERT INTO `tbtipopista` VALUES ('7', 'Fangosa', '1');
INSERT INTO `tbtipopista` VALUES ('8', 'Sintentica', '1');
INSERT INTO `tbtipopista` VALUES ('9', 'Grama', '1');
INSERT INTO `tbtipopista` VALUES ('10', 'Arena', '1');

-- ----------------------------
-- Table structure for `tbtipounidades`
-- ----------------------------
DROP TABLE IF EXISTS `tbtipounidades`;
CREATE TABLE `tbtipounidades` (
  `idtipounidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombretipounidad` varchar(45) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipounidad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbtipounidades
-- ----------------------------
INSERT INTO `tbtipounidades` VALUES ('3', 'Distancia', '1');
INSERT INTO `tbtipounidades` VALUES ('4', 'Velocidad', '1');
INSERT INTO `tbtipounidades` VALUES ('5', 'Altura', '1');

-- ----------------------------
-- Table structure for `tbtraqueos`
-- ----------------------------
DROP TABLE IF EXISTS `tbtraqueos`;
CREATE TABLE `tbtraqueos` (
  `idtraqueos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpistadistancia` int(10) unsigned NOT NULL,
  `idjinete` int(10) unsigned NOT NULL,
  `idejemplar` int(10) unsigned NOT NULL,
  `idrevista` int(10) unsigned NOT NULL,
  `idcomentarios` int(10) unsigned NOT NULL,
  `tiempo` decimal(3,2) NOT NULL,
  `remate` decimal(3,2) NOT NULL,
  `fecha_traqueo` datetime NOT NULL,
  PRIMARY KEY (`idtraqueos`),
  KEY `FK_tbtraqueos_tbdistancia` (`idpistadistancia`),
  KEY `FK_tbtraqueos_tbjinete` (`idjinete`),
  KEY `FK_tbtraqueos_tbejemplar` (`idejemplar`),
  KEY `FK_tbtraqueos_tbrevista` (`idrevista`),
  KEY `FK_tbtraqueos_tbcomentarios` (`idcomentarios`),
  CONSTRAINT `tbtraqueos_ibfk_1` FOREIGN KEY (`idcomentarios`) REFERENCES `tbcomentarios` (`idcomentarios`),
  CONSTRAINT `tbtraqueos_ibfk_2` FOREIGN KEY (`idpistadistancia`) REFERENCES `tbpistadistancia` (`idpistadistancia`),
  CONSTRAINT `tbtraqueos_ibfk_3` FOREIGN KEY (`idejemplar`) REFERENCES `tbejemplar` (`idejemplar`),
  CONSTRAINT `tbtraqueos_ibfk_4` FOREIGN KEY (`idjinete`) REFERENCES `tbjinete` (`idjinete`),
  CONSTRAINT `tbtraqueos_ibfk_5` FOREIGN KEY (`idrevista`) REFERENCES `tbrevista` (`idrevista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbtraqueos
-- ----------------------------

-- ----------------------------
-- Table structure for `tbtropiezo`
-- ----------------------------
DROP TABLE IF EXISTS `tbtropiezo`;
CREATE TABLE `tbtropiezo` (
  `idtropiezo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(5) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtropiezo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbtropiezo
-- ----------------------------
INSERT INTO `tbtropiezo` VALUES ('3', 'Enfermedad', 'ENF', '2015-07-02 09:01:45', '1');
INSERT INTO `tbtropiezo` VALUES ('4', 'Obstaculo', 'OBS', '2015-07-02 09:02:05', '1');

-- ----------------------------
-- Table structure for `tbunidades`
-- ----------------------------
DROP TABLE IF EXISTS `tbunidades`;
CREATE TABLE `tbunidades` (
  `idunidad` int(10) unsigned NOT NULL,
  `factor` decimal(10,2) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `idtipounidad` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idunidad`),
  KEY `tbunidades_ibfk_1` (`idtipounidad`),
  CONSTRAINT `tbunidades_ibfk_1` FOREIGN KEY (`idtipounidad`) REFERENCES `tbtipounidades` (`idtipounidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbunidades
-- ----------------------------

-- ----------------------------
-- Table structure for `tbusuario`
-- ----------------------------
DROP TABLE IF EXISTS `tbusuario`;
CREATE TABLE `tbusuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) CHARACTER SET latin1 NOT NULL,
  `clave` varchar(32) CHARACTER SET latin1 NOT NULL,
  `email` varchar(120) CHARACTER SET latin1 NOT NULL,
  `idpersona` int(10) unsigned NOT NULL,
  `activo` tinyint(3) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `FK_tbusuario_tbpersona` (`idpersona`),
  CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbusuario
-- ----------------------------

-- ----------------------------
-- Table structure for `tbusuariopermiso`
-- ----------------------------
DROP TABLE IF EXISTS `tbusuariopermiso`;
CREATE TABLE `tbusuariopermiso` (
  `idusuario` int(10) unsigned NOT NULL,
  `idpermiso` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idusuario`,`idpermiso`),
  KEY `idpermiso` (`idpermiso`),
  CONSTRAINT `tbusuariopermiso_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `tbusuario` (`idusuario`),
  CONSTRAINT `tbusuariopermiso_ibfk_2` FOREIGN KEY (`idpermiso`) REFERENCES `tbpermiso` (`idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbusuariopermiso
-- ----------------------------

-- ----------------------------
-- Table structure for `tbusuarios_unidades`
-- ----------------------------
DROP TABLE IF EXISTS `tbusuarios_unidades`;
CREATE TABLE `tbusuarios_unidades` (
  `idrevista_unidades` int(10) unsigned NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `id_unidad` int(10) unsigned NOT NULL,
  KEY `tbrevista_unidades_ibfk_1` (`idusuario`),
  KEY `tbrevista_unidades_ibfk_2` (`id_unidad`),
  CONSTRAINT `tbusuarios_unidades_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `tbusuario` (`idusuario`),
  CONSTRAINT `tbusuarios_unidades_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `tbunidades` (`idunidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbusuarios_unidades
-- ----------------------------

-- ----------------------------
-- View structure for `tbentrenador_detallado`
-- ----------------------------
DROP VIEW IF EXISTS `tbentrenador_detallado`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `tbentrenador_detallado` AS select `a`.`identrenador` AS `identrenador`,`a`.`idpersona` AS `idpersona`,`a`.`status` AS `status`,`b`.`primer_apellido` AS `primer_apellido`,`b`.`primer_nombre` AS `primer_nombre`,`b`.`nacionalidad` AS `nacionalidad`,`b`.`rif` AS `rif` from (`tbentrenador` `a` join `tbpersona` `b`) where (`a`.`idpersona` = `b`.`idpersona`) ;
