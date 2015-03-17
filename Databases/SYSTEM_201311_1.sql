# -----------------------------------------------------------
# PHP-Amateur database backup files
# Blog: http://blog.51edm.org
# Type: 系统自动备份
# Description:当前SQL文件包含了表：pa1_access、pa1_ad、pa1_admin、pa1_category、pa1_link、pa1_member、pa1_message、pa1_nav、pa1_news、pa1_node、pa1_page、pa1_product、pa1_role、pa1_role_user、pa1_tag的结构信息，表：pa1_access、pa1_ad、pa1_admin、pa1_category、pa1_link、pa1_member、pa1_message、pa1_nav、pa1_news、pa1_node、pa1_page、pa1_product、pa1_role、pa1_role_user、pa1_tag的数据
# Time: 2013-11-10 23:58:24
# -----------------------------------------------------------
# 当前SQL卷标：#1
# -----------------------------------------------------------


# 数据库表：pa1_access 结构信息
DROP TABLE IF EXISTS `pa1_access`;
CREATE TABLE `pa1_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限分配表' ;

# 数据库表：pa1_ad 结构信息
DROP TABLE IF EXISTS `pa1_ad`;
CREATE TABLE `pa1_ad` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(60) NOT NULL DEFAULT '',
  `ad_link` varchar(255) NOT NULL DEFAULT '',
  `ad_img` varchar(255) NOT NULL,
  `position` char(10) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ;

# 数据库表：pa1_admin 结构信息
DROP TABLE IF EXISTS `pa1_admin`;
CREATE TABLE `pa1_admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT '登录账号',
  `pwd` char(32) DEFAULT NULL COMMENT '登录密码',
  `status` int(11) DEFAULT '1' COMMENT '账号状态',
  `remark` varchar(255) DEFAULT '' COMMENT '备注信息',
  `find_code` char(5) DEFAULT NULL COMMENT '找回账号验证码',
  `time` int(10) DEFAULT NULL COMMENT '开通时间',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='网站后台管理员表' ;

# 数据库表：pa1_category 结构信息
DROP TABLE IF EXISTS `pa1_category`;
CREATE TABLE `pa1_category` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `pid` int(5) DEFAULT NULL COMMENT 'parentCategory上级分类',
  `name` varchar(20) DEFAULT NULL COMMENT '分类名称',
  `type` char(10) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='新闻分类表' ;

# 数据库表：pa1_link 结构信息
DROP TABLE IF EXISTS `pa1_link`;
CREATE TABLE `pa1_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `display` int(1) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `target` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

# 数据库表：pa1_member 结构信息
DROP TABLE IF EXISTS `pa1_member`;
CREATE TABLE `pa1_member` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `weibo_uid` varchar(15) DEFAULT NULL COMMENT '对应的新浪微博uid',
  `tencent_uid` varchar(20) DEFAULT NULL COMMENT '腾讯微博UID',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱地址',
  `nickname` varchar(20) DEFAULT NULL COMMENT '用户昵称',
  `pwd` char(32) DEFAULT NULL COMMENT '密码',
  `reg_date` int(10) DEFAULT NULL,
  `reg_ip` char(15) DEFAULT NULL COMMENT '注册IP地址',
  `verify_status` int(1) DEFAULT '0' COMMENT '电子邮件验证标示 0未验证，1已验证',
  `verify_code` varchar(32) DEFAULT NULL COMMENT '电子邮件验证随机码',
  `verify_time` int(10) DEFAULT NULL COMMENT '邮箱验证时间',
  `verify_exp_time` int(10) DEFAULT NULL COMMENT '验证邮件过期时间',
  `find_fwd_code` varchar(32) DEFAULT NULL COMMENT '找回密码验证随机码',
  `find_pwd_time` int(10) DEFAULT NULL COMMENT '找回密码申请提交时间',
  `find_pwd_exp_time` int(10) DEFAULT NULL COMMENT '找回密码验证随机码过期时间',
  `avatar` varchar(100) DEFAULT NULL COMMENT '用户头像',
  `birthday` int(10) DEFAULT NULL COMMENT '用户生日',
  `sex` int(1) DEFAULT NULL COMMENT '0女1男',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `province` varchar(100) DEFAULT NULL COMMENT '省份',
  `city` varchar(100) DEFAULT NULL COMMENT '城市',
  `intr` varchar(500) DEFAULT NULL COMMENT '个人介绍',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号码',
  `phone` varchar(30) DEFAULT NULL COMMENT '电话',
  `fax` varchar(30) DEFAULT NULL,
  `qq` int(15) DEFAULT NULL,
  `msn` varchar(100) DEFAULT NULL,
  `login_ip` varchar(15) DEFAULT NULL COMMENT '登录ip',
  `login_time` int(10) DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=352 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='网站前台会员表' ;

# 数据库表：pa1_message 结构信息
DROP TABLE IF EXISTS `pa1_message`;
CREATE TABLE `pa1_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(32) NOT NULL,
  `moblie` char(15) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ;

# 数据库表：pa1_nav 结构信息
DROP TABLE IF EXISTS `pa1_nav`;
CREATE TABLE `pa1_nav` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `guide` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `link` varchar(225) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn' COMMENT '语言',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `target` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ;

# 数据库表：pa1_news 结构信息
DROP TABLE IF EXISTS `pa1_news`;
CREATE TABLE `pa1_news` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `title` varchar(200) DEFAULT NULL COMMENT '新闻标题',
  `keywords` varchar(50) DEFAULT NULL COMMENT '文章关键字',
  `description` mediumtext COMMENT '文章描述',
  `status` tinyint(1) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL COMMENT '文章摘要',
  `published` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `content` text,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  `aid` smallint(3) DEFAULT NULL COMMENT '发布者UID',
  `click` int(11) NOT NULL DEFAULT '0',
  `is_recommend` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='新闻表' ;

# 数据库表：pa1_node 结构信息
DROP TABLE IF EXISTS `pa1_node`;
CREATE TABLE `pa1_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='权限节点表' ;

# 数据库表：pa1_page 结构信息
DROP TABLE IF EXISTS `pa1_page`;
CREATE TABLE `pa1_page` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `page_name` varchar(150) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ;

# 数据库表：pa1_product 结构信息
DROP TABLE IF EXISTS `pa1_product`;
CREATE TABLE `pa1_product` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `title` varchar(200) DEFAULT NULL COMMENT '产品标题',
  `price` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `psize` varchar(32) NOT NULL,
  `image` varchar(255) NOT NULL COMMENT '图片',
  `keywords` varchar(50) DEFAULT NULL COMMENT '产品关键字',
  `description` mediumtext COMMENT '产品描述',
  `status` tinyint(1) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL COMMENT '产品摘要',
  `published` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `content` text,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  `aid` smallint(3) DEFAULT NULL COMMENT '发布者UID',
  `click` int(11) NOT NULL DEFAULT '0',
  `is_recommend` int(1) NOT NULL DEFAULT '0',
  `wap_display` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='产品表' ;

# 数据库表：pa1_role 结构信息
DROP TABLE IF EXISTS `pa1_role`;
CREATE TABLE `pa1_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='权限角色表' ;

# 数据库表：pa1_role_user 结构信息
DROP TABLE IF EXISTS `pa1_role_user`;
CREATE TABLE `pa1_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色表' ;

# 数据库表：pa1_tag 结构信息
DROP TABLE IF EXISTS `pa1_tag`;
CREATE TABLE `pa1_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `unique_id` char(20) NOT NULL,
  `content` text NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ;



# 数据库表：pa1_access 数据信息
INSERT INTO `pa1_access` VALUES ('2','8','3','14','');
INSERT INTO `pa1_access` VALUES ('2','14','2','1','');
INSERT INTO `pa1_access` VALUES ('2','10','3','4','');
INSERT INTO `pa1_access` VALUES ('2','4','2','1','');
INSERT INTO `pa1_access` VALUES ('2','7','3','3','');
INSERT INTO `pa1_access` VALUES ('2','3','2','1','');
INSERT INTO `pa1_access` VALUES ('2','6','3','2','');
INSERT INTO `pa1_access` VALUES ('2','5','3','2','');
INSERT INTO `pa1_access` VALUES ('2','2','2','1','');
INSERT INTO `pa1_access` VALUES ('2','1','1','0','');
INSERT INTO `pa1_access` VALUES ('3','14','2','1','');
INSERT INTO `pa1_access` VALUES ('3','13','3','4','');
INSERT INTO `pa1_access` VALUES ('3','12','3','4','');
INSERT INTO `pa1_access` VALUES ('3','11','3','4','');
INSERT INTO `pa1_access` VALUES ('3','10','3','4','');
INSERT INTO `pa1_access` VALUES ('3','4','2','1','');
INSERT INTO `pa1_access` VALUES ('3','9','3','3','');
INSERT INTO `pa1_access` VALUES ('3','8','3','3','');
INSERT INTO `pa1_access` VALUES ('3','7','3','3','');
INSERT INTO `pa1_access` VALUES ('3','3','2','1','');
INSERT INTO `pa1_access` VALUES ('3','6','3','2','');
INSERT INTO `pa1_access` VALUES ('3','5','3','2','');
INSERT INTO `pa1_access` VALUES ('3','2','2','1','');
INSERT INTO `pa1_access` VALUES ('3','1','1','0','');
INSERT INTO `pa1_access` VALUES ('4','7','3','3','');
INSERT INTO `pa1_access` VALUES ('4','3','2','1','');
INSERT INTO `pa1_access` VALUES ('4','6','3','2','');
INSERT INTO `pa1_access` VALUES ('4','5','3','2','');
INSERT INTO `pa1_access` VALUES ('4','2','2','1','');
INSERT INTO `pa1_access` VALUES ('4','1','1','0','');
INSERT INTO `pa1_access` VALUES ('2','9','3','14','');
INSERT INTO `pa1_access` VALUES ('2','15','3','14','');
INSERT INTO `pa1_access` VALUES ('2','16','3','14','');
INSERT INTO `pa1_access` VALUES ('2','17','3','14','');
INSERT INTO `pa1_access` VALUES ('2','18','3','14','');
INSERT INTO `pa1_access` VALUES ('2','19','3','14','');
INSERT INTO `pa1_access` VALUES ('2','20','3','14','');
INSERT INTO `pa1_access` VALUES ('2','21','3','14','');
INSERT INTO `pa1_access` VALUES ('2','22','3','14','');
INSERT INTO `pa1_access` VALUES ('2','23','3','14','');
INSERT INTO `pa1_access` VALUES ('2','24','3','14','');
INSERT INTO `pa1_access` VALUES ('2','25','3','14','');
INSERT INTO `pa1_access` VALUES ('2','26','2','1','');
INSERT INTO `pa1_access` VALUES ('2','27','3','26','');
INSERT INTO `pa1_access` VALUES ('2','28','3','26','');
INSERT INTO `pa1_access` VALUES ('2','29','3','26','');
INSERT INTO `pa1_access` VALUES ('2','30','3','26','');
INSERT INTO `pa1_access` VALUES ('2','31','3','26','');
INSERT INTO `pa1_access` VALUES ('4','26','2','1','');
INSERT INTO `pa1_access` VALUES ('4','27','3','26','');
INSERT INTO `pa1_access` VALUES ('4','28','3','26','');
INSERT INTO `pa1_access` VALUES ('4','29','3','26','');
INSERT INTO `pa1_access` VALUES ('4','30','3','26','');
INSERT INTO `pa1_access` VALUES ('4','31','3','26','');
INSERT INTO `pa1_access` VALUES ('4','53','3','26','');
INSERT INTO `pa1_access` VALUES ('4','54','3','26','');
INSERT INTO `pa1_access` VALUES ('4','45','2','1','');
INSERT INTO `pa1_access` VALUES ('4','55','3','45','');
INSERT INTO `pa1_access` VALUES ('4','46','2','1','');
INSERT INTO `pa1_access` VALUES ('4','47','3','46','');
INSERT INTO `pa1_access` VALUES ('4','48','3','46','');
INSERT INTO `pa1_access` VALUES ('4','49','3','46','');
INSERT INTO `pa1_access` VALUES ('4','50','3','46','');
INSERT INTO `pa1_access` VALUES ('4','51','3','46','');
INSERT INTO `pa1_access` VALUES ('4','52','3','46','');


# 数据库表：pa1_ad 数据信息
INSERT INTO `pa1_ad` VALUES ('6','图片1','http://www.2345.com/','201311/527bb0c2728a4.jpg','index','1','zh-en');
INSERT INTO `pa1_ad` VALUES ('7','图片2','http://www.2345.com/','201311/527bb0d5ceda0.jpg','index','2','zh-en');
INSERT INTO `pa1_ad` VALUES ('9','圣丹斯','http://www.2345.com/','201311/527c9f47bf378.jpg','index','0','zh-en');
INSERT INTO `pa1_ad` VALUES ('11','广告1','http://www.2345.com/','201311/527d13d20bff4.jpg','index','10','zh-cn');
INSERT INTO `pa1_ad` VALUES ('12','广告2','http://www.2345.com/','201311/527d13e5ade49.jpg','index','11','zh-cn');
INSERT INTO `pa1_ad` VALUES ('15','全局1','http://www.2345.com/','201311/527d1587ddb98.jpg','all','0','zh-cn');
INSERT INTO `pa1_ad` VALUES ('16','全局2','http://www.2345.com/','201311/527d15971446c.jpg','all','0','zh-cn');
INSERT INTO `pa1_ad` VALUES ('17','全局3','http://www.2345.com/','201311/527d15a630135.jpg','all','0','zh-en');
INSERT INTO `pa1_ad` VALUES ('18','手机','http://www.2345.com','201311/527f13755025a.jpg','wap','30','zh-cn');


# 数据库表：pa1_admin 数据信息
INSERT INTO `pa1_admin` VALUES ('1','超级管理员','lysily1314@gmail.com','d0c3d9b5b7ad7621590e4aa88cc6cad2','1','我是超级管理员 哈哈~~','','1384099075');


# 数据库表：pa1_category 数据信息
INSERT INTO `pa1_category` VALUES ('73','0','手机','p','zh-cn');
INSERT INTO `pa1_category` VALUES ('72','0','显示器','p','zh-cn');
INSERT INTO `pa1_category` VALUES ('74','0','公司新闻','n','zh-cn');
INSERT INTO `pa1_category` VALUES ('71','0','笔记本','p','zh-cn');
INSERT INTO `pa1_category` VALUES ('75','0','网络新闻','n','zh-cn');
INSERT INTO `pa1_category` VALUES ('76','0','Company News','n','zh-en');
INSERT INTO `pa1_category` VALUES ('77','0','Phone','p','zh-en');
INSERT INTO `pa1_category` VALUES ('78','0','Display','p','zh-en');
INSERT INTO `pa1_category` VALUES ('79','0','Network','p','zh-en');


# 数据库表：pa1_link 数据信息
INSERT INTO `pa1_link` VALUES ('1','Conist','1','http://www.conist.com','124','2');


# 数据库表：pa1_member 数据信息


# 数据库表：pa1_message 数据信息


# 数据库表：pa1_nav 数据信息
INSERT INTO `pa1_nav` VALUES ('38','page','公司简介','0','1','middle','','zh-cn','11','0');
INSERT INTO `pa1_nav` VALUES ('35','news','公司新闻','0','0','middle','','zh-cn','99','0');
INSERT INTO `pa1_nav` VALUES ('36','product','公司产品','0','0','middle','','zh-cn','100','0');
INSERT INTO `pa1_nav` VALUES ('44','message','Message','0','0','middle','','zh-en','97','0');
INSERT INTO `pa1_nav` VALUES ('39','message','留言板','0','0','middle','','zh-cn','11','0');
INSERT INTO `pa1_nav` VALUES ('41','product','Product','0','0','middle','','zh-en','100','0');
INSERT INTO `pa1_nav` VALUES ('42','news','News','0','0','middle','','zh-en','99','0');
INSERT INTO `pa1_nav` VALUES ('43','page','Company','0','1','middle','','zh-en','98','0');


# 数据库表：pa1_news 数据信息


# 数据库表：pa1_node 数据信息
INSERT INTO `pa1_node` VALUES ('1','Admin','后台管理','1','网站后台管理项目','10','0','1');
INSERT INTO `pa1_node` VALUES ('2','Index','管理首页','1','','1','1','2');
INSERT INTO `pa1_node` VALUES ('3','Member','注册会员管理','1','','3','1','2');
INSERT INTO `pa1_node` VALUES ('4','Webinfo','系统管理','1','','4','1','2');
INSERT INTO `pa1_node` VALUES ('5','index','默认页','1','','5','2','3');
INSERT INTO `pa1_node` VALUES ('6','myInfo','我的个人信息','1','','6','2','3');
INSERT INTO `pa1_node` VALUES ('7','index','会员首页','1','','7','3','3');
INSERT INTO `pa1_node` VALUES ('8','index','管理员列表','1','','8','14','3');
INSERT INTO `pa1_node` VALUES ('9','addAdmin','添加管理员','1','','9','14','3');
INSERT INTO `pa1_node` VALUES ('10','index','系统设置首页','1','','10','4','3');
INSERT INTO `pa1_node` VALUES ('11','setEmailConfig','设置系统邮件','1','','12','4','3');
INSERT INTO `pa1_node` VALUES ('12','testEmailConfig','发送测试邮件','1','','0','4','3');
INSERT INTO `pa1_node` VALUES ('13','setSafeConfig','系统安全设置','1','','0','4','3');
INSERT INTO `pa1_node` VALUES ('14','Access','权限管理','1','权限管理，为系统后台管理员设置不同的权限','0','1','2');
INSERT INTO `pa1_node` VALUES ('15','nodeList','查看节点','1','节点列表信息','0','14','3');
INSERT INTO `pa1_node` VALUES ('16','roleList','角色列表查看','1','角色列表查看','0','14','3');
INSERT INTO `pa1_node` VALUES ('17','addRole','添加角色','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('18','editRole','编辑角色','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('19','opNodeStatus','便捷开启禁用节点','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('20','opRoleStatus','便捷开启禁用角色','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('21','editNode','编辑节点','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('22','addNode','添加节点','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('23','addAdmin','添加管理员','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('24','editAdmin','编辑管理员信息','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('25','changeRole','权限分配','1','','0','14','3');
INSERT INTO `pa1_node` VALUES ('26','News','资讯管理','1','','0','1','2');
INSERT INTO `pa1_node` VALUES ('27','index','新闻列表','1','','0','26','3');
INSERT INTO `pa1_node` VALUES ('28','category','新闻分类管理','1','','0','26','3');
INSERT INTO `pa1_node` VALUES ('29','add','发布新闻','1','','0','26','3');
INSERT INTO `pa1_node` VALUES ('30','edit','编辑新闻','1','','0','26','3');
INSERT INTO `pa1_node` VALUES ('31','del','删除信息','0','','0','26','3');
INSERT INTO `pa1_node` VALUES ('32','SysData','数据库管理','1','包含数据库备份、还原、打包等','0','1','2');
INSERT INTO `pa1_node` VALUES ('33','index','查看数据库表结构信息','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('34','backup','备份数据库','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('35','restore','查看已备份SQL文件','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('36','restoreData','执行数据库还原操作','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('37','delSqlFiles','删除SQL文件','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('38','sendSql','邮件发送SQL文件','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('39','zipSql','打包SQL文件','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('40','zipList','查看已打包SQL文件','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('41','unzipSqlfile','解压缩ZIP文件','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('42','delZipFiles','删除zip压缩文件','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('43','downFile','下载备份的SQL,ZIP文件','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('44','repair','数据库优化修复','1','','0','32','3');
INSERT INTO `pa1_node` VALUES ('45','Siteinfo','网站功能','1','','50','1','2');
INSERT INTO `pa1_node` VALUES ('46','Product','产品管理','1','','10','1','2');
INSERT INTO `pa1_node` VALUES ('47','index','产品列表','1','','0','46','3');
INSERT INTO `pa1_node` VALUES ('48','category','产品分类管理','1','','0','46','3');
INSERT INTO `pa1_node` VALUES ('49','add','添加产品','1','','0','46','3');
INSERT INTO `pa1_node` VALUES ('50','edit','编辑产品','1','','0','46','3');
INSERT INTO `pa1_node` VALUES ('51','changeAttr','推荐产品','1','','0','46','3');
INSERT INTO `pa1_node` VALUES ('52','changeStatus','审核产品','1','','0','46','3');
INSERT INTO `pa1_node` VALUES ('53','changeAttr','推荐资讯','1','','0','26','3');
INSERT INTO `pa1_node` VALUES ('54','changeStatus','审核资讯','1','','0','26','3');
INSERT INTO `pa1_node` VALUES ('55','index','查看菜单','0','','0','45','3');


# 数据库表：pa1_page 数据信息


# 数据库表：pa1_product 数据信息


# 数据库表：pa1_role 数据信息
INSERT INTO `pa1_role` VALUES ('1','超级管理员','0','1','系统内置超级管理员组，不受权限分配账号限制');
INSERT INTO `pa1_role` VALUES ('2','管理员','1','1','拥有系统仅此于超级管理员的权限');
INSERT INTO `pa1_role` VALUES ('3','领导','1','1','拥有所有操作的读权限，无增加、删除、修改的权限');
INSERT INTO `pa1_role` VALUES ('4','测试组','1','1','测试');


# 数据库表：pa1_role_user 数据信息
INSERT INTO `pa1_role_user` VALUES ('2','4');
INSERT INTO `pa1_role_user` VALUES ('2','5');
INSERT INTO `pa1_role_user` VALUES ('2','6');
INSERT INTO `pa1_role_user` VALUES ('2','7');
INSERT INTO `pa1_role_user` VALUES ('4','8');
INSERT INTO `pa1_role_user` VALUES ('4','9');


# 数据库表：pa1_tag 数据信息
INSERT INTO `pa1_tag` VALUES ('6','关于我们','aboutus','《关于·我们》是歌手尚雯婕于2007年底推出的圣诞节日专辑。其以轻松欢快为基调打造出非同一般的节日气氛，更加贴合时下风潮。在曲风与节奏的变化没有给人带来陌生感的同时，拓宽了尚雯婕的音乐思路，清晰的旋律线条直观具象的表达着蕴藏在音乐中心的思想内涵。不仅仅拘泥于浪漫情节的文艺小调，利用多元化的表现手法在实现扩大音乐内容的同时挖掘音乐中更成层的含义。','zh-cn');
INSERT INTO `pa1_tag` VALUES ('8','手机版首页欢迎语（中文）','wapindexwelcome','手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语','zh-cn');
INSERT INTO `pa1_tag` VALUES ('9','手机版首页欢迎语（English）','wapindexwelcome','welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span>','zh-en');
INSERT INTO `pa1_tag` VALUES ('10','手机版关于我们（中文）','wapaboutus','手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）','zh-cn');
INSERT INTO `pa1_tag` VALUES ('11','手机版关于我们（English）','wapaboutus','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.','zh-en');
INSERT INTO `pa1_tag` VALUES ('12','手机版联系我们（English）','wapcontactus','<span style="line-height:1.5;">Adress:guangdong guangzhou tianhe</span><br>Phone:123456789<br>Fax:12-11-245327<span>123456789<br></span> Mobile:123456789','zh-en');
INSERT INTO `pa1_tag` VALUES ('13','手机版联系我们（中文）','wapcontactus','<span style="line-height:1.5;">地址:广东省广州市天河区&nbsp;</span><br>Phone:123456789&nbsp;<br>Fax:123456789&nbsp;<br>Mobile:123456789<br>','zh-cn');
