-- MySQL dump 10.15  Distrib 10.0.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: hipica_roberto
-- ------------------------------------------------------
-- Server version	10.0.13-MariaDB

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
INSERT INTO `par_subproductos` VALUES ('ANV','EDICION ANIVERSARIO','EAN'),('ANV','EDICION ANIVERSARIO','NPG'),('BAN','BANNER','WEB'),('BSA','BIENESTAR Y SALUD','CRN'),('CAD','CANCHA ADENTRO','CRN'),('CAL','CALENTAMIENTO','CRN'),('CDB','CIUDAD BOLIVAR','NPG'),('CDG','EDICION GUAYANA','NPG'),('COM','COMUNIDAD','NPG'),('CON','CONTRAPORTADA','CRN'),('CON','CONTRAPORTADA','NPG'),('COP','COMBO PERFECTO','QC'),('CUL','CULTURA','NPG'),('DEP','DEPORTES','NPG'),('DES','DESPLEGADOS','DN'),('ECF','ECONOMIA Y FINANZAS','NPG'),('EDE','EDICION ESPECIAL','NPG'),('EDU','EDUCACION','NPG'),('EMP','EMPRESAS','NPG'),('ESP','ESPECTACULOS','NPG'),('GUC','GUIA COMERCIAL','QC'),('GUM','GUIA MEDICA','QC'),('HOM','HOMBRES','NPG'),('INF','INFORMACION','NPG'),('INM','INMOBILIARIAS','QC'),('INT','INTERNACIONALES','NPG'),('LAB','LABORAL','NPG'),('MDH','MUJER DE HOY','NPG'),('NAC','NACIONALES','NPG'),('OPN','OPINION','NPG'),('OTR','OTROS','DN'),('OTR','OTROS','DT'),('OTR','OTROS','ESTG'),('OTR','OTROS','NPG'),('OTR','OTROS','NPO'),('OTR','OTROS','NWG'),('OTR','OTROS','QC'),('PAE','PAGINAS ESPECIALES','NPG'),('PAI','PAGINAS INTERNAS','QC'),('PAT','PATROCINIOS','DN'),('PER','PERSONAJES','CRN'),('POL','POLITICA','NPG'),('POR','PORTADA','NPG'),('POR','PORTADA','QC'),('PRE','PREMIUM','DN'),('PTD','PORTADA','CRN'),('SAL','SALUD','NPG'),('SUC','SUCESOS','NPG'),('SUR','SUR','NPG'),('TAP','TAPETE','CRN'),('TEX','TIEMPO EXTRA','CRN'),('ULP','ULTIMA PAGINA','QC'),('VER','VENDE RAPIDO','QC'),('VIC','VITRINA COMERCIAL','DN');
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcarrera`
--

LOCK TABLES `tbcarrera` WRITE;
/*!40000 ALTER TABLE `tbcarrera` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcausaretiro`
--

LOCK TABLES `tbcausaretiro` WRITE;
/*!40000 ALTER TABLE `tbcausaretiro` DISABLE KEYS */;
INSERT INTO `tbcausaretiro` VALUES (4,'Lesion','2015-07-01 15:55:05',0),(5,'Muerte','2015-07-01 15:55:17',1),(6,'Pelea','2015-07-01 15:55:25',1);
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
  `tipo` varchar(1) NOT NULL,
  `pond` int(10) unsigned NOT NULL,
  `grado` tinyint(3) unsigned NOT NULL,
  `fecha_registro` varchar(45) NOT NULL,
  PRIMARY KEY (`idclasico`),
  KEY `FK_tbclasico_tbpais` (`idhipodromo`) USING BTREE,
  CONSTRAINT `kd_tbclasico_1` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbclasico`
--

LOCK TABLES `tbclasico` WRITE;
/*!40000 ALTER TABLE `tbclasico` DISABLE KEYS */;
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
  `cond_orden` tinyint(10) DEFAULT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcondicion`),
  KEY `FK_tbcondiciion_tbtipocondicion` (`idtipocondicion`),
  CONSTRAINT `tbcondicion_ibfk_1` FOREIGN KEY (`idtipocondicion`) REFERENCES `tbtipocondicion` (`idtipocondicion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcondicion`
--

LOCK TABLES `tbcondicion` WRITE;
/*!40000 ALTER TABLE `tbcondicion` DISABLE KEYS */;
INSERT INTO `tbcondicion` VALUES (6,2,'2015-07-01 16:00:05','CNE','Condicionale',2,3,0),(7,2,'2015-07-01 16:00:57','MNR','Menores',3,1,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcondicioncarrera`
--

LOCK TABLES `tbcondicioncarrera` WRITE;
/*!40000 ALTER TABLE `tbcondicioncarrera` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbdistancia`
--

LOCK TABLES `tbdistancia` WRITE;
/*!40000 ALTER TABLE `tbdistancia` DISABLE KEYS */;
INSERT INTO `tbdistancia` VALUES (1,500,'2015-07-01 16:06:40',1),(2,400,'2015-07-01 16:06:46',1),(3,105,'2015-07-01 16:06:59',0);
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
  `peso` decimal(12,2) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `castrado` tinyint(1) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idtipopelaje` int(10) unsigned NOT NULL,
  `idtipoorigen` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idejemplar`),
  KEY `FK_tbejemplar_tbpais` (`idpais`),
  KEY `FK_tbejemplar_tbharas` (`idharas`),
  KEY `FK_tbejemplar_tbstud` (`idstud`),
  KEY `FK_tbejemplar_tbejemplar_padre` (`idejemplarpadre`),
  KEY `FK_tbejemplar_tbejemplar_madre` (`idejemplarmadre`),
  KEY `FK_tbejemplar_tbtipopelaje` (`idtipopelaje`),
  KEY `tbejemplar_ibfk_8` (`idtipoorigen`),
  CONSTRAINT `tbejemplar_ibfk_2` FOREIGN KEY (`idejemplarmadre`) REFERENCES `tbejemplar` (`idejemplar`),
  CONSTRAINT `tbejemplar_ibfk_3` FOREIGN KEY (`idejemplarpadre`) REFERENCES `tbejemplar` (`idejemplar`),
  CONSTRAINT `tbejemplar_ibfk_4` FOREIGN KEY (`idharas`) REFERENCES `tbharas` (`idharas`),
  CONSTRAINT `tbejemplar_ibfk_5` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`),
  CONSTRAINT `tbejemplar_ibfk_6` FOREIGN KEY (`idstud`) REFERENCES `tbstud` (`idstud`),
  CONSTRAINT `tbejemplar_ibfk_7` FOREIGN KEY (`idtipopelaje`) REFERENCES `tbtipopelaje` (`idtipopelaje`),
  CONSTRAINT `tbejemplar_ibfk_8` FOREIGN KEY (`idtipoorigen`) REFERENCES `tbtipoorigen` (`idtipoorigen`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbejemplar`
--

LOCK TABLES `tbejemplar` WRITE;
/*!40000 ALTER TABLE `tbejemplar` DISABLE KEYS */;
INSERT INTO `tbejemplar` VALUES (1,3,2,1,'Gazel','2015-05-12','GAZ',1,NULL,NULL,2.00,90000.00,1,1,'2015-07-01 16:13:40',3,1),(2,3,2,1,'Brisa marina','2015-05-12','BMA',0,NULL,NULL,2.00,120000.00,1,1,'2015-07-01 16:13:40',3,1),(3,2,2,1,'Prada ','2015-04-13','PRD',1,1,2,9.00,50000.00,1,0,'2015-07-01 16:20:12',3,1),(4,3,2,1,'Vengadora','2014-12-02','VGN',0,1,2,5.00,10000.00,1,1,'2015-07-01 16:21:07',3,1),(9,12,3,2,'Atila','2006-01-24','ATI',1,2,3,6.00,150000.00,1,1,'2015-05-12 00:01:52',2,1);
/*!40000 ALTER TABLE `tbejemplar` ENABLE KEYS */;
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
  `fecha_registro` datetime NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`identrenador`),
  KEY `FK_tbentrenador_tbpersona` (`idpersona`),
  CONSTRAINT `tbentrenador_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbentrenador`
--

LOCK TABLES `tbentrenador` WRITE;
/*!40000 ALTER TABLE `tbentrenador` DISABLE KEYS */;
INSERT INTO `tbentrenador` VALUES (1,2,'2015-07-01 10:04:56','1'),(2,3,'2015-07-01 10:05:03','1');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbestadopista`
--

LOCK TABLES `tbestadopista` WRITE;
/*!40000 ALTER TABLE `tbestadopista` DISABLE KEYS */;
INSERT INTO `tbestadopista` VALUES (1,'DETRO','DTR',9,'2015-07-01 16:33:52',1),(2,'NUEVOE','NVE',5,'2015-07-01 16:34:08',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbgrupo`
--

LOCK TABLES `tbgrupo` WRITE;
/*!40000 ALTER TABLE `tbgrupo` DISABLE KEYS */;
INSERT INTO `tbgrupo` VALUES (1,'Sistemas');
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
  `descripcion` varchar(60) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idharas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbharas`
--

LOCK TABLES `tbharas` WRITE;
/*!40000 ALTER TABLE `tbharas` DISABLE KEYS */;
INSERT INTO `tbharas` VALUES (1,'HRA','HARA','2015-06-30 14:37:53',1),(2,'NVM','NUEVAH','2015-06-30 14:38:08',1),(3,'HARAPRUEBA','harapdd','2015-07-01 16:36:00',1);
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
  `abreviatura` varchar(5) NOT NULL COMMENT 'Abreviatura del Hipodromo',
  `descripcion` varchar(45) NOT NULL COMMENT 'Descripción del Hipodromo',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se creo el registro',
  `idpais` int(10) unsigned NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idhipodromo`),
  KEY `FK_tbhipodromo_tbpais` (`idpais`),
  CONSTRAINT `tbhipodromo_ibfk_1` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena los Hipodromos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbhipodromo`
--

LOCK TABLES `tbhipodromo` WRITE;
/*!40000 ALTER TABLE `tbhipodromo` DISABLE KEYS */;
INSERT INTO `tbhipodromo` VALUES (1,'HP2','Hipodromo 1','2015-06-23 13:32:25',5,1),(2,'HP1','Hipodromo 2','2015-06-23 13:32:37',2,1);
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
  `abreviatura` varchar(4) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idimplemento`),
  KEY `FK_tbimplemento_tbtipoimplemento` (`idtipoimplemento`),
  CONSTRAINT `tbimplemento_ibfk_1` FOREIGN KEY (`idtipoimplemento`) REFERENCES `tbtipoimplemento` (`idtipoimplemento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbimplemento`
--

LOCK TABLES `tbimplemento` WRITE;
/*!40000 ALTER TABLE `tbimplemento` DISABLE KEYS */;
INSERT INTO `tbimplemento` VALUES (1,1,'Silla','SIL','2015-06-29 14:16:26',1),(2,1,'OTRO','OTR','2015-06-29 14:17:45',1),(3,1,'OTROs','OTE','2015-06-29 14:18:11',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbjinete`
--

LOCK TABLES `tbjinete` WRITE;
/*!40000 ALTER TABLE `tbjinete` DISABLE KEYS */;
INSERT INTO `tbjinete` VALUES (1,1,90.00,'1','1','2015-06-30 09:15:37'),(2,2,70.00,'1','1','2015-07-02 09:15:57');
/*!40000 ALTER TABLE `tbjinete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `tbjinete_detallado`
--

DROP TABLE IF EXISTS `tbjinete_detallado`;
/*!50001 DROP VIEW IF EXISTS `tbjinete_detallado`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tbjinete_detallado` (
  `idjinete` tinyint NOT NULL,
  `idpersona` tinyint NOT NULL,
  `peso` tinyint NOT NULL,
  `nivel` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `primer_apellido` tinyint NOT NULL,
  `primer_nombre` tinyint NOT NULL,
  `nacionalidad` tinyint NOT NULL,
  `rif` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tbjugada`
--

DROP TABLE IF EXISTS `tbjugada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbjugada` (
  `idjugada` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `por_defecto` tinyint(1) NOT NULL,
  `idtipojugada` int(10) unsigned NOT NULL,
  `multijugada` tinyint(1) NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `cantcarr` smallint(10) NOT NULL,
  `idpais` int(10) unsigned NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idjugada`),
  KEY `FK_tbjugada_tbtipojugada` (`idtipojugada`),
  KEY `tbjugada_ibfk_2` (`idpais`),
  CONSTRAINT `tbjugada_ibfk_1` FOREIGN KEY (`idtipojugada`) REFERENCES `tbtipojugada` (`idtipojugada`),
  CONSTRAINT `tbjugada_ibfk_2` FOREIGN KEY (`idpais`) REFERENCES `tbpais` (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbjugada`
--

LOCK TABLES `tbjugada` WRITE;
/*!40000 ALTER TABLE `tbjugada` DISABLE KEYS */;
INSERT INTO `tbjugada` VALUES (1,'Prueba',1,2,1,'DET',2,4,1),(2,'Pruebab',1,2,0,'DET',2,4,1);
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbjugadacarrera`
--

LOCK TABLES `tbjugadacarrera` WRITE;
/*!40000 ALTER TABLE `tbjugadacarrera` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbjugadacarrera` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena los paises';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpais`
--

LOCK TABLES `tbpais` WRITE;
/*!40000 ALTER TABLE `tbpais` DISABLE KEYS */;
INSERT INTO `tbpais` VALUES (1,'ARG','Argentina','2015-06-15 08:39:57',1),(2,'VNZ','Venezuela','2015-06-15 09:01:38',1),(3,'EUA','Estados Unidos','2015-06-15 11:19:22',1),(4,'BRA','Brasil','2015-06-15 11:20:34',0),(5,'BOL','Bolivia','2015-06-15 11:25:45',1),(12,'COL','Colombia','2015-06-15 11:41:11',0),(27,'MEX','Mexico','2015-06-27 11:36:41',0),(28,'CHL','Chile','2015-07-01 23:52:00',1);
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbparticipante_llamado`
--

LOCK TABLES `tbparticipante_llamado` WRITE;
/*!40000 ALTER TABLE `tbparticipante_llamado` DISABLE KEYS */;
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
  `ponderacion` smallint(10) unsigned NOT NULL,
  PRIMARY KEY (`idpartllamadoimplemento`),
  KEY `FK_tbimplemento_participante_tbparcipante` (`idparticipantellamado`),
  KEY `FK_tbimplemento_participante_tbimplemento` (`idimplemento`),
  CONSTRAINT `tbpartimplementollamado_ibfk_1` FOREIGN KEY (`idimplemento`) REFERENCES `tbimplemento` (`idimplemento`),
  CONSTRAINT `tbpartimplementollamado_ibfk_2` FOREIGN KEY (`idparticipantellamado`) REFERENCES `tbparticipante_llamado` (`idparticipacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpartimplementollamado`
--

LOCK TABLES `tbpartimplementollamado` WRITE;
/*!40000 ALTER TABLE `tbpartimplementollamado` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpersona`
--

LOCK TABLES `tbpersona` WRITE;
/*!40000 ALTER TABLE `tbpersona` DISABLE KEYS */;
INSERT INTO `tbpersona` VALUES (1,'Mendoza','Hernadez','Carlos','Javier','2015-06-29 15:19:13','CJMH','20504015','V','V20504015-0',1,1,1,0),(2,'Alvarado','Medina','Aileen','Cristina','2015-06-30 15:33:13','ACAM','18456077','V','V18465077',0,1,0,1),(3,'Salazar','Guevara','Edder','Jose','2015-06-29 15:38:28','EJSG','19333195','V','V19333195',0,0,1,1);
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
  CONSTRAINT `tbpista_ibfk_1
tbpista_ibfk_1
tbtipohipodromodistancia_ibfk_2` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`),
  CONSTRAINT `tbpista_ibfk_1` FOREIGN KEY (`idhipodromo`) REFERENCES `tbhipodromo` (`idhipodromo`),
  CONSTRAINT `tbpista_ibfk_2` FOREIGN KEY (`idtipopista`) REFERENCES `tbtipopista` (`idtipopista`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpista`
--

LOCK TABLES `tbpista` WRITE;
/*!40000 ALTER TABLE `tbpista` DISABLE KEYS */;
INSERT INTO `tbpista` VALUES (1,'Pista 1',4,2,1),(2,'Pista 2',2,2,0),(3,'Pista 3',2,2,1),(4,'Pista 4',5,1,0);
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
  `idparticipante` int(10) unsigned NOT NULL,
  `fecha_record` datetime NOT NULL,
  `curvas` smallint(10) NOT NULL,
  PRIMARY KEY (`idpistadistancia`),
  KEY `fk_tbpistadistancia_1` (`idpista`),
  KEY `fk_tbpistadistancia_2` (`iddistancia`),
  CONSTRAINT `fk_tbpistadistancia_1` FOREIGN KEY (`idpista`) REFERENCES `tbpista` (`idpista`),
  CONSTRAINT `fk_tbpistadistancia_2` FOREIGN KEY (`iddistancia`) REFERENCES `tbdistancia` (`iddistancia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpistadistancia`
--

LOCK TABLES `tbpistadistancia` WRITE;
/*!40000 ALTER TABLE `tbpistadistancia` DISABLE KEYS */;
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
  PRIMARY KEY (`idpremios`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpremios`
--

LOCK TABLES `tbpremios` WRITE;
/*!40000 ALTER TABLE `tbpremios` DISABLE KEYS */;
INSERT INTO `tbpremios` VALUES (1,'TrofeoA',80,20,0,0,0,1),(2,'CopaB',50,30,10,5,5,1),(3,'PremioC',45,20,15,10,10,1),(4,'MedallaD',40,35,25,0,0,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpropietario`
--

LOCK TABLES `tbpropietario` WRITE;
/*!40000 ALTER TABLE `tbpropietario` DISABLE KEYS */;
INSERT INTO `tbpropietario` VALUES (1,1,'2015-07-01 09:45:40','1'),(2,3,'2015-07-25 09:45:56','1');
/*!40000 ALTER TABLE `tbpropietario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `tbpropietario_detallado`
--

DROP TABLE IF EXISTS `tbpropietario_detallado`;
/*!50001 DROP VIEW IF EXISTS `tbpropietario_detallado`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tbpropietario_detallado` (
  `idpropietario` tinyint NOT NULL,
  `idpersona` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `primer_apellido` tinyint NOT NULL,
  `primer_nombre` tinyint NOT NULL,
  `nacionalidad` tinyint NOT NULL,
  `rif` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

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
  `colores` varchar(60) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idstud`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbstud`
--

LOCK TABLES `tbstud` WRITE;
/*!40000 ALTER TABLE `tbstud` DISABLE KEYS */;
INSERT INTO `tbstud` VALUES (1,'Equipo A','VERDE','2015-06-30 14:41:13',1),(2,'Equipo B','ROJO','2015-07-01 16:57:02',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipocomentarios`
--

LOCK TABLES `tbtipocomentarios` WRITE;
/*!40000 ALTER TABLE `tbtipocomentarios` DISABLE KEYS */;
INSERT INTO `tbtipocomentarios` VALUES (1,'Comentario abc',1),(2,'Comentario dfg',1),(3,'Comentario hij',1);
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
  `tipocond_multiple` tinyint(1) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipocondicion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipocondicion`
--

LOCK TABLES `tbtipocondicion` WRITE;
/*!40000 ALTER TABLE `tbtipocondicion` DISABLE KEYS */;
INSERT INTO `tbtipocondicion` VALUES (1,'TcondicionA','2015-06-22 14:23:14',3,1,1,1),(2,'TcondicionB','2015-06-22 14:23:39',2,1,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipoimplemento`
--

LOCK TABLES `tbtipoimplemento` WRITE;
/*!40000 ALTER TABLE `tbtipoimplemento` DISABLE KEYS */;
INSERT INTO `tbtipoimplemento` VALUES (1,'Tipo 1','TI1','2015-06-29 13:48:26',1),(2,'Tipo 2','TI2','2015-06-29 13:48:41',1),(3,'Tipo 3','TI3','2015-07-01 00:36:31',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipojugada`
--

LOCK TABLES `tbtipojugada` WRITE;
/*!40000 ALTER TABLE `tbtipojugada` DISABLE KEYS */;
INSERT INTO `tbtipojugada` VALUES (1,'Arriesgada','2015-06-26 15:30:05',1),(2,'Nueva','2015-06-26 15:30:36',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipoorigen`
--

LOCK TABLES `tbtipoorigen` WRITE;
/*!40000 ALTER TABLE `tbtipoorigen` DISABLE KEYS */;
INSERT INTO `tbtipoorigen` VALUES (1,'NUEVOORIGEN','2015-06-26 14:00:05','NVO',1);
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
  `abreviatura` char(3) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipopelaje`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipopelaje`
--

LOCK TABLES `tbtipopelaje` WRITE;
/*!40000 ALTER TABLE `tbtipopelaje` DISABLE KEYS */;
INSERT INTO `tbtipopelaje` VALUES (1,'Liso','2015-06-22 08:53:27','LSO',0),(2,'Corto','2015-06-22 08:53:47','CRT',1),(3,'Aspero','2015-06-22 08:53:56','ASP',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipopista`
--

LOCK TABLES `tbtipopista` WRITE;
/*!40000 ALTER TABLE `tbtipopista` DISABLE KEYS */;
INSERT INTO `tbtipopista` VALUES (1,'Fangosa',1),(2,'Pasto',1),(3,'Arena',1),(4,'Grava',1),(5,'Sintetica',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipounidades`
--

LOCK TABLES `tbtipounidades` WRITE;
/*!40000 ALTER TABLE `tbtipounidades` DISABLE KEYS */;
INSERT INTO `tbtipounidades` VALUES (1,'Millas',1),(2,'Metros',1),(3,'Yardas',1);
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
  PRIMARY KEY (`idtropiezo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtropiezo`
--

LOCK TABLES `tbtropiezo` WRITE;
/*!40000 ALTER TABLE `tbtropiezo` DISABLE KEYS */;
INSERT INTO `tbtropiezo` VALUES (1,'Enfermedad','ENF','2015-07-01 21:53:09'),(2,'Obstaculo en pista','OBS','2015-06-22 00:21:03');
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

--
-- Final view structure for view `tbjinete_detallado`
--

/*!50001 DROP TABLE IF EXISTS `tbjinete_detallado`*/;
/*!50001 DROP VIEW IF EXISTS `tbjinete_detallado`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `tbjinete_detallado` AS select `a`.`idjinete` AS `idjinete`,`a`.`idpersona` AS `idpersona`,`a`.`peso` AS `peso`,`a`.`nivel` AS `nivel`,`a`.`status` AS `status`,`b`.`primer_apellido` AS `primer_apellido`,`b`.`primer_nombre` AS `primer_nombre`,`b`.`nacionalidad` AS `nacionalidad`,`b`.`rif` AS `rif` from (`tbjinete` `a` join `tbpersona` `b`) where (`a`.`idpersona` = `b`.`idpersona`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `tbpropietario_detallado`
--

/*!50001 DROP TABLE IF EXISTS `tbpropietario_detallado`*/;
/*!50001 DROP VIEW IF EXISTS `tbpropietario_detallado`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `tbpropietario_detallado` AS select `a`.`idpropietario` AS `idpropietario`,`a`.`idpersona` AS `idpersona`,`a`.`status` AS `status`,`b`.`primer_apellido` AS `primer_apellido`,`b`.`primer_nombre` AS `primer_nombre`,`b`.`nacionalidad` AS `nacionalidad`,`b`.`rif` AS `rif` from (`tbpropietario` `a` join `tbpersona` `b`) where (`a`.`idpersona` = `b`.`idpersona`) */;
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

-- Dump completed on 2015-07-10 14:20:55
