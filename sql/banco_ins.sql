-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: BD_TECHWAY
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `BD_TECHWAY`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bd_techway` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `BD_TECHWAY`;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin@gmail.com','$2y$10$/qVtnT/UfBk/CLWOHUay/u7cqz/QlT7k.2Pqee2Mz7ltwBS6vzzMS');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Hospedagem'),(2,'Alimentação'),(3,'Compras'),(4,'Locomoção');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estabelecimento`
--

DROP TABLE IF EXISTS `estabelecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estabelecimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_estabelecimento` varchar(80) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `bairro` varchar(40) DEFAULT NULL,
  `tipo_logradouro` varchar(20) DEFAULT NULL,
  `logradouro` varchar(80) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `horario` varchar(80) DEFAULT NULL,
  `instagram` varchar(400) DEFAULT NULL,
  `tiktok` varchar(400) DEFAULT NULL,
  `facebook` varchar(400) DEFAULT NULL,
  `emailCom` varchar(100) DEFAULT NULL,
  `emailLog` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `autorizado` varchar(20) DEFAULT NULL,
  `recuperar_senha` varchar(80) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Categoria` (`id_categoria`),
  CONSTRAINT `FK_Categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estabelecimento`
--

LOCK TABLES `estabelecimento` WRITE;
/*!40000 ALTER TABLE `estabelecimento` DISABLE KEYS */;
INSERT INTO `estabelecimento` VALUES (1,' Pizzaria Mais Sabor','Somos uma pizzaria que desde 2015 procura trazer mais sabor para os momentos especiais dos nossos clientes. Nossa casa é o lugar certo, quando se trata de um ambiente acolhedor, perfeito para curtir com a família, amigos ou até mesmo sozinho! Valorizamos cada detalhe, desde a escolha dos ingredientes até o atendimento de qualidade, para proporcionar a melhor experiência possível.\r\n','15.051.639/0001-73','Centro','Avenida','da República',865,'(11) 99727-3566','Segunda à Domingo – 18h às 23:50',' https://www.instagram.com/pizzaria_maisssabor/','','https://www.facebook.com/rpmaissabor/?locale=pt_BR','rpmaissabor@gmail.com','rpmaissabor@gmail.com','$2y$10$OxGbl63FDfzV2WzmJnGzQu7oToAatI82e/rFHcA80SHaYD3AvUjz.','Autorizado',NULL,2),(2,'Taberna do Rei','Hamburgueria e choperia temática com a missão de proporcionar a melhor experiência gastronômica, com qualidade de atendimento e preço justo.\r\n','28.108.075/0001-00','Jardim Monte Serrat','Avenida','Pref. João Píres Filho',15,'(11) 46801-2941','Segunda à quinta – 17h às 23h Sexta e sábado – 17h às 01h Domingo – 17h às 23h',' https://www.instagram.com/tabernadorei/','','https://www.facebook.com/tabernadoreipub/?locale=pt_BR','walter.negrao.almeida@gmail.com','walter.negrao.almeida@gmail.com','$2y$10$2AXIPXIGZt3LxCs8hXprau0KQ696vKSH6txTlS85L/5hVbNGhflFu','Autorizado',NULL,2),(3,'Shell','Posto de combustíveis 24 horas com conveniência disponível\r\n','44.444.444/4444-44','Recanto Imperial','Avenida','da República',741,'(11) 11111-1111','24 Horas','https://www.instagram.com/shell/','','','shel@gmail.com','shell@gmail.com','$2y$10$MMMMuUrUuI/iSGweA2atPuYRtjz8RTztb/7ndZ5r0VpUdG8xePoMm','Autorizado',NULL,4),(4,'Gema',' Se você quer uma refeição que vai deixar seu paladar feliz, o Gema é o lugar certo! Vem experimentar nossos pratos incrível e se apaixonar de vez!???? Aqui a gente coloca sabor em cada detalhe. Você não vai querer perder ????\r\n','47.298.673/0001-33','Centro','Rua','Diogo Batista Nunes',179,'(11) 91642-8548','Segunda à sábado 11:00 - 15:30',' https://www.instagram.com/gemabistro/','','','gemabistro@gmail.com','gemabistro@gmail.com','$2y$10$3asFafr19FgTQtEm5ZAFaOrQ2o/2cxcTjgvRYrY5VGYy9jzLu6ige','Autorizado',NULL,2),(5,'Tesouros na Brasa','Se deseja comer um belo burger, batata frita sequinha e crocante, milk-shakes de verdade, entre muitos outros #Tesouros, está no local certo. Nosso principal objetivo é proporcionar uma experiência ímpar aos nossos clientes para que sempre voltem. Agradecemos a sua confiança. Trabalhamos sempre para te surpreender! \r\n','28.511.284/0001-08','Treze de Maio','Rua','Profa. Ana Moutinho Gonçalves',82,'(11) 97474-2371','Terça a sábado – 18:00 às 23:00h','https://www.instagram.com/tesourosnabrasa/','','https://www.facebook.com/tesourosnabrasa/?locale=pt_BR','tesourosnabrasa@gmail.com','tesourosnabrasa@gmail.com','$2y$10$50cQi.37uANVYdu1sNOS2eR7aLaowOW51MJD3Vly80WShLre3L4X2','Autorizado',NULL,2);
/*!40000 ALTER TABLE `estabelecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos_estabelecimento`
--

DROP TABLE IF EXISTS `fotos_estabelecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos_estabelecimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estabelecimento` int(11) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `foto_1` varchar(100) DEFAULT NULL,
  `foto_2` varchar(100) DEFAULT NULL,
  `foto_3` varchar(100) DEFAULT NULL,
  `foto_4` varchar(100) DEFAULT NULL,
  `foto_5` varchar(100) DEFAULT NULL,
  `foto_6` varchar(100) DEFAULT NULL,
  `foto_7` varchar(100) DEFAULT NULL,
  `foto_8` varchar(100) DEFAULT NULL,
  `foto_9` varchar(100) DEFAULT NULL,
  `foto_10` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `FK_Estabelecimento` FOREIGN KEY (`id_estabelecimento`) REFERENCES `estabelecimento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos_estabelecimento`
--

LOCK TABLES `fotos_estabelecimento` WRITE;
/*!40000 ALTER TABLE `fotos_estabelecimento` DISABLE KEYS */;
INSERT INTO `fotos_estabelecimento` VALUES (1,1,'9a6706c30122741adbbf346583132a09.jpg','82eeea3a56d2c67acbae7338b43f6f32.jpeg','80b339918c106d455248de0f0090320c.jpeg','92d22883899cea17262811481aaf022a.jpeg','35f0ea4cf781b76cd99ba505acb91e7e.jpeg','577ebad27d5f9923f03f4bcb33e6dcc4.jpeg','9978bce6ae9b1fdc17f430ded2e74e07.jpeg','8dba8a0ea157d7e6f9d3ebdfd06fc555.jpeg','','',''),(2,2,'b8bfae28e83315e7a4ad8ad3bd15da74.PNG','0f185ebaf6770bc2a25625e184cca520.PNG','600f7a204073b9a02db7916cc1ffb71c.PNG','06d47611590f004852d18bf501151432.PNG','e9b2a89da5b7724f5944eac70f992e5b.jpg','65c255466ebb7b793b221b14b8d01619.jpg','c652d08152a0a5463d855dbc8e159654.PNG','095bc84a585b5be179c4514a3003eb58.PNG','ec72887d6ccd21392dfa78006c754c02.PNG','b8d4b25cb51d77f2e613b1a38299002c.PNG',''),(3,3,'1b6accba25ea491c62ef74d931bb9ebf.png','57c458d19349e1a6abedea352488d5b1.jpg','','','','','','','','',''),(4,4,'dfb3c95885360d52936c35d72a92491e.jpg','49734dd9967f538d1ac43a7b5eb087cb.jpg','119c28e192a168d4ed6046adb47c4943.jpg','3a241b3367c8775152850f09b6c35c6b.jpg','aaeb966138bc76e38b9a0121d98550b0.jpg','9a911af5843e74e48c585f11c8c6b09f.jpg','99cdc81f763dacf4c821c91edcdf25ba.jpg','d5d2594c8797d76c64e5594b7563f09e.jpg','5d78f1c0b6d28fb6d488b48e88389304.jpg','5d5420dd531f410e7c7714d094ef6025.jpg','8f70806d299c2a1b418ae0acab63a980.jpg'),(5,5,'106eef9a4109828f2a193d0eee30623f.png','08802b593f90203a391fc5c70fa99e72.jpg','e29707f3febea58648fa8d84d7848583.jpg','','','','','','','','');
/*!40000 ALTER TABLE `fotos_estabelecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos_monitor`
--

DROP TABLE IF EXISTS `fotos_monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos_monitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_monitor` int(11) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `foto_1` varchar(100) DEFAULT NULL,
  `foto_2` varchar(100) DEFAULT NULL,
  `foto_3` varchar(100) DEFAULT NULL,
  `foto_4` varchar(100) DEFAULT NULL,
  `foto_5` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Monitor` (`id_monitor`),
  CONSTRAINT `FK_Monitor` FOREIGN KEY (`id_monitor`) REFERENCES `monitor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos_monitor`
--

LOCK TABLES `fotos_monitor` WRITE;
/*!40000 ALTER TABLE `fotos_monitor` DISABLE KEYS */;
INSERT INTO `fotos_monitor` VALUES (1,1,'ef1d2060a3cc1822f9c8275f2d1550c6.PNG','55629e375d8fb335b47633e46f317de9.PNG','4f9b9e3f33b514a4a8eff9ecf3f9acb5.PNG','3d642317a12f9a80361c17981b39d7d4.PNG','1cfa843b1064a88f7445eed367bc01f7.PNG','88e476fed4b68f43378daa12b5658fb4.PNG'),(2,2,'ada6d35a2a6d438052aa8762d18c3eb4.jpg','3bc9cc2416cbc2ce0216b3db2047c37a.jpeg','3d26c0da692f71e55a2a5ef0e6102485.jpeg','82f52bf6b875e7fd9cd9ae5c368c8232.jpeg','666bc1ab1bc657809848de371ec271f2.jpeg','9eba413ed278205adfbb6f94f83b2191.jpeg');
/*!40000 ALTER TABLE `fotos_monitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitor`
--

DROP TABLE IF EXISTS `monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `numero_cadastur` varchar(20) DEFAULT NULL,
  `genero` varchar(40) DEFAULT NULL,
  `idiomas` varchar(80) DEFAULT NULL,
  `areas_especializacao` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `instagram` varchar(400) DEFAULT NULL,
  `tiktok` varchar(400) DEFAULT NULL,
  `facebook` varchar(400) DEFAULT NULL,
  `autorizado` varchar(20) DEFAULT NULL,
  `recuperar_senha` varchar(80) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Tipo` (`id_tipo`),
  CONSTRAINT `FK_Tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_monitor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitor`
--

LOCK TABLES `monitor` WRITE;
/*!40000 ALTER TABLE `monitor` DISABLE KEYS */;
INSERT INTO `monitor` VALUES (1,'Júlio Sérgio da Silva','Meu nome é Júlio Sérgio, sou Monitor Ambiental autônomo cadastrado na Fundação Florestal Parque do Itaberaba, com ampla experiência no setor de turismo, especialmente em atividades de ecoturismo e turismo de aventura. Desde 2016, venho realizando trilhas e caminhadas por cachoeiras na região de Santa Isabel, proporcionando aos visitantes uma imersão única na natureza local.\r\nTenho experiência e especialização em:\r\nTurismo de Aventura por Caminhada (Ecoturismo)\r\nAcesso por trilhas e visitação de cachoeiras\r\nConhecimento em fauna e flora local.\r\n','11.111.111/1111-11','Masculino','Nenhum','Locomoção','pedrabranca1005@gmail.com','$2y$10$4v3E9CHRmUJHqHjBYrR3AuLUAs3xFW6NyD9BFqvgC1HAJr8ZbIn/C','(11) 97526-2549',' https://www.instagram.com/trilhapedrabrancasi?igsh=N24yZnQ2YzkwM3Mw','','https://www.facebook.com/jilio.sergio?mibextid=ZbWKwL','Autorizado',NULL,1),(2,'Bárbara de Oliveira Araújo','Meu nome é Bárbara Oliveira, mais conhecida como Babi!\r\nSou Guia de Turismo (Cadastur), Monitora Ambiental no Parque Itaberaba, professora de Educação Física, cicloturista e aventureira. Com experiência em Turismo desde 2016, realizo atividades de cicloturismo, cicloviagem, trilhas e caminhadas por cachoeiras nas regiões de Santa Isabel, Arujá e entorno.\r\nSou fundadora do Miau Ciclismo Feminino de Santa Isabel, onde ensino e incentivo a prática do mountain bike entre mulheres da região, que hoje se destacam em várias competições de MTB.\r\nMinha formação inclui:\r\nGuia de Turismo\r\nTécnica em Organização Esportiva\r\nMonitora Ambiental (Parque Itaberaba)\r\nProfessora de Educação Física (especialista em Condicionamento Físico e Saúde Mental)\r\n','49.592.197/0001-94','Feminino','Espanhol','Locomoção','aventureirababi@gmail.com','$2y$10$rEwEBIiehG78qw0QgA5AqeOuDrST1E3vk2UDflMr33dOeg7uR1Lai','(11) 99524-8423','https://www.instagram.com/aventureirababi/profilecard/?igsh=YXRjNHBuZ3RmZGdy','','','Autorizado',NULL,3);
/*!40000 ALTER TABLE `monitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_monitor`
--

DROP TABLE IF EXISTS `tipo_monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_monitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_monitor`
--

LOCK TABLES `tipo_monitor` WRITE;
/*!40000 ALTER TABLE `tipo_monitor` DISABLE KEYS */;
INSERT INTO `tipo_monitor` VALUES (1,'Monitor'),(2,'Guia'),(3,'Guia e Monitor');
/*!40000 ALTER TABLE `tipo_monitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  `id_google` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `recuperar_senha` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-27  8:41:41
