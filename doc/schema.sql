CREATE DATABASE `testing` CHARSET=utf8;
USE `testing`;

CREATE TABLE `todo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `task` varchar(100) NOT NULL COMMENT '工作',
  `done` enum('y','n') NOT NULL DEFAULT 'n' COMMENT '是否完成',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Todo';