
set names utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password CHAR(40) NOT NULL,
    group_id INT(11) NOT NULL,
    created DATETIME,
    modified DATETIME
);


DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created DATETIME,
    modified DATETIME
);
/*
skus":{"sku":[{"created":"2012-09-05 12:37:11","modified":"2012-09-23 02:31:22","price":"7700.00","properties":"1627207:28320;1630696:6536025","quantity":194,"sku_id":22169393864},{"created":"2012-09-05 12:37:11","modified":"2012-09-23 04:22:46","price":"7700.00","properties":"1627207:28341;1630696:6536025","quantity":193,"sku_id":22169393865},{"created":"2012-09-14 11:56:44","modified":"2012-09-22 11:30:35","price":"8800.00","properties":"1627207:3232481;1630696:6536025","quantity":276,"sku_id":22369518881},{"created":"2012-09-14 11:56:44","modified":"2012-09-22 11:30:35","price":"8200.00","properties":"1627207:3232483;1630696:6536025","quantity":259,"sku_id":22369518882},{"created":"2012-09-14 11:56:44","modified":"2012-09-22 11:30:35","price":"8200.00","properties":"1627207:3232484;1630696:6536025","quantity":271,"sku_id":22369518883},{"created":"2012-09-14 11:56:44","modified":"2012-09-22 11:30:35","price":"8800.00","properties":"1627207:90554;1630696:6536025","quantity":273,"sku_id":22369518884},{"created":"2012-09-22 11:30:35","modified":"2012-09-22 14:37:38","price":"5990.00","properties":"1627207:28332;1630696:6536025","quantity":198,"sku_id":31377528504},{"created":"2012-09-22 11:30:35","modified":"2012-09-22 14:37:38","price":"5990.00","properties":"1627207:30156;1630696:6536025","quantity":199,"sku_id":31377528505}]}
item_imgs":{"item_img":[{"id":0,"position":0,"url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1OiLKXXRpXXbQ90I__105735.jpg"}]}
prop_imgs":{"prop_img":[{"id":0,"position":0,"properties":"","url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1OiLKXXRpXXbQ90I__105735.jpg"}]}
location":{"city":"深圳","state":"广东"}
*/
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`
(
    `id` int unsigned not null auto_increment,
    `num_iid` bigint unsigned not null comment 'taobao详情页 item.htm 对应id item.htm?id=xxx',
	`title` varchar(255) not null comment '商品名称',
	`click_url` text not null comment '转换后的淘宝链接url',
	`shop_click_url` text not null comment '店铺url',
	`seller_credit_score` tinyint unsigned not null comment '卖家信用等级',
	`pic_url` varchar(255) not null comment '商品图片url',
    `item_imgs` text not null comment '需要序列化，为多个宝贝的图片',
    `num` int(11) unsigned not null comment '库存',
    `track_iid` varchar(255) not null default '',
    `cid` int(11) unsigned not null comment '分类id?',
    `list_time` datetime not null comment '上架时间',
    `delist_time` datetime not null comment '下架时间',
    `modified` datetime not null comment '最后修改时间',
    `price` decimal(10,2) unsigned not null comment '商品费用',
    `nick` varchar(255) not null comment 'taobao帐号',
    `city` varchar(255) not null comment '城市',
    `state` varchar(255) not null comment '省份？',
    `desc` text not null comment '宝贝描述',
	`prop_img` text not null default '' comment '宝贝详情属性多图',
	`props` text not null default '' comment '宝贝详情属性部分',
	`property_alias` text not null default '' comment '属性别名',
    `auction_point` tinyint(3) unsigned not null comment '拍卖点？',
    `approve_status` varchar(255) not null comment '核准状态:在售?onsale',
    `detail_url` varchar(255) not null comment '商品taobao地址',
    `ems_fee` decimal(10,2) unsigned not null comment 'ems费用',
    `express_fee` decimal(10,2) unsigned not null comment '快递费用',
    `freight_payer` varchar(255) not null comment '邮费付款方seller, buyer',
    `has_discount` tinyint(3) unsigned not null comment '是否有折扣',
    `has_invoice` tinyint(3) unsigned not null comment '是否有发票',
    `has_showcase` tinyint(3) unsigned not null comment '是否有橱窗？？',
    `has_warranty` tinyint(3) unsigned not null comment '是否有担保',
    `is_virtual` tinyint(3) unsigned not null comment '是否是虚拟货物',
    `stuff_status` varchar(255) not null comment '新品？二手？。。。new?',
    `seller_cids` varchar(255) not null,
    `input_pids` varchar(255) not null comment '自定义属性名id',
    `input_str` varchar(255) not null comment '自定义属性值',
    `type` varchar(255) not null,
    `valid_thru` int(11) unsigned not null comment '有效时长 ７天',
    `post_fee` decimal(10,2) unsigned not null comment '邮费',
    `postage_id` int(11) unsigned not null comment '邮件id',
    `outer_id` varchar(255) not null,
    `skus` text not null comment '类似套餐的商品选择',
    PRIMARY KEY `id` (`id`),
    UNIQUE KEY `num_iid` (`num_iid`),
    UNIQUE KEY `track_iid` (`track_iid`),
    KEY `seller_credit_score` (`seller_credit_score`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag`
(
    `id` int(11) not null auto_increment,
    `tag` varchar(255) not null,
    `parent_id` int(11) not null default 0,
    `display_html` tinyint(1) not null default 0 comment '是否显示在页面分类中',
    `order` smallint not null default 0 comment '排序',
    `validate` tinyint(1) not null default 1,
    `time` timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY `id` (`id`),
    KEY `parent_id` (`parent_id`),
    UNIQUE KEY `tag` (`tag`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- game 游戏tag
-- official 官方tag （用于官方分类，搜索)
-- user 用户自定义tag (用户提交商品自定义tag， 如果不再收录的tag中， 则添加为此分类， 方便转入官方支持的tag）
insert into `tag` (`tag`, `parent_id`, `display_html`) value 

('#game', 0, 0),
('#product', 0, 0),
('#user', 0, 0),

('服装', 2, 1),
('配饰', 2, 1),
('周边', 2, 1),
('电子产品', 2, 1),

('大衣', 4, 1),
('卫衣', 4, 1),
('T恤', 4, 1),
('裤子', 4, 1),
('鞋', 4, 1),
('帽子', 4, 1),

('手表', 5, 1),
('钥匙链', 5, 1),
('打火机', 5, 1),
('烟灰缸', 5, 1),
('项链', 5, 1),
('徽章', 5, 1),

('抱枕靠垫', 6, 1),
('杯子', 6, 1),
('手机壳', 6, 1),
('其他', 6, 1),

('耳机', 7, 1),
('手柄', 7, 1),
('U盘', 7, 1),
('鼠标垫', 7, 1),

('#price', 0, 0),
('100以下', 28, 1),
('100~200', 28, 1),
('200~500', 28, 1),
('500~1000', 28, 1),
('1000~2000', 28, 1),
('2000~5000', 28, 1),
('5000以上', 28, 1),

('穿越火线', 1, 1),
('英雄联盟', 1, 1),
('梦幻西游', 1, 1),
('地下城与勇士', 1, 1),
('植物大战僵尸', 1, 1),
('愤怒的小鸟', 1, 1);


DROP TABLE IF EXISTS `item_tag`;
CREATE TABLE `item_tag`
(
    `id` int(11) unsigned not null auto_increment,
    `item_id` int(11) unsigned not null,
    `tag_id` int(11) unsigned not null,
    PRIMARY KEY `id` (`id`),
    KEY `tag_id` (`tag_id`),
    KEY `item_id` (`item_id`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


DROP TABLE IF EXISTS `ad`;
CREATE TABLE `ad`
(
    `id` int(11) unsigned not null auto_increment,
    `name` varchar(255) not null,
    `type` enum('text','img','flash','javascript') not null comment '广告类型 text,flash,img',
    `url` varchar(255) not null,
    `img` varchar(255) not null,
    `txt` varchar(255) not null,
    `width` smallint unsigned not null,
    `height` smallint unsigned not null,
    `other` text(255) not null default '',
    PRIMARY KEY `id` (`id`),
    KEY `type` (`type`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
insert into ad (name, type, url, img , txt, width, height) values 
('首页导航横条','img','http://www.google.com','files/e/5/3b2468ac04caf05777a9d33c9c5c0de5.jpg','导航横条推荐','548','199'),
('首页导航右侧','img','http://www.baidu.com','files/f/c/4fb0a4cfa942e94003e0132a324bc1fc.jpg','导航右侧推荐','180','394'),
('首页导航左下1','img','http://www.baidu.com','files/5/b/d00ad374a35f49215b1b706644eef45b.jpg','导航左下1推荐','182','194'),
('首页导航左下2','img','http://www.google.com','files/7/c/2b7442c29d67262fdce234dae7d10b7c.jpg','导航左下2推荐','182','194'),
('首页导航左下3','img','http://www.google.com','files/e/6/7d3ec21552fbbac14ca3b72ffd6007e6.jpg','导航左下3推荐','182','194')
, ('首页左侧','img','http://www.google.com','files/2/2/618187e13fb5c838b0fd569e279b7f22.jpg','首页左侧','980','90')
, ('首页右侧1','img','http://www.google.com','files/0/4/28d5eea9376733495e4a3a61af53ae04.jpg','首页右侧','240','120')
, ('首页右侧2','img','http://www.google.com','files/0/4/28d5eea9376733495e4a3a61af53ae04.jpg','首页右侧','240','120')
, ('二级页首部','img','http://www.google.com','files/2/2/618187e13fb5c838b0fd569e279b7f22.jpg','二级页首部','980','90')
, ('二级页左侧1','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧1','245','280')
, ('二级页左侧2','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧2','245','280')
, ('二级页左侧3','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧3','245','280')
;

-- 热门店铺
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop`
(
    `id` int(11) unsigned not null auto_increment,
    `shop_title` varchar(255) not null comment 'taobao shop_title',
	`user_id` int unsigned not null comment 'taobao user_id',
	`click_url` text comment '转换后的淘宝链接',
	`auction_count` int unsigned not null comment '',
	`seller_credit` tinyint unsigned not null comment '店铺等级,共２０给',
	`commission_rate` decimal(2) not null comment '佣金率',
	`shop_type` tinyint unsigned not null default 1 comment '1:c,2:b',
	`total_auction` int unsigned not null comment '',
	`update_time` datetime not null,
    PRIMARY KEY `id` (`id`),
	UNIQUE KEY `user_id` (`user_id`),
	KEY `shop_title` (`shop_title`),
	KEY `update_time` (`update_time`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-- 
-- DROP TABLE IF EXISTS `shop_tag`;
-- CREATE TABLE `shop_tag`
-- (
--     `id` int(11) unsigned not null auto_increment,
--     `shopid` int(11) unsigned not null comment 'http://xx.taobao.com/item?mid=xxxxx',
--     `tags` varchar(255) unsigned not null,
--     PRIMARY KEY `id` (`id`),
--     KEY `tagid` (`tagid`),
--     KEY `itemid` (`itemid`)
-- ) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-- 

DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

LOCK TABLES `acos` WRITE;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,130),(2,1,NULL,NULL,'Admin',2,17),(3,2,NULL,NULL,'index',3,4),(4,2,NULL,NULL,'top',5,6),(5,2,NULL,NULL,'bottom',7,8),(6,2,NULL,NULL,'add',9,10),(7,2,NULL,NULL,'edit',11,12),(8,2,NULL,NULL,'view',13,14),(9,2,NULL,NULL,'delete',15,16),(10,1,NULL,NULL,'Ads',18,29),(11,10,NULL,NULL,'index',19,20),(12,10,NULL,NULL,'view',21,22),(13,10,NULL,NULL,'add',23,24),(14,10,NULL,NULL,'edit',25,26),(15,10,NULL,NULL,'delete',27,28),(16,1,NULL,NULL,'App',30,41),(17,16,NULL,NULL,'add',31,32),(18,16,NULL,NULL,'edit',33,34),(19,16,NULL,NULL,'index',35,36),(20,16,NULL,NULL,'view',37,38),(21,16,NULL,NULL,'delete',39,40),(22,1,NULL,NULL,'Groups',42,53),(23,22,NULL,NULL,'index',43,44),(24,22,NULL,NULL,'view',45,46),(25,22,NULL,NULL,'add',47,48),(26,22,NULL,NULL,'edit',49,50),(27,22,NULL,NULL,'delete',51,52),(28,1,NULL,NULL,'Index',54,69),(29,28,NULL,NULL,'index',55,56),(30,28,NULL,NULL,'tag',57,58),(31,28,NULL,NULL,'search',59,60),(32,28,NULL,NULL,'add',61,62),(33,28,NULL,NULL,'edit',63,64),(34,28,NULL,NULL,'view',65,66),(35,28,NULL,NULL,'delete',67,68),(36,1,NULL,NULL,'Items',70,81),(37,36,NULL,NULL,'index',71,72),(38,36,NULL,NULL,'view',73,74),(39,36,NULL,NULL,'add',75,76),(40,36,NULL,NULL,'edit',77,78),(41,36,NULL,NULL,'delete',79,80),(42,1,NULL,NULL,'Pages',82,95),(43,42,NULL,NULL,'display',83,84),(44,42,NULL,NULL,'add',85,86),(45,42,NULL,NULL,'edit',87,88),(46,42,NULL,NULL,'index',89,90),(47,42,NULL,NULL,'view',91,92),(48,42,NULL,NULL,'delete',93,94),(49,1,NULL,NULL,'Spider',96,109),(50,49,NULL,NULL,'request',97,98),(51,49,NULL,NULL,'index',99,100),(52,49,NULL,NULL,'view',101,102),(53,49,NULL,NULL,'add',103,104),(54,49,NULL,NULL,'edit',105,106),(55,49,NULL,NULL,'delete',107,108),(56,1,NULL,NULL,'Users',110,129),(57,56,NULL,NULL,'login',111,112),(58,56,NULL,NULL,'logout',113,114),(59,56,NULL,NULL,'index',115,116),(60,56,NULL,NULL,'view',117,118),(61,56,NULL,NULL,'add',119,120),(62,56,NULL,NULL,'edit',121,122),(63,56,NULL,NULL,'delete',123,124),(64,56,NULL,NULL,'initDB',125,126),(65,56,NULL,NULL,'build_acl',127,128);
UNLOCK TABLES;

DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

LOCK TABLES `aros` WRITE;
INSERT INTO `aros` VALUES (1,NULL,'Group',1,NULL,1,2),(2,NULL,'Group',1,NULL,3,6),(3,2,'User',1,NULL,4,5),(4,NULL,'Group',2,NULL,7,10),(5,4,'User',2,NULL,8,9),(6,7,'User',3,NULL,12,13),(7,NULL,'Group',3,NULL,11,14);
UNLOCK TABLES;

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

LOCK TABLES `aros_acos` WRITE;
INSERT INTO `aros_acos` VALUES (1,2,1,'1','1','1','1'),(2,4,1,'-1','-1','-1','-1'),(3,4,28,'1','1','1','1'),(4,7,1,'-1','-1','-1','-1'),(5,7,10,'1','1','1','1'),(6,7,49,'1','1','1','1');
UNLOCK TABLES;
