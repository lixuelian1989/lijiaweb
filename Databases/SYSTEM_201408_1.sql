# -----------------------------------------------------------
# PHP-Amateur database backup files
# Blog: http://blog.51edm.org
# Type: 系统自动备份
# Description:当前SQL文件包含了表：rc_access、rc_ad、rc_admin、rc_category、rc_laws、rc_lawscountry、rc_lawsmodule、rc_lawstype、rc_link、rc_message、rc_nav、rc_news、rc_node、rc_page、rc_product、rc_role、rc_role_user、rc_tag、rc_user的结构信息，表：rc_access、rc_ad、rc_admin、rc_category、rc_laws、rc_lawscountry、rc_lawsmodule、rc_lawstype、rc_link、rc_message、rc_nav、rc_news、rc_node、rc_page、rc_product、rc_role、rc_role_user、rc_tag、rc_user的数据
# Time: 2014-08-01 14:00:01
# -----------------------------------------------------------
# 当前SQL卷标：#1
# -----------------------------------------------------------


# 数据库表：rc_access 结构信息
DROP TABLE IF EXISTS `rc_access`;
CREATE TABLE `rc_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) default NULL,
  `module` varchar(50) default NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限分配表' ;

# 数据库表：rc_ad 结构信息
DROP TABLE IF EXISTS `rc_ad`;
CREATE TABLE `rc_ad` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `ad_name` varchar(60) NOT NULL default '',
  `ad_link` varchar(255) NOT NULL default '',
  `ad_img` varchar(255) NOT NULL,
  `position` char(10) NOT NULL default '0',
  `sort` tinyint(1) unsigned NOT NULL default '50',
  `lang` varchar(10) NOT NULL default 'zh-cn',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ;

# 数据库表：rc_admin 结构信息
DROP TABLE IF EXISTS `rc_admin`;
CREATE TABLE `rc_admin` (
  `aid` int(11) NOT NULL auto_increment,
  `nickname` varchar(20) default NULL,
  `email` varchar(50) default NULL COMMENT '登录账号',
  `pwd` char(32) default NULL COMMENT '登录密码',
  `status` int(11) default '1' COMMENT '账号状态',
  `remark` varchar(255) default '' COMMENT '备注信息',
  `find_code` char(5) default NULL COMMENT '找回账号验证码',
  `time` int(10) default NULL COMMENT '开通时间',
  PRIMARY KEY  (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='网站后台管理员表' ;

# 数据库表：rc_category 结构信息
DROP TABLE IF EXISTS `rc_category`;
CREATE TABLE `rc_category` (
  `cid` int(5) NOT NULL auto_increment,
  `pid` int(5) default NULL COMMENT 'parentCategory上级分类',
  `name` varchar(20) default NULL COMMENT '分类名称',
  `type` char(10) NOT NULL,
  `lang` varchar(10) NOT NULL default 'zh-cn',
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='新闻分类表' ;

# 数据库表：rc_laws 结构信息
DROP TABLE IF EXISTS `rc_laws`;
CREATE TABLE `rc_laws` (
  `l_id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL COMMENT '修订历史ID',
  `history_name` varchar(255) NOT NULL COMMENT '修订历史',
  `l_number` varchar(100) NOT NULL COMMENT '法规号',
  `l_title` varchar(100) NOT NULL COMMENT '标题',
  `l_en_title` varchar(100) NOT NULL COMMENT '法规英文名称',
  `l_keywords` varchar(100) NOT NULL COMMENT '法规关键字',
  `l_range` varchar(100) NOT NULL COMMENT '适用范围',
  `l_series` varchar(100) NOT NULL COMMENT '系列',
  `l_level` varchar(100) NOT NULL COMMENT '增补等级',
  `l_sum` int(11) NOT NULL COMMENT '页数',
  `l_effect_time` varchar(100) NOT NULL COMMENT '生效日期',
  `l_pdf` varchar(100) NOT NULL COMMENT 'pdf',
  `l_img` varchar(100) NOT NULL COMMENT '封面图片',
  `l_description` varchar(255) NOT NULL COMMENT '描述',
  `add_time` varchar(100) NOT NULL COMMENT '录入日期',
  `l_country_id` int(11) NOT NULL COMMENT '国家 ID',
  `lt_id` int(11) NOT NULL COMMENT '法规类型 ID',
  `lt_status` mediumint(9) NOT NULL COMMENT '法规状态1=生效，2=草案',
  `module_id` int(11) NOT NULL COMMENT '车型ID',
  `lang` varchar(100) NOT NULL COMMENT '语言',
  `aid` int(11) NOT NULL,
  PRIMARY KEY  (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='法规表' ;

# 数据库表：rc_lawscountry 结构信息
DROP TABLE IF EXISTS `rc_lawscountry`;
CREATE TABLE `rc_lawscountry` (
  `lc_id` int(11) NOT NULL auto_increment COMMENT '颁布国家 ID',
  `lc_name` varchar(100) NOT NULL COMMENT '颁布国家名称',
  `lc_img` varchar(100) NOT NULL COMMENT '国家标志',
  `lang` varchar(100) NOT NULL COMMENT '语言',
  `add_time` varchar(100) NOT NULL COMMENT '添加时间',
  PRIMARY KEY  (`lc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='法规颁布国家表' ;

# 数据库表：rc_lawsmodule 结构信息
DROP TABLE IF EXISTS `rc_lawsmodule`;
CREATE TABLE `rc_lawsmodule` (
  `lm_id` int(11) NOT NULL auto_increment,
  `lm_name` varchar(50) NOT NULL COMMENT '车型名称',
  `lang` varchar(50) NOT NULL COMMENT '语言',
  PRIMARY KEY  (`lm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='车型' ;

# 数据库表：rc_lawstype 结构信息
DROP TABLE IF EXISTS `rc_lawstype`;
CREATE TABLE `rc_lawstype` (
  `lt_id` int(11) NOT NULL auto_increment COMMENT '法规分类ID',
  `pid` int(11) NOT NULL COMMENT '上级分类ID',
  `lt_name` varchar(100) NOT NULL COMMENT '分类名称',
  `lt_time` varchar(100) NOT NULL COMMENT '时间',
  `lang` varchar(100) NOT NULL COMMENT '语言',
  PRIMARY KEY  (`lt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='法规类型表' ;

# 数据库表：rc_link 结构信息
DROP TABLE IF EXISTS `rc_link`;
CREATE TABLE `rc_link` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(32) NOT NULL,
  `display` int(1) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `target` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

# 数据库表：rc_message 结构信息
DROP TABLE IF EXISTS `rc_message`;
CREATE TABLE `rc_message` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `email` varchar(32) NOT NULL,
  `moblie` char(15) NOT NULL,
  `display` int(1) NOT NULL default '0',
  `addtime` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ;

# 数据库表：rc_nav 结构信息
DROP TABLE IF EXISTS `rc_nav`;
CREATE TABLE `rc_nav` (
  `id` mediumint(8) NOT NULL auto_increment,
  `module` varchar(20) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `parent_id` smallint(5) NOT NULL default '0',
  `guide` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `link` varchar(225) NOT NULL,
  `lang` varchar(10) NOT NULL default 'zh-cn' COMMENT '语言',
  `sort` tinyint(1) unsigned NOT NULL default '50',
  `target` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 ;

# 数据库表：rc_news 结构信息
DROP TABLE IF EXISTS `rc_news`;
CREATE TABLE `rc_news` (
  `id` mediumint(8) NOT NULL auto_increment,
  `cid` smallint(3) default NULL COMMENT '所在分类',
  `title` varchar(200) default NULL COMMENT '新闻标题',
  `imgsrc` varchar(100) NOT NULL,
  `keywords` varchar(50) default NULL COMMENT '文章关键字',
  `description` mediumtext COMMENT '文章描述',
  `status` tinyint(1) default NULL,
  `summary` varchar(255) default NULL COMMENT '文章摘要',
  `published` int(10) default NULL,
  `update_time` int(10) default NULL,
  `content` text,
  `lang` varchar(10) NOT NULL default 'zh-cn',
  `aid` smallint(3) default NULL COMMENT '发布者UID',
  `click` int(11) NOT NULL default '0',
  `is_recommend` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='新闻表' ;

# 数据库表：rc_node 结构信息
DROP TABLE IF EXISTS `rc_node`;
CREATE TABLE `rc_node` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) default NULL,
  `status` tinyint(1) default '0',
  `remark` varchar(255) default NULL,
  `sort` smallint(6) unsigned default NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='权限节点表' ;

# 数据库表：rc_page 结构信息
DROP TABLE IF EXISTS `rc_page`;
CREATE TABLE `rc_page` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `unique_id` varchar(30) NOT NULL default '',
  `parent_id` smallint(5) NOT NULL default '0',
  `page_name` varchar(150) NOT NULL default '',
  `content` longtext NOT NULL,
  `display` int(1) NOT NULL default '0',
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `lang` varchar(10) NOT NULL default 'zh-cn',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ;

# 数据库表：rc_product 结构信息
DROP TABLE IF EXISTS `rc_product`;
CREATE TABLE `rc_product` (
  `id` mediumint(8) NOT NULL auto_increment,
  `cid` smallint(3) default NULL COMMENT '所在分类',
  `title` varchar(200) default NULL COMMENT '产品标题',
  `price` double(10,2) NOT NULL default '0.00' COMMENT '价格',
  `psize` varchar(32) NOT NULL,
  `image` varchar(255) NOT NULL COMMENT '图片',
  `keywords` varchar(50) default NULL COMMENT '产品关键字',
  `description` mediumtext COMMENT '产品描述',
  `status` tinyint(1) default NULL,
  `summary` varchar(255) default NULL COMMENT '产品摘要',
  `published` int(10) default NULL,
  `update_time` int(10) default NULL,
  `content` text,
  `lang` varchar(10) NOT NULL default 'zh-cn',
  `aid` smallint(3) default NULL COMMENT '发布者UID',
  `click` int(11) NOT NULL default '0',
  `is_recommend` int(1) NOT NULL default '0',
  `wap_display` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='产品表' ;

# 数据库表：rc_role 结构信息
DROP TABLE IF EXISTS `rc_role`;
CREATE TABLE `rc_role` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) default NULL,
  `status` tinyint(1) unsigned default NULL,
  `remark` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='权限角色表' ;

# 数据库表：rc_role_user 结构信息
DROP TABLE IF EXISTS `rc_role_user`;
CREATE TABLE `rc_role_user` (
  `role_id` mediumint(9) unsigned default NULL,
  `user_id` char(32) default NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色表' ;

# 数据库表：rc_tag 结构信息
DROP TABLE IF EXISTS `rc_tag`;
CREATE TABLE `rc_tag` (
  `id` int(11) NOT NULL auto_increment,
  `name` char(20) NOT NULL,
  `unique_id` char(20) NOT NULL,
  `content` text NOT NULL,
  `lang` varchar(10) NOT NULL default 'zh-cn',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ;

# 数据库表：rc_user 结构信息
DROP TABLE IF EXISTS `rc_user`;
CREATE TABLE `rc_user` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `uemail` varchar(100) NOT NULL COMMENT 'Email',
  `uname` varchar(100) NOT NULL COMMENT '用户名',
  `upwd` varchar(100) NOT NULL COMMENT '密码',
  `addtime` varchar(50) NOT NULL COMMENT '注册时间',
  `lastlogintime` varchar(50) NOT NULL COMMENT '最后登陆时间',
  `is_yz` int(11) NOT NULL default '0' COMMENT '1=验证,0=未验证',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;



# 数据库表：rc_access 数据信息
INSERT INTO `rc_access` VALUES ('2','8','3','14','');
INSERT INTO `rc_access` VALUES ('2','14','2','1','');
INSERT INTO `rc_access` VALUES ('2','10','3','4','');
INSERT INTO `rc_access` VALUES ('2','4','2','1','');
INSERT INTO `rc_access` VALUES ('2','7','3','3','');
INSERT INTO `rc_access` VALUES ('2','3','2','1','');
INSERT INTO `rc_access` VALUES ('2','6','3','2','');
INSERT INTO `rc_access` VALUES ('2','5','3','2','');
INSERT INTO `rc_access` VALUES ('2','2','2','1','');
INSERT INTO `rc_access` VALUES ('2','1','1','0','');
INSERT INTO `rc_access` VALUES ('3','14','2','1','');
INSERT INTO `rc_access` VALUES ('3','13','3','4','');
INSERT INTO `rc_access` VALUES ('3','12','3','4','');
INSERT INTO `rc_access` VALUES ('3','11','3','4','');
INSERT INTO `rc_access` VALUES ('3','10','3','4','');
INSERT INTO `rc_access` VALUES ('3','4','2','1','');
INSERT INTO `rc_access` VALUES ('3','9','3','3','');
INSERT INTO `rc_access` VALUES ('3','8','3','3','');
INSERT INTO `rc_access` VALUES ('3','7','3','3','');
INSERT INTO `rc_access` VALUES ('3','3','2','1','');
INSERT INTO `rc_access` VALUES ('3','6','3','2','');
INSERT INTO `rc_access` VALUES ('3','5','3','2','');
INSERT INTO `rc_access` VALUES ('3','2','2','1','');
INSERT INTO `rc_access` VALUES ('3','1','1','0','');
INSERT INTO `rc_access` VALUES ('4','7','3','3','');
INSERT INTO `rc_access` VALUES ('4','3','2','1','');
INSERT INTO `rc_access` VALUES ('4','6','3','2','');
INSERT INTO `rc_access` VALUES ('4','5','3','2','');
INSERT INTO `rc_access` VALUES ('4','2','2','1','');
INSERT INTO `rc_access` VALUES ('4','1','1','0','');
INSERT INTO `rc_access` VALUES ('2','9','3','14','');
INSERT INTO `rc_access` VALUES ('2','15','3','14','');
INSERT INTO `rc_access` VALUES ('2','16','3','14','');
INSERT INTO `rc_access` VALUES ('2','17','3','14','');
INSERT INTO `rc_access` VALUES ('2','18','3','14','');
INSERT INTO `rc_access` VALUES ('2','19','3','14','');
INSERT INTO `rc_access` VALUES ('2','20','3','14','');
INSERT INTO `rc_access` VALUES ('2','21','3','14','');
INSERT INTO `rc_access` VALUES ('2','22','3','14','');
INSERT INTO `rc_access` VALUES ('2','23','3','14','');
INSERT INTO `rc_access` VALUES ('2','24','3','14','');
INSERT INTO `rc_access` VALUES ('2','25','3','14','');
INSERT INTO `rc_access` VALUES ('2','26','2','1','');
INSERT INTO `rc_access` VALUES ('2','27','3','26','');
INSERT INTO `rc_access` VALUES ('2','28','3','26','');
INSERT INTO `rc_access` VALUES ('2','29','3','26','');
INSERT INTO `rc_access` VALUES ('2','30','3','26','');
INSERT INTO `rc_access` VALUES ('2','31','3','26','');
INSERT INTO `rc_access` VALUES ('4','26','2','1','');
INSERT INTO `rc_access` VALUES ('4','27','3','26','');
INSERT INTO `rc_access` VALUES ('4','28','3','26','');
INSERT INTO `rc_access` VALUES ('4','29','3','26','');
INSERT INTO `rc_access` VALUES ('4','30','3','26','');
INSERT INTO `rc_access` VALUES ('4','31','3','26','');
INSERT INTO `rc_access` VALUES ('4','53','3','26','');
INSERT INTO `rc_access` VALUES ('4','54','3','26','');
INSERT INTO `rc_access` VALUES ('4','45','2','1','');
INSERT INTO `rc_access` VALUES ('4','55','3','45','');
INSERT INTO `rc_access` VALUES ('4','46','2','1','');
INSERT INTO `rc_access` VALUES ('4','47','3','46','');
INSERT INTO `rc_access` VALUES ('4','48','3','46','');
INSERT INTO `rc_access` VALUES ('4','49','3','46','');
INSERT INTO `rc_access` VALUES ('4','50','3','46','');
INSERT INTO `rc_access` VALUES ('4','51','3','46','');
INSERT INTO `rc_access` VALUES ('4','52','3','46','');


# 数据库表：rc_ad 数据信息
INSERT INTO `rc_ad` VALUES ('6','图片1','http://www.conist.com/','201311/527bb0c2728a4.jpg','index','1','zh-en');
INSERT INTO `rc_ad` VALUES ('7','图片2','http://www.conist.com/','201311/527bb0d5ceda0.jpg','index','2','zh-en');
INSERT INTO `rc_ad` VALUES ('9','圣丹斯','http://www.conist.com/','201311/527c9f47bf378.jpg','index','0','zh-en');
INSERT INTO `rc_ad` VALUES ('11','广告1','http://www.conist.com/','201311/527d13d20bff4.jpg','index','10','zh-cn');
INSERT INTO `rc_ad` VALUES ('12','广告2','http://www.conist.com/','201311/527d13e5ade49.jpg','index','11','zh-cn');
INSERT INTO `rc_ad` VALUES ('15','全局1','http://www.conist.com/','201311/527d1587ddb98.jpg','all','0','zh-cn');
INSERT INTO `rc_ad` VALUES ('16','全局2','http://www.conist.com/','201311/527d15971446c.jpg','all','0','zh-cn');
INSERT INTO `rc_ad` VALUES ('17','全局3','http://www.conist.com/','201311/527d15a630135.jpg','all','0','zh-en');
INSERT INTO `rc_ad` VALUES ('18','手机','http://www.conist.com','201311/527f13755025a.jpg','wap','30','zh-cn');


# 数据库表：rc_admin 数据信息
INSERT INTO `rc_admin` VALUES ('1','超级管理员','lixuelianlk@163.com','fb30be373c67cf0c4f29a89ef2a012dd','1','我是超级管理员 哈哈~~','','1406516142');


# 数据库表：rc_category 数据信息
INSERT INTO `rc_category` VALUES ('73','0','手机','p','zh-cn');
INSERT INTO `rc_category` VALUES ('72','0','显示器','p','zh-cn');
INSERT INTO `rc_category` VALUES ('74','0','新闻动态','n','zh-cn');
INSERT INTO `rc_category` VALUES ('71','0','笔记本','p','zh-cn');
INSERT INTO `rc_category` VALUES ('80','0','法规月报','n','zh-cn');
INSERT INTO `rc_category` VALUES ('76','0','News','n','zh-en');
INSERT INTO `rc_category` VALUES ('77','0','Phone','p','zh-en');
INSERT INTO `rc_category` VALUES ('78','0','Display','p','zh-en');
INSERT INTO `rc_category` VALUES ('79','0','Network','p','zh-en');
INSERT INTO `rc_category` VALUES ('81','0','Regulations','n','zh-en');
INSERT INTO `rc_category` VALUES ('83','0','cc','n','zh-cn');


# 数据库表：rc_laws 数据信息
INSERT INTO `rc_laws` VALUES ('4','0','','001','法规标题测试xg','fa gui biao ti','法规','所有','kkk','','0','2014-03-03','201407/53d9e883959f2.pdf','','','1406791262','7','1','1','2','zh-cn','1');
INSERT INTO `rc_laws` VALUES ('5','0','','002','中国第二次修订案','fa gui biao ti','法规','所有','kkk','','0','2013-07-01','201407/53da1836802b7.pdf','201407/53da178f1e271.jpg','','1406801974','7','4','2','2','zh-cn','1');


# 数据库表：rc_lawscountry 数据信息
INSERT INTO `rc_lawscountry` VALUES ('7','ssdxg','201407/53d76fab95df0.jpg','zh-en','');


# 数据库表：rc_lawsmodule 数据信息
INSERT INTO `rc_lawsmodule` VALUES ('2','xxx','zh-cn');


# 数据库表：rc_lawstype 数据信息
INSERT INTO `rc_lawstype` VALUES ('1','0','刑事认证','1406622345','zh-cn');
INSERT INTO `rc_lawstype` VALUES ('4','0','啊啊啊','','zh-cn');


# 数据库表：rc_link 数据信息
INSERT INTO `rc_link` VALUES ('1','Conist','1','http://www.conist.com','124','2');


# 数据库表：rc_message 数据信息


# 数据库表：rc_nav 数据信息
INSERT INTO `rc_nav` VALUES ('35','news','新闻动态','0','0','middle','','zh-cn','1','0');
INSERT INTO `rc_nav` VALUES ('36','product','公司产品','0','0','middle','','zh-cn','100','0');
INSERT INTO `rc_nav` VALUES ('44','message','Message','0','0','middle','','zh-en','97','0');
INSERT INTO `rc_nav` VALUES ('39','message','留言板','0','0','middle','','zh-cn','11','0');
INSERT INTO `rc_nav` VALUES ('41','product','Product','0','0','middle','','zh-en','100','0');
INSERT INTO `rc_nav` VALUES ('42','news','News','0','0','middle','','zh-en','99','0');
INSERT INTO `rc_nav` VALUES ('46','page','关于我们','0','17','middle','','zh-cn','2','0');
INSERT INTO `rc_nav` VALUES ('47','page','联系我们','0','18','top','','zh-cn','3','0');


# 数据库表：rc_news 数据信息
INSERT INTO `rc_news` VALUES ('17','74','我要买车','201407/53d61fe884cfa.jpg','','','1','已由中华人民共和国第十届全国人民代表大会常务委员会第二十八次会议于2007年6月2日通过，现予公布，自2008年1月1日起施行。
第一条
为了完善劳动合同制度，明确劳动合同双方当事人的权利和义务，保护劳动者的合法权益。
第二条
中华人民共和国境内的企业个体经济组织。','1406540706','1406541800','<p><span style="color: rgb(34, 34, 34); font-family: Consolas, &#39;Lucida Console&#39;, monospace; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: pre-wrap; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;">已由中华人民共和国第十届全国人民代表大会常务委员会第二十八次会议于2007年6月2日通过，现予公布，自2008年1月1日起施行。
第一条
为了完善劳动合同制度，明确劳动合同双方当事人的权利和义务，保护劳动者的合法权益。
第二条
中华人民共和国境内的企业个体经济组织。</span></p>','zh-cn','1','4','0');
INSERT INTO `rc_news` VALUES ('18','80','中华人民共和国主席令','','','','1','第　七　号　　《全国人民代表大会常务委员会关于修改＜中华人民共和国消费者权益保护法＞的决定》已由中华人民共和国第十二届全国人民代表大会常务委员会第五次会议于2013年10月25日通过，现予公布，自2014年3月15日起施行。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbs&hellip;','1406605605','','<p style="text-align:center;font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="font-size: 14pt;">第　<strong>七</strong>　号</span></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="font-size: 14pt;">　　《全国人民代表大会常务委员会关于修改＜中华人民共和国消费者权益保护法＞的决定》已由中华人民共和国第十二届全国人民代表大会常务委员会第五次会议于2013年10月25日通过，现予公布，自2014年3月15日起施行。</span></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="font-size: 14pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;中华人民共和国主席 习近平</span></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="font-size: 14pt;">　　　　　　　　　　　　　　　　　　　2013年10月25日</span></p><p style="text-align:left;font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="text-align:center;font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="color:#000000"><span style="font-size: 18pt;"><strong>全国人民代表大会常务委员会关于修改<br/>《中华人民共和国消费者权益保护法》的决定</strong></span><br/>（2013年10月25日第十二届全国人民代表大会常务委员会第五次会议通过）</span></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十二届全国人民代表大会常务委员会第五次会议决定对《中华人民共和国消费者权益保护法》作如下修改：</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;一、第五条增加一款，作为第三款：“国家倡导文明、健康、节约资源和保护环境的消费方式，反对浪费。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二、将第十四条修改为：“消费者在购买、使用商品和接受服务时，享有人格尊严、民族风俗习惯得到尊重的权利，享有个人信息依法得到保护的权利。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;三、将第十六条第一款修改为：“经营者向消费者提供商品或者服务，应当依照本法和其他有关法律、法规的规定履行义务。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加一款，作为第三款：“经营者向消费者提供商品或者服务，应当恪守社会公德，诚信经营，保障消费者的合法权益；不得设定不公平、不合理的交易条件，不得强制交易。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;四、第十八条增加一款，作为第二款：“宾馆、商场、餐馆、银行、机场、车站、港口、影剧院等经营场所的经营者，应当对消费者尽到安全保障义务。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;将第二款改为第十九条，修改为：“经营者发现其提供的商品或者服务存在缺陷，有危及人身、财产安全危险的，应当立即向有关行政部门报告和告知消费者，并采取停止销售、警示、召回、无害化处理、销毁、停止生产或者服务等措施。采取召回措施的，经营者应当承担消费者因商品被召回支出的必要费用。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;五、将第十九条改为第二十条，第一款修改为：“经营者向消费者提供有关商品或者服务的质量、性能、用途、有效期限等信息，应当真实、全面，不得作虚假或者引人误解的宣传。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三款修改为：“经营者提供商品或者服务应当明码标价。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;六、将第二十一条改为第二十二条，其中的“购货凭证或者服务单据”修改为“发票等购货凭证或者服务单据”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;七、将第二十二条改为第二十三条，第一款中的“但消费者在购买该商品或者接受该服务前已经知道其存在瑕疵的除外”修改为“但消费者在购买该商品或者接受该服务前已经知道其存在瑕疵，且存在该瑕疵不违反法律强制性规定的除外”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加一款，作为第三款：“经营者提供的机动车、计算机、电视机、电冰箱、空调器、洗衣机等耐用商品或者装饰装修等服务，消费者自接受商品或者服务之日起六个月内发现瑕疵，发生争议的，由经营者承担有关瑕疵的举证责任。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;八、将第二十三条、第四十五条合并，作为第二十四条，修改为：“经营者提供的商品或者服务不符合质量要求的，消费者可以依照国家规定、当事人约定退货，或者要求经营者履行更换、修理等义务。没有国家规定和当事人约定的，消费者可以自收到商品之日起七日内退货；七日后符合法定解除合同条件的，消费者可以及时退货，不符合法定解除合同条件的，可以要求经营者履行更换、修理等义务。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“依照前款规定进行退货、更换、修理的，经营者应当承担运输等必要费用。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;九、增加一条，作为第二十五条：“经营者采用网络、电视、电话、邮购等方式销售商品，消费者有权自收到商品之日起七日内退货，且无需说明理由，但下列商品除外：</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“（一）消费者定作的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“（二）鲜活易腐的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“（三）在线下载或者消费者拆封的音像制品、计算机软件等数字化商品；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“（四）交付的报纸、期刊。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“除前款所列商品外，其他根据商品性质并经消费者在购买时确认不宜退货的商品，不适用无理由退货。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“消费者退货的商品应当完好。经营者应当自收到退回商品之日起七日内返还消费者支付的商品价款。退回商品的运费由消费者承担；经营者和消费者另有约定的，按照约定。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十、将第二十四条改为第二十六条，增加一款，作为第一款：“经营者在经营活动中使用格式条款的，应当以显著方式提请消费者注意商品或者服务的数量和质量、价款或者费用、履行期限和方式、安全注意事项和风险警示、售后服务、民事责任等与消费者有重大利害关系的内容，并按照消费者的要求予以说明。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一款、第二款改为第二款、第三款，修改为：“经营者不得以格式条款、通知、声明、店堂告示等方式，作出排除或者限制消费者权利、减轻或者免除经营者责任、加重消费者责任等对消费者不公平、不合理的规定，不得利用格式条款并借助技术手段强制交易。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“格式条款、通知、声明、店堂告示等含有前款所列内容的，其内容无效。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十一、增加一条，作为第二十八条：“采用网络、电视、电话、邮购等方式提供商品或者服务的经营者，以及提供证券、保险、银行等金融服务的经营者，应当向消费者提供经营地址、联系方式、商品或者服务的数量和质量、价款或者费用、履行期限和方式、安全注意事项和风险警示、售后服务、民事责任等信息。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十二、增加一条，作为第二十九条：“经营者收集、使用消费者个人信息，应当遵循合法、正当、必要的原则，明示收集、使用信息的目的、方式和范围，并经消费者同意。经营者收集、使用消费者个人信息，应当公开其收集、使用规则，不得违反法律、法规的规定和双方的约定收集、使用信息。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“经营者及其工作人员对收集的消费者个人信息必须严格保密，不得泄露、出售或者非法向他人提供。经营者应当采取技术措施和其他必要措施，确保信息安全，防止消费者个人信息泄露、丢失。在发生或者可能发生信息泄露、丢失的情况时，应当立即采取补救措施。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“经营者未经消费者同意或者请求，或者消费者明确表示拒绝的，不得向其发送商业性信息。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十三、将第二十六条改为第三十条，修改为：“国家制定有关消费者权益的法律、法规、规章和强制性标准，应当听取消费者和消费者协会等组织的意见。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;相应地将第二十八条第二款中的“及其社会团体”修改为“和消费者协会等组织”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十四、将第二十七条改为第三十一条，第一款修改为：“各级人民政府应当加强领导，组织、协调、督促有关行政部门做好保护消费者合法权益的工作，落实保护消费者合法权益的职责。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加一条，作为第三十三条：“有关行政部门在各自的职责范围内，应当定期或者不定期对经营者提供的商品和服务进行抽查检验，并及时向社会公布抽查检验结果。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“有关行政部门发现并认定经营者提供的商品或者服务存在缺陷，有危及人身、财产安全危险的，应当立即责令经营者采取停止销售、警示、召回、无害化处理、销毁、停止生产或者服务等措施。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十五、将第三十一条改为第三十六条，修改为：“消费者协会和其他消费者组织是依法成立的对商品和服务进行社会监督的保护消费者合法权益的社会组织。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;相应地将第十二条中的“社会团体”修改为“社会组织”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;将第三十二条改为第三十七条，第一款中的“消费者协会履行下列职能：”修改为“消费者协会履行下列公益性职责：”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一款第一项修改为：“（一）向消费者提供消费信息和咨询服务，提高消费者维护自身合法权益的能力，引导文明、健康、节约资源和保护环境的消费方式”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一款增加一项，作为第二项：“（二）参与制定有关消费者权益的法律、法规、规章和强制性标准”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一款第三项改为第四项，修改为：“（四）就有关消费者合法权益的问题，向有关部门反映、查询，提出建议”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一款第五项改为第六项，修改为：“（六）投诉事项涉及商品和服务质量问题的，可以委托具备资格的鉴定人鉴定，鉴定人应当告知鉴定意见”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一款第六项改为第七项，修改为：“（七）就损害消费者合法权益的行为，支持受损害的消费者提起诉讼或者依照本法提起诉讼”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二款修改为：“各级人民政府对消费者协会履行职责应当予以必要的经费等支持。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加二款，作为第三款、第四款：“消费者协会应当认真履行保护消费者合法权益的职责，听取消费者的意见和建议，接受社会监督。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“依法成立的其他消费者组织依照法律、法规及其章程的规定，开展保护消费者合法权益的活动。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;将第三十三条改为第三十八条，修改为：“消费者组织不得从事商品经营和营利性服务，不得以收取费用或者其他牟取利益的方式向消费者推荐商品和服务。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十六、将第三十四条改为第三十九条，第二项修改为：“（二）请求消费者协会或者依法成立的其他调解组织调解”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三项修改为：“（三）向有关行政部门投诉”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十七、增加一条，作为第四十四条：“消费者通过网络交易平台购买商品或者接受服务，其合法权益受到损害的，可以向销售者或者服务者要求赔偿。网络交易平台提供者不能提供销售者或者服务者的真实名称、地址和有效联系方式的，消费者也可以向网络交易平台提供者要求赔偿；网络交易平台提供者作出更有利于消费者的承诺的，应当履行承诺。网络交易平台提供者赔偿后，有权向销售者或者服务者追偿。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“网络交易平台提供者明知或者应知销售者或者服务者利用其平台侵害消费者合法权益，未采取必要措施的，依法与该销售者或者服务者承担连带责任。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十八、将第三十九条改为第四十五条第一款，其中的“利用虚假广告”修改为“利用虚假广告或者其他虚假宣传方式”，“广告的经营者”修改为“广告经营者、发布者”，“真实名称、地址”修改为“真实名称、地址和有效联系方式”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加二款，作为第二款、第三款：“广告经营者、发布者设计、制作、发布关系消费者生命健康商品或者服务的虚假广告，造成消费者损害的，应当与提供该商品或者服务的经营者承担连带责任。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;“社会团体或者其他组织、个人在关系消费者生命健康商品或者服务的虚假广告或者其他虚假宣传中向消费者推荐商品或者服务，造成消费者损害的，应当与提供该商品或者服务的经营者承担连带责任。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;十九、增加一条，作为第四十六条：“消费者向有关行政部门投诉的，该部门应当自收到投诉之日起七个工作日内，予以处理并告知消费者。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十、增加一条，作为第四十七条：“对侵害众多消费者合法权益的行为，中国消费者协会以及在省、自治区、直辖市设立的消费者协会，可以向人民法院提起诉讼。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十一、将第四十条改为第四十八条第一款，其中的“应当依照《中华人民共和国产品质量法》和其他有关法律、法规的规定”修改为“应当依照其他有关法律、法规的规定”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一项修改为：“（一）商品或者服务存在缺陷的”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加一款，作为第二款：“经营者对消费者未尽到安全保障义务，造成消费者损害的，应当承担侵权责任。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十二、将第四十一条、第四十二条合并，作为第四十九条，修改为：“经营者提供商品或者服务，造成消费者或者其他受害人人身伤害的，应当赔偿医疗费、护理费、交通费等为治疗和康复支出的合理费用，以及因误工减少的收入。造成残疾的，还应当赔偿残疾生活辅助具费和残疾赔偿金。造成死亡的，还应当赔偿丧葬费和死亡赔偿金。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十三、将第四十三条改为第五十条，修改为：“经营者侵害消费者的人格尊严、侵犯消费者人身自由或者侵害消费者个人信息依法得到保护的权利的，应当停止侵害、恢复名誉、消除影响、赔礼道歉，并赔偿损失。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十四、增加一条，作为第五十一条：“经营者有侮辱诽谤、搜查身体、侵犯人身自由等侵害消费者或者其他受害人人身权益的行为，造成严重精神损害的，受害人可以要求精神损害赔偿。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十五、将第四十四条改为第五十二条，修改为：“经营者提供商品或者服务，造成消费者财产损害的，应当依照法律规定或者当事人约定承担修理、重作、更换、退货、补足商品数量、退还货款和服务费用或者赔偿损失等民事责任。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十六、删去第四十六条。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十七、将第四十九条改为第五十五条第一款，修改为：“经营者提供商品或者服务有欺诈行为的，应当按照消费者的要求增加赔偿其受到的损失，增加赔偿的金额为消费者购买商品的价款或者接受服务的费用的三倍；增加赔偿的金额不足五百元的，为五百元。法律另有规定的，依照其规定。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加一款，作为第二款：“经营者明知商品或者服务存在缺陷，仍然向消费者提供，造成消费者或者其他受害人死亡或者健康严重损害的，受害人有权要求经营者依照本法第四十九条、第五十一条等法律规定赔偿损失，并有权要求所受损失二倍以下的惩罚性赔偿。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十八、将第五十条改为第五十六条第一款，其中的“《中华人民共和国产品质量法》和其他有关法律、法规对处罚机关和处罚方式有规定的”修改为“除承担相应的民事责任外，其他有关法律、法规对处罚机关和处罚方式有规定的”，“工商行政管理部门”修改为“工商行政管理部门或者其他有关行政部门”，“处以违法所得一倍以上五倍以下的罚款”修改为“处以违法所得一倍以上十倍以下的罚款”，“处以一万元以下的罚款”修改为“处以五十万元以下的罚款”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一项修改为：“（一）提供的商品或者服务不符合保障人身、财产安全要求的”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四项修改为：“（四）伪造商品的产地，伪造或者冒用他人的厂名、厂址，篡改生产日期，伪造或者冒用认证标志等质量标志的”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第六项修改为：“（六）对商品或者服务作虚假或者引人误解的宣传的”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加一项，作为第七项：“（七）拒绝或者拖延有关行政部门责令对缺陷商品或者服务采取停止销售、警示、召回、无害化处理、销毁、停止生产或者服务等措施的”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第八项改为第九项，修改为：“（九）侵害消费者人格尊严、侵犯消费者人身自由或者侵害消费者个人信息依法得到保护的权利的”。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;增加一款，作为第二款：“经营者有前款规定情形的，除依照法律、法规规定予以处罚外，处罚机关应当记入信用档案，向社会公布。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;二十九、增加一条，作为第五十七条：“经营者违反本法规定提供商品或者服务，侵害消费者合法权益，构成犯罪的，依法追究刑事责任。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;三十、增加一条，作为第五十八条：“经营者违反本法规定，应当承担民事赔偿责任和缴纳罚款、罚金，其财产不足以同时支付的，先承担民事赔偿责任。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;三十一、将第五十一条改为第五十九条，修改为：“经营者对行政处罚决定不服的，可以依法申请行政复议或者提起行政诉讼。”</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;此外，对条文顺序作相应调整。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;本决定自2014年3月15日起施行。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;《中华人民共和国消费者权益保护法》根据本决定作相应修改，重新公布。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="text-align:center;font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="font-size: 18pt;"><strong>中华人民共和国消费者权益保护法</strong></span></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（1993年10月31日第八届全国人民代表大会常务委员会第四次会议通过 根据2009年8月27日第十一届全国人民代表大会常务委员会第十次会议《关于修改部分法律的决定》第一次修正 根据2013年10月25日第十二届全国人民代表大会常务委员会第五次会议《关于修改＜中华人民共和国消费者权益保护法＞的决定》第二次修正）</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;<strong>目 录</strong></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一章 总 则</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二章 消费者的权利</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三章 经营者的义务</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四章 国家对消费者合法权益的保护</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第五章 消费者组织</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第六章 争议的解决</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第七章 法律责任</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第八章 附 则</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;<strong>第一章 总 则</strong></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第一条 为保护消费者的合法权益，维护社会经济秩序，促进社会主义市场经济健康发展，制定本法。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二条 消费者为生活消费需要购买、使用商品或者接受服务，其权益受本法保护；本法未作规定的，受其他有关法律、法规保护。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三条 经营者为消费者提供其生产、销售的商品或者提供服务，应当遵守本法；本法未作规定的，应当遵守其他有关法律、法规。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四条 经营者与消费者进行交易，应当遵循自愿、平等、公平、诚实信用的原则。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第五条 国家保护消费者的合法权益不受侵害。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;国家采取措施，保障消费者依法行使权利，维护消费者的合法权益。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;国家倡导文明、健康、节约资源和保护环境的消费方式，反对浪费。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第六条 保护消费者的合法权益是全社会的共同责任。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;国家鼓励、支持一切组织和个人对损害消费者合法权益的行为进行社会监督。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;大众传播媒介应当做好维护消费者合法权益的宣传，对损害消费者合法权益的行为进行舆论监督。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;<strong>&nbsp;第二章 消费者的权利</strong></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第七条 消费者在购买、使用商品和接受服务时享有人身、财产安全不受损害的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者有权要求经营者提供的商品和服务，符合保障人身、财产安全的要求。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第八条 消费者享有知悉其购买、使用的商品或者接受的服务的真实情况的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者有权根据商品或者服务的不同情况，要求经营者提供商品的价格、产地、生产者、用途、性能、规格、等级、主要成份、生产日期、有效期限、检验合格证明、使用方法说明书、售后服务，或者服务的内容、规格、费用等有关情况。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第九条 消费者享有自主选择商品或者服务的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者有权自主选择提供商品或者服务的经营者，自主选择商品品种或者服务方式，自主决定购买或者不购买任何一种商品、接受或者不接受任何一项服务。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者在自主选择商品或者服务时，有权进行比较、鉴别和挑选。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十条 消费者享有公平交易的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者在购买商品或者接受服务时，有权获得质量保障、价格合理、计量正确等公平交易条件，有权拒绝经营者的强制交易行为。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十一条 消费者因购买、使用商品或者接受服务受到人身、财产损害的，享有依法获得赔偿的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十二条 消费者享有依法成立维护自身合法权益的社会组织的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十三条 消费者享有获得有关消费和消费者权益保护方面的知识的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者应当努力掌握所需商品或者服务的知识和使用技能，正确使用商品，提高自我保护意识。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十四条 消费者在购买、使用商品和接受服务时，享有人格尊严、民族风俗习惯得到尊重的权利，享有个人信息依法得到保护的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十五条 消费者享有对商品和服务以及保护消费者权益工作进行监督的权利。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者有权检举、控告侵害消费者权益的行为和国家机关及其工作人员在保护消费者权益工作中的违法失职行为，有权对保护消费者权益工作提出批评、建议。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><strong>&nbsp;&nbsp;&nbsp;&nbsp;第三章 经营者的义务</strong></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十六条 经营者向消费者提供商品或者服务，应当依照本法和其他有关法律、法规的规定履行义务。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者和消费者有约定的，应当按照约定履行义务，但双方的约定不得违背法律、法规的规定。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者向消费者提供商品或者服务，应当恪守社会公德，诚信经营，保障消费者的合法权益；不得设定不公平、不合理的交易条件，不得强制交易。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十七条 经营者应当听取消费者对其提供的商品或者服务的意见，接受消费者的监督。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十八条 经营者应当保证其提供的商品或者服务符合保障人身、财产安全的要求。对可能危及人身、财产安全的商品和服务，应当向消费者作出真实的说明和明确的警示，并说明和标明正确使用商品或者接受服务的方法以及防止危害发生的方法。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;宾馆、商场、餐馆、银行、机场、车站、港口、影剧院等经营场所的经营者，应当对消费者尽到安全保障义务。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第十九条 经营者发现其提供的商品或者服务存在缺陷，有危及人身、财产安全危险的，应当立即向有关行政部门报告和告知消费者，并采取停止销售、警示、召回、无害化处理、销毁、停止生产或者服务等措施。采取召回措施的，经营者应当承担消费者因商品被召回支出的必要费用。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十条 经营者向消费者提供有关商品或者服务的质量、性能、用途、有效期限等信息，应当真实、全面，不得作虚假或者引人误解的宣传。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者对消费者就其提供的商品或者服务的质量和使用方法等问题提出的询问，应当作出真实、明确的答复。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者提供商品或者服务应当明码标价。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十一条 经营者应当标明其真实名称和标记。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;租赁他人柜台或者场地的经营者，应当标明其真实名称和标记。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十二条 经营者提供商品或者服务，应当按照国家有关规定或者商业惯例向消费者出具发票等购货凭证或者服务单据；消费者索要发票等购货凭证或者服务单据的，经营者必须出具。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十三条 经营者应当保证在正常使用商品或者接受服务的情况下其提供的商品或者服务应当具有的质量、性能、用途和有效期限；但消费者在购买该商品或者接受该服务前已经知道其存在瑕疵，且存在该瑕疵不违反法律强制性规定的除外。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者以广告、产品说明、实物样品或者其他方式表明商品或者服务的质量状况的，应当保证其提供的商品或者服务的实际质量与表明的质量状况相符。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者提供的机动车、计算机、电视机、电冰箱、空调器、洗衣机等耐用商品或者装饰装修等服务，消费者自接受商品或者服务之日起六个月内发现瑕疵，发生争议的，由经营者承担有关瑕疵的举证责任。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十四条 经营者提供的商品或者服务不符合质量要求的，消费者可以依照国家规定、当事人约定退货，或者要求经营者履行更换、修理等义务。没有国家规定和当事人约定的，消费者可以自收到商品之日起七日内退货；七日后符合法定解除合同条件的，消费者可以及时退货，不符合法定解除合同条件的，可以要求经营者履行更换、修理等义务。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;依照前款规定进行退货、更换、修理的，经营者应当承担运输等必要费用。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十五条 经营者采用网络、电视、电话、邮购等方式销售商品，消费者有权自收到商品之日起七日内退货，且无需说明理由，但下列商品除外：</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（一）消费者定作的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（二）鲜活易腐的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（三）在线下载或者消费者拆封的音像制品、计算机软件等数字化商品；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（四）交付的报纸、期刊。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;除前款所列商品外，其他根据商品性质并经消费者在购买时确认不宜退货的商品，不适用无理由退货。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者退货的商品应当完好。经营者应当自收到退回商品之日起七日内返还消费者支付的商品价款。退回商品的运费由消费者承担；经营者和消费者另有约定的，按照约定。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十六条 经营者在经营活动中使用格式条款的，应当以显著方式提请消费者注意商品或者服务的数量和质量、价款或者费用、履行期限和方式、安全注意事项和风险警示、售后服务、民事责任等与消费者有重大利害关系的内容，并按照消费者的要求予以说明。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者不得以格式条款、通知、声明、店堂告示等方式，作出排除或者限制消费者权利、减轻或者免除经营者责任、加重消费者责任等对消费者不公平、不合理的规定，不得利用格式条款并借助技术手段强制交易。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;格式条款、通知、声明、店堂告示等含有前款所列内容的，其内容无效。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十七条 经营者不得对消费者进行侮辱、诽谤，不得搜查消费者的身体及其携带的物品，不得侵犯消费者的人身自由。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十八条 采用网络、电视、电话、邮购等方式提供商品或者服务的经营者，以及提供证券、保险、银行等金融服务的经营者，应当向消费者提供经营地址、联系方式、商品或者服务的数量和质量、价款或者费用、履行期限和方式、安全注意事项和风险警示、售后服务、民事责任等信息。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第二十九条 经营者收集、使用消费者个人信息，应当遵循合法、正当、必要的原则，明示收集、使用信息的目的、方式和范围，并经消费者同意。经营者收集、使用消费者个人信息，应当公开其收集、使用规则，不得违反法律、法规的规定和双方的约定收集、使用信息。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者及其工作人员对收集的消费者个人信息必须严格保密，不得泄露、出售或者非法向他人提供。经营者应当采取技术措施和其他必要措施，确保信息安全，防止消费者个人信息泄露、丢失。在发生或者可能发生信息泄露、丢失的情况时，应当立即采取补救措施。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者未经消费者同意或者请求，或者消费者明确表示拒绝的，不得向其发送商业性信息。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><strong>&nbsp;&nbsp;&nbsp;&nbsp;第四章 国家对消费者合法权益的保护</strong></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十条 国家制定有关消费者权益的法律、法规、规章和强制性标准，应当听取消费者和消费者协会等组织的意见。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十一条 各级人民政府应当加强领导，组织、协调、督促有关行政部门做好保护消费者合法权益的工作，落实保护消费者合法权益的职责。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;各级人民政府应当加强监督，预防危害消费者人身、财产安全行为的发生，及时制止危害消费者人身、财产安全的行为。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十二条 各级人民政府工商行政管理部门和其他有关行政部门应当依照法律、法规的规定，在各自的职责范围内，采取措施，保护消费者的合法权益。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;有关行政部门应当听取消费者和消费者协会等组织对经营者交易行为、商品和服务质量问题的意见，及时调查处理。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十三条 有关行政部门在各自的职责范围内，应当定期或者不定期对经营者提供的商品和服务进行抽查检验，并及时向社会公布抽查检验结果。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;有关行政部门发现并认定经营者提供的商品或者服务存在缺陷，有危及人身、财产安全危险的，应当立即责令经营者采取停止销售、警示、召回、无害化处理、销毁、停止生产或者服务等措施。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十四条 有关国家机关应当依照法律、法规的规定，惩处经营者在提供商品和服务中侵害消费者合法权益的违法犯罪行为。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十五条 人民法院应当采取措施，方便消费者提起诉讼。对符合《中华人民共和国民事诉讼法》起诉条件的消费者权益争议，必须受理，及时审理。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;<strong>&nbsp;&nbsp;第五章 消费者组织</strong></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十六条 消费者协会和其他消费者组织是依法成立的对商品和服务进行社会监督的保护消费者合法权益的社会组织。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十七条 消费者协会履行下列公益性职责：</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（一）向消费者提供消费信息和咨询服务，提高消费者维护自身合法权益的能力，引导文明、健康、节约资源和保护环境的消费方式；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（二）参与制定有关消费者权益的法律、法规、规章和强制性标准；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（三）参与有关行政部门对商品和服务的监督、检查；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（四）就有关消费者合法权益的问题，向有关部门反映、查询，提出建议；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（五）受理消费者的投诉，并对投诉事项进行调查、调解；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（六）投诉事项涉及商品和服务质量问题的，可以委托具备资格的鉴定人鉴定，鉴定人应当告知鉴定意见；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（七）就损害消费者合法权益的行为，支持受损害的消费者提起诉讼或者依照本法提起诉讼；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（八）对损害消费者合法权益的行为，通过大众传播媒介予以揭露、批评。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;各级人民政府对消费者协会履行职责应当予以必要的经费等支持。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者协会应当认真履行保护消费者合法权益的职责，听取消费者的意见和建议，接受社会监督。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;依法成立的其他消费者组织依照法律、法规及其章程的规定，开展保护消费者合法权益的活动。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十八条 消费者组织不得从事商品经营和营利性服务，不得以收取费用或者其他牟取利益的方式向消费者推荐商品和服务。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;<strong>&nbsp;&nbsp;第六章 争议的解决</strong></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第三十九条 消费者和经营者发生消费者权益争议的，可以通过下列途径解决：</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（一）与经营者协商和解；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（二）请求消费者协会或者依法成立的其他调解组织调解；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（三）向有关行政部门投诉；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（四）根据与经营者达成的仲裁协议提请仲裁机构仲裁；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（五）向人民法院提起诉讼。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十条 消费者在购买、使用商品时，其合法权益受到损害的，可以向销售者要求赔偿。销售者赔偿后，属于生产者的责任或者属于向销售者提供商品的其他销售者的责任的，销售者有权向生产者或者其他销售者追偿。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者或者其他受害人因商品缺陷造成人身、财产损害的，可以向销售者要求赔偿，也可以向生产者要求赔偿。属于生产者责任的，销售者赔偿后，有权向生产者追偿。属于销售者责任的，生产者赔偿后，有权向销售者追偿。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;消费者在接受服务时，其合法权益受到损害的，可以向服务者要求赔偿。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十一条 消费者在购买、使用商品或者接受服务时，其合法权益受到损害，因原企业分立、合并的，可以向变更后承受其权利义务的企业要求赔偿。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十二条 使用他人营业执照的违法经营者提供商品或者服务，损害消费者合法权益的，消费者可以向其要求赔偿，也可以向营业执照的持有人要求赔偿。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十三条 消费者在展销会、租赁柜台购买商品或者接受服务，其合法权益受到损害的，可以向销售者或者服务者要求赔偿。展销会结束或者柜台租赁期满后，也可以向展销会的举办者、柜台的出租者要求赔偿。展销会的举办者、柜台的出租者赔偿后，有权向销售者或者服务者追偿。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十四条 消费者通过网络交易平台购买商品或者接受服务，其合法权益受到损害的，可以向销售者或者服务者要求赔偿。网络交易平台提供者不能提供销售者或者服务者的真实名称、地址和有效联系方式的，消费者也可以向网络交易平台提供者要求赔偿；网络交易平台提供者作出更有利于消费者的承诺的，应当履行承诺。网络交易平台提供者赔偿后，有权向销售者或者服务者追偿。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;网络交易平台提供者明知或者应知销售者或者服务者利用其平台侵害消费者合法权益，未采取必要措施的，依法与该销售者或者服务者承担连带责任。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十五条 消费者因经营者利用虚假广告或者其他虚假宣传方式提供商品或者服务，其合法权益受到损害的，可以向经营者要求赔偿。广告经营者、发布者发布虚假广告的，消费者可以请求行政主管部门予以惩处。广告经营者、发布者不能提供经营者的真实名称、地址和有效联系方式的，应当承担赔偿责任。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;广告经营者、发布者设计、制作、发布关系消费者生命健康商品或者服务的虚假广告，造成消费者损害的，应当与提供该商品或者服务的经营者承担连带责任。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;社会团体或者其他组织、个人在关系消费者生命健康商品或者服务的虚假广告或者其他虚假宣传中向消费者推荐商品或者服务，造成消费者损害的，应当与提供该商品或者服务的经营者承担连带责任。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十六条 消费者向有关行政部门投诉的，该部门应当自收到投诉之日起七个工作日内，予以处理并告知消费者。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十七条 对侵害众多消费者合法权益的行为，中国消费者协会以及在省、自治区、直辖市设立的消费者协会，可以向人民法院提起诉讼。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"><strong>&nbsp;&nbsp;&nbsp;&nbsp;第七章 法律责任</strong></p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;第四十八条 经营者提供商品或者服务有下列情形之一的，除本法另有规定外，应当依照其他有关法律、法规的规定，承担民事责任：</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（一）商品或者服务存在缺陷的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（二）不具备商品应当具备的使用性能而出售时未作说明的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（三）不符合在商品或者其包装上注明采用的商品标准的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（四）不符合商品说明、实物样品等方式表明的质量状况的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（五）生产国家明令淘汰的商品或者销售失效、变质的商品的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（六）销售的商品数量不足的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（七）服务的内容和费用违反约定的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（八）对消费者提出的修理、重作、更换、退货、补足商品数量、退还货款和服务费用或者赔偿损失的要求，故意拖延或者无理拒绝的；</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;（九）法律、法规规定的其他损害消费者权益的情形。</p><p style="font-family: 宋体; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;经营者对消费者未尽到安全保障义务，造成消费者损害的','zh-cn','1','3','0');


# 数据库表：rc_node 数据信息
INSERT INTO `rc_node` VALUES ('1','Admin','后台管理','1','网站后台管理项目','10','0','1');
INSERT INTO `rc_node` VALUES ('2','Index','管理首页','1','','1','1','2');
INSERT INTO `rc_node` VALUES ('3','Member','注册会员管理','1','','3','1','2');
INSERT INTO `rc_node` VALUES ('4','Webinfo','系统管理','1','','4','1','2');
INSERT INTO `rc_node` VALUES ('5','index','默认页','1','','5','2','3');
INSERT INTO `rc_node` VALUES ('6','myInfo','我的个人信息','1','','6','2','3');
INSERT INTO `rc_node` VALUES ('7','index','会员首页','1','','7','3','3');
INSERT INTO `rc_node` VALUES ('8','index','管理员列表','1','','8','14','3');
INSERT INTO `rc_node` VALUES ('9','addAdmin','添加管理员','1','','9','14','3');
INSERT INTO `rc_node` VALUES ('10','index','系统设置首页','1','','10','4','3');
INSERT INTO `rc_node` VALUES ('11','setEmailConfig','设置系统邮件','1','','12','4','3');
INSERT INTO `rc_node` VALUES ('12','testEmailConfig','发送测试邮件','1','','0','4','3');
INSERT INTO `rc_node` VALUES ('13','setSafeConfig','系统安全设置','1','','0','4','3');
INSERT INTO `rc_node` VALUES ('14','Access','权限管理','1','权限管理，为系统后台管理员设置不同的权限','0','1','2');
INSERT INTO `rc_node` VALUES ('15','nodeList','查看节点','1','节点列表信息','0','14','3');
INSERT INTO `rc_node` VALUES ('16','roleList','角色列表查看','1','角色列表查看','0','14','3');
INSERT INTO `rc_node` VALUES ('17','addRole','添加角色','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('18','editRole','编辑角色','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('19','opNodeStatus','便捷开启禁用节点','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('20','opRoleStatus','便捷开启禁用角色','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('21','editNode','编辑节点','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('22','addNode','添加节点','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('23','addAdmin','添加管理员','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('24','editAdmin','编辑管理员信息','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('25','changeRole','权限分配','1','','0','14','3');
INSERT INTO `rc_node` VALUES ('26','News','资讯管理','1','','0','1','2');
INSERT INTO `rc_node` VALUES ('27','index','新闻列表','1','','0','26','3');
INSERT INTO `rc_node` VALUES ('28','category','新闻分类管理','1','','0','26','3');
INSERT INTO `rc_node` VALUES ('29','add','发布新闻','1','','0','26','3');
INSERT INTO `rc_node` VALUES ('30','edit','编辑新闻','1','','0','26','3');
INSERT INTO `rc_node` VALUES ('31','del','删除信息','0','','0','26','3');
INSERT INTO `rc_node` VALUES ('32','SysData','数据库管理','1','包含数据库备份、还原、打包等','0','1','2');
INSERT INTO `rc_node` VALUES ('33','index','查看数据库表结构信息','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('34','backup','备份数据库','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('35','restore','查看已备份SQL文件','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('36','restoreData','执行数据库还原操作','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('37','delSqlFiles','删除SQL文件','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('38','sendSql','邮件发送SQL文件','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('39','zipSql','打包SQL文件','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('40','zipList','查看已打包SQL文件','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('41','unzipSqlfile','解压缩ZIP文件','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('42','delZipFiles','删除zip压缩文件','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('43','downFile','下载备份的SQL,ZIP文件','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('44','repair','数据库优化修复','1','','0','32','3');
INSERT INTO `rc_node` VALUES ('45','Siteinfo','网站功能','1','','50','1','2');
INSERT INTO `rc_node` VALUES ('46','Product','产品管理','1','','10','1','2');
INSERT INTO `rc_node` VALUES ('47','index','产品列表','1','','0','46','3');
INSERT INTO `rc_node` VALUES ('48','category','产品分类管理','1','','0','46','3');
INSERT INTO `rc_node` VALUES ('49','add','添加产品','1','','0','46','3');
INSERT INTO `rc_node` VALUES ('50','edit','编辑产品','1','','0','46','3');
INSERT INTO `rc_node` VALUES ('51','changeAttr','推荐产品','1','','0','46','3');
INSERT INTO `rc_node` VALUES ('52','changeStatus','审核产品','1','','0','46','3');
INSERT INTO `rc_node` VALUES ('53','changeAttr','推荐资讯','1','','0','26','3');
INSERT INTO `rc_node` VALUES ('54','changeStatus','审核资讯','1','','0','26','3');
INSERT INTO `rc_node` VALUES ('55','index','查看菜单','0','','0','45','3');


# 数据库表：rc_page 数据信息
INSERT INTO `rc_page` VALUES ('17','gywm','0','关于我们','<p>&nbsp; &nbsp; 锐驰莱德信息技术（北京）有限公司，致力于为汽车制造商和零部件供应商提供专业而全面的技术服务，业务领域涉及整车及零部件产品出口测试和认证，市场准入调研及代理，汽车法律法规更新、翻译及培训服务。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;锐驰莱德拥有丰富经验的工程师团队和遍布全球的合作网络，以保证在有效的时间内高质量的完成您的所托。锐驰莱德主要与英国交通部车辆管理局VCA、荷兰RDW、意大利MOT、爱尔兰NSAI等知名机构进行车辆及零部件测试认证合作。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;同时，锐驰莱德已经与中国境内的CATARC中国汽车技术研究中心、长春汽车检测中心、襄阳汽车检测中心、重庆汽车检测中心等主要从事车辆及零部件安全检测的国家级实验室建立了长期广泛而有效的合作关系，有专业熟练的认证工程师进行现场目击和测试服务。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;凭借经验丰富的工程师团队及广泛而有效的认证资源，锐驰莱德愿与各界合作伙伴携手并肩，共赴前程，成为您理想的车辆国际业务合作伙伴。</p><p><br/></p>','1','关于我们','关于我们','zh-cn');
INSERT INTO `rc_page` VALUES ('18','lxwm','0','联系我们','<p>联系我们</p><p><br/></p>','1','联系我们','联系我们','zh-cn');


# 数据库表：rc_product 数据信息


# 数据库表：rc_role 数据信息
INSERT INTO `rc_role` VALUES ('1','超级管理员','0','1','系统内置超级管理员组，不受权限分配账号限制');
INSERT INTO `rc_role` VALUES ('2','管理员','1','1','拥有系统仅此于超级管理员的权限');
INSERT INTO `rc_role` VALUES ('3','领导','1','1','拥有所有操作的读权限，无增加、删除、修改的权限');
INSERT INTO `rc_role` VALUES ('4','测试组','1','1','测试');


# 数据库表：rc_role_user 数据信息
INSERT INTO `rc_role_user` VALUES ('2','4');
INSERT INTO `rc_role_user` VALUES ('2','5');
INSERT INTO `rc_role_user` VALUES ('2','6');
INSERT INTO `rc_role_user` VALUES ('2','7');
INSERT INTO `rc_role_user` VALUES ('4','8');
INSERT INTO `rc_role_user` VALUES ('4','9');


# 数据库表：rc_tag 数据信息
INSERT INTO `rc_tag` VALUES ('6','关于我们','aboutus','《关于·我们》是歌手尚雯婕于2007年底推出的圣诞节日专辑。其以轻松欢快为基调打造出非同一般的节日气氛，更加贴合时下风潮。在曲风与节奏的变化没有给人带来陌生感的同时，拓宽了尚雯婕的音乐思路，清晰的旋律线条直观具象的表达着蕴藏在音乐中心的思想内涵。不仅仅拘泥于浪漫情节的文艺小调，利用多元化的表现手法在实现扩大音乐内容的同时挖掘音乐中更成层的含义。','zh-cn');
INSERT INTO `rc_tag` VALUES ('8','手机版首页欢迎语（中文）','wapindexwelcome','手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语','zh-cn');
INSERT INTO `rc_tag` VALUES ('9','手机版首页欢迎语（English）','wapindexwelcome','welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span>','zh-en');
INSERT INTO `rc_tag` VALUES ('10','手机版关于我们（中文）','wapaboutus','手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）','zh-cn');
INSERT INTO `rc_tag` VALUES ('11','手机版关于我们（English）','wapaboutus','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.','zh-en');
INSERT INTO `rc_tag` VALUES ('12','手机版联系我们（English）','wapcontactus','<span style="line-height:1.5;">Adress:guangdong guangzhou tianhe</span><br>Phone:123456789<br>Fax:12-11-245327<span>123456789<br></span> Mobile:123456789','zh-en');
INSERT INTO `rc_tag` VALUES ('13','手机版联系我们（中文）','wapcontactus','<span style="line-height:1.5;">地址:广东省广州市天河区&nbsp;</span><br>Phone:123456789&nbsp;<br>Fax:123456789&nbsp;<br>Mobile:123456789<br>','zh-cn');


# 数据库表：rc_user 数据信息
