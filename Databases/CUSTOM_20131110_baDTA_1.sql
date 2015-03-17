# -----------------------------------------------------------
# PHP-Amateur database backup files
# Blog: http://blog.51edm.org
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：pa_access、pa_ad、pa_admin、pa_category、pa_link、pa_member、pa_message、pa_nav、pa_news、pa_node、pa_page、pa_product、pa_role、pa_role_user、pa_tag的结构信息，表：pa_access、pa_ad、pa_admin、pa_category、pa_link、pa_member、pa_message、pa_nav、pa_news、pa_node、pa_page、pa_product、pa_role、pa_role_user、pa_tag的数据
# Time: 2013-11-10 23:26:57
# -----------------------------------------------------------
# 当前SQL卷标：#1
# -----------------------------------------------------------


# 数据库表：pa_access 结构信息
DROP TABLE IF EXISTS `pa_access`;
CREATE TABLE `pa_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限分配表' ;

# 数据库表：pa_ad 结构信息
DROP TABLE IF EXISTS `pa_ad`;
CREATE TABLE `pa_ad` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(60) NOT NULL DEFAULT '',
  `ad_link` varchar(255) NOT NULL DEFAULT '',
  `ad_img` varchar(255) NOT NULL,
  `position` char(10) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ;

# 数据库表：pa_admin 结构信息
DROP TABLE IF EXISTS `pa_admin`;
CREATE TABLE `pa_admin` (
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

# 数据库表：pa_category 结构信息
DROP TABLE IF EXISTS `pa_category`;
CREATE TABLE `pa_category` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `pid` int(5) DEFAULT NULL COMMENT 'parentCategory上级分类',
  `name` varchar(20) DEFAULT NULL COMMENT '分类名称',
  `type` char(10) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='新闻分类表' ;

# 数据库表：pa_link 结构信息
DROP TABLE IF EXISTS `pa_link`;
CREATE TABLE `pa_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `display` int(1) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `target` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

# 数据库表：pa_member 结构信息
DROP TABLE IF EXISTS `pa_member`;
CREATE TABLE `pa_member` (
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

# 数据库表：pa_message 结构信息
DROP TABLE IF EXISTS `pa_message`;
CREATE TABLE `pa_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(32) NOT NULL,
  `moblie` char(15) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ;

# 数据库表：pa_nav 结构信息
DROP TABLE IF EXISTS `pa_nav`;
CREATE TABLE `pa_nav` (
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

# 数据库表：pa_news 结构信息
DROP TABLE IF EXISTS `pa_news`;
CREATE TABLE `pa_news` (
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

# 数据库表：pa_node 结构信息
DROP TABLE IF EXISTS `pa_node`;
CREATE TABLE `pa_node` (
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

# 数据库表：pa_page 结构信息
DROP TABLE IF EXISTS `pa_page`;
CREATE TABLE `pa_page` (
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

# 数据库表：pa_product 结构信息
DROP TABLE IF EXISTS `pa_product`;
CREATE TABLE `pa_product` (
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

# 数据库表：pa_role 结构信息
DROP TABLE IF EXISTS `pa_role`;
CREATE TABLE `pa_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='权限角色表' ;

# 数据库表：pa_role_user 结构信息
DROP TABLE IF EXISTS `pa_role_user`;
CREATE TABLE `pa_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色表' ;

# 数据库表：pa_tag 结构信息
DROP TABLE IF EXISTS `pa_tag`;
CREATE TABLE `pa_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `unique_id` char(20) NOT NULL,
  `content` text NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ;



# 数据库表：pa_access 数据信息
INSERT INTO `pa_access` VALUES ('2','8','3','14','');
INSERT INTO `pa_access` VALUES ('2','14','2','1','');
INSERT INTO `pa_access` VALUES ('2','10','3','4','');
INSERT INTO `pa_access` VALUES ('2','4','2','1','');
INSERT INTO `pa_access` VALUES ('2','7','3','3','');
INSERT INTO `pa_access` VALUES ('2','3','2','1','');
INSERT INTO `pa_access` VALUES ('2','6','3','2','');
INSERT INTO `pa_access` VALUES ('2','5','3','2','');
INSERT INTO `pa_access` VALUES ('2','2','2','1','');
INSERT INTO `pa_access` VALUES ('2','1','1','0','');
INSERT INTO `pa_access` VALUES ('3','14','2','1','');
INSERT INTO `pa_access` VALUES ('3','13','3','4','');
INSERT INTO `pa_access` VALUES ('3','12','3','4','');
INSERT INTO `pa_access` VALUES ('3','11','3','4','');
INSERT INTO `pa_access` VALUES ('3','10','3','4','');
INSERT INTO `pa_access` VALUES ('3','4','2','1','');
INSERT INTO `pa_access` VALUES ('3','9','3','3','');
INSERT INTO `pa_access` VALUES ('3','8','3','3','');
INSERT INTO `pa_access` VALUES ('3','7','3','3','');
INSERT INTO `pa_access` VALUES ('3','3','2','1','');
INSERT INTO `pa_access` VALUES ('3','6','3','2','');
INSERT INTO `pa_access` VALUES ('3','5','3','2','');
INSERT INTO `pa_access` VALUES ('3','2','2','1','');
INSERT INTO `pa_access` VALUES ('3','1','1','0','');
INSERT INTO `pa_access` VALUES ('4','7','3','3','');
INSERT INTO `pa_access` VALUES ('4','3','2','1','');
INSERT INTO `pa_access` VALUES ('4','6','3','2','');
INSERT INTO `pa_access` VALUES ('4','5','3','2','');
INSERT INTO `pa_access` VALUES ('4','2','2','1','');
INSERT INTO `pa_access` VALUES ('4','1','1','0','');
INSERT INTO `pa_access` VALUES ('2','9','3','14','');
INSERT INTO `pa_access` VALUES ('2','15','3','14','');
INSERT INTO `pa_access` VALUES ('2','16','3','14','');
INSERT INTO `pa_access` VALUES ('2','17','3','14','');
INSERT INTO `pa_access` VALUES ('2','18','3','14','');
INSERT INTO `pa_access` VALUES ('2','19','3','14','');
INSERT INTO `pa_access` VALUES ('2','20','3','14','');
INSERT INTO `pa_access` VALUES ('2','21','3','14','');
INSERT INTO `pa_access` VALUES ('2','22','3','14','');
INSERT INTO `pa_access` VALUES ('2','23','3','14','');
INSERT INTO `pa_access` VALUES ('2','24','3','14','');
INSERT INTO `pa_access` VALUES ('2','25','3','14','');
INSERT INTO `pa_access` VALUES ('2','26','2','1','');
INSERT INTO `pa_access` VALUES ('2','27','3','26','');
INSERT INTO `pa_access` VALUES ('2','28','3','26','');
INSERT INTO `pa_access` VALUES ('2','29','3','26','');
INSERT INTO `pa_access` VALUES ('2','30','3','26','');
INSERT INTO `pa_access` VALUES ('2','31','3','26','');
INSERT INTO `pa_access` VALUES ('4','26','2','1','');
INSERT INTO `pa_access` VALUES ('4','27','3','26','');
INSERT INTO `pa_access` VALUES ('4','28','3','26','');
INSERT INTO `pa_access` VALUES ('4','29','3','26','');
INSERT INTO `pa_access` VALUES ('4','30','3','26','');
INSERT INTO `pa_access` VALUES ('4','31','3','26','');
INSERT INTO `pa_access` VALUES ('4','53','3','26','');
INSERT INTO `pa_access` VALUES ('4','54','3','26','');
INSERT INTO `pa_access` VALUES ('4','45','2','1','');
INSERT INTO `pa_access` VALUES ('4','55','3','45','');
INSERT INTO `pa_access` VALUES ('4','46','2','1','');
INSERT INTO `pa_access` VALUES ('4','47','3','46','');
INSERT INTO `pa_access` VALUES ('4','48','3','46','');
INSERT INTO `pa_access` VALUES ('4','49','3','46','');
INSERT INTO `pa_access` VALUES ('4','50','3','46','');
INSERT INTO `pa_access` VALUES ('4','51','3','46','');
INSERT INTO `pa_access` VALUES ('4','52','3','46','');


# 数据库表：pa_ad 数据信息
INSERT INTO `pa_ad` VALUES ('6','图片1','http://www.2345.com/','201311/527bb0c2728a4.jpg','index','1','zh-en');
INSERT INTO `pa_ad` VALUES ('7','图片2','http://www.2345.com/','201311/527bb0d5ceda0.jpg','index','2','zh-en');
INSERT INTO `pa_ad` VALUES ('9','圣丹斯','http://www.2345.com/','201311/527c9f47bf378.jpg','index','0','zh-en');
INSERT INTO `pa_ad` VALUES ('11','广告1','http://www.2345.com/','201311/527d13d20bff4.jpg','index','10','zh-cn');
INSERT INTO `pa_ad` VALUES ('12','广告2','http://www.2345.com/','201311/527d13e5ade49.jpg','index','11','zh-cn');
INSERT INTO `pa_ad` VALUES ('15','全局1','http://www.2345.com/','201311/527d1587ddb98.jpg','all','0','zh-cn');
INSERT INTO `pa_ad` VALUES ('16','全局2','http://www.2345.com/','201311/527d15971446c.jpg','all','0','zh-cn');
INSERT INTO `pa_ad` VALUES ('17','全局3','http://www.2345.com/','201311/527d15a630135.jpg','all','0','zh-en');
INSERT INTO `pa_ad` VALUES ('18','手机','http://www.2345.com','201311/527f13755025a.jpg','wap','30','zh-cn');


# 数据库表：pa_admin 数据信息
INSERT INTO `pa_admin` VALUES ('1','超级管理员','lysily1314@gmail.com','a693c3df306669b89355645e5d4e3604','1','我是超级管理员 哈哈~~','','1383025142');
INSERT INTO `pa_admin` VALUES ('9','','cheshi@qq.com','9a87430b52da34157e68888b219ddda8','1','','','1383987836');


# 数据库表：pa_category 数据信息
INSERT INTO `pa_category` VALUES ('73','0','手机','p','zh-cn');
INSERT INTO `pa_category` VALUES ('72','0','显示器','p','zh-cn');
INSERT INTO `pa_category` VALUES ('74','0','公司新闻','n','zh-cn');
INSERT INTO `pa_category` VALUES ('71','0','笔记本','p','zh-cn');
INSERT INTO `pa_category` VALUES ('75','0','网络新闻','n','zh-cn');
INSERT INTO `pa_category` VALUES ('76','0','Company News','n','zh-en');
INSERT INTO `pa_category` VALUES ('77','0','Phone','p','zh-en');
INSERT INTO `pa_category` VALUES ('78','0','Display','p','zh-en');
INSERT INTO `pa_category` VALUES ('79','0','Network','p','zh-en');


# 数据库表：pa_link 数据信息
INSERT INTO `pa_link` VALUES ('1','酷工坊','1','http://test2.kufactory.com','124','2');


# 数据库表：pa_member 数据信息
INSERT INTO `pa_member` VALUES ('1','43','43','lysily1314@mail.com','cony32','06b07887b11f90b86094b948bd564501','53','53','0','53','53','54','54','54','54','54','54','1','54','54','54','54','15920345843','15920345843','54','422857458','422857458','54','54');


# 数据库表：pa_message 数据信息
INSERT INTO `pa_message` VALUES ('7','ckhuahua','454353','534534534','0','1383928401','423432432');


# 数据库表：pa_nav 数据信息
INSERT INTO `pa_nav` VALUES ('38','page','公司简介','0','1','middle','','zh-cn','11','0');
INSERT INTO `pa_nav` VALUES ('35','news','公司新闻','0','0','middle','','zh-cn','99','0');
INSERT INTO `pa_nav` VALUES ('36','product','公司产品','0','0','middle','','zh-cn','100','0');
INSERT INTO `pa_nav` VALUES ('44','message','Message','0','0','middle','','zh-en','97','0');
INSERT INTO `pa_nav` VALUES ('39','message','留言板','0','0','middle','','zh-cn','11','0');
INSERT INTO `pa_nav` VALUES ('41','product','Product','0','0','middle','','zh-en','100','0');
INSERT INTO `pa_nav` VALUES ('42','news','News','0','0','middle','','zh-en','99','0');
INSERT INTO `pa_nav` VALUES ('43','page','Company','0','1','middle','','zh-en','98','0');


# 数据库表：pa_news 数据信息
INSERT INTO `pa_news` VALUES ('9','74','消息称中远集团副总裁徐敏杰被双规','消息称中远集团副总裁徐敏杰被双规','消息称中远集团副总裁徐敏杰被双规','1','据航运界网站报道称，中远集团内部人士曝料，中远集团主管安全的副总裁徐敏杰于11月5日被有关部门带走，可能涉及贪腐问题。与此同时中远前董事长魏家福已被有关部门限制离境。据悉，徐敏杰涉及贪腐问题可能和其在中远太平洋(601099,股吧)任职期间的职务活动有关。　　对此，中远集团证券事务部经理马晓静回应称，其表示未听说，稍后会向领导汇报。','1383834496','1383911701','<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;据航运界网站报道称，中远集团内部人士曝料，中远集团主管安全的副总裁徐敏杰于11月5日被有关部门带走，可能涉及贪腐问题。与此同时中远前董事长魏家福已被有关部门限制离境。据悉，徐敏杰涉及贪腐问题可能和其在中远太平洋(601099,股吧)任职期间的职务活动有关。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;对此，中远集团证券事务部经理马晓静回应称，其表示未听说，稍后会向领导汇报。</p>','zh-cn','1','9','1');
INSERT INTO `pa_news` VALUES ('10','74','微软炮轰谷歌窥探用户邮件','微软炮轰谷歌窥探用户邮件','微软炮轰谷歌窥探用户邮件','1','11月7日消息，据电脑世界(Computerworld)网站报道，微软通过Outlook.com炮轰Gmail窥探用户邮件以通过广告为自己创收。　　微软新的广告活动指出，谷歌在Gmail中窥探用户的电子邮件，寻找关键词帮助提供有针对性的广告。微软还建立名为KeepYourEmailPrivate.com的网站，将Gmail的隐私做法与Outlook.com进行比较，声称微软Outlook.com邮件服务不会偷窥用户邮件收件箱的内容和使用关键词帮助提供有针对性的广告。','1383834536','1383912796','<p>11月7日消息，据电脑世界(Computerworld)网站报道，微软通过Outlook.com炮轰Gmail窥探用户邮件以通过广告为自己创收。</p><p>　　微软新的广告活动指出，谷歌在Gmail中窥探用户的电子邮件，寻找关键词帮助提供有针对性的广告。微软还建立名为KeepYourEmailPrivate.com的网站，将Gmail的隐私做法与Outlook.com进行比较，声称微软Outlook.com邮件服务不会偷窥用户邮件收件箱的内容和使用关键词帮助提供有针对性的广告。</p><p>　　微软在网站上发布了PDF，提供了更多关于Gmail的细节做法，并提供了实际案例，如一名邮件用户在邮件中告诉朋友称他的胆固醇很高，他就会收到一个关于健康保险（放心保）的广告，如一名邮件用户在邮件中告诉朋友称他要离婚了，他就会收到一个离婚律师的广告。</p><p>　　《福布斯》自由撰稿人蒂姆-沃兹托(Tim Worstall)声称，微软基本上在做同样的事情，因为该公司要扫描电子邮件来过滤掉垃圾邮件和恶意软件。他写道：“微软扫描我在Outlook收到的电子邮件，谷歌扫描我在Gmail中收到的电子邮件，唯一的区别是，谷歌通过扫描邮件提供广告。我不得不说，我实在不能抱怨这个。”沃兹托很聪明，但他对微软在Outlook.com上的做法没有说到位，扫描恶意软件和垃圾邮件不同于扫描并保留邮件内容。微软正在寻找比表明垃圾邮件和恶意软件的模式，谷歌是采矿的消息内容。此外，微软寻找样式，而不是表明恶意软件和垃圾邮件，而谷歌是挖掘信息内容。</p><p>　　总之，微软是对的，Outlook.com不会像Gmail那样窥探用户的电子邮件。</p>','zh-cn','1','17','1');
INSERT INTO `pa_news` VALUES ('11','74','百度发力拿下六成手机游戏渠道下载量','百度发力拿下六成手机游戏渠道下载量','百度发力拿下六成手机游戏渠道下载量','1','下载量，百度系分发平台(含91助手，安卓助手，百度手机助手)与360手机助手平台同时发布三款游戏APP，包括10月1日发布棋牌类游戏“三国杀”、16日发布的竞速类游戏“地铁酷跑”，以及网游“战谷”。其中，战谷与地铁酷跑为360手机助手首栏推广热门游戏，并在其官方微博上进行道答复推广。','1383834588','1383911887','<p>下载量，百度系分发平台(含91助手，安卓助手，百度手机助手)与360手机助手平台同时发布三款游戏APP，包括10月1日发布棋牌类游戏“三国杀”、16日发布的竞速类游戏“地铁酷跑”，以及网游“战谷”。其中，战谷与地铁酷跑为360手机助手首栏推广热门游戏，并在其官方微博上进行道答复推广。</p><p>　　手机游戏渠道下载量</p><div align="center" style="margin:0px;padding:0px;"><img src="http://i0.hexunimg.cn/2013-11-07/159469503.jpg" alt="百度发力拿下六成手机游戏渠道下载量" border="1" align="middle" style="border:1px solid #000000;" /></div><br />　　根据百度系分发平台以及360手机助手官方网站上公示的分发信息，可以发现百度旗下三大平台联合分发收获的市场下载量均远超360渠道。分发量统计显示，这三款游戏APP在两大渠道上共收获8052.9万次分发量。其中，百度系平台用户下载5060.9万次，约占62.80%市场分发份额，而360手机助手仅为37.2%，下载量不足3000万次。<p>　　在这三款游戏中，360手机助手对地铁酷跑游戏推广力度较大，不仅在其官方微博上进行活动推广，并在其官方网站上持续以“激活码兑奖”的方式来吸引用户下载。而91无线以及百度在这款游戏应用上推广则是常规进行。十月的市场分发量则显示，截止10月30日，百度系平台分发2798万次，360手机助手则仅有1960万次，百度系平台领先800余万次。</p><p>　　更值得注意的是，战谷游戏曾在360手机助手上7月首发，但是由于推广效果不佳，其在10月又重新在360手机官方微博以及手机助手官方下载页首栏大作推广，试图获得更好的分发效果。但是，截止10月30日，战谷在360手机助手上的下载量不足35万次，而百度系分发平台下载量则逼近250万次。</p><p>　　为何在大力推广之下，这三款各具特点的热门手游在360手机助手渠道上的分发上无法获得成功，却让百度系平台夺走高达62.8%的市场份额?分析认为，这主要分别源于外部百度等超级分发平台的竞争压力挤压以及360自身平台产品和品牌口碑缺陷。</p><p>　　在外部竞争压力上，百度系分发平台通过9月的多次三大平台联合应用分发表现，已经让更多厂商和开发者看到其超级平台的分发实力，也激发了移动分发市场中厂商涌向百度平台的新一轮站队、洗牌。360游久回购股权独立，并向众多移动分发平台发出合作的友好信号就是最佳的例证。根据最新数据显示，百度系分发平台今年9月的移动分发市场份额高达41%，同时，日均分发量高达8000万次</p><p>　　同时，360在移动分发市场上也陷入的产品布局与品牌口碑双重缺陷中，激发了市场用户下载选择的转变和流失。产品布局上，360仅有手机助手产品，而缺失移动搜索产品，进而失去了其在中长尾应用分发市场上的发展空间。而对于360用户增长而言，更为严峻的是其品牌形象在一系列负面新闻中受损。9月市场用户APP下载行为习惯调研结果显示，仅有19%的用户表示使用360手机助手下载APP，这个数字在百度系平台上为49%。用户对于360手机助手的抱怨主要集中在：强制捆绑安装，推送垃圾应用，应用选择不丰富等方面。尤其在今年10月的360手机助手下架百度APP事件中，用户普遍认为，这是一种用户欺诈行为，迫使用户倒戈百度、金山等其他下载渠道。</p>','zh-cn','1','104','1');
INSERT INTO `pa_news` VALUES ('13','76','5.7 inch giant screen flagship phone for 3650 yuan','This week inventory: 5.7 inch giant screen flagshi','This week inventory: 5.7 inch giant screen flagship phone for 3650 yuan','1','This week inventory: 5.7 inch giant screen flagship phone for 3650 yuan','1383930466','0','<p>	After several years of development, samsung have defeated veteran manufacturers such as MOTOROLA, nokia, HTC, quickly become dominant in the field of smartphones. To get the grades, on the one hand, by reasonable marketing strategy, on the other hand is relying on its strong smart products. Recently, samsung and introduced a new GALAXY Note 3 quotation BBS software (parameters), a 1080 p screen or dual quad-core processors are impressive. At present, the machine (revised) in dealer price is 3650 yuan, hit a record low.</p><p>	Exterior aspect, the GALAXY Note3 will be deduced to get incisively and vividly, inheritance and innovation is still simple atmospheric style can easily attract customers, and the innovation imitation leather back cover is made a good impression to new users. The front is equipped with a 5.7 -inch capacitive touch screen, 1080 p resolution (1920 x 1080 pixels) level, the display effect is clear and fine. At the same time, the built-in back a 13 million pixel lens, is a color photo effect.</p><p>	Hardware configuration, the GALAXY Note 3 (euro) has reached a high level. The phone inside with a dual quad-core processor (1.9 GHz quad core + 1.3 GHz quad-core), supplemented by 16 gb ROM + 3 gb of RAM memory combination, the actual running speed is very smooth. System, it USES the latest Android version 4.3, the interface of quadratic optimization, brought excellent operating experience for users.</p>','zh-en','1','1','1');


# 数据库表：pa_node 数据信息
INSERT INTO `pa_node` VALUES ('1','Admin','后台管理','1','网站后台管理项目','10','0','1');
INSERT INTO `pa_node` VALUES ('2','Index','管理首页','1','','1','1','2');
INSERT INTO `pa_node` VALUES ('3','Member','注册会员管理','1','','3','1','2');
INSERT INTO `pa_node` VALUES ('4','Webinfo','系统管理','1','','4','1','2');
INSERT INTO `pa_node` VALUES ('5','index','默认页','1','','5','2','3');
INSERT INTO `pa_node` VALUES ('6','myInfo','我的个人信息','1','','6','2','3');
INSERT INTO `pa_node` VALUES ('7','index','会员首页','1','','7','3','3');
INSERT INTO `pa_node` VALUES ('8','index','管理员列表','1','','8','14','3');
INSERT INTO `pa_node` VALUES ('9','addAdmin','添加管理员','1','','9','14','3');
INSERT INTO `pa_node` VALUES ('10','index','系统设置首页','1','','10','4','3');
INSERT INTO `pa_node` VALUES ('11','setEmailConfig','设置系统邮件','1','','12','4','3');
INSERT INTO `pa_node` VALUES ('12','testEmailConfig','发送测试邮件','1','','0','4','3');
INSERT INTO `pa_node` VALUES ('13','setSafeConfig','系统安全设置','1','','0','4','3');
INSERT INTO `pa_node` VALUES ('14','Access','权限管理','1','权限管理，为系统后台管理员设置不同的权限','0','1','2');
INSERT INTO `pa_node` VALUES ('15','nodeList','查看节点','1','节点列表信息','0','14','3');
INSERT INTO `pa_node` VALUES ('16','roleList','角色列表查看','1','角色列表查看','0','14','3');
INSERT INTO `pa_node` VALUES ('17','addRole','添加角色','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('18','editRole','编辑角色','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('19','opNodeStatus','便捷开启禁用节点','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('20','opRoleStatus','便捷开启禁用角色','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('21','editNode','编辑节点','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('22','addNode','添加节点','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('23','addAdmin','添加管理员','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('24','editAdmin','编辑管理员信息','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('25','changeRole','权限分配','1','','0','14','3');
INSERT INTO `pa_node` VALUES ('26','News','资讯管理','1','','0','1','2');
INSERT INTO `pa_node` VALUES ('27','index','新闻列表','1','','0','26','3');
INSERT INTO `pa_node` VALUES ('28','category','新闻分类管理','1','','0','26','3');
INSERT INTO `pa_node` VALUES ('29','add','发布新闻','1','','0','26','3');
INSERT INTO `pa_node` VALUES ('30','edit','编辑新闻','1','','0','26','3');
INSERT INTO `pa_node` VALUES ('31','del','删除信息','0','','0','26','3');
INSERT INTO `pa_node` VALUES ('32','SysData','数据库管理','1','包含数据库备份、还原、打包等','0','1','2');
INSERT INTO `pa_node` VALUES ('33','index','查看数据库表结构信息','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('34','backup','备份数据库','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('35','restore','查看已备份SQL文件','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('36','restoreData','执行数据库还原操作','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('37','delSqlFiles','删除SQL文件','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('38','sendSql','邮件发送SQL文件','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('39','zipSql','打包SQL文件','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('40','zipList','查看已打包SQL文件','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('41','unzipSqlfile','解压缩ZIP文件','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('42','delZipFiles','删除zip压缩文件','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('43','downFile','下载备份的SQL,ZIP文件','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('44','repair','数据库优化修复','1','','0','32','3');
INSERT INTO `pa_node` VALUES ('45','Siteinfo','网站功能','1','','50','1','2');
INSERT INTO `pa_node` VALUES ('46','Product','产品管理','1','','10','1','2');
INSERT INTO `pa_node` VALUES ('47','index','产品列表','1','','0','46','3');
INSERT INTO `pa_node` VALUES ('48','category','产品分类管理','1','','0','46','3');
INSERT INTO `pa_node` VALUES ('49','add','添加产品','1','','0','46','3');
INSERT INTO `pa_node` VALUES ('50','edit','编辑产品','1','','0','46','3');
INSERT INTO `pa_node` VALUES ('51','changeAttr','推荐产品','1','','0','46','3');
INSERT INTO `pa_node` VALUES ('52','changeStatus','审核产品','1','','0','46','3');
INSERT INTO `pa_node` VALUES ('53','changeAttr','推荐资讯','1','','0','26','3');
INSERT INTO `pa_node` VALUES ('54','changeStatus','审核资讯','1','','0','26','3');
INSERT INTO `pa_node` VALUES ('55','index','查看菜单','0','','0','45','3');


# 数据库表：pa_page 数据信息
INSERT INTO `pa_page` VALUES ('1','about','0','公司简介','DouPHP 是一款轻量级企业网站管理系统，基于PHP+Mysql架构的，可运行在Linux、Windows、MacOSX、Solaris等各种平台上，系统搭载Smarty模板引擎，支持自定义伪静态，前台模板采用DIV+CSS设计，后台界面设计简洁明了，功能简单易具有良好的用户体验，稳定性好、扩展性及安全性强，可面向中小型站点提供网站建设解决方案。','1','公司简介','公司简介','zh-cn');
INSERT INTO `pa_page` VALUES ('2','honor','0','企业荣誉','企业荣誉','1','企业荣誉','企业荣誉','zh-cn');
INSERT INTO `pa_page` VALUES ('4','contact','1','联系我们','通讯地址：<br /><span style="color:#D7D7D7;">--------------------------------------------------------------------------------------------------------------------------------</span><br />福建省漳州市芗城区胜利东路天下广场C6幢707，邮编363000<br />&nbsp;<br />客服邮箱：<br /><span style="color:#D7D7D7;">--------------------------------------------------------------------------------------------------------------------------------</span><br />DouCo售后服务邮箱：service@douco.com<br />DouCo业务受理邮箱：hi@douco.com<br />如您需要订制开发请在邮件中注明您的大概要求，我们将在一个工作日内给予回复。<br />&nbsp;<br />客服电话：<br /><span style="color:#D7D7D7;">--------------------------------------------------------------------------------------------------------------------------------</span><br />DouCo的建站咨询电话为400-606-1245 或者 0596-2523596。<br />客服电话工作时间为周一至周日 8:00-20:00，节假日不休息，免长途话费。<br />我们将随时为您献上真诚的服务。<br />&nbsp;<br />网站网址：<br /><span style="color:#D7D7D7;">--------------------------------------------------------------------------------------------------------------------------------</span><br />www.douco.com<br />','1','联系我们','联系我们','zh-cn');
INSERT INTO `pa_page` VALUES ('5','job','1','人才招聘','人才招聘','1','人才招聘','人才招聘','zh-cn');
INSERT INTO `pa_page` VALUES ('13','about','0','Company','DouPHP is a lightweight enterprise web site management system, based on PHP + Mysql architecture and can run on Linux, Windows and MacOSX, Solaris, etc all kinds of platforms, the system of carrying the Smarty template engine, support custom pseudo static, front desk template using DIV + CSS design, interface design is simple, clear background features easy to have a good user experience, good stability, strong expansibility and security, can be geared to the needs of small and medium-sized site with website construction solutions.','1','Company','Company','zh-en');
INSERT INTO `pa_page` VALUES ('14','job','0','Job','<span style="font-family:Verdana, Geneva, sans-serif;line-height:24px;background-color:#FFFFFF;">job</span>','1','job','job','zh-en');
INSERT INTO `pa_page` VALUES ('15','contact','0','contact','<span style="font-family:Verdana, Geneva, sans-serif;line-height:24px;background-color:#F5F5F5;">contact</span>','1','contact','contact','zh-en');
INSERT INTO `pa_page` VALUES ('16','honor','0','honor','<span style="font-family:Verdana, Geneva, sans-serif;line-height:24px;background-color:#F5F5F5;">honor</span>','1','honor','honor','zh-en');


# 数据库表：pa_product 数据信息
INSERT INTO `pa_product` VALUES ('15','71','苹果笔记本','8000.00','A500','201311/527b9db140eef.jpg','苹果笔记本','苹果笔记本','1','苹果电脑公司由斯蒂夫·乔布斯、斯蒂夫·盖瑞·沃兹尼亚克和Ron Wayn在 1976年4月1日创立。1975年春天，AppleⅠ由Wozon设计，并被Byte的电脑商店购买了50台当时售价为666.66美元的AppleⅠ。 1977年苹果正式注册成为公司，并启用了沿用至今的新苹果标志。 原称苹果电脑（Apple Computer），2007年1月 9日于旧金山的Macworld Expo上宣布改名。总部位于美国加利福尼亚的库比提诺，核心业务是电子科技产品，目前全球电脑市场占有率为3.8%。 ，它在高科技企','1383833009','1383924316','苹果电脑公司由斯蒂夫·乔布斯、斯蒂夫·盖瑞·沃兹尼亚克和Ron Wayn在 1976年4月1日创立。1975年春天，AppleⅠ由Wozon设计，并被Byte的电脑商店购买了50台当时售价为666.66美元的AppleⅠ。 1977年苹果正式注册成为公司，并启用了沿用至今的新苹果标志。 原称苹果电脑（Apple Computer），2007年1月 9日于旧金山的Macworld Expo上宣布改名。总部位于美国加利福尼亚的库比提诺，核心业务是电子科技产品，目前全球电脑市场占有率为3.8%。 ，它在高科技企业中以创新而闻名。','zh-cn','1','6','1','1');
INSERT INTO `pa_product` VALUES ('16','72','液晶显示器','2000.00','SP1942','201311/527b9df436e1d.jpg','液晶显示器','尺寸：19
品牌：LG
像素：1440x900','1','尺寸：19<br />
品牌：LG<br />
像素：1440x900','1383833076','1384009953','液晶显示器，或称LCD（Liquid Crystal Display），为平面超薄的显示设备，它由一定数量的彩色或黑白像素组成，放置于光源或者反射面前方。液晶显示器功耗很低，因此倍受工程师青睐，适用于使用电池的电子设备。它的主要原理是以电流刺激液晶分子产生点、线、面配合背部灯管构成画面。','zh-cn','1','21','1','1');
INSERT INTO `pa_product` VALUES ('17','73','诺基亚手机LUMIA 920','3000.00','lium900','201311/527b9e2f82a95.jpg','诺基亚手机LUMIA 920','诺基亚手机','1','       诺基亚（Nokia Corporation）是一家总部位于芬兰埃斯波 ，主要从事生产移动通信产品的跨国公司。诺基亚成立于1865年，当时以造纸为主，后来逐步向胶鞋、轮胎、电缆等领域，最后才发展成为一家手机制造商。','1383833135','1383929688','<p>&nbsp;&nbsp;&nbsp;&nbsp;诺基亚（Nokia Corporation）是一家总部位于芬兰埃斯波&nbsp;，主要从事生产移动通信产品的跨国公司。诺基亚成立于1865年，当时以造纸为主，后来逐步向胶鞋、轮胎、电缆等领域，最后才发展成为一家手机制造商。自1996年以来，诺基亚连续14年占据市场份额第一。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;面对新操作系统的智能手机双面夹击，诺基亚全球手机销量第一的地位在2011年第二季被苹果及三星双双超越。2011年2月，诺基亚与微软达成全球战略同盟并深度合作共同研发Windows Phone操作系统。2013年7月11日23时，拥有4100万像素的诺基亚Lumia 1020正式在纽约发布亮相。2013年9月3日，微软宣布以72亿美元收购诺基亚设备与服务部门（诺基亚手机业务），并获得专利和品牌的授权。诺基亚将业务重心转向Here地图服务。</p>','zh-cn','1','114','1','1');
INSERT INTO `pa_product` VALUES ('21','79','Apple computer2','9000.00','3651','201311/527b9db140eef.jpg','Apple computer','Apple computer','1','Apple computer','1383930321','1384002669','<br />
&nbsp;&nbsp;&nbsp;&nbsp;Apple computer by Steve jobs, Steve Gary wozniak and Ron Wayn founded on April 1, 1976. In the spring of 1975, Apple Ⅰ designed by Wozon, and Byte computer store to buy the Apple was priced at 666.66 $50 Ⅰ. In 1977 officially registered as apple company, and enable the new apple logo in use today.
<p>
	<br />
</p>
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The original said Apple Computer (traded), on January 9, 2007 in San Francisco, the Macworld Expo announced on the name. Headquarters in cupertino, California in the United States, core business is electronic technology products, is currently the global PC market share of 3.8%. It is famous for its innovation in high-tech enterprises.
<p>
	<br />
</p>','zh-en','1','0','1','1');


# 数据库表：pa_role 数据信息
INSERT INTO `pa_role` VALUES ('1','超级管理员','0','1','系统内置超级管理员组，不受权限分配账号限制');
INSERT INTO `pa_role` VALUES ('2','管理员','1','1','拥有系统仅此于超级管理员的权限');
INSERT INTO `pa_role` VALUES ('3','领导','1','1','拥有所有操作的读权限，无增加、删除、修改的权限');
INSERT INTO `pa_role` VALUES ('4','测试组','1','1','测试');


# 数据库表：pa_role_user 数据信息
INSERT INTO `pa_role_user` VALUES ('2','4');
INSERT INTO `pa_role_user` VALUES ('2','5');
INSERT INTO `pa_role_user` VALUES ('2','6');
INSERT INTO `pa_role_user` VALUES ('2','7');
INSERT INTO `pa_role_user` VALUES ('4','8');
INSERT INTO `pa_role_user` VALUES ('4','9');


# 数据库表：pa_tag 数据信息
INSERT INTO `pa_tag` VALUES ('6','关于我们','aboutus','《关于·我们》是歌手尚雯婕于2007年底推出的圣诞节日专辑。其以轻松欢快为基调打造出非同一般的节日气氛，更加贴合时下风潮。在曲风与节奏的变化没有给人带来陌生感的同时，拓宽了尚雯婕的音乐思路，清晰的旋律线条直观具象的表达着蕴藏在音乐中心的思想内涵。不仅仅拘泥于浪漫情节的文艺小调，利用多元化的表现手法在实现扩大音乐内容的同时挖掘音乐中更成层的含义。','zh-cn');
INSERT INTO `pa_tag` VALUES ('8','手机版首页欢迎语（中文）','wapindexwelcome','手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语手机版首页欢迎语','zh-cn');
INSERT INTO `pa_tag` VALUES ('9','手机版首页欢迎语（English）','wapindexwelcome','welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!<span>welcome to here!!</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span>','zh-en');
INSERT INTO `pa_tag` VALUES ('10','手机版关于我们（中文）','wapaboutus','手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）手机版关于我们（中文）','zh-cn');
INSERT INTO `pa_tag` VALUES ('11','手机版关于我们（English）','wapaboutus','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.','zh-en');
INSERT INTO `pa_tag` VALUES ('12','手机版联系我们（English）','wapcontactus','<span style="line-height:1.5;">Adress:guangdong guangzhou tianhe</span><br>Phone:123456789<br>Fax:12-11-245327<span>123456789<br></span> Mobile:123456789','zh-en');
INSERT INTO `pa_tag` VALUES ('13','手机版联系我们（中文）','wapcontactus','<span style="line-height:1.5;">地址:广东省广州市天河区&nbsp;</span><br>Phone:123456789&nbsp;<br>Fax:123456789&nbsp;<br>Mobile:123456789<br>','zh-cn');
