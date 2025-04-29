-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: litoranea
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cadastrodepedido`
--

DROP TABLE IF EXISTS `cadastrodepedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastrodepedido` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_pedido` date DEFAULT NULL,
  `cliente_id` bigint unsigned NOT NULL,
  `representada_id` bigint unsigned NOT NULL,
  `transportadora_id` bigint unsigned DEFAULT NULL,
  `valor_pedido` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_faturado` decimal(10,2) NOT NULL DEFAULT '0.00',
  `data_faturamento` date DEFAULT NULL,
  `valor_comissao_parcial` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_comissao_faturada` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cadastrodepedido_cliente_id_foreign` (`cliente_id`),
  KEY `cadastrodepedido_representada_id_foreign` (`representada_id`),
  KEY `cadastrodepedido_transportadora_id_foreign` (`transportadora_id`),
  CONSTRAINT `cadastrodepedido_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cadastrodepedido_representada_id_foreign` FOREIGN KEY (`representada_id`) REFERENCES `representadas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cadastrodepedido_transportadora_id_foreign` FOREIGN KEY (`transportadora_id`) REFERENCES `transportadoras` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastrodepedido`
--

LOCK TABLES `cadastrodepedido` WRITE;
/*!40000 ALTER TABLE `cadastrodepedido` DISABLE KEYS */;
INSERT INTO `cadastrodepedido` VALUES (3,'2025-05-23',2,1,1,400.00,20.00,'2025-05-25',15.00,1.00,'2025-04-29 06:39:44','2025-04-29 07:02:26'),(5,'2025-01-01',2,1,1,500.00,210.00,'2020-12-23',62.00,5.00,'2025-04-29 06:44:49','2025-04-29 07:03:14');
/*!40000 ALTER TABLE `cadastrodepedido` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-29  1:26:59
