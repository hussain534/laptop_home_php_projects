-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.25 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla zielus.z_automovil
CREATE TABLE IF NOT EXISTS `z_automovil` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_userid` int(9) DEFAULT NULL,
  `a_marca` varchar(100) DEFAULT NULL,
  `a_modelo` varchar(100) DEFAULT NULL,
  `a_ano` int(4) DEFAULT NULL,
  `a_capacidad` int(2) DEFAULT NULL,
  `a_placa` varchar(15) DEFAULT NULL,
  `a_nro_matricula` varchar(50) DEFAULT NULL,
  `a_pic_automovil` varchar(200) DEFAULT NULL,
  `a_created_on` datetime DEFAULT NULL,
  `a_created_by` int(9) DEFAULT NULL,
  `a_modified_on` datetime DEFAULT NULL,
  `a_modified_by` int(9) DEFAULT NULL,
  `a_observation` varchar(2000) DEFAULT NULL,
  `a_is_approved` int(11) NOT NULL DEFAULT '9' COMMENT '0:NO,1:SI;9:PENDIENTE',
  PRIMARY KEY (`a_id`),
  UNIQUE KEY `a_placa` (`a_placa`),
  UNIQUE KEY `a_nro_matricula` (`a_nro_matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_automovil: ~0 rows (aproximadamente)
DELETE FROM `z_automovil`;
/*!40000 ALTER TABLE `z_automovil` DISABLE KEYS */;
INSERT INTO `z_automovil` (`a_id`, `a_userid`, `a_marca`, `a_modelo`, `a_ano`, `a_capacidad`, `a_placa`, `a_nro_matricula`, `a_pic_automovil`, `a_created_on`, `a_created_by`, `a_modified_on`, `a_modified_by`, `a_observation`, `a_is_approved`) VALUES
	(23, 34, 'hyundai', 'tucson', 2015, 3, 'pka-123', '6546464', 'images/pics/Vehicle-34-23.jpg', '2017-01-04 20:09:04', 34, '2017-01-12 02:44:44', 34, 'ok', 0);
/*!40000 ALTER TABLE `z_automovil` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_bancos
CREATE TABLE IF NOT EXISTS `z_bancos` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(100) DEFAULT NULL,
  `b_estado` int(11) DEFAULT NULL COMMENT '0:Activo,1:Inactivo',
  `b_created_on` datetime DEFAULT NULL,
  `b_created_by` int(11) DEFAULT NULL,
  `b_modified_on` datetime DEFAULT NULL,
  `b_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_bancos: ~3 rows (aproximadamente)
DELETE FROM `z_bancos`;
/*!40000 ALTER TABLE `z_bancos` DISABLE KEYS */;
INSERT INTO `z_bancos` (`b_id`, `b_name`, `b_estado`, `b_created_on`, `b_created_by`, `b_modified_on`, `b_modified_by`) VALUES
	(1, 'BANCO PICHINCHA', 0, '2016-11-07 09:00:07', 1, NULL, NULL),
	(2, 'BANCO INTERNACIONAL', 0, '2016-11-07 09:00:10', 1, NULL, NULL),
	(3, 'BANCO PACIFICO', 0, '2016-11-07 09:00:13', 1, NULL, NULL);
/*!40000 ALTER TABLE `z_bancos` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_blogs
CREATE TABLE IF NOT EXISTS `z_blogs` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_user_id` int(11) DEFAULT NULL,
  `b_last_modified_dt` datetime DEFAULT NULL,
  `b_banner_img_path` varchar(100) DEFAULT NULL,
  `b_main_title` varchar(200) DEFAULT NULL,
  `t1` varchar(200) DEFAULT NULL,
  `p1` varchar(1500) DEFAULT NULL,
  `t2` varchar(200) DEFAULT NULL,
  `p2` varchar(1500) DEFAULT NULL,
  `t3` varchar(200) DEFAULT NULL,
  `p3` varchar(1500) DEFAULT NULL,
  `t4` varchar(200) DEFAULT NULL,
  `p4` varchar(1500) DEFAULT NULL,
  `t5` varchar(200) DEFAULT NULL,
  `p5` varchar(1500) DEFAULT NULL,
  `t6` varchar(200) DEFAULT NULL,
  `p6` varchar(1500) DEFAULT NULL,
  `t7` varchar(200) DEFAULT NULL,
  `p7` varchar(1500) DEFAULT NULL,
  `t8` varchar(200) DEFAULT NULL,
  `p8` varchar(1500) DEFAULT NULL,
  `t9` varchar(200) DEFAULT NULL,
  `p9` varchar(1500) DEFAULT NULL,
  `t10` varchar(200) DEFAULT NULL,
  `p10` varchar(1500) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_blogs: ~0 rows (aproximadamente)
DELETE FROM `z_blogs`;
/*!40000 ALTER TABLE `z_blogs` DISABLE KEYS */;
INSERT INTO `z_blogs` (`b_id`, `b_user_id`, `b_last_modified_dt`, `b_banner_img_path`, `b_main_title`, `t1`, `p1`, `t2`, `p2`, `t3`, `p3`, `t4`, `p4`, `t5`, `p5`, `t6`, `p6`, `t7`, `p7`, `t8`, `p8`, `t9`, `p9`, `t10`, `p10`) VALUES
	(5, 34, '2017-01-04 21:25:12', 'images/blogs//BlogPic-34-654370146.jpg', 'dfgfdgdg', '7653476', 'hfghgfhfhfghvbnbgfn hgf h', '5646464', 'hfghfhfhfh h hf ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
/*!40000 ALTER TABLE `z_blogs` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_ciudad
CREATE TABLE IF NOT EXISTS `z_ciudad` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) DEFAULT NULL,
  `c_estado` int(11) DEFAULT NULL COMMENT '0:habilitado,1:deshabilitado',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_ciudad: ~5 rows (aproximadamente)
DELETE FROM `z_ciudad`;
/*!40000 ALTER TABLE `z_ciudad` DISABLE KEYS */;
INSERT INTO `z_ciudad` (`c_id`, `c_name`, `c_estado`) VALUES
	(1, 'QUITO', 0),
	(2, 'GUAYAQUIL', 0),
	(3, 'CUENCA', 0),
	(4, 'AMBATO', 0),
	(5, 'LOJA', 0);
/*!40000 ALTER TABLE `z_ciudad` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_comments
CREATE TABLE IF NOT EXISTS `z_comments` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_viaje_id` int(11) DEFAULT NULL,
  `c_comments` varchar(500) DEFAULT NULL,
  `c_commented_by` int(11) DEFAULT NULL,
  `c_commented_on` datetime DEFAULT NULL,
  `c_deleted_by` int(11) DEFAULT NULL,
  `c_deleted_on` datetime DEFAULT NULL,
  `c_enable_for_home_page` int(11) DEFAULT NULL COMMENT '1:SI, 0:NO',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_comments: ~0 rows (aproximadamente)
DELETE FROM `z_comments`;
/*!40000 ALTER TABLE `z_comments` DISABLE KEYS */;
INSERT INTO `z_comments` (`c_id`, `c_viaje_id`, `c_comments`, `c_commented_by`, `c_commented_on`, `c_deleted_by`, `c_deleted_on`, `c_enable_for_home_page`) VALUES
	(11, 347, 'gfgfdgd gfdg fdgfdg dgfdgf dgfdgd g', 35, '2017-01-04 21:04:13', NULL, NULL, 1);
/*!40000 ALTER TABLE `z_comments` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_cuenta
CREATE TABLE IF NOT EXISTS `z_cuenta` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_userid` int(11) DEFAULT NULL,
  `c_nro_cuenta` varchar(50) DEFAULT NULL,
  `c_banco_id` int(11) DEFAULT NULL,
  `c_tipo_cuenta` int(11) DEFAULT NULL,
  `c_created_on` datetime DEFAULT NULL,
  `c_created_by` int(11) DEFAULT NULL,
  `c_modified_on` datetime DEFAULT NULL,
  `c_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_cuenta: ~0 rows (aproximadamente)
DELETE FROM `z_cuenta`;
/*!40000 ALTER TABLE `z_cuenta` DISABLE KEYS */;
INSERT INTO `z_cuenta` (`c_id`, `c_userid`, `c_nro_cuenta`, `c_banco_id`, `c_tipo_cuenta`, `c_created_on`, `c_created_by`, `c_modified_on`, `c_modified_by`) VALUES
	(2, 34, '654646', 3, 1, '2017-01-04 21:15:17', 34, NULL, NULL);
/*!40000 ALTER TABLE `z_cuenta` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_docs
CREATE TABLE IF NOT EXISTS `z_docs` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_desc` varchar(50) DEFAULT NULL,
  `d_role` int(11) DEFAULT NULL,
  `d_is_mandatory` int(11) DEFAULT NULL COMMENT '0;yes, 1:no',
  PRIMARY KEY (`d_id`),
  KEY `FK__z_roles` (`d_role`),
  CONSTRAINT `FK__z_roles` FOREIGN KEY (`d_role`) REFERENCES `z_roles` (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_docs: ~3 rows (aproximadamente)
DELETE FROM `z_docs`;
/*!40000 ALTER TABLE `z_docs` DISABLE KEYS */;
INSERT INTO `z_docs` (`d_id`, `d_desc`, `d_role`, `d_is_mandatory`) VALUES
	(1, 'CEDULA', 2, 0),
	(3, 'LICENCIA DE CONDUCIR', 2, 0),
	(4, 'MATRICULACION', 2, 0);
/*!40000 ALTER TABLE `z_docs` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_gallery
CREATE TABLE IF NOT EXISTS `z_gallery` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_viaje_id` int(11) DEFAULT NULL,
  `g_userId` int(11) DEFAULT NULL,
  `g_caption` varchar(100) DEFAULT NULL,
  `g_desc` varchar(500) DEFAULT NULL,
  `g_image_path` varchar(100) DEFAULT NULL,
  `g_img_uploaded_by` int(11) DEFAULT NULL,
  `g_img_uploaded_on` datetime DEFAULT NULL,
  `g_img_deleted_by` int(11) DEFAULT NULL,
  `g_img_deleted_on` datetime DEFAULT NULL,
  `g_enable_for_home_page` int(11) DEFAULT NULL COMMENT '1:SI,0:NO',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_gallery: ~2 rows (aproximadamente)
DELETE FROM `z_gallery`;
/*!40000 ALTER TABLE `z_gallery` DISABLE KEYS */;
INSERT INTO `z_gallery` (`g_id`, `g_viaje_id`, `g_userId`, `g_caption`, `g_desc`, `g_image_path`, `g_img_uploaded_by`, `g_img_uploaded_on`, `g_img_deleted_by`, `g_img_deleted_on`, `g_enable_for_home_page`) VALUES
	(3, 347, 35, 'viaje a esmeralda', 'con familia', 'images/gallery/Gallery-347-2143429774.jpg', 35, '2017-01-04 21:03:06', NULL, NULL, 1),
	(4, 347, 35, 'viaje a esmeralda', 'otro', 'images/gallery/Gallery-347-1375440330.jpg', 35, '2017-01-04 21:05:47', NULL, NULL, NULL);
/*!40000 ALTER TABLE `z_gallery` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_login
CREATE TABLE IF NOT EXISTS `z_login` (
  `l_id` int(9) NOT NULL,
  `l_email` varchar(100) DEFAULT NULL,
  `l_pwd` varchar(20) DEFAULT NULL,
  `l_last_login_dt` datetime DEFAULT NULL,
  `l_failed_attempts` int(1) DEFAULT NULL,
  `l_max_fail_attempts_perm` int(1) DEFAULT '5',
  `l_is_first_login` int(1) DEFAULT NULL COMMENT '0:yes, 1:no',
  `l_is_blocked` int(1) DEFAULT NULL COMMENT '0:yes,1:no',
  `l_is_eliminado_por_usuario` int(1) DEFAULT '1' COMMENT '0:yes,1:no',
  `l_in_use` int(1) DEFAULT NULL COMMENT '0:yes,1:no',
  `l_session_id` varchar(100) DEFAULT NULL,
  `l_created_on` datetime DEFAULT NULL,
  `l_created_by` int(11) DEFAULT NULL,
  `l_modified_on` datetime DEFAULT NULL,
  `l_modified_by` int(11) DEFAULT NULL,
  `l_observacion` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`l_id`),
  KEY `l_email` (`l_email`,`l_pwd`),
  CONSTRAINT `FK_z_login_z_users` FOREIGN KEY (`l_email`) REFERENCES `z_users` (`u_emailId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_login: ~3 rows (aproximadamente)
DELETE FROM `z_login`;
/*!40000 ALTER TABLE `z_login` DISABLE KEYS */;
INSERT INTO `z_login` (`l_id`, `l_email`, `l_pwd`, `l_last_login_dt`, `l_failed_attempts`, `l_max_fail_attempts_perm`, `l_is_first_login`, `l_is_blocked`, `l_is_eliminado_por_usuario`, `l_in_use`, `l_session_id`, `l_created_on`, `l_created_by`, `l_modified_on`, `l_modified_by`, `l_observacion`) VALUES
	(1, 'admin@zielus.com', 'admin534', '2017-01-26 20:25:31', 0, 5, 0, 1, 1, 1, '', NULL, NULL, NULL, NULL, NULL),
	(34, 'hussain.mm.2006@gmail.com', 'hussain534', '2017-01-26 20:26:24', 0, 5, 0, 1, 1, 0, '1485480384_1043435622', NULL, NULL, NULL, NULL, NULL),
	(35, 'pasajero1@gmail.com', 'pasajero1', '2017-01-11 23:15:08', 0, 5, 0, 1, 1, 1, '', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `z_login` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_notificacion
CREATE TABLE IF NOT EXISTS `z_notificacion` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `n_user_id` int(11) DEFAULT NULL,
  `n_noti_publicacion` int(11) DEFAULT '0' COMMENT '0:no desea;1:desea',
  `n_noti_reservacion` int(11) DEFAULT '0' COMMENT '0:no desea;1:desea',
  `n_noti_publicacion_cambio` int(11) DEFAULT '0' COMMENT '0:no desea;1:desea',
  `n_noti_reservacion_cambio` int(11) DEFAULT '0' COMMENT '0:no desea;1:desea',
  `n_noti_publicos` int(11) DEFAULT '0' COMMENT '0:no desea;1:desea',
  `n_noti_privados` int(11) DEFAULT '0' COMMENT '0:no desea;1:desea',
  `n_created_by` int(11) DEFAULT NULL,
  `n_created_on` datetime DEFAULT NULL,
  `n_modified_by` int(11) DEFAULT NULL,
  `n_modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_notificacion: ~0 rows (aproximadamente)
DELETE FROM `z_notificacion`;
/*!40000 ALTER TABLE `z_notificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `z_notificacion` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_parametros
CREATE TABLE IF NOT EXISTS `z_parametros` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_desc` varchar(50) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_parametros: ~7 rows (aproximadamente)
DELETE FROM `z_parametros`;
/*!40000 ALTER TABLE `z_parametros` DISABLE KEYS */;
INSERT INTO `z_parametros` (`p_id`, `p_desc`) VALUES
	(1, 'PUBLICADO'),
	(2, 'PROGRAMADO'),
	(3, 'EN EJECUCION'),
	(4, 'TERMINADO'),
	(5, 'CANCELADO'),
	(6, 'PAGO PENDIENTE'),
	(7, 'PAGADO');
/*!40000 ALTER TABLE `z_parametros` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_ratings
CREATE TABLE IF NOT EXISTS `z_ratings` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_viaje_id` int(11) DEFAULT NULL,
  `r_conductor_id` int(11) DEFAULT NULL,
  `r_vehicle_id` int(11) DEFAULT NULL,
  `r_calificacion_viaje` double DEFAULT NULL,
  `r_calificacion_conductor` double DEFAULT NULL,
  `r_calificacion_vehicle` double DEFAULT NULL,
  `r_calificacion_plataforma` double DEFAULT NULL,
  `r_calificado_on` datetime DEFAULT NULL,
  `r_calificado_por` int(11) DEFAULT NULL,
  `r_modificado_on` datetime DEFAULT NULL,
  `r_modificado_por` int(11) DEFAULT NULL,
  `r_calificado_veh_on` datetime DEFAULT NULL,
  `r_calificado_veh_por` int(11) DEFAULT NULL,
  `r_modificado_veh_on` datetime DEFAULT NULL,
  `r_modificado_veh_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_ratings: ~2 rows (aproximadamente)
DELETE FROM `z_ratings`;
/*!40000 ALTER TABLE `z_ratings` DISABLE KEYS */;
INSERT INTO `z_ratings` (`r_id`, `r_viaje_id`, `r_conductor_id`, `r_vehicle_id`, `r_calificacion_viaje`, `r_calificacion_conductor`, `r_calificacion_vehicle`, `r_calificacion_plataforma`, `r_calificado_on`, `r_calificado_por`, `r_modificado_on`, `r_modificado_por`, `r_calificado_veh_on`, `r_calificado_veh_por`, `r_modificado_veh_on`, `r_modificado_veh_por`) VALUES
	(3, 347, 34, NULL, NULL, 3, NULL, NULL, '2017-01-04 21:01:55', 35, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 347, NULL, 23, NULL, NULL, 4.25, NULL, NULL, NULL, NULL, NULL, '2017-01-04 21:02:22', 35, NULL, NULL);
/*!40000 ALTER TABLE `z_ratings` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_roles
CREATE TABLE IF NOT EXISTS `z_roles` (
  `r_id` int(1) NOT NULL AUTO_INCREMENT,
  `r_desc` varchar(50) DEFAULT NULL,
  `r_is_enabled` int(1) DEFAULT NULL COMMENT '0:yes, 1:no',
  `r_created_on` datetime DEFAULT NULL,
  `r_created_by` int(9) DEFAULT NULL,
  `r_modified_on` datetime DEFAULT NULL,
  `r_modified_by` int(9) DEFAULT NULL,
  `r_observatio` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_roles: ~4 rows (aproximadamente)
DELETE FROM `z_roles`;
/*!40000 ALTER TABLE `z_roles` DISABLE KEYS */;
INSERT INTO `z_roles` (`r_id`, `r_desc`, `r_is_enabled`, `r_created_on`, `r_created_by`, `r_modified_on`, `r_modified_by`, `r_observatio`) VALUES
	(1, 'ADMINISTRADOR', 0, '2016-10-26 15:03:41', NULL, NULL, NULL, NULL),
	(2, 'CONDUCTOR', 0, '2016-10-26 15:03:44', NULL, NULL, NULL, NULL),
	(3, 'PASAJERO', 0, '2016-10-26 15:03:45', NULL, NULL, NULL, NULL),
	(4, 'DESARROLLADOR', 0, '2016-10-26 15:03:47', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `z_roles` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_terminal
CREATE TABLE IF NOT EXISTS `z_terminal` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(100) DEFAULT NULL,
  `t_id_ciudad` int(11) DEFAULT NULL,
  `t_estado` int(11) DEFAULT NULL COMMENT '0:habilitado,1:deshabilitado',
  `longitud` double DEFAULT NULL,
  `latitud` double DEFAULT NULL,
  PRIMARY KEY (`t_id`),
  KEY `FK_z_terminal_z_ciudad` (`t_id_ciudad`),
  CONSTRAINT `FK_z_terminal_z_ciudad` FOREIGN KEY (`t_id_ciudad`) REFERENCES `z_ciudad` (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_terminal: ~8 rows (aproximadamente)
DELETE FROM `z_terminal`;
/*!40000 ALTER TABLE `z_terminal` DISABLE KEYS */;
INSERT INTO `z_terminal` (`t_id`, `t_name`, `t_id_ciudad`, `t_estado`, `longitud`, `latitud`) VALUES
	(1, 'AEROPUERTO QUITO', 1, 0, -0.1212164, -78.3586225),
	(2, 'SOLCA', 1, 0, -0.136693, -78.468822),
	(3, 'PLAZA DE TOROS', 1, 0, -0.163364, -78.484074),
	(4, 'CONDADO SHOPPING', 1, 0, -0.1027989, -78.4904186),
	(5, 'CARAPUNGO', 1, 0, -0.0940492, -78.4510101),
	(6, 'MALL EL JARDIN', 1, 0, -0.189569, -78.487386),
	(7, 'PLAZA GRANDE-CENTRO HISTORICO', 1, 0, -0.2200615, -78.5120744),
	(8, 'CENTRO DE GUAYAQUIL', 2, 0, -2.1442952, -79.8710912);
/*!40000 ALTER TABLE `z_terminal` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_tipo_cuenta
CREATE TABLE IF NOT EXISTS `z_tipo_cuenta` (
  `tc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_tipo_cuenta: ~2 rows (aproximadamente)
DELETE FROM `z_tipo_cuenta`;
/*!40000 ALTER TABLE `z_tipo_cuenta` DISABLE KEYS */;
INSERT INTO `z_tipo_cuenta` (`tc_id`, `tc_desc`) VALUES
	(1, 'AHORRO'),
	(2, 'CORRIENTE');
/*!40000 ALTER TABLE `z_tipo_cuenta` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_userdocs
CREATE TABLE IF NOT EXISTS `z_userdocs` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_veh_id` int(11) DEFAULT '0',
  `d_user` int(9) DEFAULT NULL,
  `d_document_type` int(11) DEFAULT NULL,
  `d_document_name` varchar(200) DEFAULT NULL,
  `d_created_on` datetime DEFAULT NULL,
  `d_modified_on` datetime DEFAULT NULL,
  `d_is_doc_verified` int(11) DEFAULT '9' COMMENT '0:SI,1:NO;9:PENDIENTE',
  `d_ultimo_verificacion` datetime DEFAULT NULL,
  `d_observacion` varchar(750) DEFAULT NULL,
  PRIMARY KEY (`d_id`),
  KEY `FK_z_userdocs_z_docs` (`d_document_type`),
  KEY `FK_z_userdocs_z_users` (`d_user`),
  CONSTRAINT `FK_z_userdocs_z_docs` FOREIGN KEY (`d_document_type`) REFERENCES `z_docs` (`d_id`),
  CONSTRAINT `FK_z_userdocs_z_users` FOREIGN KEY (`d_user`) REFERENCES `z_users` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_userdocs: ~4 rows (aproximadamente)
DELETE FROM `z_userdocs`;
/*!40000 ALTER TABLE `z_userdocs` DISABLE KEYS */;
INSERT INTO `z_userdocs` (`d_id`, `d_veh_id`, `d_user`, `d_document_type`, `d_document_name`, `d_created_on`, `d_modified_on`, `d_is_doc_verified`, `d_ultimo_verificacion`, `d_observacion`) VALUES
	(55, 0, 34, 1, 'images/pics/Cedula-34.jpg', '2017-01-04 20:04:12', '2017-01-12 02:42:54', 0, '2017-01-12 02:45:20', 'ok'),
	(56, 0, 34, 3, 'images/pics/Licencia-34.jpg', '2017-01-04 20:04:12', '2017-01-12 02:44:55', 0, '2017-01-12 02:45:28', 'ok'),
	(57, 23, 34, 4, 'images/pics/Matricula-34-57.jpg', '2017-01-04 20:09:05', '2017-01-12 02:43:47', 0, '2017-01-12 02:45:35', 'ok'),
	(58, 0, 35, 1, 'images/pics/Cedula-35.jpg', '2017-01-04 20:19:36', NULL, 0, '2017-01-04 20:20:02', 'ok');
/*!40000 ALTER TABLE `z_userdocs` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_users
CREATE TABLE IF NOT EXISTS `z_users` (
  `u_id` int(9) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(100) DEFAULT NULL,
  `u_role` int(11) DEFAULT NULL,
  `u_emailId` varchar(100) DEFAULT NULL,
  `u_celular` varchar(15) DEFAULT NULL,
  `u_conventional` varchar(15) DEFAULT NULL,
  `u_cedula` varchar(10) DEFAULT NULL,
  `u_licence_number` varchar(50) DEFAULT NULL,
  `u_created_on` datetime DEFAULT NULL,
  `u_created_by` int(9) DEFAULT NULL,
  `u_modified_on` datetime DEFAULT NULL,
  `u_modified_by` int(9) DEFAULT NULL,
  `u_observation` varchar(1000) DEFAULT NULL,
  `u_profile_pic` varchar(200) DEFAULT NULL,
  `u_is_email_verified` int(11) DEFAULT '1' COMMENT '0:SI,1:NO',
  `u_verificacion_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_emailId` (`u_emailId`),
  KEY `FK_role` (`u_role`),
  CONSTRAINT `FK_role` FOREIGN KEY (`u_role`) REFERENCES `z_roles` (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_users: ~3 rows (aproximadamente)
DELETE FROM `z_users`;
/*!40000 ALTER TABLE `z_users` DISABLE KEYS */;
INSERT INTO `z_users` (`u_id`, `u_name`, `u_role`, `u_emailId`, `u_celular`, `u_conventional`, `u_cedula`, `u_licence_number`, `u_created_on`, `u_created_by`, `u_modified_on`, `u_modified_by`, `u_observation`, `u_profile_pic`, `u_is_email_verified`, `u_verificacion_code`) VALUES
	(1, 'admin', 1, 'admin@zielus.com', NULL, NULL, NULL, NULL, '2016-10-26 15:13:46', 1, NULL, NULL, NULL, NULL, 0, NULL),
	(34, 'hussain mahaboob', 3, 'hussain.mm.2006@gmail.com', '67584635', '765757', '1777777', '', '2017-01-04 20:00:25', 1, '2017-01-04 20:03:39', 34, NULL, 'images/pics/ProfilePic-34.jpg', 0, 2011057418),
	(35, 'pasajero 1', 3, 'pasajero1@gmail.com', '6654646', '54646', '545353535', '', '2017-01-04 20:13:18', 1, '2017-01-04 20:19:02', 35, NULL, 'images/pics/ProfilePic-35.jpg', 0, 1468774637);
/*!40000 ALTER TABLE `z_users` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_viajes
CREATE TABLE IF NOT EXISTS `z_viajes` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_codigo_viaje` varchar(12) NOT NULL,
  `v_automovil_id` int(11) DEFAULT NULL,
  `v_desde` int(11) NOT NULL,
  `v_hasta` int(11) NOT NULL,
  `v_fecha_salida` datetime NOT NULL,
  `v_estado` int(11) NOT NULL DEFAULT '1',
  `v_ocupado` int(11) NOT NULL DEFAULT '0',
  `v_cant_pagado_retorno` int(11) NOT NULL DEFAULT '0',
  `v_cant_retorno_servido` int(11) NOT NULL DEFAULT '0',
  `v_min_pasajeros` int(11) NOT NULL,
  `v_equipaje_pasajero` int(11) NOT NULL DEFAULT '1',
  `v_costo_viaje` double NOT NULL,
  `v_acceptas_mascotas` int(11) NOT NULL DEFAULT '0' COMMENT '1:SI, 0:NO',
  `v_acceptas_fumar` int(11) NOT NULL DEFAULT '0' COMMENT '1:SI, 0:NO',
  `v_acceptas_alcohol` int(11) NOT NULL DEFAULT '0' COMMENT '1:SI, 0:NO',
  `v_paradas_comer` int(11) NOT NULL DEFAULT '0',
  `v_diligencias` int(11) NOT NULL DEFAULT '0',
  `v_mercancias` int(11) NOT NULL DEFAULT '0',
  `v_created_on` datetime NOT NULL,
  `v_created_by` int(11) NOT NULL,
  `v_modified_on` datetime NOT NULL,
  `v_modified_by` int(11) NOT NULL,
  `v_observaciones` varchar(2000) NOT NULL,
  PRIMARY KEY (`v_id`),
  KEY `FK_z_viajes_z_terminal` (`v_desde`),
  KEY `FK_z_viajes_z_terminal_2` (`v_hasta`),
  CONSTRAINT `FK_z_viajes_z_terminal` FOREIGN KEY (`v_desde`) REFERENCES `z_terminal` (`t_id`),
  CONSTRAINT `FK_z_viajes_z_terminal_2` FOREIGN KEY (`v_hasta`) REFERENCES `z_terminal` (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=355 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_viajes: ~22 rows (aproximadamente)
DELETE FROM `z_viajes`;
/*!40000 ALTER TABLE `z_viajes` DISABLE KEYS */;
INSERT INTO `z_viajes` (`v_id`, `v_codigo_viaje`, `v_automovil_id`, `v_desde`, `v_hasta`, `v_fecha_salida`, `v_estado`, `v_ocupado`, `v_cant_pagado_retorno`, `v_cant_retorno_servido`, `v_min_pasajeros`, `v_equipaje_pasajero`, `v_costo_viaje`, `v_acceptas_mascotas`, `v_acceptas_fumar`, `v_acceptas_alcohol`, `v_paradas_comer`, `v_diligencias`, `v_mercancias`, `v_created_on`, `v_created_by`, `v_modified_on`, `v_modified_by`, `v_observaciones`) VALUES
	(317, '', 23, 5, 1, '2017-01-31 10:00:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:11:51', 34, '0000-00-00 00:00:00', 0, ''),
	(318, '', 23, 5, 1, '2017-01-31 10:30:00', 2, 1, 1, 0, 3, 1, 12, 0, 0, 0, 0, 0, 0, '2017-01-04 20:11:51', 34, '0000-00-00 00:00:00', 0, ''),
	(319, '', 23, 5, 1, '2017-01-31 11:00:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:11:51', 34, '0000-00-00 00:00:00', 0, ''),
	(320, '', 23, 1, 6, '2017-01-31 11:30:00', 2, 1, 1, 0, 3, 1, 6, 0, 0, 0, 0, 0, 0, '2017-01-04 20:11:51', 34, '0000-00-00 00:00:00', 0, ''),
	(321, '', 23, 5, 1, '2017-01-31 12:00:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:11:51', 34, '0000-00-00 00:00:00', 0, ''),
	(322, '', 23, 5, 1, '2017-01-31 12:30:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:11:51', 34, '0000-00-00 00:00:00', 0, ''),
	(339, '', 23, 6, 1, '2017-01-30 07:00:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:41:21', 34, '0000-00-00 00:00:00', 0, ''),
	(340, '', 23, 6, 1, '2017-01-30 07:30:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:41:21', 34, '0000-00-00 00:00:00', 0, ''),
	(341, '', 23, 6, 1, '2017-01-30 08:00:00', 2, 1, 1, 0, 3, 1, 12, 0, 0, 0, 0, 0, 0, '2017-01-04 20:41:21', 34, '0000-00-00 00:00:00', 0, ''),
	(342, '', 23, 6, 1, '2017-01-30 08:30:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:41:21', 34, '0000-00-00 00:00:00', 0, ''),
	(343, '', 23, 1, 6, '2017-01-30 09:00:00', 1, 0, 1, 0, 3, 1, 6, 0, 0, 0, 0, 0, 0, '2017-01-04 20:41:21', 34, '0000-00-00 00:00:00', 0, ''),
	(344, '', 23, 6, 1, '2017-01-30 09:30:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:41:21', 34, '0000-00-00 00:00:00', 0, ''),
	(345, '', 23, 6, 1, '2017-01-30 10:00:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:41:21', 34, '0000-00-00 00:00:00', 0, ''),
	(346, '', 23, 6, 1, '2017-01-30 10:30:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:41:21', 34, '0000-00-00 00:00:00', 0, ''),
	(347, '', 23, 2, 1, '2017-01-04 06:00:00', 1, 1, 1, 0, 3, 1, 12, 0, 0, 0, 0, 0, 0, '2017-01-04 20:44:09', 34, '0000-00-00 00:00:00', 0, ''),
	(348, '', 23, 2, 1, '2017-01-20 06:30:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:44:09', 34, '0000-00-00 00:00:00', 0, ''),
	(349, '', 23, 1, 6, '2017-01-20 07:00:00', 1, 0, 1, 0, 3, 1, 6, 0, 0, 0, 0, 0, 0, '2017-01-04 20:44:09', 34, '0000-00-00 00:00:00', 0, ''),
	(350, '', 23, 2, 1, '2017-01-20 07:30:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-04 20:44:09', 34, '0000-00-00 00:00:00', 0, ''),
	(351, '', 23, 5, 1, '2017-02-10 02:00:00', 0, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-11 23:49:36', 34, '0000-00-00 00:00:00', 0, ''),
	(352, '', 23, 5, 1, '2017-02-10 02:30:00', 0, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-11 23:49:36', 34, '0000-00-00 00:00:00', 0, ''),
	(353, '', 23, 5, 1, '2017-02-10 03:00:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-11 23:49:36', 34, '0000-00-00 00:00:00', 0, ''),
	(354, '', 23, 5, 1, '2017-02-10 03:30:00', 99, 0, 0, 0, 3, 1, 0, 0, 0, 0, 0, 0, 0, '2017-01-11 23:49:36', 34, '0000-00-00 00:00:00', 0, '');
/*!40000 ALTER TABLE `z_viajes` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_viajespasajero
CREATE TABLE IF NOT EXISTS `z_viajespasajero` (
  `vp_id` int(11) NOT NULL AUTO_INCREMENT,
  `vp_viaje_id` int(11) DEFAULT '0',
  `vp_codigo_viaje` varchar(50) DEFAULT '0',
  `vp_pass_id` int(11) DEFAULT '0',
  `vp_fecha_aceptacion` datetime DEFAULT NULL,
  `vp_direccion` varchar(200) DEFAULT NULL,
  `vp_tipo_pago` int(11) DEFAULT NULL,
  `vp_pic_pago` varchar(200) DEFAULT NULL,
  `vp_fecha_pago` datetime DEFAULT NULL,
  `vp_estado_viaje` int(11) DEFAULT '0' COMMENT '0:PENDIENTE, 1:TERMINADO',
  `vp_pago_verificado` int(11) DEFAULT '99' COMMENT '1:APROBADO, 0:RECHAZADO,99:PENDIENTE',
  `vp_observacion` varchar(500) DEFAULT NULL,
  `vp_doc_paymet_to_client` varchar(20) DEFAULT NULL,
  `vp_dt_payment_to_client` date DEFAULT NULL,
  PRIMARY KEY (`vp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_viajespasajero: ~6 rows (aproximadamente)
DELETE FROM `z_viajespasajero`;
/*!40000 ALTER TABLE `z_viajespasajero` DISABLE KEYS */;
INSERT INTO `z_viajespasajero` (`vp_id`, `vp_viaje_id`, `vp_codigo_viaje`, `vp_pass_id`, `vp_fecha_aceptacion`, `vp_direccion`, `vp_tipo_pago`, `vp_pic_pago`, `vp_fecha_pago`, `vp_estado_viaje`, `vp_pago_verificado`, `vp_observacion`, `vp_doc_paymet_to_client`, `vp_dt_payment_to_client`) VALUES
	(11, 318, '1210321363', 35, '2017-01-04 20:21:05', 'gasper', 1, 'images/pics/PagoPic-1210321363-35.jpg', '2017-01-04 20:21:05', 2, 1, 'ok', NULL, NULL),
	(12, 320, '1210321363', 35, '2017-01-04 20:29:17', 'QUITO AEROPUERTO', 1, 'images/pics/PagoPic-1210321363-35.jpg', '2017-01-04 20:21:05', 2, 1, 'ok', NULL, NULL),
	(13, 341, '76438953', 35, '2017-01-04 20:41:21', '1', 1, 'images/pics/PagoPic-76438953-35.jpg', '2017-01-04 20:41:21', 2, 1, 'ok', NULL, NULL),
	(14, 343, '76438953', 35, NULL, 'QUITO AEROPUERTO', 1, 'images/pics/PagoPic-76438953-35.jpg', '2017-01-04 20:41:21', 0, 1, 'ok', NULL, NULL),
	(15, 347, '171689456', 35, '2017-01-04 20:44:09', '1', 1, 'images/pics/PagoPic-171689456-35.jpg', '2017-01-04 20:44:09', 1, 1, 'ok', '333', '2017-01-02'),
	(16, 349, '171689456', 35, NULL, 'QUITO AEROPUERTO', 1, 'images/pics/PagoPic-171689456-35.jpg', '2017-01-04 20:44:09', 0, 1, 'ok', '', '0000-00-00');
/*!40000 ALTER TABLE `z_viajespasajero` ENABLE KEYS */;


-- Volcando estructura para tabla zielus.z_viajes_solicitado
CREATE TABLE IF NOT EXISTS `z_viajes_solicitado` (
  `vs_id` int(11) NOT NULL AUTO_INCREMENT,
  `vs_desde` int(11) DEFAULT NULL,
  `vs_hasta` int(11) DEFAULT '1',
  `vs_direccion` varchar(200) DEFAULT '1',
  `vs_fecha_viaje` datetime DEFAULT NULL,
  `vs_cant_pasajeros` int(11) DEFAULT '1',
  `vs_plan_retorno` int(11) DEFAULT '0',
  `vs_costo_viaje` double DEFAULT '0',
  `vs_codigo_pago` varchar(50) DEFAULT NULL,
  `vs_tipo_pago` int(11) DEFAULT NULL,
  `vs_codigo_viaje` int(11) DEFAULT NULL,
  `vs_estado_solicitud` int(11) DEFAULT '0' COMMENT '0:pendiente, 1:terminado,2:cancelado',
  `vs_created_by` int(11) DEFAULT NULL,
  `vs_created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`vs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla zielus.z_viajes_solicitado: ~1 rows (aproximadamente)
DELETE FROM `z_viajes_solicitado`;
/*!40000 ALTER TABLE `z_viajes_solicitado` DISABLE KEYS */;
INSERT INTO `z_viajes_solicitado` (`vs_id`, `vs_desde`, `vs_hasta`, `vs_direccion`, `vs_fecha_viaje`, `vs_cant_pasajeros`, `vs_plan_retorno`, `vs_costo_viaje`, `vs_codigo_pago`, `vs_tipo_pago`, `vs_codigo_viaje`, `vs_estado_solicitud`, `vs_created_by`, `vs_created_on`) VALUES
	(6, 6, 1, '1', '2017-01-30 08:00:00', 1, 1, 12, '76438953', 1, 341, 1, 35, '2017-01-04 20:31:08'),
	(7, 2, 1, '1', '2017-01-20 06:00:00', 1, 1, 12, '171689456', 1, 347, 1, 35, '2017-01-04 20:43:21');
/*!40000 ALTER TABLE `z_viajes_solicitado` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
