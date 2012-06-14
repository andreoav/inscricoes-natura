/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : sysinscricoes

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2012-06-14 11:24:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `campeonatos`
-- ----------------------------
DROP TABLE IF EXISTS `campeonatos`;
CREATE TABLE `campeonatos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`nome`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of campeonatos
-- ----------------------------
INSERT INTO `campeonatos` VALUES ('1', 'Campeonato Gaúcho de Orientação 2012');
INSERT INTO `campeonatos` VALUES ('2', 'Campeonato para Testes');
INSERT INTO `campeonatos` VALUES ('3', 'Campeonato Brasileiro de Orientação');

-- ----------------------------
-- Table structure for `etapas`
-- ----------------------------
DROP TABLE IF EXISTS `etapas`;
CREATE TABLE `etapas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `localidade` varchar(255) NOT NULL,
  `data_inicio` int(11) unsigned NOT NULL,
  `data_final` int(11) NOT NULL,
  `inscricao_ate` int(11) NOT NULL,
  `campeonato_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`,`campeonato_id`),
  KEY `id` (`id`),
  KEY `fk_campeonato_etapa` (`campeonato_id`),
  CONSTRAINT `fk_campeonato_etapa` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of etapas
-- ----------------------------
INSERT INTO `etapas` VALUES ('1', 'I Etapa CGO', 'Santa Cruz do Sul - RS', '1332903600', '1332903600', '1331175600', '1');
INSERT INTO `etapas` VALUES ('2', 'II Etapa CGO', 'Itaara', '1338087600', '1338087600', '1337482800', '1');
INSERT INTO `etapas` VALUES ('4', 'IV Etapa CGO', 'Bagé - Rio Grande do Sul, Brasil', '1342321200', '1342321200', '1341889200', '1');
INSERT INTO `etapas` VALUES ('5', 'III Etapa CGO', 'Santa Maria, Rio Grande do Sul', '1339902000', '1339902000', '1339297200', '1');
INSERT INTO `etapas` VALUES ('6', 'Etapa 1 - Teste', 'Uruguaiana, Rio Grande do Sul', '1352426400', '1352426400', '1351735200', '2');
INSERT INTO `etapas` VALUES ('7', 'I Etapa CamBOr 2012', 'Uruguaiana, Rio Grande do Sul', '1351389600', '1351476000', '1350702000', '3');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'admin', '100', '1', '0');
INSERT INTO `groups` VALUES ('2', 'atleta', '1', '0', '0');

-- ----------------------------
-- Table structure for `inscricoes`
-- ----------------------------
DROP TABLE IF EXISTS `inscricoes`;
CREATE TABLE `inscricoes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(10) NOT NULL,
  `comprovante` varchar(255) NOT NULL,
  `status` int(11) unsigned DEFAULT NULL,
  `observacao` text,
  `etapa_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `id` (`id`),
  KEY `fk_etapa_inscricao` (`etapa_id`),
  KEY `fk_inscricao_user` (`user_id`),
  CONSTRAINT `fk_etapa_inscricao` FOREIGN KEY (`etapa_id`) REFERENCES `etapas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_inscricao_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of inscricoes
-- ----------------------------
INSERT INTO `inscricoes` VALUES ('1', 'H21E', 'campeonato-gaucho-de-orientacao-2012/iii-etapa-cgo/andreo-vieira_digitalizar0004.jpg', '1', 'Obs', '5', '1', '1338648020');
INSERT INTO `inscricoes` VALUES ('3', 'H21E', 'campeonato-gaucho-de-orientacao-2012/iii-etapa-cgo/joao-batista_digitalizar0031.jpg', '2', '', '5', '2', '1338659165');
INSERT INTO `inscricoes` VALUES ('4', 'H21E', 'campeonato-gaucho-de-orientacao-2012/iv-etapa-cgo/andreo-vieira_digitalizar0031.jpg', '2', '', '4', '1', '1338659236');
INSERT INTO `inscricoes` VALUES ('11', 'H21E', 'campeonato-para-testes/etapa-1-teste/andreo-vieira_set1.zip', '2', 'Observação', '6', '1', '1339615048');
INSERT INTO `inscricoes` VALUES ('12', 'H21E', 'campeonato-brasileiro-de-orientacao/i-etapa-cambor-2012/andreo-vieira_d0a81bbd1a7580764255d46ad400a6af.jpeg', '2', 'Observação', '7', '1', '1339615062');

-- ----------------------------
-- Table structure for `noticias`
-- ----------------------------
DROP TABLE IF EXISTS `noticias`;
CREATE TABLE `noticias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_noticia_user` (`user_id`),
  CONSTRAINT `fk_noticia_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of noticias
-- ----------------------------

-- ----------------------------
-- Table structure for `respostas`
-- ----------------------------
DROP TABLE IF EXISTS `respostas`;
CREATE TABLE `respostas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conteudo` text NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `inscricao_id` int(11) unsigned NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inscricao_resposta` (`inscricao_id`),
  KEY `fk_resposta_user` (`user_id`),
  CONSTRAINT `fk_inscricao_resposta` FOREIGN KEY (`inscricao_id`) REFERENCES `inscricoes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_resposta_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of respostas
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(81) NOT NULL,
  `password_reset_hash` varchar(81) NOT NULL,
  `temp_password` varchar(81) NOT NULL,
  `remember_me` varchar(81) NOT NULL,
  `activation_hash` varchar(81) NOT NULL,
  `last_login` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `activated` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'andreoav', 'andreoav@gmail.com', 'bQgPFKWNjGGVB3pWee6ac5e49cf600bdc907d0b79e5382b221003c10e5bb14fd9775c4ff85b99625', '', '', 'di6l1rs7rtfnNdDm30f599d93101613577deaab860d0ef9f855b6ed6394687a29f62efecac8685a1', '', '1339623946', '127.0.0.1', '1339624114', '1336793644', '1', '1');
INSERT INTO `users` VALUES ('2', 'joaobpv', 'presidente@naturaco.org', 'aSgrB8X7rq79M9V33daa607fef6a6ed3cfd5eac6039712e7cba7c62a16db5f8f8214c188d50eda4e', '', '', 'q4ik04fv6CllmxtIcfbb82881152f45486fcc7067555bd6e639d0eb94e87ce8002d0e620349e9acb', '', '1338659153', '127.0.0.1', '1338659153', '1338658435', '1', '1');
INSERT INTO `users` VALUES ('3', 'Natura CO', 'natura@naturaco.org', 'jPLjCHCjBbY3WR8Cccfc45b8d8927dc7819088c253f24800a7bf77ad4b146afe3510dce6e1ae245e', '', '', '', '', '1338672186', '127.0.0.1', '1338672222', '1338672186', '1', '1');
INSERT INTO `users` VALUES ('4', 'karolinasimon', 'karolinasimon@gmail.com', 'IMY4mETy1QMiMHQ8cf7c79c66f7fad39bc09d365596f0d4d03991dcce4dc9d1972b0bcd6603abd51', '', '', '', '', '1339624160', '127.0.0.1', '1339624268', '1339624160', '1', '1');

-- ----------------------------
-- Table structure for `users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('1', '1');
INSERT INTO `users_groups` VALUES ('2', '2');
INSERT INTO `users_groups` VALUES ('3', '2');
INSERT INTO `users_groups` VALUES ('4', '2');

-- ----------------------------
-- Table structure for `users_metadata`
-- ----------------------------
DROP TABLE IF EXISTS `users_metadata`;
CREATE TABLE `users_metadata` (
  `user_id` int(11) unsigned NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` char(14) NOT NULL,
  `identidade` char(10) NOT NULL,
  `nascimento` char(10) NOT NULL,
  `numero_cbo` varchar(15) DEFAULT NULL,
  `sicard` varchar(15) DEFAULT NULL,
  `alergia` tinyint(1) DEFAULT NULL,
  `sistema_tour` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`cpf`,`identidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_metadata
-- ----------------------------
INSERT INTO `users_metadata` VALUES ('1', 'Andreo Vieira', '022.878.130-20', '5077333754', '08/03/1990', '1234', '152162', '1', '1');
INSERT INTO `users_metadata` VALUES ('2', 'João Batista', '442.392.200-25', '9999999999', '28/09/1963', '', '', null, '0');
INSERT INTO `users_metadata` VALUES ('3', 'Natura CO', '111.111.111-11', '1111111111', '11/11/2012', '', '', null, '0');
INSERT INTO `users_metadata` VALUES ('4', '', '', '', '', null, null, null, '1');

-- ----------------------------
-- Table structure for `users_suspended`
-- ----------------------------
DROP TABLE IF EXISTS `users_suspended`;
CREATE TABLE `users_suspended` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login_id` varchar(50) NOT NULL,
  `attempts` int(50) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `last_attempt_at` int(11) NOT NULL,
  `suspended_at` int(11) NOT NULL,
  `unsuspend_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_suspended
-- ----------------------------
