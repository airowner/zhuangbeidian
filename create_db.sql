
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
LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (1,'zhanghua','e5a3f6412e61c6959028f9b2ab9e373a315c2995',1,'2012-09-26 00:32:21','2012-09-26 00:32:21');
UNLOCK TABLES;


DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created DATETIME,
    modified DATETIME
);
LOCK TABLES `groups` WRITE;
INSERT INTO `groups` VALUES (1,'administrator','2012-09-26 00:32:02','2012-09-26 00:32:02'),(2,'viewer','2012-09-26 00:32:11','2012-09-26 00:32:11');
UNLOCK TABLES;


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
INSERT INTO `aros` VALUES (1,NULL,'Group',1,'',1,4),(2,NULL,'Group',2,'',5,6),(3,1,'User',1,'',2,3);
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

/*
skus":{"sku":[{"created":"2012-09-05 12:37:11","modified":"2012-09-23 02:31:22","price":"7700.00","properties":"1627207:28320;1630696:6536025","quantity":194,"sku_id":22169393864},{"created":"2012-09-05 12:37:11","modified":"2012-09-23 04:22:46","price":"7700.00","properties":"1627207:28341;1630696:6536025","quantity":193,"sku_id":22169393865},{"created":"2012-09-14 11:56:44","modified":"2012-09-22 11:30:35","price":"8800.00","properties":"1627207:3232481;1630696:6536025","quantity":276,"sku_id":22369518881},{"created":"2012-09-14 11:56:44","modified":"2012-09-22 11:30:35","price":"8200.00","properties":"1627207:3232483;1630696:6536025","quantity":259,"sku_id":22369518882},{"created":"2012-09-14 11:56:44","modified":"2012-09-22 11:30:35","price":"8200.00","properties":"1627207:3232484;1630696:6536025","quantity":271,"sku_id":22369518883},{"created":"2012-09-14 11:56:44","modified":"2012-09-22 11:30:35","price":"8800.00","properties":"1627207:90554;1630696:6536025","quantity":273,"sku_id":22369518884},{"created":"2012-09-22 11:30:35","modified":"2012-09-22 14:37:38","price":"5990.00","properties":"1627207:28332;1630696:6536025","quantity":198,"sku_id":31377528504},{"created":"2012-09-22 11:30:35","modified":"2012-09-22 14:37:38","price":"5990.00","properties":"1627207:30156;1630696:6536025","quantity":199,"sku_id":31377528505}]}
item_imgs":{"item_img":[{"id":0,"position":0,"url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1OiLKXXRpXXbQ90I__105735.jpg"}]}
prop_imgs":{"prop_img":[{"id":0,"position":0,"properties":"","url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1OiLKXXRpXXbQ90I__105735.jpg"}]}
location":{"city":"深圳","state":"广东"}
*/
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`
(
    `id` int(11) unsigned not null auto_increment,
    `num_iid` bigint unsigned not null comment 'taobao详情页 item.htm 对应id item.htm?id=xxx',
    `title` varchar(255) not null comment '商品名称',
    `click_url` text not null comment '转换后的淘宝链接url',
    `shop_click_url` text not null comment '店铺url',
    `seller_credit_score` tinyint unsigned not null comment '卖家信用等级',
    `pic_url` varchar(255) not null comment '商品图片url',
    `item_imgs` text not null comment '需要序列化，为多个宝贝的图片',
    `num` int(11) unsigned not null comment '商品数量',
    `track_iid` varchar(255) not null default '',
    `cid` int(11) unsigned not null comment '商品所属的叶子类目id',
    `list_time` datetime not null comment '上架时间',
    `delist_time` datetime not null comment '下架时间',
    `modified` datetime not null comment '最后修改时间',
    `price` decimal(10,2) unsigned not null comment '商品价格',
    `nick` varchar(255) not null comment 'taobao帐号',
    `city` varchar(255) not null comment '城市',
    `state` varchar(255) not null comment '省份',
    `desc` text not null comment '宝贝描述',
    `volume` int(11) unsigned not null comment '对应搜索商品列表页的最近成交量',
    `prop_img` text not null default '' comment '宝贝详情属性多图',
    `props` text not null default '' comment '宝贝详情属性部分',
    `property_alias` text not null default '' comment '属性值别名,比如颜色的自定义名称',
    `auction_point` tinyint(3) unsigned not null comment '商城返点比例，为5的倍数，最低0.5%',
    `approve_status` varchar(255) not null comment '商品上传后的状态。onsale出售中，instock库中',
    `detail_url` varchar(255) not null comment '商品taobao地址',
    `ems_fee` decimal(10,2) unsigned not null comment 'ems费用',
    `express_fee` decimal(10,2) unsigned not null comment '快递费用',
    `post_fee` decimal(10,2) unsigned not null comment '平邮费用',
    `freight_payer` varchar(255) not null comment '运费承担方式,seller(卖家承担),buyer(买家承担)',
    `has_discount` tinyint(3) unsigned not null comment '是否支持会员打折',
    `has_invoice` tinyint(3) unsigned not null comment '是否有发票',
    `has_showcase` tinyint(3) unsigned not null comment '是否橱窗推荐',
    `has_warranty` tinyint(3) unsigned not null comment '是否有保修',
    `is_virtual` tinyint(3) unsigned not null comment '是否是虚拟货物',
    `stuff_status` varchar(255) not null comment '商品新旧程度(全新:new，闲置:unused，二手：second)',
    `seller_cids` varchar(255) not null comment '商品所属的店铺内卖家自定义类目列表',
    `input_pids` varchar(255) not null default '' comment '用户自行输入的类目属性ID串',
    `input_str` varchar(255) not null default '' comment '用户自行输入的子属性名和属性值, input_str需要与input_pids一一对应',
    `type` varchar(255) not null comment '商品类型(fixed:一口价;auction:拍卖)',
    `valid_thru` int(11) unsigned not null default 14 comment '有效期,7或者14（默认是14天）',
    `postage_id` int(11) unsigned not null comment '宝贝所属的运费模板ID',
    `outer_id` varchar(255) not null default '商家外部编码(可与商家外部系统对接)',
    `skus` text not null default '' comment '类似套餐的商品选择',
    `update_time` datetime not null,
    PRIMARY KEY `id` (`id`),
    UNIQUE KEY `num_iid` (`num_iid`),
    KEY `seller_credit_score` (`seller_credit_score`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

/*
{"taobaoke_items":{"taobaoke_item":[{"click_url":"http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB07S4%2FK0CFcRfH0G7DbPkiN9MMPecybwDdQGyQGNWpa%2FrqL810trhFZxYWgEd6cOg%2FnidoGpioMeUCXAD9J2kZ4FKD3nSisZO6nYxiwLZgtlwp1esdL9CUSQKB%2BvLatQDG2j0DfaAUKzPD%2BGJDlkOXO9%2FkBzpP7AVY6chwCRfsY5kpSB5Qw08Mv&spm=2014.21181372.1.0","commission":"36.00","commission_num":"233","commission_rate":"1250.00","commission_volume":"3373.92","item_location":"广东 中山","nick":"gainreel内衣旗舰店","num_iid":12427061690,"pic_url":"http://img01.taobaocdn.com/bao/uploaded/i1/T18QbOXgJeXXbRAd70_034715.jpg","price":"288.00","seller_credit_score":18,"shop_click_url":"http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB04MQzdgG3VSuWRIvnJbEpKV5PVD2lUYrHAPqQnJnJMUFuskL3QoyiFpXf6o%2F7vmancvd0ORLyZG8r3C93ddF3m6xV54JsfFCHJDoTEpcKx82ABn6xsv2mYoAlb83N02UjzWIPRnTSKPPwJGUnVF5uFWlwRhDsddURFsg%3D%3D&spm=2014.21181372.1.0","title":"歌瑞尔正品时尚芭蕾黑天鹅收副乳调整型深V性感蕾丝聚拢内衣文胸","volume":957}]},"total_results":1}
*/

DROP TABLE IF EXISTS `item_ext`;
CREATE TABLE `item_ext`
(
    `id` int(11) unsigned not null auto_increment,
    `num_iid` bigint unsigned not null comment 'taobao详情页 item.htm 对应id item.htm?id=xxx',
    `commisson` decimal(2) not null default 0 comment '淘宝客佣金',
    `commisson_volume` decimal(2) not null default 0 comment '累计总支出佣金量',
    `commisson_rate` int(11) not null default 0 comment '淘宝客佣金率',
    `commisson_num` int(11) not null default 0 comment '累计成交量.注：返回的数据是30天内累计推广量',
    `coupon_price` decimal(2) not null default 0 comment '折扣价格',
    `coupon_rate` decimal(2) not null default 0 comment '折扣比率',
    `coupon_start_time` int(11) not null default 0 comment '折扣活动开始时间',
    `coupon_end_time` int(11) not null default 0 comment '折扣活动结束时间',
    `volume` int(11) unsigned not null default 0 comment '30天内交易量',
    `update_time` datetime not null,
    PRIMARY KEY `id` (`id`),
    UNIQUE KEY `num_iid` (`num_iid`),
    KEY `volume` (`volume`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop`
(
    `id` int(11) unsigned not null auto_increment,
    `shop_id` int(11) unsigned not null default 0 comment 'maybe not exists',
    `seller_nick` varchar(255) not null,
	`user_id` int unsigned not null comment 'taobao user_id',
    `shop_title` varchar(255) not null comment 'taobao shop_title',
	`click_url` text comment '转换后的淘宝链接',
	`auction_count` int unsigned not null comment '店铺内商品总数',
	`seller_credit` tinyint unsigned not null comment '店铺掌柜信用等级,共２０给',
	`commission_rate` decimal(2) not null comment '淘宝客店铺佣金比率',
	`shop_type` tinyint unsigned not null default 1 comment '1:c,2:b',
	`total_auction` int unsigned not null comment '累计推广量',
	`update_time` datetime not null,
    PRIMARY KEY `id` (`id`),
	UNIQUE KEY `user_id` (`user_id`),
	KEY `shop_title` (`shop_title`),
	KEY `update_time` (`update_time`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


-- 店铺折扣
DROP TABLE IF EXISTS `item_promotion`;
CREATE TABLE `item_promotion`
(
	`id` int(11) not null auto_increment,
	`item_id` int(11) unsigned not null,
	`promotion_id` varchar(255) not null,
	`name` varchar(255) not null,
	`desc` varchar(255) not null,
	`start_time` datetime not null,
	`end_time` datetime not null,
	`item_promo_price` int(11) not null,
	`other_need` varchar(255) not null,
	`other_send` varchar(255) not null,
	`sku_id_list` text not null,
	`sky_price_list` text not null,
	primary key `id` (`id`),
	key `price` (`item_promo_price`),
	key `start_time` (`start_time`),
	key `end_time` (`end_time`) 
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 商品推荐
DROP TABLE IF EXISTS `item_recommend`;
CREATE TABLE `item_recommend`
(
	`id` int(11) not null auto_increment,
	`item_id` int(11) unsigned not null,
	`modify_time` datetime not null, 
	primary key `id` (`id`),
	-- key `price` (`item_promo_price`),
	key `modify_time` (`modify_time`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag`
(
    `id` int(11) not null auto_increment,
    `tag` varchar(255) not null,
    `parent_id` int(11) default null,
    `lft` int(11) default null,
    `rght` int(11) default null,
    `display_html` tinyint(1) not null default 0 comment '是否显示在页面分类中',
    `order` smallint not null default 0 comment '排序',
    `validate` tinyint(1) not null default 1,
    `time` timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY `id` (`id`),
    KEY `parent_id` (`parent_id`),
    UNIQUE KEY `tag` (`tag`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- user 用户自定义tag (用户提交商品自定义tag， 如果不再收录的tag中， 则添加为此分类， 方便转入官方支持的tag）
insert into `tag` (`id`, `tag`, `parent_id`, `display_html`, `lft`, `rght`) value 

(1, '#game', NULL, 0, 1, 14),
(2, '穿越火线', 1, 1, 2, 3),
(3, '英雄联盟', 1, 1, 4, 5),
(4, '梦幻西游', 1, 1, 6, 7),
(5, '地下城与勇士', 1, 1, 8, 9),
(6, '植物大战僵尸', 1, 1, 10, 11),
(7, '愤怒的小鸟', 1, 1, 12, 13),

(8, '#product', NULL, 0, 15, 78),
(9, '服装', 8, 1, 16, 31),
(10, '大衣', 9, 1, 17, 18),
(11, '卫衣', 9, 1, 19, 20),
(12, 'T恤', 9, 1, 21, 22),
(13, '裤子', 9, 1, 23, 24),
(14, '鞋', 9, 1, 25, 26),
(15, '袜子', 9, 1, 27, 28),
(16, '帽子', 9, 1, 29, 30),

(17, '配饰', 8, 1, 32, 49),
(18, '钱包(及背包)', 17, 1, 33, 34),
(19, '腰带', 17, 1, 35, 36),
(20, '手表', 17, 1, 37, 38),
(21, '钥匙链', 17, 1, 39, 40),
(22, '打火机', 17, 1, 41, 42),
(23, '烟灰缸', 17, 1, 43, 44),
(24, '项链', 17, 1, 45, 46),
(25, '徽章', 17, 1, 47, 48),

(26, '周边', 8, 1, 50, 63),
(27, '毛绒玩具', 26, 1, 51, 52),
(28, '手办', 26, 1, 53, 54),
(29, '抱枕靠垫', 26, 1, 55, 56),
(30, '杯子', 26, 1, 57, 58),
(31, '手机壳', 26, 1, 59, 60),
(32, '其他', 26, 1, 61, 62),


(33, '电子产品', 8, 1, 64, 77),
(34, '键盘', 33, 1, 65, 66),
(35, '鼠标', 33, 1, 67, 68),
(36, '耳机', 33, 1, 69, 70),
(37, '手柄', 33, 1, 71, 72),
(38, 'U盘', 33, 1, 73, 74),
(39, '鼠标垫', 33, 1, 75, 76),

(40, '#price', NULL, 0, 79, 94),
(41, '100以下', 40, 1, 80, 81),
(42, '100~200', 40, 1, 82, 83),
(43, '200~500', 40, 1, 84, 85),
(44, '500~1000', 40, 1, 86, 87),
(45, '1000~2000', 40, 1, 88, 89),
(46, '2000~5000', 40, 1, 90, 91),
(47, '5000以上', 40, 1, 92, 93),

(48, '#user', NULL, 0, 95, 96);



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
('首页导航左下3','img','http://www.google.com','files/e/6/7d3ec21552fbbac14ca3b72ffd6007e6.jpg','导航左下3推荐','182','194'),
('首页左侧','img','http://www.google.com','files/2/2/618187e13fb5c838b0fd569e279b7f22.jpg','首页左侧','980','90'),
('首页右侧1','img','http://www.google.com','files/0/4/28d5eea9376733495e4a3a61af53ae04.jpg','首页右侧','240','120'),
('首页右侧2','img','http://www.google.com','files/0/4/28d5eea9376733495e4a3a61af53ae04.jpg','首页右侧','240','120'),
('二级页首部','img','http://www.google.com','files/2/2/618187e13fb5c838b0fd569e279b7f22.jpg','二级页首部','980','90'),
('二级页左侧1','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧1','245','280'),
('二级页左侧2','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧2','245','280'),
('二级页左侧3','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧3','245','280')
;

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

