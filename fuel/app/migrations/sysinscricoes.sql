/*
Navicat MySQL Data Transfer

Source Server         : MySQL Local
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : sysinscricoes

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-06-28 13:59:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `boletins`
-- ----------------------------
DROP TABLE IF EXISTS `boletins`;
CREATE TABLE `boletins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `etapa_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`,`nome`),
  KEY `fk_boletim_etapa` (`etapa_id`),
  CONSTRAINT `fk_boletim_etapa` FOREIGN KEY (`etapa_id`) REFERENCES `etapas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of boletins
-- ----------------------------
INSERT INTO `boletins` VALUES ('1', 'andreo-vieira_6ce5f81349509211083740ae4c596ab5(4).pdf', '17');
INSERT INTO `boletins` VALUES ('2', 'andreo-vieira_6ce5f81349509211083740ae4c596ab5.pdf', '17');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of etapas
-- ----------------------------
INSERT INTO `etapas` VALUES ('1', 'I Etapa CGO', 'Santa Cruz do Sul - RS', '1332903600', '1332903600', '1331175600', '1');
INSERT INTO `etapas` VALUES ('2', 'II Etapa CGO', 'Itaara', '1338087600', '1338087600', '1337482800', '1');
INSERT INTO `etapas` VALUES ('4', 'IV Etapa CGO', 'Bagé - Rio Grande do Sul, Brasil', '1342321200', '1342321200', '1341889200', '1');
INSERT INTO `etapas` VALUES ('5', 'III Etapa CGO', 'Santa Maria, Rio Grande do Sul', '1339902000', '1339902000', '1339297200', '1');
INSERT INTO `etapas` VALUES ('6', 'Etapa 1 - Teste', 'Uruguaiana, Rio Grande do Sul', '1352426400', '1352426400', '1351735200', '2');
INSERT INTO `etapas` VALUES ('7', 'III Etapa CamBOr 2012', 'Santa Rosa', '1349060400', '1349146800', '1348110000', '3');
INSERT INTO `etapas` VALUES ('17', 'Etapa Teste 2', 'Localidade de Teste', '1343358000', '1341111600', '1342753200', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of inscricoes
-- ----------------------------
INSERT INTO `inscricoes` VALUES ('3', 'H 45 A', 'campeonato-gaucho-de-orientacao-2012/iv-etapa-cgo/andreo-vieira_619ab51818b4a44baddbb4772a55fd04.jpg', '1', '', '4', '1', '1340378741');
INSERT INTO `inscricoes` VALUES ('4', 'D 10 N', 'campeonato-para-testes/etapa-1-teste/joao-batista-porcella-vieira_f2556f4e0b7b0f7724a2c81e9013fcdb.jpg', '1', '', '6', '2', '1340630495');

-- ----------------------------
-- Table structure for `noticias`
-- ----------------------------
DROP TABLE IF EXISTS `noticias`;
CREATE TABLE `noticias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`,`titulo`,`user_id`),
  KEY `fk_notica_user` (`user_id`),
  CONSTRAINT `fk_notica_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of noticias
-- ----------------------------
INSERT INTO `noticias` VALUES ('1', 'Notícia 1 - Teste 1 às [14:49]', '<p><span style=\"color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: justify; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none; \">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum<span id=\"pastemarkerend\">&nbsp;</span></span></p>\r\n', '1340387441', '1340387441', '1');
INSERT INTO `noticias` VALUES ('2', 'Notícia 2 - Teste 2 às [14:54]', '<p><span style=\"color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: justify; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none; \">Lorem\r\n ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy \r\nnibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut\r\n wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper \r\nsuscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem \r\nvel eum iriure dolor in hendrerit in vulputate velit esse molestie \r\nconsequat, vel illum dolore eu feugiat nulla facilisis at vero eros et \r\naccumsan et iusto odio dignissim qui blandit praesent luptatum zzril \r\ndelenit augue duis dolore te feugait nulla facilisi. Nam liber tempor \r\ncum soluta nobis eleifend option congue nihil imperdiet doming id quod \r\nmazim placerat facer possim assum. Typi non habent claritatem insitam; \r\nest usus legentis in iis qui facit eorum claritatem. Investigationes \r\ndemonstraverunt lectores legere me lius quod ii legunt saepius. Claritas\r\n est etiam processus dynamicus, qui sequitur mutationem consuetudium \r\nlectorum. Mirum est notare quam littera gothica, quam nunc putamus parum\r\n claram, anteposuerit litterarum formas humanitatis per seacula quarta \r\ndecima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum \r\nclari, fiant sollemnes in futurum<span id=\"pastemarkerend\"><span id=\"pastemarkerend\">&nbsp;</span></span></span></p>\r\n', '1340387665', '1340387665', '1');
INSERT INTO `noticias` VALUES ('3', 'Notícia 3 - Teste 3 às [14:57]', '<p><span style=\"color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: justify; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none; \">Lorem\r\n ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy \r\nnibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut\r\n wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper \r\nsuscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem \r\nvel eum iriure dolor in hendrerit in vulputate velit esse molestie \r\nconsequat, vel illum dolore eu feugiat nulla facilisis at vero eros et \r\naccumsan et iusto odio dignissim qui blandit praesent luptatum zzril \r\ndelenit augue duis dolore te feugait nulla facilisi. Nam liber tempor \r\ncum soluta nobis eleifend option congue nihil imperdiet doming id quod \r\nmazim placerat facer possim assum. Typi non habent claritatem insitam; \r\nest usus legentis in iis qui facit eorum claritatem. Investigationes \r\ndemonstraverunt lectores legere me lius quod ii legunt saepius. Claritas\r\n est etiam processus dynamicus, qui sequitur mutationem consuetudium \r\nlectorum. Mirum est notare quam littera gothica, quam nunc putamus parum\r\n claram, anteposuerit litterarum formas humanitatis per seacula quarta \r\ndecima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum \r\nclari, fiant sollemnes in futurum<span id=\"pastemarkerend\"><span id=\"pastemarkerend\">&nbsp;</span></span></span></p>\r\n', '1340387832', '1340387832', '1');
INSERT INTO `noticias` VALUES ('4', 'Notícia 4 - Teste 4 às [15:06]', '<p><span style=\"color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: left; text-transform: none; white-space: pre; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none; \">Notícia inserida as 15 : 06</span><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(199, 61, 255); font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: left; text-transform: none; white-space: pre; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; \"><span id=\"pastemarkerend\"></span></span><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(199, 61, 255); font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: left; text-transform: none; white-space: pre; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; \"><span id=\"pastemarkerend\"></span></span></p>\r\n', '1340388376', '1340388376', '1');

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
  CONSTRAINT `fk_inscricao_resposta` FOREIGN KEY (`inscricao_id`) REFERENCES `inscricoes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_resposta_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of respostas
-- ----------------------------
INSERT INTO `respostas` VALUES ('1', 'Resposata', '1', '3', '1340388628');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'andreoav', 'andreoav@gmail.com', 'bQgPFKWNjGGVB3pWee6ac5e49cf600bdc907d0b79e5382b221003c10e5bb14fd9775c4ff85b99625', '', '', 'zB6odI0ezKLl9wzie238a4028bbdc34797f9a10018a03012fcdb9f48c8369130bb126ee24605239e', '', '1340891509', '127.0.0.1', '1340891509', '1336793644', '1', '1');
INSERT INTO `users` VALUES ('2', 'joaobpv', 'presidente@naturaco.org', 'aSgrB8X7rq79M9V33daa607fef6a6ed3cfd5eac6039712e7cba7c62a16db5f8f8214c188d50eda4e', '', '', '8v8ZvlAejUAZ4i1ud53e5b122c2319a9540fd7ff659ccede8f656635e7ea437dce2b02adcdabcc7a', '', '1340630487', '127.0.0.1', '1340630487', '1338658435', '1', '1');
INSERT INTO `users` VALUES ('3', 'Natura CO', 'natura@naturaco.org', 'jPLjCHCjBbY3WR8Cccfc45b8d8927dc7819088c253f24800a7bf77ad4b146afe3510dce6e1ae245e', '', '', '', '', '1338672186', '127.0.0.1', '1338672222', '1338672186', '1', '1');
INSERT INTO `users` VALUES ('4', 'karolinasimon', 'karolinasimon@gmail.com', '3KmfldBGsm5lhxZTe285312fd03e4b2a6585a5559fae16e153df4bb8a6c95d80ba2b6273b206f3aa', '', '', '', '', '1338853026', '127.0.0.1', '1338853175', '1338853026', '1', '1');
INSERT INTO `users` VALUES ('5', 'vicepresidente', 'vicepresidente@naturaco.org', 'o9FyIczKycDLsNm1bb55fbda736f3198376b2ac905b5b6ff8ff17f9f180c9d1399892fccbc8da665', '', '', '', '', '1339438276', '127.0.0.1', '1339438276', '1339102989', '1', '1');
INSERT INTO `users` VALUES ('6', 'andreovieira', 'andreoav@hotmail.com', 'hFozbe1XFvYmRcc566a185e89667b56f9031a8d51b87e5a4b708878747775953f3b5a8d9f1cc2def', '', '', 'hKdf5E3M3O5VTsKH4a9b686efae50832dbc0c914ce43bfbb20f358b0f8b9bbc5f0d8c5ec1d2decc8', '', '1339439067', '127.0.0.1', '1339439067', '1339438509', '1', '1');
INSERT INTO `users` VALUES ('7', 'raphael', 'simon@opaweb.net', 'wVWSV9WtNvJ0ImiBb1e04661b08983e5ceff4603ec58f79896218ecde89c21f030d524f2d0c0654c', '', '', '', '', '1339781330', '127.0.0.1', '1339781507', '1339781330', '1', '1');
INSERT INTO `users` VALUES ('8', 'andreovieira', 'andreoav@naturaco.org', 'Tl6q8lEVafwKc47r11ab89e97699b979fdc34db533764d8c881de7f59aa08060ffc44695c4dc160e', '', '', '', '', '1340164256', '127.0.0.1', '1340164454', '1340164255', '1', '1');
INSERT INTO `users` VALUES ('9', 'joao-adiles', 'joao-adiles@hotmail.com', 'Gk9mhOPKpYVATiBgb39d277f03dda8cdc1a72dae5a043c31547d3f6b6eb2ba2584c4acd6e290f3db', '', '', '', '', '1340296999', '127.0.0.1', '1340297097', '1340296999', '1', '1');

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
INSERT INTO `users_groups` VALUES ('5', '2');
INSERT INTO `users_groups` VALUES ('6', '2');
INSERT INTO `users_groups` VALUES ('7', '2');
INSERT INTO `users_groups` VALUES ('8', '2');
INSERT INTO `users_groups` VALUES ('9', '2');

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
  `sistema_tour` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`user_id`,`cpf`,`identidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_metadata
-- ----------------------------
INSERT INTO `users_metadata` VALUES ('1', 'Andreo Vieira', '022.878.130-20', '5077333754', '08/03/1990', '1234', '152162', '1', '1');
INSERT INTO `users_metadata` VALUES ('2', 'João Batista Porcella Vieira', '442.392.200-25', '9999999999', '28/09/1963', '', '', null, '0');
INSERT INTO `users_metadata` VALUES ('3', 'Natura CO', '111.111.111-11', '1111111111', '11/11/2012', '', '', null, '0');
INSERT INTO `users_metadata` VALUES ('4', 'Karolina Simon', '022.878.130-20', '9999999999', '09/11/1987', '', '', '1', '0');
INSERT INTO `users_metadata` VALUES ('5', 'Vice Presidente', '442.392.200-25', '1111111111', '08/03/1990', '', '', null, '0');
INSERT INTO `users_metadata` VALUES ('7', 'Raphael Waechter Simon', '022.878.130-20', '2315849410', '01/01/1985', '', '', '1', '1');
INSERT INTO `users_metadata` VALUES ('8', 'Andreo de Aguiar Vieira', '022.878.130-20', '5077333754', '08/03/1990', '', '', '1', '1');
INSERT INTO `users_metadata` VALUES ('9', '', '', '', '', null, null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_suspended
-- ----------------------------
INSERT INTO `users_suspended` VALUES ('1', 'karolinasimon@gmail.com', '3', '127.0.0.1', '1340200265', '0', '0');
