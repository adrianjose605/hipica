-- MySQL dump 10.15  Distrib 10.0.21-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: hipica1
-- ------------------------------------------------------
-- Server version	10.0.21-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `par_subproductos`
--

DROP TABLE IF EXISTS `par_subproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `par_subproductos` (
  `cod_subproducto` varchar(4) NOT NULL DEFAULT '',
  `nombre_subproducto` varchar(45) NOT NULL DEFAULT '',
  `cod_producto` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`cod_subproducto`,`cod_producto`),
  KEY `fk_par_subproductos` (`cod_producto`),
  CONSTRAINT `fk_par_subproductos` FOREIGN KEY (`cod_producto`) REFERENCES `par_productos_periodico` (`cod_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `par_subproductos`
--

LOCK TABLES `par_subproductos` WRITE;
/*!40000 ALTER TABLE `par_subproductos` DISABLE KEYS */;
/*!40000 ALTER TABLE `par_subproductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_haras_acum_mensual`
--

DROP TABLE IF EXISTS `tb_haras_acum_mensual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_haras_acum_mensual` (
  `idharas` int(10) unsigned NOT NULL,
  `inicio_mes` date NOT NULL,
  `acumulado` decimal(10,4) DEFAULT '0.0000',
  PRIMARY KEY (`idharas`,`inicio_mes`),
  CONSTRAINT `fk_acumulado_haras_1` FOREIGN KEY (`idharas`) REFERENCES `tbharas` (`idharas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_haras_acum_mensual`
--

LOCK TABLES `tb_haras_acum_mensual` WRITE;
/*!40000 ALTER TABLE `tb_haras_acum_mensual` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_haras_acum_mensual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcarrera`
--

DROP TABLE IF EXISTS `tbcarrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcarrera` (
  `idcarrera` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpistadistancia` int(10) unsigned NOT NULL,
  `idclasico` int(10) unsigned DEFAULT NULL,
  `idestadopista` int(10) unsigned NOT NULL DEFAULT '9',
  `numero` int(10) unsigned DEFAULT NULL,
  `fecha_carrera` datetime NOT NULL,
  `desv_standar` decimal(10,0) DEFAULT NULL,
  `nro_llamado` int(10) unsigned DEFAULT NULL,
  `numero_carrera_dia` int(10) unsigned DEFAULT NULL,
  `reunion` int(10) unsigned NOT NULL,
  `serie_carrera` varchar(6) DEFAULT NULL,
  `categoria` int(10) unsigned DEFAULT NULL,
  `trofeo` varchar(200) DEFAULT NULL,
  `integridad` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idpremio` int(10) unsigned NOT NULL,
  `premiototal` decimal(10,2) NOT NULL,
  `cantidad_participantes` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`idcarrera`),
  KEY `FK_tbcarrera_tbclasico` (`idclasico`),
  KEY `FK_tbcarrera_tbdistancia` (`idpistadistancia`),
  KEY `FK_tbcarrera_tbestadopista` (`idestadopista`),
  KEY `tbcarrera_ibfk_5` (`idpremio`),
  CONSTRAINT `tbcarrera_ibfk_1` FOREIGN KEY (`idclasico`) REFERENCES `tbclasico` (`idclasico`),
  CONSTRAINT `tbcarrera_ibfk_3` FOREIGN KEY (`idestadopista`) REFERENCES `tbestadopista` (`idestadopista`),
  CONSTRAINT `tbcarrera_ibfk_4` FOREIGN KEY (`idpistadistancia`) REFERENCES `tbpistadistancia` (`idpistadistancia`),
  CONSTRAINT `tbcarrera_ibfk_5` FOREIGN KEY (`idpremio`) REFERENCES `tbpremios` (`idpremios`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcarrera`
--

LOCK TABLES `tbcarrera` WRITE;
/*!40000 ALTER TABLE `tbcarrera` DISABLE KEYS */;
INSERT INTO `tbcarrera` VALUES (28,15,NULL,6,2,'2015-12-01 04:30:00',NULL,1,NULL,1,NULL,NULL,'TrofeoA',0,'2015-12-01 10:20:34',9,450020.00,2),(29,14,2,7,3,'2015-12-01 16:35:00',NULL,2,NULL,2,NULL,NULL,'TrofeoB',0,'2015-12-01 10:23:44',9,600000.00,2),(30,14,NULL,6,1,'2015-12-01 02:38:00',NULL,3,NULL,3,NULL,NULL,'TrofeoC',0,'2015-12-01 10:26:06',9,250000.00,2),(31,12,NULL,9,4,'2015-12-14 16:00:00',NULL,2,NULL,2,NULL,NULL,NULL,0,'2015-12-14 16:23:51',9,500000.00,2);
/*!40000 ALTER TABLE `tbcarrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcausaretiro`
--

DROP TABLE IF EXISTS `tbcausaretiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcausaretiro` (
  `idcausaretiro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcausaretiro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcausaretiro`
--

LOCK TABLES `tbcausaretiro` WRITE;
/*!40000 ALTER TABLE `tbcausaretiro` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbcausaretiro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbclasico`
--

DROP TABLE IF EXISTS `tbclasico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbclasico` (
  `idclasico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idhipodromo` int(10) unsigned NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT '1',
  `pond` int(10) unsigned NOT NULL,
  `grado` tinyint(3) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(4) NOT NULL DEFAULT '1',
  `patrocinador` varchar(255) DEFAULT '',
  PRIMARY KEY (`idclasico`),
  KEY `FK_tbclasico_tbpais` (`idhipodromo`) USING BTREE,
  CONSTRAINT `kd_tbclasico_1` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbclasico`
--

LOCK TABLES `tbclasico` WRITE;
/*!40000 ALTER TABLE `tbclasico` DISABLE KEYS */;
INSERT INTO `tbclasico` VALUES (1,6,'dsaddadsasdasdasdas',1,12,0,'2015-11-04 19:28:12',1,'prueba'),(2,6,'GRADISCO',1,2,1,'2015-11-19 14:41:18',1,'');
/*!40000 ALTER TABLE `tbclasico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcomentarios`
--

DROP TABLE IF EXISTS `tbcomentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcomentarios` (
  `idcomentarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `idtipocomentario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idcomentarios`),
  KEY `tbcomentario_ibfk_1` (`idtipocomentario`),
  CONSTRAINT `tbcomentario_ibfk_1` FOREIGN KEY (`idtipocomentario`) REFERENCES `tbtipocomentarios` (`idtipocomentario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcomentarios`
--

LOCK TABLES `tbcomentarios` WRITE;
/*!40000 ALTER TABLE `tbcomentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbcomentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcondicion`
--

DROP TABLE IF EXISTS `tbcondicion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcondicion`
--

LOCK TABLES `tbcondicion` WRITE;
/*!40000 ALTER TABLE `tbcondicion` DISABLE KEYS */;
INSERT INTO `tbcondicion` VALUES (11,6,'2015-11-19 14:44:22','GN','Ganador',12,1,32);
/*!40000 ALTER TABLE `tbcondicion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcondicioncarrera`
--

DROP TABLE IF EXISTS `tbcondicioncarrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcondicioncarrera` (
  `idcondicioncarrera` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcarrera` int(10) unsigned NOT NULL,
  `idcondicion` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idcondicioncarrera`),
  KEY `FK_tbcondicioncarrera_tbcarrera` (`idcarrera`),
  KEY `FK_tbcondicioncarrera_tbcondicion` (`idcondicion`),
  CONSTRAINT `tbcondicioncarrera_ibfk_1` FOREIGN KEY (`idcarrera`) REFERENCES `tbcarrera` (`idcarrera`),
  CONSTRAINT `tbcondicioncarrera_ibfk_2` FOREIGN KEY (`idcondicion`) REFERENCES `tbcondicion` (`idcondicion`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcondicioncarrera`
--

LOCK TABLES `tbcondicioncarrera` WRITE;
/*!40000 ALTER TABLE `tbcondicioncarrera` DISABLE KEYS */;
INSERT INTO `tbcondicioncarrera` VALUES (54,30,11),(55,28,11),(56,29,11),(57,31,11);
/*!40000 ALTER TABLE `tbcondicioncarrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcuerpos`
--

DROP TABLE IF EXISTS `tbcuerpos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcuerpos` (
  `idcuerpos` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idcuerpos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcuerpos`
--

LOCK TABLES `tbcuerpos` WRITE;
/*!40000 ALTER TABLE `tbcuerpos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbcuerpos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbdiccionario`
--

DROP TABLE IF EXISTS `tbdiccionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbdiccionario` (
  `idtermino` int(10) unsigned NOT NULL,
  `ididioma` int(10) unsigned NOT NULL,
  `representacion` varchar(55) NOT NULL,
  PRIMARY KEY (`idtermino`,`ididioma`),
  KEY `tbdiccionario_fk_2` (`ididioma`),
  CONSTRAINT `tbdiccionario_fk_1` FOREIGN KEY (`idtermino`) REFERENCES `tbtermino` (`idtermino`),
  CONSTRAINT `tbdiccionario_fk_2` FOREIGN KEY (`ididioma`) REFERENCES `tbidioma` (`ididioma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbdiccionario`
--

LOCK TABLES `tbdiccionario` WRITE;
/*!40000 ALTER TABLE `tbdiccionario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbdiccionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbdistancia`
--

DROP TABLE IF EXISTS `tbdistancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbdistancia` (
  `iddistancia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `distancia` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iddistancia`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbdistancia`
--

LOCK TABLES `tbdistancia` WRITE;
/*!40000 ALTER TABLE `tbdistancia` DISABLE KEYS */;
INSERT INTO `tbdistancia` VALUES (8,1100,'2015-10-28 21:08:55',1),(9,1200,'2015-10-28 21:09:00',1),(10,1300,'2015-10-28 21:09:05',1),(11,1400,'2015-10-28 21:09:09',1),(12,1500,'2015-10-28 21:09:13',1),(13,1600,'2015-10-28 21:09:17',1),(14,1700,'2015-10-28 21:09:22',1),(15,1800,'2015-10-28 21:09:26',1),(16,1900,'2015-10-28 21:09:30',1),(17,2000,'2015-10-28 21:09:34',1),(18,2400,'2015-10-28 21:10:09',1),(19,2800,'2015-10-28 21:10:13',1),(20,3200,'2015-10-28 21:10:18',1),(21,800,'2015-10-30 20:24:41',1),(22,350,'2015-10-30 20:24:53',1),(23,400,'2015-11-02 17:28:07',1),(24,1660,'2015-11-05 21:46:22',1),(25,2200,'2015-11-05 21:47:47',1),(26,2100,'2015-11-19 14:46:09',1);
/*!40000 ALTER TABLE `tbdistancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbdistanciamiento`
--

DROP TABLE IF EXISTS `tbdistanciamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbdistanciamiento` (
  `iddistanciamiento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `abrev` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iddistanciamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbdistanciamiento`
--

LOCK TABLES `tbdistanciamiento` WRITE;
/*!40000 ALTER TABLE `tbdistanciamiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbdistanciamiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbejemplar`
--

DROP TABLE IF EXISTS `tbejemplar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbejemplar`
--

LOCK TABLES `tbejemplar` WRITE;
/*!40000 ALTER TABLE `tbejemplar` DISABLE KEYS */;
INSERT INTO `tbejemplar` VALUES (1,32,4,3,'PADRE_SISTEMA','2015-05-12','MDS',1,NULL,NULL,90000.00,1,1,'2015-07-01 16:13:40',6,4,''),(2,32,4,3,'MADRE_SISTEMA','2015-05-12','PDS',0,NULL,NULL,120000.00,1,1,'2015-07-01 16:13:40',6,4,'');
/*!40000 ALTER TABLE `tbejemplar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbejemplarstatus`
--

DROP TABLE IF EXISTS `tbejemplarstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbejemplarstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbejemplarstatus`
--

LOCK TABLES `tbejemplarstatus` WRITE;
/*!40000 ALTER TABLE `tbejemplarstatus` DISABLE KEYS */;
INSERT INTO `tbejemplarstatus` VALUES (1,'Activo');
/*!40000 ALTER TABLE `tbejemplarstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbentrenador`
--

DROP TABLE IF EXISTS `tbentrenador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbentrenador` (
  `identrenador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpersona` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`identrenador`),
  KEY `FK_tbentrenador_tbpersona` (`idpersona`),
  CONSTRAINT `tbentrenador_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbentrenador`
--

LOCK TABLES `tbentrenador` WRITE;
/*!40000 ALTER TABLE `tbentrenador` DISABLE KEYS */;
INSERT INTO `tbentrenador` VALUES (1,11,'2015-10-13 15:40:10',1),(2,12,'2015-10-13 15:40:13',1),(3,13,'2015-10-13 15:40:17',1),(4,14,'2015-10-13 15:40:20',1),(5,15,'2015-10-13 15:40:37',1),(6,16,'2015-10-13 15:40:43',1),(7,17,'2015-10-13 15:40:48',1),(8,18,'2015-10-13 15:40:52',1),(9,19,'2015-10-13 15:40:56',1),(10,20,'2015-10-13 15:41:06',1);
/*!40000 ALTER TABLE `tbentrenador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `tbentrenador_detallado`
--

DROP TABLE IF EXISTS `tbentrenador_detallado`;
/*!50001 DROP VIEW IF EXISTS `tbentrenador_detallado`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tbentrenador_detallado` (
  `identrenador` tinyint NOT NULL,
  `idpersona` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `primer_apellido` tinyint NOT NULL,
  `primer_nombre` tinyint NOT NULL,
  `nacionalidad` tinyint NOT NULL,
  `rif` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tbestadopista`
--

DROP TABLE IF EXISTS `tbestadopista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbestadopista` (
  `idestadopista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(3) NOT NULL,
  `pond` tinyint(1) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idestadopista`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbestadopista`
--

LOCK TABLES `tbestadopista` WRITE;
/*!40000 ALTER TABLE `tbestadopista` DISABLE KEYS */;
INSERT INTO `tbestadopista` VALUES (5,'Pesada','P',0,'2015-10-28 20:56:36',1),(6,'Liviana','L',5,'2015-10-28 20:58:29',1),(7,'Normal','N',3,'2015-10-28 20:58:47',1),(8,'Fangosa','F',1,'2015-10-28 20:59:05',1),(9,'Por Defecto','PD',0,'2015-12-14 16:06:42',1);
/*!40000 ALTER TABLE `tbestadopista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbgrupo`
--

DROP TABLE IF EXISTS `tbgrupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbgrupo` (
  `idgrupo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idgrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbgrupo`
--

LOCK TABLES `tbgrupo` WRITE;
/*!40000 ALTER TABLE `tbgrupo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbgrupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbgrupopermiso`
--

DROP TABLE IF EXISTS `tbgrupopermiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbgrupopermiso` (
  `idgrupo` int(10) unsigned NOT NULL,
  `idpermiso` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idgrupo`,`idpermiso`),
  KEY `FK_tbgrupopermiso_tbpermiso` (`idpermiso`),
  CONSTRAINT `tbgrupopermiso_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `tbgrupo` (`idgrupo`),
  CONSTRAINT `tbgrupopermiso_ibfk_2` FOREIGN KEY (`idpermiso`) REFERENCES `tbpermiso` (`idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbgrupopermiso`
--

LOCK TABLES `tbgrupopermiso` WRITE;
/*!40000 ALTER TABLE `tbgrupopermiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbgrupopermiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbharas`
--

DROP TABLE IF EXISTS `tbharas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbharas` (
  `idharas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `abrev` varchar(60) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `idpais` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idharas`),
  KEY `tbharas_fk_1` (`idpais`),
  CONSTRAINT `tbharas_fk_1` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbharas`
--

LOCK TABLES `tbharas` WRITE;
/*!40000 ALTER TABLE `tbharas` DISABLE KEYS */;
INSERT INTO `tbharas` VALUES (4,'La Marquesena','Harased guarico','2015-07-02 09:00:30',1,32),(8,'Gran Derby','GB','2015-11-19 14:46:50',1,32),(9,'La Orlyana','LO','2015-11-19 14:47:07',1,32),(10,'La Alhambra','LA','2015-11-19 14:47:23',1,32);
/*!40000 ALTER TABLE `tbharas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbhipodromo`
--

DROP TABLE IF EXISTS `tbhipodromo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena los Hipodromos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbhipodromo`
--

LOCK TABLES `tbhipodromo` WRITE;
/*!40000 ALTER TABLE `tbhipodromo` DISABLE KEYS */;
INSERT INTO `tbhipodromo` VALUES (6,'C','La Rinconada','2015-10-28 20:53:08',32,1),(7,'V','Valencia','2015-10-28 20:53:19',32,1),(8,'Z','Santa Rita','2015-10-28 20:53:30',32,1),(9,'R','Rancho Alegre','2015-10-28 20:53:44',32,1),(10,'B','Benéfico','2015-10-28 20:54:00',32,1),(11,'PR','Presidente Remón','2015-11-02 16:31:41',38,1);
/*!40000 ALTER TABLE `tbhipodromo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbidioma`
--

DROP TABLE IF EXISTS `tbidioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbidioma` (
  `ididioma` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_idioma` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ididioma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbidioma`
--

LOCK TABLES `tbidioma` WRITE;
/*!40000 ALTER TABLE `tbidioma` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbidioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbimplemento`
--

DROP TABLE IF EXISTS `tbimplemento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbimplemento` (
  `idimplemento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idtipoimplemento` int(10) unsigned NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(3) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `defecto` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idimplemento`),
  KEY `FK_tbimplemento_tbtipoimplemento` (`idtipoimplemento`),
  CONSTRAINT `tbimplemento_ibfk_1` FOREIGN KEY (`idtipoimplemento`) REFERENCES `tbtipoimplemento` (`idtipoimplemento`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbimplemento`
--

LOCK TABLES `tbimplemento` WRITE;
/*!40000 ALTER TABLE `tbimplemento` DISABLE KEYS */;
INSERT INTO `tbimplemento` VALUES (5,7,'Gringolas','Gr.','2015-11-05 22:09:37',1,0),(6,8,'Bozal Blanco','BB.','2015-11-05 22:10:28',1,1),(7,7,'Martingalas','M.','2015-11-05 22:11:08',1,0),(8,7,'Lengua Amarrada','La.','2015-11-05 22:11:53',1,0),(9,8,'Bozal en 8','Bz.','2015-11-05 22:12:30',1,0),(10,7,'Guayo','G.','2015-11-05 22:13:11',1,0),(11,7,'Casquillo de Hi','CH.','2015-11-05 22:14:17',1,0),(12,7,'Orejas Taponada','OT','2015-11-19 14:21:22',1,0),(13,7,'Casquillos Corr','CC','2015-11-19 14:32:34',1,0),(14,8,'Látigo','L','2015-11-19 14:59:46',1,0),(15,7,'Butasolidina','B','2015-11-19 16:01:35',1,0),(16,8,'asdsad','as','2015-11-19 16:04:12',1,1);
/*!40000 ALTER TABLE `tbimplemento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbjinete`
--

DROP TABLE IF EXISTS `tbjinete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbjinete`
--

LOCK TABLES `tbjinete` WRITE;
/*!40000 ALTER TABLE `tbjinete` DISABLE KEYS */;
INSERT INTO `tbjinete` VALUES (1,2,60.00,'2','1','2015-09-29 15:38:52'),(2,2,62.00,'3','1','2015-10-13 15:39:09'),(3,3,58.00,'1','1','2015-10-08 15:39:34'),(4,4,59.00,'3','1','2015-10-06 15:39:55'),(5,5,58.00,'2','1','2015-10-01 15:40:17'),(6,6,63.00,'2','1','2015-10-05 15:40:57'),(7,7,55.00,'3','1','2015-10-01 15:41:22'),(8,8,60.00,'2','1','2015-10-07 15:41:35'),(9,9,62.00,'3','1','2015-10-11 15:41:46'),(10,10,57.00,'2','1','2015-10-01 15:42:06');
/*!40000 ALTER TABLE `tbjinete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbjugada`
--

DROP TABLE IF EXISTS `tbjugada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbjugada` (
  `idjugada` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` char(5) DEFAULT NULL,
  `por_defecto` tinyint(1) NOT NULL,
  `idtipojugada` int(10) unsigned NOT NULL,
  `multijugada` tinyint(1) NOT NULL DEFAULT '0',
  `detalle` varchar(255) NOT NULL,
  `cantcarr` smallint(10) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `idjugadabase` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idjugada`),
  KEY `FK_tbjugada_tbtipojugada` (`idtipojugada`),
  KEY `tbjugada_ibfk_3` (`idjugadabase`),
  CONSTRAINT `tbjugada_ibfk_1` FOREIGN KEY (`idtipojugada`) REFERENCES `tbtipojugada` (`idtipojugada`),
  CONSTRAINT `tbjugada_ibfk_3` FOREIGN KEY (`idjugadabase`) REFERENCES `tbjugada` (`idjugada`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbjugada`
--

LOCK TABLES `tbjugada` WRITE;
/*!40000 ALTER TABLE `tbjugada` DISABLE KEYS */;
INSERT INTO `tbjugada` VALUES (17,'asd','asd',0,5,1,'asd',4,1,NULL);
/*!40000 ALTER TABLE `tbjugada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbjugadacarrera`
--

DROP TABLE IF EXISTS `tbjugadacarrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbjugadacarrera` (
  `idjugadacarrera` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idjugada` int(10) unsigned NOT NULL,
  `idcarrera` int(10) unsigned NOT NULL,
  `numero_jugada` int(10) unsigned DEFAULT NULL,
  `dividendo` decimal(10,2) DEFAULT NULL,
  `acumulado` tinyint(4) DEFAULT NULL,
  `garantizado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idjugadacarrera`),
  KEY `FK_tbjugadacarrera_tbjugada` (`idjugada`),
  KEY `FK_tbjugadacarrera_tbcarrera` (`idcarrera`),
  CONSTRAINT `tbjugadacarrera_ibfk_1` FOREIGN KEY (`idcarrera`) REFERENCES `tbcarrera` (`idcarrera`),
  CONSTRAINT `tbjugadacarrera_ibfk_2` FOREIGN KEY (`idjugada`) REFERENCES `tbjugada` (`idjugada`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbjugadacarrera`
--

LOCK TABLES `tbjugadacarrera` WRITE;
/*!40000 ALTER TABLE `tbjugadacarrera` DISABLE KEYS */;
INSERT INTO `tbjugadacarrera` VALUES (1,17,30,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbjugadacarrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbjugadahipodromo`
--

DROP TABLE IF EXISTS `tbjugadahipodromo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbjugadahipodromo` (
  `idhipodromo` int(10) unsigned NOT NULL,
  `idjugada` int(10) unsigned NOT NULL,
  `idjugadahipodromo` int(10) NOT NULL AUTO_INCREMENT,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idjugadahipodromo`),
  KEY `fk_tbjugadahipodromo_1` (`idhipodromo`),
  KEY `fk_tbjugadahipodromo_2` (`idjugada`),
  CONSTRAINT `fk_tbjugadahipodromo_1` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`),
  CONSTRAINT `fk_tbjugadahipodromo_2` FOREIGN KEY (`idjugada`) REFERENCES `tbjugada` (`idjugada`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbjugadahipodromo`
--

LOCK TABLES `tbjugadahipodromo` WRITE;
/*!40000 ALTER TABLE `tbjugadahipodromo` DISABLE KEYS */;
INSERT INTO `tbjugadahipodromo` VALUES (6,17,18,1);
/*!40000 ALTER TABLE `tbjugadahipodromo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpais`
--

DROP TABLE IF EXISTS `tbpais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpais` (
  `idpais` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave Principal de la Tabla',
  `abreviatura` varchar(3) CHARACTER SET latin1 NOT NULL COMMENT 'Abreviatura del Pais',
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL COMMENT 'Nombre del Pais',
  `fecha_registro` datetime NOT NULL COMMENT 'Fecha en la que se creo el registro',
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena los paises';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpais`
--

LOCK TABLES `tbpais` WRITE;
/*!40000 ALTER TABLE `tbpais` DISABLE KEYS */;
INSERT INTO `tbpais` VALUES (32,'VEN','Venezuela','2015-10-26 21:28:21',1),(33,'PER','Péru','2015-10-30 16:19:51',1),(34,'USA','Estados Unidos','2015-10-30 20:14:04',0),(35,'ARG','Argentina','2015-11-02 16:29:37',0),(36,'PAN','Panamá','2015-11-02 16:32:03',1),(37,'RD','Republica Dominicana','2015-11-05 21:32:45',1),(38,'PR','Puerto Rico','2015-11-05 21:37:47',1),(39,'GP','Gulfstream Park','2015-11-19 15:02:51',0),(40,'AQ','Aqueduct','2015-11-19 15:03:17',0),(41,'SA','Santa Anita Park','2015-11-19 15:03:31',0);
/*!40000 ALTER TABLE `tbpais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbparcial`
--

DROP TABLE IF EXISTS `tbparcial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbparcial` (
  `idparcial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `distancia` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idparcial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbparcial`
--

LOCK TABLES `tbparcial` WRITE;
/*!40000 ALTER TABLE `tbparcial` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbparcial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbparticipante_causaretiro_llegada`
--

DROP TABLE IF EXISTS `tbparticipante_causaretiro_llegada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbparticipante_causaretiro_llegada`
--

LOCK TABLES `tbparticipante_causaretiro_llegada` WRITE;
/*!40000 ALTER TABLE `tbparticipante_causaretiro_llegada` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbparticipante_causaretiro_llegada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbparticipante_llamado`
--

DROP TABLE IF EXISTS `tbparticipante_llamado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbparticipante_llamado` (
  `idparticipacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcarrera` int(10) unsigned NOT NULL,
  `idejemplar` int(10) unsigned NOT NULL,
  `identrenador` int(10) unsigned NOT NULL,
  `numero` varchar(3) NOT NULL,
  `llave` varchar(3) DEFAULT NULL,
  `puesto_pista` tinyint(2) NOT NULL,
  `valor_recal` decimal(10,0) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbparticipante_llamado`
--

LOCK TABLES `tbparticipante_llamado` WRITE;
/*!40000 ALTER TABLE `tbparticipante_llamado` DISABLE KEYS */;
INSERT INTO `tbparticipante_llamado` VALUES (92,30,1,2,'1',NULL,1,NULL,3,2,2.00),(93,30,2,1,'2',NULL,2,NULL,3,1,6.00),(94,28,1,9,'1',NULL,1,NULL,3,4,2.00),(95,28,2,1,'2',NULL,2,NULL,3,2,5.00),(96,29,1,5,'1',NULL,1,NULL,3,2,2.00),(97,29,2,2,'2',NULL,2,NULL,3,7,3.00),(98,31,1,2,'2',NULL,2,NULL,3,3,3.00),(99,31,2,1,'1',NULL,1,NULL,3,1,2.00);
/*!40000 ALTER TABLE `tbparticipante_llamado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbparticipante_llegada`
--

DROP TABLE IF EXISTS `tbparticipante_llegada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbparticipante_llegada`
--

LOCK TABLES `tbparticipante_llegada` WRITE;
/*!40000 ALTER TABLE `tbparticipante_llegada` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbparticipante_llegada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbparticipante_parcial`
--

DROP TABLE IF EXISTS `tbparticipante_parcial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbparticipante_parcial`
--

LOCK TABLES `tbparticipante_parcial` WRITE;
/*!40000 ALTER TABLE `tbparticipante_parcial` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbparticipante_parcial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpartimplementollamado`
--

DROP TABLE IF EXISTS `tbpartimplementollamado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpartimplementollamado` (
  `idpartllamadoimplemento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idimplemento` int(10) unsigned NOT NULL,
  `idparticipantellamado` int(10) unsigned NOT NULL,
  `ponderacion` smallint(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idpartllamadoimplemento`),
  KEY `FK_tbimplemento_participante_tbparcipante` (`idparticipantellamado`),
  KEY `FK_tbimplemento_participante_tbimplemento` (`idimplemento`),
  CONSTRAINT `tbpartimplementollamado_ibfk_1` FOREIGN KEY (`idimplemento`) REFERENCES `tbimplemento` (`idimplemento`),
  CONSTRAINT `tbpartimplementollamado_ibfk_2` FOREIGN KEY (`idparticipantellamado`) REFERENCES `tbparticipante_llamado` (`idparticipacion`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpartimplementollamado`
--

LOCK TABLES `tbpartimplementollamado` WRITE;
/*!40000 ALTER TABLE `tbpartimplementollamado` DISABLE KEYS */;
INSERT INTO `tbpartimplementollamado` VALUES (154,6,92,NULL),(155,16,92,NULL),(156,6,93,NULL),(157,16,93,NULL),(158,6,94,NULL),(159,16,94,NULL),(160,6,95,NULL),(161,16,95,NULL),(162,6,96,NULL),(163,16,96,NULL),(164,6,97,NULL),(165,16,97,NULL),(166,6,98,NULL),(167,16,98,NULL),(168,6,99,NULL),(169,16,99,NULL);
/*!40000 ALTER TABLE `tbpartimplementollamado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpermiso`
--

DROP TABLE IF EXISTS `tbpermiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpermiso` (
  `idpermiso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conjunto` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL,
  `privado` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpermiso`
--

LOCK TABLES `tbpermiso` WRITE;
/*!40000 ALTER TABLE `tbpermiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbpermiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpersona`
--

DROP TABLE IF EXISTS `tbpersona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpersona` (
  `idpersona` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `primer_apellido` varchar(45) NOT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `primer_nombre` varchar(45) NOT NULL,
  `segundo_nombre` varchar(45) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre_abrev` varchar(15) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `nacionalidad` char(1) NOT NULL,
  `rif` varchar(15) NOT NULL,
  `usuario` int(1) DEFAULT '0',
  `jinete` int(1) DEFAULT '0',
  `propietario` int(1) DEFAULT '0',
  `entrenador` int(1) DEFAULT '0',
  PRIMARY KEY (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpersona`
--

LOCK TABLES `tbpersona` WRITE;
/*!40000 ALTER TABLE `tbpersona` DISABLE KEYS */;
INSERT INTO `tbpersona` VALUES (1,'Malaver','Valderrama','Roberto','','2015-10-13 10:25:40','RM','23502393','P','23502393',0,1,0,0),(2,'Mendoza','Hernandez','Carlos','','2015-10-13 10:28:38','CM','20504015','V','20504015',0,1,0,0),(3,'Peñaloza','Rendon','Adrian','','2015-10-13 10:29:57','AP','21247605','V','212476052',0,1,0,0),(4,'Gozalez','Borges','Victor','','2015-10-13 10:37:33','VG','20359878','V','2035987',0,1,0,0),(5,'Castellano','Luzardo','Abel','','2015-10-14 10:39:50','AC','10529895','V','10529895',0,1,0,0),(6,'Castro','Ruiz','Julio','','2015-10-13 10:40:53','JC','95874546','V','95874546',0,1,0,0),(7,'Gomez','Roman','Carlos','','2015-10-06 10:56:26','CG','20521145','V','205211452',0,1,0,0),(8,'Silva','Malave','Mario','','2015-10-13 10:59:42','MS','23621421','V','236214214',0,1,0,0),(9,'Rodriguez','Suarez','Juan','','2015-10-13 11:00:28','JR','9456235','V','94562355',0,1,0,0),(10,'Perez','Alfonso','Ricardo',' ','2015-10-13 11:01:49','RP','20632145','V','206321451',0,1,0,0),(11,'Sulbaran','Herrera','Kellys','','2015-10-13 11:02:56','KS','20178987','V','201789872',0,0,0,1),(12,'Garcia','Zuñiga','Betsy','','2015-10-13 11:03:37','BG','26452056','V','264520561',0,0,0,1),(13,'Malpica','','Dulce','','2015-10-13 11:04:22','DM','18752257','V','187522573',0,0,0,1),(14,'Salazar','Rodriguez','Keyla','','2015-10-13 11:05:15','KS','19232456','V','192324562',0,0,0,1),(15,'Rodriguez','Carrasco','Osneida','','2015-10-13 11:05:52','OR','22456789','V','224567893',0,0,0,1),(16,'Rendon','Muñoz','Andreina','','2015-10-13 11:06:31','AR','11728132','V','117281324',0,0,0,1),(17,'Peñaloza','Rendon','Andrea','','2015-10-13 11:07:06','AP','26852963','V','268529633',0,0,0,1),(18,'Colmenarez','Barros','Jenny','','2015-10-13 11:08:21','JC','14258369','V','142583695',0,0,0,1),(19,'Rengel','Perez','Keissy','','2015-10-13 11:10:05','KR','21951753','V','219517532',0,0,0,1),(20,'Cordero','Giron','Yxzandra','','2015-10-13 11:10:48','YC','23654987','V','236549872',0,0,0,1);
/*!40000 ALTER TABLE `tbpersona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpista`
--

DROP TABLE IF EXISTS `tbpista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  CONSTRAINT `tbpista_ibfk_1` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`),
  CONSTRAINT `tbpista_ibfk_1
tbpista_ibfk_1
tbtipohipodromodistancia_ibfk_2` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`),
  CONSTRAINT `tbpista_ibfk_2` FOREIGN KEY (`idtipopista`) REFERENCES `tbtipopista` (`idtipopista`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpista`
--

LOCK TABLES `tbpista` WRITE;
/*!40000 ALTER TABLE `tbpista` DISABLE KEYS */;
INSERT INTO `tbpista` VALUES (7,'Principal',11,6,1),(8,'Interna',11,8,1),(9,'Grama',12,7,1);
/*!40000 ALTER TABLE `tbpista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpistadistancia`
--

DROP TABLE IF EXISTS `tbpistadistancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpistadistancia`
--

LOCK TABLES `tbpistadistancia` WRITE;
/*!40000 ALTER TABLE `tbpistadistancia` DISABLE KEYS */;
INSERT INTO `tbpistadistancia` VALUES (7,9,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(8,9,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(9,9,23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(10,8,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(11,8,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(12,7,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(13,7,23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(14,7,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(15,9,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(16,9,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `tbpistadistancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpremios`
--

DROP TABLE IF EXISTS `tbpremios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpremios`
--

LOCK TABLES `tbpremios` WRITE;
/*!40000 ALTER TABLE `tbpremios` DISABLE KEYS */;
INSERT INTO `tbpremios` VALUES (9,'Estandar',50,25,15,5,5,1,7);
/*!40000 ALTER TABLE `tbpremios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpronostico`
--

DROP TABLE IF EXISTS `tbpronostico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpronostico`
--

LOCK TABLES `tbpronostico` WRITE;
/*!40000 ALTER TABLE `tbpronostico` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbpronostico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpropietario`
--

DROP TABLE IF EXISTS `tbpropietario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpropietario` (
  `idpropietario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpersona` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`idpropietario`),
  KEY `FK_tbentrenador_tbpersona` (`idpersona`) USING BTREE,
  CONSTRAINT `tbpropietario_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpropietario`
--

LOCK TABLES `tbpropietario` WRITE;
/*!40000 ALTER TABLE `tbpropietario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbpropietario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpropietariostud`
--

DROP TABLE IF EXISTS `tbpropietariostud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpropietariostud` (
  `idstud` int(10) unsigned NOT NULL,
  `idpropietario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idstud`,`idpropietario`),
  KEY `tbstudprop_llamado_ibfk_2` (`idpropietario`),
  CONSTRAINT `tbstudprop_llamado_ibfk_1` FOREIGN KEY (`idstud`) REFERENCES `tbstud` (`idstud`),
  CONSTRAINT `tbstudprop_llamado_ibfk_2` FOREIGN KEY (`idpropietario`) REFERENCES `tbpropietario` (`idpropietario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpropietariostud`
--

LOCK TABLES `tbpropietariostud` WRITE;
/*!40000 ALTER TABLE `tbpropietariostud` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbpropietariostud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbrevista`
--

DROP TABLE IF EXISTS `tbrevista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbrevista`
--

LOCK TABLES `tbrevista` WRITE;
/*!40000 ALTER TABLE `tbrevista` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbrevista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbrevista_circulacion`
--

DROP TABLE IF EXISTS `tbrevista_circulacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbrevista_circulacion` (
  `idpais` int(10) unsigned DEFAULT NULL,
  `idrevista` int(10) unsigned DEFAULT NULL,
  KEY `fk_revista_circulacion` (`idpais`),
  KEY `fk_revista_circulacion_1` (`idrevista`),
  CONSTRAINT `fk_revista_circulacion` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`),
  CONSTRAINT `fk_revista_circulacion_1` FOREIGN KEY (`idrevista`) REFERENCES `tbrevista` (`idrevista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbrevista_circulacion`
--

LOCK TABLES `tbrevista_circulacion` WRITE;
/*!40000 ALTER TABLE `tbrevista_circulacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbrevista_circulacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbrevista_unidades`
--

DROP TABLE IF EXISTS `tbrevista_unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbrevista_unidades` (
  `idrevista_unidades` int(10) unsigned NOT NULL,
  `idrevista` int(10) unsigned NOT NULL,
  `id_unidad` int(10) unsigned NOT NULL,
  KEY `tbrevista_unidades_ibfk_1` (`idrevista`),
  KEY `tbrevista_unidades_ibfk_2` (`id_unidad`),
  CONSTRAINT `tbrevista_unidades_ibfk_1` FOREIGN KEY (`idrevista`) REFERENCES `tbrevista` (`idrevista`),
  CONSTRAINT `tbrevista_unidades_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `tbunidades` (`idunidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbrevista_unidades`
--

LOCK TABLES `tbrevista_unidades` WRITE;
/*!40000 ALTER TABLE `tbrevista_unidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbrevista_unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbstud`
--

DROP TABLE IF EXISTS `tbstud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbstud`
--

LOCK TABLES `tbstud` WRITE;
/*!40000 ALTER TABLE `tbstud` DISABLE KEYS */;
INSERT INTO `tbstud` VALUES (3,'StudA','ROJO','2015-07-02 09:09:21',1,32),(6,'Prueba Dos','Camisa mangas y gorra azul H espalda','2015-11-16 20:44:43',1,32),(7,'Prueba 3','doicweo hweoi hwoeh foweij osi','2015-11-16 20:45:16',1,32);
/*!40000 ALTER TABLE `tbstud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtermino`
--

DROP TABLE IF EXISTS `tbtermino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtermino` (
  `idtermino` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref_termino` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`idtermino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtermino`
--

LOCK TABLES `tbtermino` WRITE;
/*!40000 ALTER TABLE `tbtermino` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbtermino` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipocomentarios`
--

DROP TABLE IF EXISTS `tbtipocomentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipocomentarios` (
  `idtipocomentario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipocomentario` varchar(45) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipocomentario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipocomentarios`
--

LOCK TABLES `tbtipocomentarios` WRITE;
/*!40000 ALTER TABLE `tbtipocomentarios` DISABLE KEYS */;
INSERT INTO `tbtipocomentarios` VALUES (7,'Carrera',1),(8,'Pronóstico',1),(9,'Traqueo',1);
/*!40000 ALTER TABLE `tbtipocomentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipocondicion`
--

DROP TABLE IF EXISTS `tbtipocondicion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipocondicion` (
  `idtipocondicion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipocond_pond` tinyint(10) NOT NULL,
  `tipocond_orden` tinyint(10) NOT NULL,
  `tipocond_multiple` tinyint(1) NOT NULL DEFAULT '0',
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipocondicion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipocondicion`
--

LOCK TABLES `tbtipocondicion` WRITE;
/*!40000 ALTER TABLE `tbtipocondicion` DISABLE KEYS */;
INSERT INTO `tbtipocondicion` VALUES (6,'asd','2015-11-19 14:43:06',12,1,1,1,0);
/*!40000 ALTER TABLE `tbtipocondicion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipoimplemento`
--

DROP TABLE IF EXISTS `tbtipoimplemento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipoimplemento` (
  `idtipoimplemento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(5) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipoimplemento`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipoimplemento`
--

LOCK TABLES `tbtipoimplemento` WRITE;
/*!40000 ALTER TABLE `tbtipoimplemento` DISABLE KEYS */;
INSERT INTO `tbtipoimplemento` VALUES (7,'Medicamento','Med','2015-11-05 22:08:41',1),(8,'Implemento','Im','2015-11-16 20:32:56',1);
/*!40000 ALTER TABLE `tbtipoimplemento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipojugada`
--

DROP TABLE IF EXISTS `tbtipojugada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipojugada` (
  `idtipojugada` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipojugada`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipojugada`
--

LOCK TABLES `tbtipojugada` WRITE;
/*!40000 ALTER TABLE `tbtipojugada` DISABLE KEYS */;
INSERT INTO `tbtipojugada` VALUES (5,'Básica','2015-11-16 20:38:02',1),(6,'Compuesta','2015-11-16 20:38:12',1);
/*!40000 ALTER TABLE `tbtipojugada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipoorigen`
--

DROP TABLE IF EXISTS `tbtipoorigen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipoorigen` (
  `idtipoorigen` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `abreviatura` varchar(4) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipoorigen`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipoorigen`
--

LOCK TABLES `tbtipoorigen` WRITE;
/*!40000 ALTER TABLE `tbtipoorigen` DISABLE KEYS */;
INSERT INTO `tbtipoorigen` VALUES (4,'Nacional','2015-07-02 09:02:58','NAC',1),(6,'ImportadVientre','2015-11-19 14:53:57','IV',1);
/*!40000 ALTER TABLE `tbtipoorigen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipopelaje`
--

DROP TABLE IF EXISTS `tbtipopelaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipopelaje` (
  `idtipopelaje` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `fecharegistro` datetime NOT NULL,
  `abreviatura` char(1) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipopelaje`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipopelaje`
--

LOCK TABLES `tbtipopelaje` WRITE;
/*!40000 ALTER TABLE `tbtipopelaje` DISABLE KEYS */;
INSERT INTO `tbtipopelaje` VALUES (6,'Castano','2015-07-02 09:07:01','C',1),(10,'Tordillo','2015-11-19 14:55:35','T',1),(11,'Alazán','2015-11-19 14:55:45','A',1),(12,'Zaino','2015-11-19 14:55:56','Z',1);
/*!40000 ALTER TABLE `tbtipopelaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipopista`
--

DROP TABLE IF EXISTS `tbtipopista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipopista` (
  `idtipopista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipopista`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipopista`
--

LOCK TABLES `tbtipopista` WRITE;
/*!40000 ALTER TABLE `tbtipopista` DISABLE KEYS */;
INSERT INTO `tbtipopista` VALUES (11,'Arena',1),(12,'Grama',1);
/*!40000 ALTER TABLE `tbtipopista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipounidades`
--

DROP TABLE IF EXISTS `tbtipounidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipounidades` (
  `idtipounidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombretipounidad` varchar(45) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipounidad`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipounidades`
--

LOCK TABLES `tbtipounidades` WRITE;
/*!40000 ALTER TABLE `tbtipounidades` DISABLE KEYS */;
INSERT INTO `tbtipounidades` VALUES (6,'Dolar',1),(7,'Bolivares',1);
/*!40000 ALTER TABLE `tbtipounidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtraqueos`
--

DROP TABLE IF EXISTS `tbtraqueos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtraqueos`
--

LOCK TABLES `tbtraqueos` WRITE;
/*!40000 ALTER TABLE `tbtraqueos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbtraqueos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtropiezo`
--

DROP TABLE IF EXISTS `tbtropiezo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtropiezo` (
  `idtropiezo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(5) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtropiezo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtropiezo`
--

LOCK TABLES `tbtropiezo` WRITE;
/*!40000 ALTER TABLE `tbtropiezo` DISABLE KEYS */;
INSERT INTO `tbtropiezo` VALUES (5,'Partió Mal','PMal','2015-11-05 21:51:03',1),(6,'Cargó Afuera','CAfue','2015-11-05 21:51:58',1),(7,'Cargó Adentro','CAden','2015-11-05 21:52:30',1),(8,'Sintió Mal','SMal','2015-11-05 21:53:11',1),(9,'Claudicó','Claud','2015-11-05 21:53:54',1),(10,'Golpe Aparato','GApto','2015-11-05 21:54:40',1),(11,'Perdio Estribos','PE','2015-11-19 14:48:23',1),(12,'Rodó','Rodo','2015-11-19 14:48:49',1),(13,'Tropiezos Iniciales','TIni','2015-11-19 14:49:13',1),(14,'Tropiezos Finales','TFin','2015-11-19 14:49:22',1);
/*!40000 ALTER TABLE `tbtropiezo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbunidades`
--

DROP TABLE IF EXISTS `tbunidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbunidades` (
  `idunidad` int(10) unsigned NOT NULL,
  `factor` decimal(10,2) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `idtipounidad` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idunidad`),
  KEY `tbunidades_ibfk_1` (`idtipounidad`),
  CONSTRAINT `tbunidades_ibfk_1` FOREIGN KEY (`idtipounidad`) REFERENCES `tbtipounidades` (`idtipounidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbunidades`
--

LOCK TABLES `tbunidades` WRITE;
/*!40000 ALTER TABLE `tbunidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbunidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbusuario`
--

DROP TABLE IF EXISTS `tbusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbusuario`
--

LOCK TABLES `tbusuario` WRITE;
/*!40000 ALTER TABLE `tbusuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbusuariopermiso`
--

DROP TABLE IF EXISTS `tbusuariopermiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbusuariopermiso` (
  `idusuario` int(10) unsigned NOT NULL,
  `idpermiso` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idusuario`,`idpermiso`),
  KEY `idpermiso` (`idpermiso`),
  CONSTRAINT `tbusuariopermiso_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `tbusuario` (`idusuario`),
  CONSTRAINT `tbusuariopermiso_ibfk_2` FOREIGN KEY (`idpermiso`) REFERENCES `tbpermiso` (`idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbusuariopermiso`
--

LOCK TABLES `tbusuariopermiso` WRITE;
/*!40000 ALTER TABLE `tbusuariopermiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbusuariopermiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbusuarios_unidades`
--

DROP TABLE IF EXISTS `tbusuarios_unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbusuarios_unidades` (
  `idrevista_unidades` int(10) unsigned NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `id_unidad` int(10) unsigned NOT NULL,
  KEY `tbrevista_unidades_ibfk_1` (`idusuario`),
  KEY `tbrevista_unidades_ibfk_2` (`id_unidad`),
  CONSTRAINT `tbusuarios_unidades_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `tbusuario` (`idusuario`),
  CONSTRAINT `tbusuarios_unidades_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `tbunidades` (`idunidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbusuarios_unidades`
--

LOCK TABLES `tbusuarios_unidades` WRITE;
/*!40000 ALTER TABLE `tbusuarios_unidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbusuarios_unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'hipica1'
--
/*!50003 DROP FUNCTION IF EXISTS `anual` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `anual`(x int(20)) RETURNS int(50)
    DETERMINISTIC
BEGIN
DECLARE fecha_actual DATETIME;

	DECLARE cantidad int;

	DECLARE hipodromo int;



	

	SELECT tbcarrera.fecha_carrera,tbpista.idhipodromo INTO fecha_actual,hipodromo FROM tbcarrera

		INNER JOIN tbpistadistancia ON (tbpistadistancia.idpistadistancia=tbcarrera.idpistadistancia)

		INNER JOIN tbpista ON (tbpista.idpista=tbpistadistancia.idpista) WHERE tbcarrera.idcarrera=x;





	SET cantidad=(SELECT COUNT(*) FROM tbcarrera

		INNER JOIN tbpistadistancia ON (tbpistadistancia.idpistadistancia=tbcarrera.idpistadistancia)

		INNER JOIN tbpista ON (tbpista.idpista=tbpistadistancia.idpista) WHERE YEAR(fecha_actual)=YEAR(tbcarrera.fecha_carrera) AND tbpista.idhipodromo=hipodromo AND tbcarrera.fecha_carrera<=fecha_actual AND tbcarrera.idcarrera!=x GROUP BY tbpista.idhipodromo );



	SET cantidad= IFNULL(cantidad,0);

	SET cantidad=cantidad + 1;



	return cantidad;



end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `posicion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`test`@`%` FUNCTION `posicion`(idcarr int(20)) RETURNS int(50)
    DETERMINISTIC
BEGIN
DECLARE aux INT;
DECLARE fec datetime;
SET fec=(SELECT tbcarrera.fecha_carrera from tbcarrera WHERE idcarrera=idcarr);


SET aux = (SELECT COUNT(*) from tbcarrera INNER JOIN(tbpistadistancia, tbpista, tbhipodromo)
ON (tbpistadistancia.idpistadistancia=tbcarrera.idpistadistancia AND tbpistadistancia.idpista=tbpista.idpista AND tbpista.idhipodromo=tbhipodromo.idhipodromo)  WHERE YEAR(tbcarrera.fecha_carrera) = YEAR(fec) and tbcarrera.fecha_carrera<fec  GROUP BY tbhipodromo.idhipodromo); 
		-- 
    RETURN IFNULL((aux),0);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `tbentrenador_detallado`
--

/*!50001 DROP TABLE IF EXISTS `tbentrenador_detallado`*/;
/*!50001 DROP VIEW IF EXISTS `tbentrenador_detallado`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `tbentrenador_detallado` AS select `a`.`identrenador` AS `identrenador`,`a`.`idpersona` AS `idpersona`,`a`.`status` AS `status`,`b`.`primer_apellido` AS `primer_apellido`,`b`.`primer_nombre` AS `primer_nombre`,`b`.`nacionalidad` AS `nacionalidad`,`b`.`rif` AS `rif` from (`tbentrenador` `a` join `tbpersona` `b`) where (`a`.`idpersona` = `b`.`idpersona`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-15 14:17:01
