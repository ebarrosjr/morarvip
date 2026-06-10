/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: db    Database: morarvip
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `atendimentos`
--

DROP TABLE IF EXISTS `atendimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atendimentos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int unsigned NOT NULL,
  `imovel_id` int unsigned DEFAULT NULL,
  `interesse` tinyint(1) DEFAULT NULL,
  `atendido_por` int unsigned DEFAULT NULL,
  `canal` enum('W','T','E','P','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `conversao` enum('N','P','X','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nota` int DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atendimentos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `atendimentos` WRITE;
/*!40000 ALTER TABLE `atendimentos` DISABLE KEYS */;
INSERT INTO `atendimentos` VALUES
(1,1,1,1,1,'W','Teste','P',7,'2026-06-07 16:22:54','2026-06-07 16:22:54');
/*!40000 ALTER TABLE `atendimentos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES
(1,'Apartamentos'),
(2,'Casas'),
(3,'Loja'),
(4,'Terreno'),
(5,'Vaga garagem'),
(6,'Galpo');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `foto_imoveis`
--

DROP TABLE IF EXISTS `foto_imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `foto_imoveis` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `imovel_id` int unsigned NOT NULL,
  `arquivo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal` tinyint unsigned DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto_imoveis`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `foto_imoveis` WRITE;
/*!40000 ALTER TABLE `foto_imoveis` DISABLE KEYS */;
INSERT INTO `foto_imoveis` VALUES
(1,1,'1_6a25868b01c18_bg-4.jpg',0,'2026-06-07 14:56:11','2026-06-07 14:56:11'),
(4,1,'1_6a25868b2277d_bg-1.jpg',0,'2026-06-07 14:56:11','2026-06-07 16:02:25'),
(5,1,'1_6a2587b46ebcc_68bd58a44a97f.jpg',0,'2026-06-07 15:01:08','2026-06-07 17:29:32'),
(15,1,'1_6a25aa9c81154_bg-2.jpg',1,'2026-06-07 17:30:04','2026-06-07 17:30:04');
/*!40000 ALTER TABLE `foto_imoveis` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `imoveis` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `proprietario` int unsigned NOT NULL,
  `titulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chamada` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `cep` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `vaga_garagem` int unsigned DEFAULT NULL,
  `banheiros` int DEFAULT '1',
  `tamanho` int DEFAULT '70',
  `quartos` int DEFAULT '1',
  `foto` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_imovel_id` int unsigned DEFAULT NULL,
  `construtora` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negocio` enum('V','A','L') COLLATE utf8mb4_unicode_ci DEFAULT 'V' COMMENT 'Venda ou Aluguel',
  `categoria_id` int unsigned DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted` timestamp NULL DEFAULT NULL,
  `situacao` enum('D','V','A','S') COLLATE utf8mb4_unicode_ci DEFAULT 'D' COMMENT '''Disponivel Vendido Alugado Suspenso''',
  `valor` double(15,2) unsigned DEFAULT NULL,
  `iptu` double(15,2) unsigned DEFAULT NULL,
  `comissao` double(15,2) unsigned DEFAULT NULL,
  `show_site` tinyint unsigned DEFAULT NULL,
  `show_preco_site` tinyint unsigned DEFAULT NULL,
  `comissao_permanente` tinyint unsigned DEFAULT NULL,
  `tipo_comissao` enum('D','P') COLLATE utf8mb4_unicode_ci DEFAULT 'P',
  `financia` tinyint unsigned DEFAULT NULL,
  `parceiria` tinyint(1) DEFAULT NULL,
  `porcentagem_parceiro` double(5,2) unsigned DEFAULT NULL,
  `corretor_opcionista` tinyint unsigned DEFAULT NULL,
  `exclusividade` tinyint unsigned DEFAULT NULL,
  `inicio_exclusividade` date DEFAULT NULL,
  `fim_exclusividade` date DEFAULT NULL,
  `votos` int DEFAULT '0',
  `nota` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imoveis`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `imoveis` WRITE;
/*!40000 ALTER TABLE `imoveis` DISABLE KEYS */;
INSERT INTO `imoveis` VALUES
(1,1,1,'Casa grande com piscina','zs d fgghb fgh cnmbnmbv nmnmc mnb','fgsdxh dfhj ghj ndgfh kjlsdfg jlk dfskjlgfnsdfgjh dfgçljkhdfgom ndfg kçjgfçojdfg m,gb fn','25946-337','665','',NULL,NULL,6,4,900,2,NULL,5,NULL,'V',2,'2026-06-07 12:48:45','2026-06-07 13:50:50',NULL,'D',750000.00,1500.00,5.00,1,0,0,'P',0,NULL,NULL,1,1,'2026-06-01','2026-06-13',0,0);
/*!40000 ALTER TABLE `imoveis` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `imovel_parcerias`
--

DROP TABLE IF EXISTS `imovel_parcerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `imovel_parcerias` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `imovei_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `parceiro_id` int unsigned NOT NULL,
  `inicio_parceria` date DEFAULT NULL,
  `porcentagem_parceiro` double(5,2) unsigned DEFAULT NULL,
  `fim_parceria` date DEFAULT NULL,
  `situacao` enum('P','A','R') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacao_reprovado` text COLLATE utf8mb4_unicode_ci,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imovel_parcerias`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `imovel_parcerias` WRITE;
/*!40000 ALTER TABLE `imovel_parcerias` DISABLE KEYS */;
/*!40000 ALTER TABLE `imovel_parcerias` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cpf` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nascimento` date DEFAULT NULL,
  `mae` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexo` enum('N','F','M') COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `raca_id` int unsigned DEFAULT '1',
  `estado_civil` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome_social` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escolaridade_id` int unsigned DEFAULT NULL,
  `renda_id` int unsigned DEFAULT NULL,
  `religiao_id` int unsigned DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `telefone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci,
  `propaganda` tinyint(1) DEFAULT '0',
  `share_data` tinyint(1) DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted` timestamp NULL DEFAULT NULL,
  `origem` enum('C','S','A','T','W') COLLATE utf8mb4_unicode_ci DEFAULT 'S' COMMENT '''C'' => ''Corretor'', ''S'' => ''Site'',  ''A'' => ''App'', ''T'' => TeleAtendimento CL'', ''W'' => ''Widget''',
  `id_asaas` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `INDEX_SEXO` (`sexo`),
  KEY `INDEX_CPF` (`cpf`),
  KEY `INDEX_NOME` (`nome`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` VALUES
(1,'95050850525','Teste',NULL,NULL,NULL,'N',1,NULL,NULL,NULL,NULL,NULL,'ebarrosjr@gmail.com',NULL,NULL,NULL,NULL,NULL,'21980888080',NULL,NULL,NULL,NULL,NULL,0,0,'2026-06-07 12:43:28','2026-06-07 12:43:28',NULL,'S',NULL,NULL);
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `valor` double(15,2) unsigned NOT NULL,
  `dias_gratis` int DEFAULT '15',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES
(1,'Plano Basico',NULL,0.00,90);
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tipo_imoveis`
--

DROP TABLE IF EXISTS `tipo_imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_imoveis` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_imoveis`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tipo_imoveis` WRITE;
/*!40000 ALTER TABLE `tipo_imoveis` DISABLE KEYS */;
INSERT INTO `tipo_imoveis` VALUES
(1,'Na Planta','Imvel em fase de projeto'),
(2,'Lanamento','Imvel construdo a menos de 6 meses'),
(3,'Novo','Imvel construdo a mais de 6 meses e menos de 1 ano'),
(4,'Primeira locao','Imvel construdo a mais de um ano, mas nunca ocupado'),
(5,'Usado','imvel j ocupado anteriormente');
/*!40000 ALTER TABLE `tipo_imoveis` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_date` timestamp NULL DEFAULT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creci` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uf_creci` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` int unsigned NOT NULL,
  `inicio_plano` date DEFAULT NULL,
  `asaas_customer_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `alias_UNIQUE` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Everton Barros Jr',NULL,NULL,'ebarrosjr@gmail.com',NULL,'2026-06-05 18:44:33','21980888080',NULL,NULL,'$2y$12$lxKACWrVW6ehcF.9khvBueFOGIQFYWpO.EHcn/pTl7o9SM43gxrNy',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-06-05 18:44:19','2026-06-05 18:44:33',NULL),
(2,'Erick Raimondi',NULL,NULL,'erimovel@gmail.com',NULL,'2026-06-07 17:17:24','21983195552',NULL,NULL,'$2y$12$hhv6aHUb4S0QgRgg4kreGeDZ.EKpaytSam5iJvATimLsr8dzHhX3q',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-06-07 17:17:05','2026-06-07 17:17:24',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-06-10 11:23:39
