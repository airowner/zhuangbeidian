
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

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`
(
    `id` int(11) unsigned not null auto_increment,
    `num_iid` int(11) unsigned not null comment 'taobao详情页 item.htm 对应id item.htm?id=xxx',
    `item_imgs` text not null comment '需要序列化，为宝贝的图片',
    `num` int(11) unsigned not null comment '库存',
    `track_iid` int(11) unsigned not null,
    `cid` int(11) unsigned not null comment '分类id?',
    `list_time` datetime not null comment '上架时间',
    `modified` datetime not null comment '最后修改时间',
    `delist_time` datetime not null comment '下架时间',
    `title` varchar(255) not null comment '商品名称',
    `pic_url` varchar(255) not null comment '商品图片url',
    `price` decimal(10,2) unsigned not null comment '商品费用',
    `props` varchar(255) not null comment '宝贝详情属性部分',
    `nick` varchar(255) not null comment 'taobao帐号',
    `city` varchar(255) not null comment '城市',
    `state` varchar(255) not null comment '省份？',
    `desc` text not null comment '宝贝描述',
    `auction_point` tinyint(3) unsigned not null comment '拍卖点？',
    `approve_status` varchar(255) not null comment '在售?onsale',
    `detail_url` varchar(255) not null comment '商品taobao地址',
    `ems_fee` decimal(10,2) unsigned not null comment 'ems费用',
    `express_fee` decimal(10,2) unsigned not null comment '快递费用',
    `freight_payer` varchar(255) not null comment '邮费付款方seller, buyer',
    `has_discount` tinyint(3) unsigned not null comment '是否有折扣',
    `has_invoice` tinyint(3) unsigned not null comment '是否有发票',
    `has_showcase` tinyint(3) unsigned not null comment '是否有橱窗？？',
    `has_warranty` tinyint(3) unsigned not null comment '是否有折扣',
    `is_virtual` tinyint(3) unsigned not null comment '是否是虚拟货物',
    `stuff_status` varchar(255) not null comment '新品？二手？。。。new?',
    `seller_cids` varchar(255) not null,
    `input_pids` varchar(255) not null comment '自定义属性名id',
    `input_str` varchar(255) not null comment '自定义属性值',
    `type` varchar(255) not null,
    `valid_thru` int(11) unsigned not null,
    `post_fee` decimal(10,2) unsigned not null,
    `postage_id` int(11) unsigned not null,
    `property_alias` varchar(255) not null,
    `outer_id` varchar(255) not null,
    `skus` text not null comment '商品分类',
    PRIMARY KEY `id` (`id`)
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
insert into `tag` (`tag`, `parent_id`, `display_html`) value \

('#game', 0, 0), \
('#product', 0, 0), \
('#user', 0, 0), \

('服装', 2, 1), \
('配饰', 2, 1), \
('周边', 2, 1), \
('电子产品', 2, 1), \

('大衣', 4, 1), \
('卫衣', 4, 1), \
('T恤', 4, 1), \
('裤子', 4, 1), \
('鞋', 4, 1), \
('帽子', 4, 1), \

('手表', 5, 1), \
('钥匙链', 5, 1), \
('打火机', 5, 1), \
('烟灰缸', 5, 1), \
('项链', 5, 1), \
('徽章', 5, 1), \

('抱枕靠垫', 6, 1), \
('杯子', 6, 1), \
('手机壳', 6, 1), \
('其他', 6, 1), \

('耳机', 7, 1), \
('手柄', 7, 1), \
('U盘', 7, 1), \
('鼠标垫', 7, 1), \

('#price', 0, 0), \
('100以下', 28, 1), \
('100~200', 28, 1), \
('200~500', 28, 1), \
('500~1000', 28, 1), \
('1000~2000', 28, 1), \
('2000~5000', 28, 1), \
('5000以上', 28, 1), \

('穿越火线', 1, 1), \
('英雄联盟', 1, 1), \
('梦幻西游', 1, 1), \
('地下城与勇士', 1, 1), \
('植物大战僵尸', 1, 1), \
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
insert into ad (name, type, url, img , txt, width, height) values \
('首页导航横条','img','http://www.google.com','files/e/5/3b2468ac04caf05777a9d33c9c5c0de5.jpg','导航横条推荐','548','199'),\
('首页导航右侧','img','http://www.baidu.com','files/f/c/4fb0a4cfa942e94003e0132a324bc1fc.jpg','导航右侧推荐','180','394'),\
('首页导航左下1','img','http://www.baidu.com','files/5/b/d00ad374a35f49215b1b706644eef45b.jpg','导航左下1推荐','182','194'),\
('首页导航左下2','img','http://www.google.com','files/7/c/2b7442c29d67262fdce234dae7d10b7c.jpg','导航左下2推荐','182','194'),\
('首页导航左下3','img','http://www.google.com','files/e/6/7d3ec21552fbbac14ca3b72ffd6007e6.jpg','导航左下3推荐','182','194')\
, ('首页左侧','img','http://www.google.com','files/2/2/618187e13fb5c838b0fd569e279b7f22.jpg','首页左侧','980','90')\
, ('首页右侧1','img','http://www.google.com','files/0/4/28d5eea9376733495e4a3a61af53ae04.jpg','首页右侧','240','120')\
, ('首页右侧2','img','http://www.google.com','files/0/4/28d5eea9376733495e4a3a61af53ae04.jpg','首页右侧','240','120')\
, ('二级页首部','img','http://www.google.com','files/2/2/618187e13fb5c838b0fd569e279b7f22.jpg','二级页首部','980','90')\
, ('二级页左侧1','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧1','245','280')\
, ('二级页左侧2','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧2','245','280')\
, ('二级页左侧3','img','http://www.google.com','files/c/b/50f50dba109f82522e13d943df195dcb.jpg','二级页左侧3','245','280')\
;

-- 请求列表
DROP TABLE IF EXISTS `item_get_before`;
CREATE TABLE `item_get_before`
(
    `id` int(11) unsigned not null auto_increment,
    `url` varchar(255) not null comment 'http://xx.taobao.com/item?mid=xxxxx',
    `tags` varchar(255) not null,
    PRIMARY KEY `id` (`id`),
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 热门店铺
-- DROP TABLE IF EXISTS `shop`;
-- CREATE TABLE `shop`
-- (
--     `id` int(11) unsigned not null auto_increment,
--     `name` varchar(255) not null,
--     PRIMARY KEY `id` (`id`),
-- ) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
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
