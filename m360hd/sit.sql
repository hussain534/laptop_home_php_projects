-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for sit_v2
CREATE DATABASE IF NOT EXISTS `sit_v2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sit_v2`;


-- Dumping structure for table sit_v2.catalogue
CREATE TABLE IF NOT EXISTS `catalogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1: PROJECT, 2:ENVIRONMENT, 3:TASK TYPE, 4: TECHNOLOGY-PRODUCT, 5: STATUS, 6: PRIORITY, 7:NOTIFICATION MEDIUM',
  `created_on` datetime DEFAULT NULL,
  `enabled` int(11) DEFAULT NULL COMMENT '1:YES, 2:NO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_CHECK` (`name`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

-- Dumping data for table sit_v2.catalogue: ~142 rows (approximately)
DELETE FROM `catalogue`;
/*!40000 ALTER TABLE `catalogue` DISABLE KEYS */;
INSERT INTO `catalogue` (`id`, `name`, `type`, `created_on`, `enabled`) VALUES
	(1, 'MULTICANALIDAD', 1, '2018-08-14 11:11:58', 1),
	(2, 'PORTAL', 1, '2018-08-14 11:12:31', 1),
	(3, 'CONTINGENCIA', 1, '2018-08-14 11:12:53', 1),
	(4, 'BILLTERA ELECTRONICA', 1, '2018-08-14 11:13:23', 1),
	(5, 'VU', 1, '2018-08-14 11:13:40', 1),
	(6, 'PRODUCCION', 2, '2018-08-14 11:15:39', 1),
	(7, 'PRE-PRODUCCION', 2, '2018-08-14 11:15:58', 1),
	(8, 'CONTINGENCIA', 2, '2018-08-14 11:16:17', 1),
	(9, 'CALIDAD', 2, '2018-08-14 11:16:34', 1),
	(10, 'DESARROLLO', 2, '2018-08-14 11:16:52', 1),
	(11, 'REQUERIMIENTO', 3, '2018-08-14 11:17:11', 1),
	(12, 'ADMINISTRACION - EVENTOS', 3, '2018-08-14 11:17:31', 1),
	(13, 'MEJORAS', 3, '2018-08-14 11:17:53', 1),
	(14, 'VALOR AGREGADO', 3, '2018-08-14 11:18:16', 1),
	(15, 'IIB - MQ', 4, '2018-08-14 11:18:55', 1),
	(16, 'LINUX', 4, '2018-08-14 11:19:13', 1),
	(17, 'AIX', 4, '2018-08-14 11:19:29', 1),
	(18, 'BDD ORACLE', 4, '2018-08-14 11:19:57', 1),
	(19, 'STORAGE', 4, '2018-08-14 11:20:14', 1),
	(20, 'VMWARE', 4, '2018-08-14 11:20:33', 1),
	(21, 'SWITCHES SAN', 4, '2018-08-14 11:20:54', 1),
	(22, 'SWITCHES RED', 4, '2018-08-14 11:21:10', 1),
	(23, 'RED', 4, '2018-08-14 11:21:39', 1),
	(24, 'PORTAL', 4, '2018-08-14 11:21:59', 1),
	(25, 'BDD DB2', 4, '2018-08-14 11:22:14', 1),
	(26, 'LDAP', 4, '2018-08-14 11:22:36', 1),
	(27, 'EDGE SERVER', 4, '2018-08-14 11:22:52', 1),
	(28, 'F5', 4, '2018-08-14 11:23:14', 1),
	(29, 'APPL - MULTICANAL', 4, '2018-08-14 11:23:40', 1),
	(30, 'COORDINATION', 4, '2018-08-14 11:24:05', 1),
	(31, 'CREADO', 5, '2018-08-14 11:42:39', 1),
	(32, 'EN PROGRESO', 5, '2018-08-14 11:42:58', 1),
	(33, 'CANCELADO', 5, '2018-08-14 11:43:22', 1),
	(34, 'EN ESPERA - INTERNO', 5, '2018-08-14 11:43:56', 1),
	(35, 'DELEGADO', 5, '2018-08-14 11:46:58', 1),
	(36, 'ATENDIDO', 5, '2018-08-14 11:47:27', 1),
	(38, 'CERRADO', 5, '2018-08-14 11:48:00', 0),
	(39, 'ABRIR DE NUEVO', 5, '2018-08-14 11:48:38', 1),
	(40, 'ADMINISTRACION - BITACORA', 3, '2018-09-24 22:28:19', 1),
	(41, 'INCIDENTE', 3, '2018-09-24 22:29:04', 1),
	(42, 'ALTO', 6, '2018-09-24 22:31:15', 1),
	(43, 'MEDIO', 6, '2018-09-24 22:31:33', 1),
	(44, 'BAJO', 6, '2018-09-24 22:31:51', 1),
	(45, 'EN ESPERA - CLIENTE', 5, '2018-09-24 22:36:10', 1),
	(46, 'NOTIFICADO-EMAIL', 5, '2018-09-24 22:36:54', 1),
	(47, 'NOTIFICADO-LLAMADA', 5, '2018-09-24 22:37:13', 1),
	(48, 'LLAMADA TELEFONICA', 7, '2018-09-24 23:43:04', 1),
	(49, 'EMAIL', 7, '2018-09-24 23:43:23', 1),
	(50, 'ALERTA', 7, '2018-09-24 23:43:49', 1),
	(51, 'TICKET', 7, '2018-09-24 23:44:08', 1),
	(52, 'INTERNO', 7, '2018-09-24 23:44:22', 1),
	(53, 'Aplicativos del CAO', 1, '2018-09-27 12:20:10', 1),
	(54, 'Aplicativos del GESTOR', 1, '2018-09-27 12:20:10', 1),
	(55, 'Aplicativos del WEBID', 1, '2018-09-27 12:20:10', 1),
	(56, 'APLICACION B24', 1, '2018-09-27 12:20:10', 1),
	(57, 'ATALLA', 1, '2018-09-27 12:20:10', 1),
	(58, 'ATM', 1, '2018-09-27 12:20:10', 1),
	(59, 'B24', 1, '2018-09-27 12:20:10', 1),
	(60, 'BANRED', 1, '2018-09-27 12:20:10', 1),
	(61, 'BANRED 24', 1, '2018-09-27 12:20:10', 1),
	(62, 'BOTON DE PAGOS ANTIGUO', 1, '2018-09-27 12:20:10', 1),
	(63, 'BOTON DE PAGOS NUEVO', 1, '2018-09-27 12:20:10', 1),
	(64, 'PAGINAS WEB', 1, '2018-09-27 12:20:10', 1),
	(65, 'RECARGA MINUTOS', 1, '2018-09-27 12:20:10', 1),
	(66, 'VPOS', 1, '2018-09-27 12:20:10', 1),
	(67, 'COMERCIOS', 1, '2018-09-27 12:20:10', 1),
	(68, 'MPI', 1, '2018-09-27 12:20:10', 1),
	(69, 'CONSULTAS ', 1, '2018-09-27 12:20:11', 1),
	(70, 'CONSULTAS XML', 1, '2018-09-27 12:20:11', 1),
	(71, 'CALL CENTER', 1, '2018-09-27 12:20:11', 1),
	(72, 'DATAFAST', 1, '2018-09-27 12:20:11', 1),
	(73, 'DATAFAST  VISA', 1, '2018-09-27 12:20:11', 1),
	(74, 'DATAFAST DINERS', 1, '2018-09-27 12:20:11', 1),
	(75, 'DATAFAST DINERS/VISA', 1, '2018-09-27 12:20:11', 1),
	(76, 'DCI', 1, '2018-09-27 12:20:11', 1),
	(77, 'DCI1', 1, '2018-09-27 12:20:11', 1),
	(78, 'DCI2', 1, '2018-09-27 12:20:11', 1),
	(79, 'EFECTIVO EXPRESS', 1, '2018-09-27 12:20:11', 1),
	(80, 'ENLACE DINERS - IBM', 1, '2018-09-27 12:20:11', 1),
	(81, 'F5 ', 1, '2018-09-27 12:20:11', 1),
	(82, 'F5 PRODUCCION', 1, '2018-09-27 12:20:11', 1),
	(83, 'FIREWALL MULTICANALIDAD PRODUCCION', 1, '2018-09-27 12:20:11', 1),
	(84, 'GESTOR', 1, '2018-09-27 12:20:11', 1),
	(85, 'GRABADOR DE LLAMADAS', 1, '2018-09-27 12:20:11', 1),
	(86, 'PORTAL INTERDIN', 1, '2018-09-27 12:20:11', 1),
	(87, 'PORTAL DISCOVER', 1, '2018-09-27 12:20:11', 1),
	(88, 'PORTAL TARJETAS BANCO PICHINCHA', 1, '2018-09-27 12:20:11', 1),
	(89, 'IVR', 1, '2018-09-27 12:20:11', 1),
	(90, 'MASTERCARD INTERNACIONAL', 1, '2018-09-27 12:20:11', 1),
	(91, 'MCI', 1, '2018-09-27 12:20:11', 1),
	(92, 'MCI y MDS', 1, '2018-09-27 12:20:11', 1),
	(93, 'MDS', 1, '2018-09-27 12:20:11', 1),
	(94, 'MODULO GRAFICO CAO', 1, '2018-09-27 12:20:11', 1),
	(95, 'MULTICANALIDAD APP', 1, '2018-09-27 12:20:11', 1),
	(96, 'MULTICANALIDAD WEB', 1, '2018-09-27 12:20:11', 1),
	(97, 'Municipio de Guayaquil', 1, '2018-09-27 12:20:11', 1),
	(98, 'OFICIAL', 1, '2018-09-27 12:20:11', 1),
	(99, 'ONLINE COLAS', 1, '2018-09-27 12:20:11', 1),
	(100, 'ONLINE MASIVO', 1, '2018-09-27 12:20:11', 1),
	(101, 'RECARGAS', 1, '2018-09-27 12:20:11', 1),
	(102, 'Pagina Owadinersclub', 1, '2018-09-27 12:20:11', 1),
	(103, 'pagina Diners Club', 1, '2018-09-27 12:20:11', 1),
	(104, 'Pagina Dinersbox', 1, '2018-09-27 12:20:11', 1),
	(105, 'Pagina Discover', 1, '2018-09-27 12:20:11', 1),
	(106, 'Pagina y Webservice de Yellowpepper', 1, '2018-09-27 12:20:11', 1),
	(107, 'Solicitud Afiliacion MPOS', 1, '2018-09-27 12:20:11', 1),
	(108, 'PAGINAS DOMINIO OPTAR.COM.EC', 1, '2018-09-27 12:20:11', 1),
	(109, 'PAGINAS DOMINIO SERVICIOS.INTERDIN.COM.EC', 1, '2018-09-27 12:20:11', 1),
	(110, 'PAGINAS WEB DOMINIO OPTAR', 1, '2018-09-27 12:20:11', 1),
	(111, 'Pasivos AURO', 1, '2018-09-27 12:20:11', 1),
	(112, 'PEOPLE SOFT', 1, '2018-09-27 12:20:11', 1),
	(113, 'PIC', 1, '2018-09-27 12:20:11', 1),
	(115, 'PRUEBAID', 1, '2018-09-27 12:22:18', 1),
	(116, 'PULSE', 1, '2018-09-27 12:22:18', 1),
	(118, 'RED DEL EDIFICIO MATRIZ', 1, '2018-09-27 12:22:41', 1),
	(119, 'SERVICIO SMS', 1, '2018-09-27 12:22:41', 1),
	(120, 'SERVICIOS SMS Y EMAIL GENERAL', 1, '2018-09-27 12:22:41', 1),
	(121, 'SERVICIOS WEB', 1, '2018-09-27 12:22:41', 1),
	(122, 'SFTP', 1, '2018-09-27 12:22:41', 1),
	(123, 'SMS BAFRA', 1, '2018-09-27 12:22:41', 1),
	(124, 'SMS FRAUDES INTERDIN', 1, '2018-09-27 12:22:41', 1),
	(125, 'SMS FRAUDES PICHINCHA', 1, '2018-09-27 12:22:41', 1),
	(126, 'SMS OTP GENERAL', 1, '2018-09-27 12:22:41', 1),
	(127, 'SMS FRAUDES BANCOS ASOCIADOS', 1, '2018-09-27 12:22:41', 1),
	(129, 'SMS VARIABLES GENERAL', 1, '2018-09-27 12:23:06', 1),
	(130, 'SMS OTP', 1, '2018-09-27 12:23:06', 1),
	(131, 'SMS PIFRA', 1, '2018-09-27 12:23:06', 1),
	(132, 'SMS INFRA', 1, '2018-09-27 12:23:06', 1),
	(133, 'TELEFONIA ', 1, '2018-09-27 12:23:06', 1),
	(134, 'TL5 - PEOPLE SOFT', 1, '2018-09-27 12:23:06', 1),
	(135, 'TRANSACCIONAL', 1, '2018-09-27 12:23:06', 1),
	(136, 'VIEWER WAR', 1, '2018-09-27 12:23:06', 1),
	(137, 'VISA ELECTRON', 1, '2018-09-27 12:23:06', 1),
	(138, 'VISA EMISION - ADQUIRENCIA', 1, '2018-09-27 12:23:06', 1),
	(139, 'VISA VAP ', 1, '2018-09-27 12:23:06', 1),
	(140, 'VISA VAP (EMISION Y ADQUIRENCIA)', 1, '2018-09-27 12:23:06', 1),
	(141, 'VISA VAP EMI', 1, '2018-09-27 12:23:06', 1),
	(142, 'VISA VIP ADQ', 1, '2018-09-27 12:23:06', 1),
	(144, 'VPOS COMERCIOS', 1, '2018-09-27 12:23:37', 1),
	(145, 'VPOS CONSULTAS', 1, '2018-09-27 12:23:37', 1),
	(146, 'VPOS CONSULTAS XMAL', 1, '2018-09-27 12:23:37', 1),
	(147, 'WEB DINERS', 1, '2018-09-27 12:23:37', 1),
	(148, 'WEB VISA', 1, '2018-09-27 12:23:37', 1),
	(149, 'WEB MASTERCARD', 1, '2018-09-27 12:23:37', 1);
/*!40000 ALTER TABLE `catalogue` ENABLE KEYS */;


-- Dumping structure for table sit_v2.mpm_login
CREATE TABLE IF NOT EXISTS `mpm_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `profile` int(11) DEFAULT '2' COMMENT '1:ADMIN;2:USER',
  `password` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `enabled` int(11) DEFAULT NULL COMMENT '1:YES,0:NO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table sit_v2.mpm_login: ~8 rows (approximately)
DELETE FROM `mpm_login`;
/*!40000 ALTER TABLE `mpm_login` DISABLE KEYS */;
INSERT INTO `mpm_login` (`id`, `name`, `email`, `profile`, `password`, `created_by`, `created_on`, `modified_by`, `modified_on`, `enabled`) VALUES
	(1, 'Admin', 'admin@ibm.com', 1, 'admin534', 1, '2017-10-29 02:06:26', 1, '2017-10-29 02:06:30', 1),
	(2, 'Arturo Cifuentes', 'apcifuen@ec.ibm.com', 3, 'acifuen534', 1, '2018-04-21 21:21:14', 1, '2018-04-21 21:21:14', 1),
	(3, 'Mahaboob Hussain', 'mulla.hussain@ibm.com', 4, 'hussain534', 1, '2017-10-29 03:31:25', 1, '2017-10-29 03:31:25', 1),
	(5, 'Juan Burbano', 'juan.burbano@ibm.com', 4, 'jburbano534', 1, '2018-04-21 17:19:45', 1, '2018-04-21 17:19:45', 1),
	(7, 'Juan Llamuca', 'juan.llamuca@ibm.com', 4, 'jllamuca534', 1, '2018-06-05 00:08:54', 1, '2018-06-05 00:08:56', 1),
	(8, 'Danny Cabrera', 'danny.cabrera@ibm.com', 4, 'dcabrera534', 1, '2018-06-05 00:11:52', 1, '2018-06-05 00:11:57', 1),
	(9, 'Rahul Gupta', 'rahul.gupta@ibm.com', 4, 'rgupta534', 1, '2018-06-05 00:12:55', 1, '2018-06-05 00:12:58', 1),
	(11, 'Santiago Chan', 'sachan@ec.ibm.com', 4, 'sachan123', 1, '2018-07-02 10:31:26', 1, '2018-07-02 10:31:31', 1);
/*!40000 ALTER TABLE `mpm_login` ENABLE KEYS */;


-- Dumping structure for table sit_v2.mpm_profiles
CREATE TABLE IF NOT EXISTS `mpm_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `enabled` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table sit_v2.mpm_profiles: ~4 rows (approximately)
DELETE FROM `mpm_profiles`;
/*!40000 ALTER TABLE `mpm_profiles` DISABLE KEYS */;
INSERT INTO `mpm_profiles` (`id`, `name`, `enabled`) VALUES
	(1, 'ADMIN', 1),
	(2, 'OPERADOR', 1),
	(3, 'COORDINADOR', 1),
	(4, 'TECNICO', 1);
/*!40000 ALTER TABLE `mpm_profiles` ENABLE KEYS */;


-- Dumping structure for table sit_v2.mpm_servers
CREATE TABLE IF NOT EXISTS `mpm_servers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Hostname` varchar(50) DEFAULT NULL,
  `IP` varchar(50) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `Environment` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table sit_v2.mpm_servers: ~4 rows (approximately)
DELETE FROM `mpm_servers`;
/*!40000 ALTER TABLE `mpm_servers` DISABLE KEYS */;
INSERT INTO `mpm_servers` (`Id`, `Hostname`, `IP`, `Description`, `Environment`) VALUES
	(1, 'srvrevproxwebbankprod', '192.168.174.11', 'Apache Multi Principal Prod', 6),
	(2, 'srvrevproxwebbankhaprod', '192.168.174.111', 'Apache Multi HA Prod', 6),
	(3, 'srvportalmobilbankprod', '192.168.174.12', 'Tomcat mobile Principal Prod', 6),
	(4, 'srvportalmobilbankhaprod', '192.168.174.112', 'Tomcat mobile HA Prod', 6);
/*!40000 ALTER TABLE `mpm_servers` ENABLE KEYS */;


-- Dumping structure for table sit_v2.mpm_tasks
CREATE TABLE IF NOT EXISTS `mpm_tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_type` int(11) DEFAULT NULL,
  `task_notified_through` int(11) DEFAULT NULL,
  `task_notified_by` varchar(100) DEFAULT NULL,
  `task_notified_on` datetime DEFAULT NULL,
  `task_recieved_by` int(11) DEFAULT NULL,
  `task_assigned_to` int(11) DEFAULT NULL,
  `task_assigned_on` datetime DEFAULT NULL,
  `task_priority` int(11) DEFAULT NULL,
  `task_service_appl` int(11) DEFAULT NULL,
  `task_title` varchar(200) DEFAULT NULL,
  `task_desc` varchar(2000) DEFAULT NULL,
  `task_server_ips` varchar(500) DEFAULT NULL,
  `task_document` varchar(200) DEFAULT NULL,
  `task_email_sent_on` datetime DEFAULT NULL,
  `task_call_made_on` datetime DEFAULT NULL,
  `task_status` int(11) DEFAULT NULL,
  `task_last_updated_on` datetime DEFAULT NULL,
  `task_last_updated_by` int(11) DEFAULT NULL,
  `enabled` int(11) DEFAULT '1',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sit_v2.mpm_tasks: ~0 rows (approximately)
DELETE FROM `mpm_tasks`;
/*!40000 ALTER TABLE `mpm_tasks` DISABLE KEYS */;
INSERT INTO `mpm_tasks` (`task_id`, `task_type`, `task_notified_through`, `task_notified_by`, `task_notified_on`, `task_recieved_by`, `task_assigned_to`, `task_assigned_on`, `task_priority`, `task_service_appl`, `task_title`, `task_desc`, `task_server_ips`, `task_document`, `task_email_sent_on`, `task_call_made_on`, `task_status`, `task_last_updated_on`, `task_last_updated_by`, `enabled`) VALUES
	(1, 40, 50, 'INTERNO', '2018-10-09 08:30:00', 3, 3, '2018-10-09 08:55:28', 42, 1, 'cambiar fecha del servidor', 'cambiar fecha del servidor', 'cambiar fecha del servidor', 'uploads/', '2018-10-09 08:55:30', '2018-10-09 08:55:32', 36, '2018-10-09 09:47:24', 3, 1);
/*!40000 ALTER TABLE `mpm_tasks` ENABLE KEYS */;


-- Dumping structure for table sit_v2.mpm_task_follow_up_dtl
CREATE TABLE IF NOT EXISTS `mpm_task_follow_up_dtl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mt_task_id` int(11) NOT NULL DEFAULT '0',
  `task_follow_up_on` datetime DEFAULT NULL,
  `task_follow_up_by` int(11) DEFAULT NULL,
  `task_follow_up_status` int(11) DEFAULT NULL,
  `task_new_tecnico_id` int(11) DEFAULT NULL,
  `technology_product_id` int(11) DEFAULT NULL,
  `solution_applied` varchar(5000) DEFAULT NULL,
  `cause` varchar(5000) DEFAULT NULL,
  `impact_identified` varchar(5000) DEFAULT NULL,
  `comments` varchar(5000) DEFAULT NULL,
  `task_follow_up_doc_path` varchar(500) DEFAULT NULL,
  `task_mark_as_kdb` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '1' COMMENT '1:SI, 0:NO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sit_v2.mpm_task_follow_up_dtl: ~2 rows (approximately)
DELETE FROM `mpm_task_follow_up_dtl`;
/*!40000 ALTER TABLE `mpm_task_follow_up_dtl` DISABLE KEYS */;
INSERT INTO `mpm_task_follow_up_dtl` (`id`, `mt_task_id`, `task_follow_up_on`, `task_follow_up_by`, `task_follow_up_status`, `task_new_tecnico_id`, `technology_product_id`, `solution_applied`, `cause`, `impact_identified`, `comments`, `task_follow_up_doc_path`, `task_mark_as_kdb`, `enabled`) VALUES
	(1, 1, '2018-10-09 08:55:53', 3, 36, 3, 17, 'NA', 'NA', 'NA', 'NA', 'uploads/', 0, 1),
	(2, 1, '2018-10-09 09:47:24', 3, 36, 3, 17, 'na', 'na', 'na', 'na', 'uploads/JSF_HelloWorld.zip', 0, 1);
/*!40000 ALTER TABLE `mpm_task_follow_up_dtl` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
