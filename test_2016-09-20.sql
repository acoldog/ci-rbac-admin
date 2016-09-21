# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 121.41.83.91 (MySQL 5.6.29)
# Database: test
# Generation Time: 2016-09-20 10:31:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table rbac_auth
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_auth`;

CREATE TABLE `rbac_auth` (
  `node_id` int(11) NOT NULL COMMENT '节点ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  UNIQUE KEY `nid_rid` (`node_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色与节点对应表';

LOCK TABLES `rbac_auth` WRITE;
/*!40000 ALTER TABLE `rbac_auth` DISABLE KEYS */;

INSERT INTO `rbac_auth` (`node_id`, `role_id`)
VALUES
	(1,1),
	(2,1),
	(3,1),
	(4,1),
	(5,1),
	(6,1),
	(7,1),
	(8,1),
	(9,1),
	(10,1),
	(11,1),
	(12,1),
	(13,1),
	(14,1),
	(15,1),
	(16,1),
	(17,1),
	(18,1),
	(18,2),
	(19,1),
	(20,1);

/*!40000 ALTER TABLE `rbac_auth` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_log`;

CREATE TABLE `rbac_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `admin_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作人管理员账号id',
  `admin_nickname` varchar(25) NOT NULL DEFAULT '' COMMENT '操作人管理员昵称',
  `db_name` varchar(50) NOT NULL DEFAULT '' COMMENT '操作的数据表',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '操作类型：add，update，delete',
  `data_num` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '操作数，以便操作统计',
  `data_ids` varchar(300) NOT NULL DEFAULT '' COMMENT '操作数据id，多个以逗号分隔，以便数据还原',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '操作说明',
  `uri` varchar(50) NOT NULL DEFAULT '' COMMENT '操作发生的uri',
  `rollback_tag` varchar(10) NOT NULL DEFAULT '' COMMENT '单次回滚标识，以便脚本分段回滚',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '记录添加时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台管理员操作日志表';

LOCK TABLES `rbac_log` WRITE;
/*!40000 ALTER TABLE `rbac_log` DISABLE KEYS */;

INSERT INTO `rbac_log` (`id`, `admin_user_id`, `admin_nickname`, `db_name`, `type`, `data_num`, `data_ids`, `intro`, `uri`, `rollback_tag`, `is_deleted`, `create_time`, `update_time`)
VALUES
	(216,1,'admin','test','update',1,'1','修改数据','【添加】product/index/testAdd/1','',0,'2016-09-20 17:29:40','2016-09-20 17:29:40'),
	(217,1,'admin','test','update',1,'1','修改数据','【添加】product/index/testAdd/1','',0,'2016-09-20 17:29:50','2016-09-20 17:29:50');

/*!40000 ALTER TABLE `rbac_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_menu`;

CREATE TABLE `rbac_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '导航名称',
  `node_id` int(11) DEFAULT NULL COMMENT '节点ID',
  `p_id` int(11) DEFAULT NULL COMMENT '导航父id',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='菜单表';

LOCK TABLES `rbac_menu` WRITE;
/*!40000 ALTER TABLE `rbac_menu` DISABLE KEYS */;

INSERT INTO `rbac_menu` (`id`, `title`, `node_id`, `p_id`, `sort`, `status`)
VALUES
	(1,'后台管理',NULL,NULL,9,1),
	(2,'节点管理',5,1,2,1),
	(3,'导航管理',1,1,1,1),
	(4,'人员管理',14,1,4,1),
	(5,'角色管理',9,1,3,1),
	(6,'一级菜单',0,NULL,0,1),
	(7,'二级节点',18,6,1,1),
	(8,'一级菜单2',NULL,NULL,2,1),
	(9,'二级菜单',NULL,8,1,1),
	(10,'三级节点',18,9,1,1),
	(11,'二级菜单2',0,8,2,1),
	(12,'三级节点222',19,11,1,1);

/*!40000 ALTER TABLE `rbac_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_node
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_node`;

CREATE TABLE `rbac_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dirc` varchar(20) NOT NULL COMMENT '目录',
  `cont` varchar(20) NOT NULL DEFAULT '' COMMENT '控制器',
  `func` varchar(20) NOT NULL DEFAULT '' COMMENT '方法',
  `memo` varchar(25) NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `d_c_f` (`dirc`,`cont`,`func`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='节点表';

LOCK TABLES `rbac_node` WRITE;
/*!40000 ALTER TABLE `rbac_node` DISABLE KEYS */;

INSERT INTO `rbac_node` (`id`, `dirc`, `cont`, `func`, `memo`, `status`)
VALUES
	(1,'manage','menu','index','导航管理',1),
	(2,'manage','menu','edit','导航修改',1),
	(3,'manage','menu','delete','导航删除',1),
	(4,'manage','menu','add','导航新增',1),
	(5,'manage','node','index','节点管理',1),
	(6,'manage','node','add','节点新增',1),
	(7,'manage','node','delete','节点删除',1),
	(8,'manage','node','edit','节点修改',1),
	(9,'manage','role','index','角色管理',1),
	(10,'manage','role','action','角色赋权',1),
	(11,'manage','role','delete','角色删除',1),
	(12,'manage','role','edit','角色修改',1),
	(13,'manage','role','add','角色新增',1),
	(14,'manage','member','index','人员管理',1),
	(15,'manage','member','edit','人员修改',1),
	(16,'manage','member','delete','人员删除',1),
	(17,'manage','member','add','人员新增',1),
	(18,'product','index','index','测试用节点',1),
	(19,'product','index','test','测试222',1),
	(20,'product','index','testAdd','添加',1);

/*!40000 ALTER TABLE `rbac_node` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_role`;

CREATE TABLE `rbac_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(25) NOT NULL COMMENT '角色名',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolename` (`rolename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色表';

LOCK TABLES `rbac_role` WRITE;
/*!40000 ALTER TABLE `rbac_role` DISABLE KEYS */;

INSERT INTO `rbac_role` (`id`, `rolename`, `status`)
VALUES
	(1,'管理员',1),
	(2,'acoltest',1);

/*!40000 ALTER TABLE `rbac_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_user`;

CREATE TABLE `rbac_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `nickname` varchar(20) NOT NULL COMMENT '昵称',
  `email` varchar(25) NOT NULL COMMENT 'Email',
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

LOCK TABLES `rbac_user` WRITE;
/*!40000 ALTER TABLE `rbac_user` DISABLE KEYS */;

INSERT INTO `rbac_user` (`id`, `username`, `password`, `nickname`, `email`, `role_id`, `status`)
VALUES
	(1,'admin','21232f297a57a5a743894a0e4a801fc3','admin','admin@admin.com',1,1),
	(2,'acoltest','c387d5df77cd2a86356951e53cb43643','测试acol','acol@outlook.com',2,1);

/*!40000 ALTER TABLE `rbac_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table test
# ------------------------------------------------------------

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `ico` varchar(255) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  `create_user` varchar(11) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;

INSERT INTO `test` (`id`, `username`, `ico`, `descr`, `create_user`, `create_time`)
VALUES
	(1,'fdsaf111','http://b.hiphotos.baidu.com/zhidao/pic/item/b21bb051f81986180f030a8049ed2e738bd4e66a.jpg','fdsaf2','acol\n','2016-08-12 10:20:39'),
	(2,'afdsa','http://www.bz55.com/uploads/allimg/120913/1-120913151Z6.jpg','111','fdsa','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
